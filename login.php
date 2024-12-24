<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
include('db_login_connection.php'); // Include the new admin login connection

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

    if ($stmt === false) {
        die('Error preparing the query: ' . $conn_login->error); // Show preparation error
    }

    $stmt->bind_param("s", $username); // Bind the username parameter
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result === false) {
        die('Error executing the query: ' . $stmt->error); // Show execution error
    }

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Check if the password matches (using password_verify for security)
        if (password_verify($password, $user['password'])) {
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <?php include 'header.php'; ?>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Admin Login</h2>
        <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
        <form method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
