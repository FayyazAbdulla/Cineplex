<?php
$servername = "127.0.0.1"; // IP address for localhost
$username = "root"; // Default XAMPP username
$password = ""; // Default XAMPP password
$dbname = "cineplex_db"; // Your database name
$port = 3307; // Specify the port number

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); // Display error if connection fails
} else {
//    echo "Connection successful!<br>"; // Display success message - for debugging purpose
}

// Your database operations will be performed in other files
?>
