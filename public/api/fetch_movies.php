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

// Fetch movies
$sql = "SELECT title, description, image FROM movies"; 
$result = $conn->query($sql);

$movies = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $movies[] = $row;
    }
}

// Close the connection after all operations are complete
if (isset($conn)) {
    $conn->close();
} else {
    echo "Error: Unable to close connection as it's not set.";
}

?>
