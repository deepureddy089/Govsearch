<?php
session_start();
include('db_connection.php');

// Check if the user is logged in
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

// Fetch the schemes from the database
$sql = "SELECT * FROM schemes";
$result = $conn->query($sql);

// Fetch the summary of schemes by state
$summary_sql = "SELECT state, COUNT(*) AS scheme_count FROM schemes GROUP BY state";
$summary_result = $conn->query($summary_sql);

// Get the logged-in user's username
$logged_in_user = $_SESSION['admin']; 

include('header.php');
?>

<div class="container mt-5">
    <h2>Admin Dashboard</h2>

    <!-- Display the logged-in user -->
    <div class="mb-4">
        <p><strong>Welcome, <?php echo htmlspecialchars($logged_in_user); ?>!</strong></p>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>

    <!-- Scheme Summary Table by State -->
    <h4>Scheme Summary by State</h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>State</th>
                <th>Number of Schemes</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $summary_result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['state']); ?></td>
                    <td><?php echo htmlspecialchars($row['scheme_count']); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Option to Add New Scheme -->
    <a href="add_scheme.php" class="btn btn-success mb-3">Add New Scheme</a>

    <!-- Back Button to Avoid Form Resubmission -->
    <a href="admin_dashboard.php" class="btn btn-secondary mb-3">Back</a>

    <!-- All Schemes Table (with Edit/Delete options) -->
    <h4>All Schemes</h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Scheme Name</th>
                <th>State</th>
                <th>Age Group</th>
                <th>Caste</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['scheme_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['state']); ?></td>
                    <td><?php echo htmlspecialchars($row['age_group']); ?></td>
                    <td><?php echo htmlspecialchars($row['caste']); ?></td>
                    <td>
                        <!-- Edit button -->
                        <a href="edit_scheme.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <!-- Delete button with confirmation prompt -->
                        <a href="delete_scheme.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirmDelete();">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- JavaScript for confirmation on delete -->
<script>
function confirmDelete() {
    return confirm("Are you sure you want to delete this scheme?");
}
</script>

<?php include('footer.php'); ?>