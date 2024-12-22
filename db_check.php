<?php
$servername = "localhost:3306"; // Database host
$username = "asse6007_admin"; // Database username
$password = "123456"; // Database password
$dbname = "asse6007_gov_schemes"; // Database name

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection is successful
if ($conn->connect_error) {
    // If the connection fails, show the error
    die("Connection failed: " . $conn->connect_error);
} else {
    // If the connection is successful, print a success message
    echo "Successfully connected to the database!";
}

// Close the connection
$conn->close();
?>