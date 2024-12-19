<?php
// db_connection.php

// Database configuration
$server = "localhost";
$username = "root";  // Update with your database username
$password = "";      // Update with your database password
$database = "government_schemes";  // Database name

// Create connection using MySQLi with error handling
$conn = new mysqli($server, $username, $password, $database);

// Check connection and handle errors securely
if ($conn->connect_error) {
    // Log the error to a file or monitoring system (do not show to the user)
    error_log("Database connection failed: " . $conn->connect_error);
    die("Connection failed. Please try again later.");
} else {
    // Optionally, you can set the character set to UTF-8 for proper encoding of special characters
    $conn->set_charset("utf8");
}

// Function for preparing and executing safe queries
function executeQuery($query, $params = []) {
    global $conn;

    // Prepare statement
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        // Log the error
        error_log("MySQL prepare error: " . $conn->error);
        return false;
    }

    // Bind parameters if any (using 's' for strings, 'i' for integers, etc.)
    if ($params) {
        // Dynamically bind the parameters
        $types = str_repeat('s', count($params)); // Assuming all parameters are strings ('s')
        $stmt->bind_param($types, ...$params);
    }

    // Execute the query
    $result = $stmt->execute();
    if (!$result) {
        // Log the error
        error_log("MySQL execute error: " . $stmt->error);
        return false;
    }

    // Return result
    return $result;
}

// If everything is set up correctly, you will have a successful connection
?>