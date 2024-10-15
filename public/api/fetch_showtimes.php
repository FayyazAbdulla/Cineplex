<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Correct the path to db.php
$db_path = realpath(__DIR__ . '/../../includes/db.php');
if ($db_path && file_exists($db_path)) {
    include_once $db_path;
} else {
    die("Error: Unable to include db.php. Please check the file path.");
}

// Check if the connection was established
if (!isset($conn) || $conn === false) {
    die("Error: Database connection failed.");
}

// Get the search query from the GET request, if it exists
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

// Prepare the SQL query to fetch movie titles and showtimes
$sql = "SELECT id, title, showtime FROM movies WHERE showtime IS NOT NULL";

// If there is a search query, add it to the SQL
if (!empty($searchQuery)) {
    $sql .= " AND title LIKE '%" . $conn->real_escape_string($searchQuery) . "%'";
}

$sql .= " ORDER BY showtime"; // Always order by showtime

// Execute the SQL query
$result = $conn->query($sql);
$showtimes = []; // Initialize the array to collect showtimes

if ($result === false) {
    // Handle query error
    $showtimes = []; // Initialize as an empty array in case of an error
} else {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $showtimes[] = $row; // Populate the showtimes array
        }
    }
}

// Close the connection
if (isset($conn)) {
    $conn->close();
}
?>