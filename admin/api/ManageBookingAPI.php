<?php

// Enable error reporting
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
    'bookings' => []
];

// Handle GET requests to fetch bookings
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'getBookings') {
    // Updated query to fetch user name, booking info, and order by creation time
    $query = "
        SELECT 
            bookings.id, 
            users.username AS customer_name, 
            bookings.movie_id, 
            bookings.seats AS seats_reserved, 
            bookings.created_at AS booking_time
        FROM bookings
        JOIN users ON bookings.user_id = users.id
        ORDER BY bookings.created_at DESC";
    
    $result = $conn->query($query);
    
    if ($result === false) {
        $response['message'] = 'Query execution failed: ' . $conn->error;
    } else {
        $bookings = $result->fetch_all(MYSQLI_ASSOC);
        if (empty($bookings)) {
            $response['message'] = 'No bookings found in the database.';
        } else {
            $response['success'] = true;
            $response['bookings'] = $bookings;
        }
    }
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);

// Close database connection
$conn->close();

?>
