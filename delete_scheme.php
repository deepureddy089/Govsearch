<?php
session_start();
include('db_connection.php');

// Check if user is logged in
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

if (isset($_GET['id'])) {
    $scheme_id = $_GET['id'];

    // Delete scheme from the database
    $sql = "DELETE FROM schemes WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $scheme_id);

    if ($stmt->execute()) {
        header('Location: admin_dashboard.php');
    } else {
        echo "Error deleting scheme.";
    }

    $stmt->close();
}
?>