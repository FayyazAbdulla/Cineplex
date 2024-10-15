<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if user is logged in, redirect if not
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to login page
    exit(); // Stop further script execution
}

// Ensure user_id is set in the session
if (!isset($_SESSION['user_id'])) {
    die("Error: User ID not found in session.");
}

// Correct the path to db.php
$db_path = realpath(__DIR__ . '/../includes/db.php');
if ($db_path && file_exists($db_path)) {
    include_once $db_path;
} else {
    die("Error: Unable to include db.php. Please check the file path.");
}

// Fetch movies for the dropdown
$sql = "SELECT id, title FROM movies";
$result = $conn->query($sql);
$movies = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $movies[] = $row;
    }
}

// Close the database connection
?>

<!DOCTYPE html>
<html lang="en"> 

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Booking</title>
    <link rel="stylesheet" href="../assets/css/booking.css"> <!-- Link booking CSS -->
    <link rel="stylesheet" href="../assets/css/header.css"> <!-- Link header CSS -->
    <link rel="stylesheet" href="../assets/css/footer.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert library -->
    <script src="../assets/js/booking.js" defer></script> <!-- Include the login.js file -->
</head>

<body>

    <!-- Header section -->
    <?php include '../includes/header.php'; ?>

    <section class="booking-section">
        <div class="booking-container">
            <h2 class="booking-title">Book Your Ticket</h2>
            <p class="booking-description">Reserve your seat now for an unforgettable experience!</p>

            <!-- Update the form to post to the same page -->
            <form id="booking-form" method="POST" action="">
                <div class="form-group">
                    <label for="movie">Select Movie:</label>
                    <select name="movie_id" id="movie" required>
                        <option value="" disabled selected>Select a movie</option>
                        <?php foreach ($movies as $movie): ?>
                            <option value="<?= $movie['id']; ?>"><?= htmlspecialchars($movie['title']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="seats">Number of Seats:</label>
                    <input type="number" name="seats" id="seats" required min="1">
                </div> 

                <!-- Hidden input for user_id -->
                <input type="hidden" name="user_id" value="<?= $_SESSION['user_id']; ?>">

                <button type="submit" class="submit-btn">Book Ticket</button>
            </form>

            <!-- Include the insert booking logic -->
            <?php // No need to include here; handle in JavaScript instead ?>
        </div>
    </section>

    <!-- Footer section -->
    <?php include '../includes/footer.php'; ?>

</body>

</html>
