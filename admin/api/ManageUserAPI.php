<?php

// Enable error reporting for all types of errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include database connection
$db_path = realpath(__DIR__ . '/../../includes/db.php');
if ($db_path && file_exists($db_path)) {
    include_once $db_path;
} else {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Error: Unable to include db.php.']);
    exit;
}

// Check if the connection was established
if (!isset($conn) || $conn === false) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Error: Database connection failed.']);
    exit;
}

// Initialize response array
$response = [
    'success' => false,
    'message' => '',
    'users' => []
];

// Handle POST requests for adding users or editing users
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check for add or edit action
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'add' && isset($_POST['username'], $_POST['email'], $_POST['password'], $_POST['role'])) {
            // Adding a new user
            $username = htmlspecialchars(trim($_POST['username']));
            $email = htmlspecialchars(trim($_POST['email']));
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $role = htmlspecialchars(trim($_POST['role']));

            // Prepare and execute the INSERT statement
            $stmt = $conn->prepare("INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, ?)");
            if ($stmt === false) {
                $response['message'] = 'Error preparing statement: ' . $conn->error;
            } else {
                $stmt->bind_param('ssss', $username, $password, $email, $role);
                if ($stmt->execute()) {
                    $response['success'] = true;
                    $response['message'] = 'User added successfully!';
                } else {
                    $response['message'] = 'Error adding user: ' . $stmt->error;
                }
                $stmt->close(); // Close the statement
            }
        } // Editing an existing user
        elseif ($_POST['action'] === 'edit' && isset($_POST['userId'], $_POST['username'], $_POST['email'], $_POST['role'])) {
            $id = (int) $_POST['userId'];  
            $username = htmlspecialchars(trim($_POST['username']));
            $email = htmlspecialchars(trim($_POST['email']));
            $role = htmlspecialchars(trim($_POST['role']));

            // Prepare and execute the UPDATE statement
            $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, role = ? WHERE id = ?");
            if ($stmt === false) {
                $response['message'] = 'Error preparing statement: ' . $conn->error;
            } else {
                $stmt->bind_param('sssi', $username, $email, $role, $id);
                if ($stmt->execute()) {
                    $response['success'] = true;
                    $response['message'] = 'User updated successfully!';
                } else {
                    $response['message'] = 'Error updating user: ' . $stmt->error;
                } 
                $stmt->close();
            }
        } else {
            $response['message'] = 'Invalid input for add/edit action.';
        }
    } else {
        $response['message'] = 'Action not specified.';
    }
}

// Handle DELETE requests for deleting users
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Get the ID from the URL query parameters
    parse_str(file_get_contents("php://input"), $_DELETE);
    if (isset($_DELETE['id'])) {
        $id = (int) $_DELETE['id'];

        // Prepare and execute the DELETE statement
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        if ($stmt === false) {
            $response['message'] = 'Error preparing statement: ' . $conn->error;
        } else {
            $stmt->bind_param('i', $id);
            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    $response['success'] = true;
                    $response['message'] = 'User deleted successfully!';
                } else {
                    $response['message'] = 'No user found with that ID.';
                }
            } else {
                $response['message'] = 'Error deleting user: ' . $stmt->error;
            }
            $stmt->close(); // Close the statement
        }
    } else {
        $response['message'] = 'Invalid input. Please provide user ID.';
    }
}

// Handle GET requests to fetch users
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'getUsers') {
    // Execute the SELECT query to fetch users
    $result = $conn->query("SELECT * FROM users");
    if ($result === false) {
        $response['message'] = 'Query execution failed: ' . $conn->error;
    } else {
        $users = $result->fetch_all(MYSQLI_ASSOC);
        if (empty($users)) {
            $response['message'] = 'No users found in the database.';
        } else {
            $response['success'] = true;
            $response['users'] = $users;
        }
    }
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);

// Close database connection
$conn->close();
?>