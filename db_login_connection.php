<?php
session_start();
include('db_login_connection.php'); // Include the new MySQLi connection

// Check if the user is already logged in
if (isset($_SESSION['admin'])) {
    // Redirect to admin dashboard if logged in
    header('Location: admin_dashboard.php');
    exit;
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SQL query to fetch user details from the users table
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn_login->prepare($query);
    $stmt->bind_param("s", $username); // Bind the username parameter
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists and verify password
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verify the password (plain-text comparison, you should use hashed passwords in production)
        if ($password === $user['password']) {
            $_SESSION['admin'] = $username; // Set session variable for successful login
            header('Location: admin_dashboard.php'); // Redirect to the admin dashboard
            exit;
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "No user found with that username!";
    }
}
?>
