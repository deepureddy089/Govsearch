<?php
session_start();
include('db_connection.php');
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Define the number of items per page
$items_per_page = 10; // Number of items to display per page

// Check if the user is logged in, this is admin-adashboard.php
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

// Get the current page number for summary table from the URL or default to page 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $items_per_page;

// Fetch the summary of schemes by state with pagination
$summary_sql = "SELECT state, COUNT(*) AS scheme_count FROM schemes GROUP BY state LIMIT $offset, $items_per_page";
$summary_result = $conn->query($summary_sql);

// Check if the query was successful
if (!$summary_result) {
    die('Error executing query: ' . $conn->error);
}

// Fetch the total number of states for pagination
$total_states_sql = "SELECT COUNT(DISTINCT state) AS total_states FROM schemes";
$total_states_result = $conn->query($total_states_sql);

// Check if the query was successful
if (!$total_states_result) {
    die('Error executing query: ' . $conn->error);
}

$total_states = $total_states_result->fetch_assoc()['total_states'];
$total_pages = ceil($total_states / $items_per_page);

// Get the current page number for the schemes table from the URL or default to page 1
$page_schemes = isset($_GET['page_schemes']) ? (int)$_GET['page_schemes'] : 1;
$offset_schemes = ($page_schemes - 1) * $items_per_page;

// Get the total number of schemes for pagination
$total_schemes_sql = "SELECT COUNT(*) AS total_schemes FROM schemes";
$total_schemes_result = $conn->query($total_schemes_sql);

// Check if the query was successful
if (!$total_schemes_result) {
    die('Error executing query: ' . $conn->error);
}

$total_schemes = $total_schemes_result->fetch_assoc()['total_schemes'];
$total_schemes_pages = ceil($total_schemes / $items_per_page);

// Fetch all schemes with pagination for the "All Schemes" section
$sql_schemes = "SELECT * FROM schemes LIMIT $offset_schemes, $items_per_page";
$result_schemes = $conn->query($sql_schemes);

// Check if the query was successful
if (!$result_schemes) {
    die('Error executing query: ' . $conn->error);
}

// Get the logged-in user's username
$logged_in_user = $_SESSION['admin']; 

include('header.php');
?>

<div class="container mt-5">
    <div class="row mb-4">
        <!-- Welcome and Admin Dash / Logout buttons -->
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <p><strong>Welcome, <?php echo htmlspecialchars($logged_in_user); ?>!</strong></p>
            </div>
            <div>
                <a href="admin_dashboard.php" class="btn btn-secondary btn-sm">Admin Dashboard</a>
                <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
            </div>
        </div>
    </div>

    <!-- Scheme Summary Table by State -->
    <h4 class="mb-4">Scheme Summary by State</h4>
    <div class="table-responsive">
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
    </div>

    <!-- Pagination for Summary Table (Schemes by State) -->
    <nav>
        <ul class="pagination justify-content-between">
            <!-- Previous Button -->
            <li class="page-item">
                <?php if ($page > 1): ?>
                    <a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a>
                <?php else: ?>
                    <span class="page-link disabled">Previous</span>
                <?php endif; ?>
            </li>

            <!-- Page Number Dropdown -->
            <li class="page-item">
                <form method="get" action="" class="d-inline">
                    <select class="form-control form-control-sm" name="page" onchange="this.form.submit()">
                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <option value="<?php echo $i; ?>" <?php if ($i == $page) echo 'selected'; ?>>Page <?php echo $i; ?></option>
                        <?php endfor; ?>
                    </select>
                </form>
            </li>

            <!-- Next Button -->
            <li class="page-item">
                <?php if ($page < $total_pages): ?>
                    <a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a>
                <?php else: ?>
                    <span class="page-link disabled">Next</span>
                <?php endif; ?>
            </li>
        </ul>
    </nav>

    <!-- Option to Add New Scheme -->
    <div class="mb-3">
        <a href="add_scheme.php" class="btn btn-success">Add New Scheme</a>
    </div>

    <!-- Back Button to Avoid Form Resubmission -->
    <div class="mb-3">
        <a href="admin_dashboard.php" class="btn btn-secondary">Back</a>
    </div>

    <!-- All Schemes Table (with Edit/Delete options) -->
    <h4 class="mb-4">All Schemes</h4>
    <div class="table-responsive">
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
                <?php while ($row = $result_schemes->fetch_assoc()) { ?>
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
                            <!-- Link to Scheme -->
                            <a href="<?php echo htmlspecialchars($row['scheme_link']); ?>" target="_blank" class="btn btn-info btn-sm">View Scheme</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination for All Schemes -->
    <nav>
        <ul class="pagination justify-content-between">
            <!-- Previous Button -->
            <li class="page-item">
                <?php if ($page_schemes > 1): ?>
                    <a class="page-link" href="?page_schemes=<?php echo $page_schemes - 1; ?>">Previous</a>
                <?php else: ?>
                    <span class="page-link disabled">Previous</span>
                <?php endif; ?>
            </li>

            <!-- Page Number Dropdown -->
            <li class="page-item">
                <form method="get" action="" class="d-inline">
                    <select class="form-control form-control-sm" name="page_schemes" onchange="this.form.submit()">
                        <?php for ($i = 1; $i <= $total_schemes_pages; $i++): ?>
                            <option value="<?php echo $i; ?>" <?php if ($i == $page_schemes) echo 'selected'; ?>>Page <?php echo $i; ?></option>
                        <?php endfor; ?>
                    </select>
                </form>
            </li>

            <!-- Next Button -->
            <li class="page-item">
                <?php if ($page_schemes < $total_schemes_pages): ?>
                    <a class="page-link" href="?page_schemes=<?php echo $page_schemes + 1; ?>">Next</a>
                <?php else: ?>
                    <span class="page-link disabled">Next</span>
                <?php endif; ?>
            </li>
        </ul>
    </nav>
</div>

<!-- JavaScript for confirmation on delete -->
<script>
function confirmDelete() {
    return confirm("Are you sure you want to delete this scheme?");
}
</script>

<?php include('footer.php'); ?>

<!-- Additional CSS to make tables mobile-responsive -->
<style>
    @media (max-width: 768px) {
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
    }
</style>