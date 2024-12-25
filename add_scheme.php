<?php
session_start();
include ('header.php');
include('db_connection.php'); // Include your database connection

// Check if user is logged in
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

// Fetch unique states from the database, sorted alphabetically
$query = "SELECT DISTINCT state FROM schemes ORDER BY state ASC";
$result = $conn->query($query);

$success = null;

// Check if the form is submitted
if (isset($_POST['submit'])) {
    $scheme_name = $_POST['scheme_name'];
    $state = $_POST['state'];
    $age_group = $_POST['age_group'];
    $caste = $_POST['caste'];
    $state_logo = $_POST['state_logo'];
    $scheme_link = $_POST['scheme_link'];

    // Insert new scheme into the database
    $sql = "INSERT INTO schemes (scheme_name, state, age_group, caste, state_logo, scheme_link) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $scheme_name, $state, $age_group, $caste, $state_logo, $scheme_link);

    if ($stmt->execute()) {
        $success = "Scheme successfully added!";
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

        <?php if (isset($error)) { ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php } ?>

        <?php if ($success) { ?>
            <div class="alert alert-success">
                <?php echo $success; ?>
            </div>
            <div class="mt-3">
                <a href="add_scheme.php" class="btn btn-secondary">Add Another Scheme</a>
                <a href="admin_dashboard.php" class="btn btn-primary">Go to Dashboard</a>
            </div>
        <?php } else { ?>
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
                <div class="form-group">
                    <label for="state_logo">State Logo URL</label>
                    <input type="url" class="form-control" id="state_logo" name="state_logo" placeholder="Enter the URL of the state logo" required>
                </div>
                <div class="form-group">
                    <label for="scheme_link">Scheme Link</label>
                    <input type="url" class="form-control" id="scheme_link" name="scheme_link" placeholder="Enter the scheme link" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Add Scheme</button>
            </form>
        <?php } ?>
    </div>
</body>
</html>
