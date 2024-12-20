<?php
session_start();
include('db_connection.php'); // Include your database connection

// Check if user is logged in
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

// Fetch unique states from the database, sorted alphabetically
$query = "SELECT DISTINCT state FROM schemes ORDER BY state ASC";
$result = $conn->query($query);

// Check if the form is submitted
if (isset($_POST['submit'])) {
    $scheme_name = $_POST['scheme_name'];
    $state = $_POST['state'];
    $age_group = $_POST['age_group'];
    $caste = $_POST['caste'];

    // Insert new scheme into the database
    $sql = "INSERT INTO schemes (scheme_name, state, age_group, caste) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $scheme_name, $state, $age_group, $caste);

    if ($stmt->execute()) {
        header('Location: admin_dashboard.php');
    } else {
        $error = "Error adding scheme!";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Scheme</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Add New Scheme</h2>
        <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
        <form method="POST">
            <div class="form-group">
                <label for="scheme_name">Scheme Name</label>
                <input type="text" class="form-control" id="scheme_name" name="scheme_name" required>
            </div>
            <div class="form-group">
                <label for="state">State</label>
                <select class="form-control" id="state" name="state" required>
                    <option value="" disabled selected>Select a state</option>
                    <?php
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value=\"" . htmlspecialchars($row['state']) . "\">" . htmlspecialchars($row['state']) . "</option>";
                        }
                    } else {
                        echo "<option value=\"\" disabled>No states available</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="age_group">Age Group</label>
                <input type="text" class="form-control" id="age_group" name="age_group" required>
            </div>
            <div class="form-group">
                <label for="caste">Caste</label>
                <input type="text" class="form-control" id="caste" name="caste" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Add Scheme</button>
        </form>
    </div>
</body>
</html>