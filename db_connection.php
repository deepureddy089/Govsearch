<?php
// Example for db_connection.php
$servername = "localhost"; // Database host
$username = "asse6007_admin"; // Database username (or your custom DB username)
$password = "00000000"; // Database password (or your custom DB password)
$dbname = "asse6007_gov_schemes"; // The database name for login functionality

// Create a new MySQL connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure the database is selected (optional if provided in the constructor)
$conn->select_db($dbname);
?>
