<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['user_id'])) {
    die("Error: User is not logged in.");
}

// Ensure POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Error: Invalid request.");
}

// Include database connection
include_once '../includes/db.php';

// Get booking data
$user_id = $_SESSION['user_id'];
$movie_id = filter_var($_POST['movie_id'], FILTER_SANITIZE_NUMBER_INT);
$seats = filter_var($_POST['seats'], FILTER_SANITIZE_NUMBER_INT);
$total_price = $seats * 10.00; // Example pricing logic

// Insert booking into the database
$sql = "INSERT INTO bookings (user_id, movie_id, seats, total_price) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('iiid', $user_id, $movie_id, $seats, $total_price);

if ($stmt->execute()) {
    $booking_id = $stmt->insert_id;
    $stmt->close();
    // Redirect to payment page
    header("Location: payment.php?booking_id=" . $booking_id);
    exit();
} else {
    echo "Error: " . $stmt->error;
}
$conn->close();
?>
