<?php
$servername = "localhost:3306"; // Database host
$username = "asse6007_admin"; // Database username (or your custom DB username)
$password = "123456"; // Database password (or your custom DB password)
$dbname = "asse6007_gov_schemes"; // The database name for login functionality

// Create a connection to the admin login database
$conn_login = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn_login->connect_error) {
    die("Connection failed: " . $conn_login->connect_error);
}
?>