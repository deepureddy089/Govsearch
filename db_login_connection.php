<?php
$servername = "localhost"; // Database host
$username = "root"; // Database username (or your custom DB username)
$password = ""; // Database password (or your custom DB password)
$dbname = "admin_login"; // The database name for login functionality

// Create a connection to the admin login database
$conn_login = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn_login->connect_error) {
    die("Connection failed: " . $conn_login->connect_error);
}
?>