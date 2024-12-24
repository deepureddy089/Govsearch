<?php
$servername = "localhost"; // Database host
$username = "asse6007_admin"; // Database username
$password = "123456"; // Database password
$dbname = "asse6007_gov_schemes"; // The database name

try {
    // Create a new PDO instance
    $conn_login = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    // Set the PDO error mode to exception
    $conn_login->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully"; // Uncomment to test connection
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
