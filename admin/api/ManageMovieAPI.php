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
    'movies' => []
];

// Handle POST requests for adding, editing movies
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? null;
    if ($action === 'add') {
        // Validate inputs for adding a movie
        if (isset($_POST['title'], $_POST['description'], $_POST['showtime'], $_POST['available_seats'], $_POST['image'])) {
            $title = htmlspecialchars(trim($_POST['title']));
            $description = htmlspecialchars(trim($_POST['description']));
            $showtime = htmlspecialchars(trim($_POST['showtime']));
            $available_seats = (int) $_POST['available_seats'];
            $image = htmlspecialchars(trim($_POST['image']));

            // Insert the new movie into the database
            $stmt = $conn->prepare("INSERT INTO movies (title, description, showtime, available_seats, image) VALUES (?, ?, ?, ?, ?)");
            if ($stmt) {
                $stmt->bind_param('sssds', $title, $description, $showtime, $available_seats, $image);
                if ($stmt->execute()) {
                    $response['success'] = true;
                    $response['message'] = 'Movie added successfully!';
                } else {
                    $response['message'] = 'Error: ' . $stmt->error;
                }
                $stmt->close();
            } else {
                $response['message'] = 'Error preparing statement: ' . $conn->error;
            }
        } else {
            $response['message'] = 'Missing required fields.';
        }
    } elseif ($action === 'edit') {
        // Validate inputs for editing a movie
        if (isset($_POST['movie_id'], $_POST['title'], $_POST['description'], $_POST['showtime'], $_POST['available_seats'], $_POST['image'])) {
            $id = (int) $_POST['movie_id'];
            $title = htmlspecialchars(trim($_POST['title']));
            $description = htmlspecialchars(trim($_POST['description']));
            $showtime = htmlspecialchars(trim($_POST['showtime']));
            $available_seats = (int) $_POST['available_seats'];
            $image = htmlspecialchars(trim($_POST['image']));

            // Update the movie in the database
            $stmt = $conn->prepare("UPDATE movies SET title = ?, description = ?, showtime = ?, available_seats = ?, image = ? WHERE id = ?");
            if ($stmt) {
                $stmt->bind_param('sssisi', $title, $description, $showtime, $available_seats, $image, $id);
                if ($stmt->execute()) {
                    $response['success'] = true;
                    $response['message'] = 'Movie updated successfully!';
                } else {
                    $response['message'] = 'Error: ' . $stmt->error;
                }
                $stmt->close();
            } else {
                $response['message'] = 'Error preparing statement: ' . $conn->error;
            }
        } else {
            $response['message'] = 'Missing required fields for editing.';
        }
    } else {
        $response['message'] = 'Invalid action.';
    }
}


// Handle DELETE requests for deleting movies
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents("php://input"), $_DELETE);
    if (isset($_DELETE['id'])) {
        $id = (int) $_DELETE['id'];

        // Prepare and execute the DELETE statement
        $stmt = $conn->prepare("DELETE FROM movies WHERE id = ?");
        if ($stmt === false) {
            $response['message'] = 'Error preparing statement: ' . $conn->error;
        } else {
            $stmt->bind_param('i', $id);
            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    $response['success'] = true;
                    $response['message'] = 'Movie deleted successfully!';
                } else {
                    $response['message'] = 'No movie found with that ID.';
                }
            } else {
                $response['message'] = 'Error deleting movie: ' . $stmt->error;
            }
            $stmt->close();
        }
    } else {
        $response['message'] = 'Invalid input. Please provide movie ID.';
    }
}

// Handle GET requests to fetch movies
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'getMovies') {
    $result = $conn->query("SELECT * FROM movies ORDER BY created_at DESC");
    if ($result === false) {
        $response['message'] = 'Query execution failed: ' . $conn->error;
    } else {
        $movies = $result->fetch_all(MYSQLI_ASSOC);
        if (empty($movies)) {
            $response['message'] = 'No movies found in the database.';
        } else {
            $response['success'] = true;
            $response['movies'] = $movies;
        }
    }
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);

// Close database connection
$conn->close();
?>