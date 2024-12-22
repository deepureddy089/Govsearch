<?php
$servername = "localhost:3306";  // Database host
$username = "asse6007_admin";  // Database username
$password = "123456";  // Database password
$dbname = "asse6007_gov_schemes";  // Database name

// Set DSN (Data Source Name) for PDO connection
$dsn = "mysql:host=$servername;dbname=$dbname";

try {
    // Create a PDO instance
    $conn = new PDO($dsn, $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully"; 
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>