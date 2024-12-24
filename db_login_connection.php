<?php
$servername = "localhost"; // Database host
$username = "asse6007_admin"; // Database username (or your custom DB username)
$password = "00000000"; // Database password (or your custom DB password)
$dbname = "asse6007_gov_schemes"; // The database name for login functionality

// Create a connection to the admin login database
$conn_login = new MySQLi($servername, $username, $password, $dbname);

if ($conn_login->connect_error) {
    die("Connection failed: " . $conn_login->connect_error);  // This will show any error in the connection
} else {
    echo "Connection successful";  // Just to confirm the connection is working
}

?>