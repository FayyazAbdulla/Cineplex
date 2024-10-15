<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Correct the path to db.php
$db_path = realpath(__DIR__ . '/../../includes/db.php');
if ($db_path && file_exists($db_path)) {
    include_once $db_path; // Assuming $conn is defined in db.php
} else { 
    die("Error: Unable to include db.php. Please check the file path.");
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
    exit;
}

// Check if request is a POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get POST data and sanitize
    $user_id = filter_var($_POST['user_id'], FILTER_SANITIZE_NUMBER_INT);
    $movie_id = filter_var($_POST['movie_id'], FILTER_SANITIZE_NUMBER_INT);
    $seats = filter_var($_POST['seats'], FILTER_SANITIZE_NUMBER_INT);

    // Validate input data
    if (!filter_var($user_id, FILTER_VALIDATE_INT) || !filter_var($movie_id, FILTER_VALIDATE_INT) || !filter_var($seats, FILTER_VALIDATE_INT)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid input data.']);
        exit;
    }

    // Prepare SQL statement
    $sql = "INSERT INTO bookings (user_id, movie_id, seats) VALUES (?, ?, ?)";

    // Ensure $conn is open and prepared before executing
    if ($stmt = $conn->prepare($sql)) {
        // Bind the parameters correctly
        $stmt->bind_param('iii', $user_id, $movie_id, $seats);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Booking successful!', 'data' => ['booking_id' => $stmt->insert_id]]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to prepare statement: ' . $conn->error]);
    }
}

// Close the database connection at the end
$conn->close(); // It's good practice to close the connection
?>
