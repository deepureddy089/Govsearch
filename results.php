<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "government_schemes";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch filters
$query = isset($_GET['query']) ? $_GET['query'] : '';
$state = isset($_GET['state']) ? $_GET['state'] : '';
$age_group = isset($_GET['age_group']) ? $_GET['age_group'] : '';
$caste = isset($_GET['caste']) ? $_GET['caste'] : '';

// Pagination settings
$results_per_page = 6;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $results_per_page;

// Build the SQL query dynamically
$sql = "SELECT * FROM schemes WHERE 1=1";
$params = [];
$types = "";

// Apply filters
if (!empty($query)) {
    $sql .= " AND scheme_name LIKE ?";
    $params[] = "%" . $query . "%";
    $types .= "s";
}
if (!empty($state)) {
    $sql .= " AND state = ?";
    $params[] = $state;
    $types .= "s";
}
if (!empty($age_group)) {
    $sql .= " AND age_group = ?";
    $params[] = $age_group;
    $types .= "s";
}
if (!empty($caste)) {
    $sql .= " AND caste LIKE ?";
    $params[] = "%" . $caste . "%";
    $types .= "s";
}

// Add pagination
$sql .= " LIMIT ?, ?";
$params[] = $offset;
$params[] = $results_per_page;
$types .= "ii";

// Prepare the statement
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Error in SQL preparation: " . $conn->error);
}

// Bind parameters if there are any
if (!empty($types)) {
    $stmt->bind_param($types, ...$params);
}

// Execute the query
if (!$stmt->execute()) {
    die("Error in query execution: " . $stmt->error);
}

// Fetch results
$result = $stmt->get_result();
if (!$result) {
    die("Error in fetching results: " . $stmt->error);
}

// Count total results for pagination
$total_sql = "SELECT COUNT(*) FROM schemes WHERE 1=1";
if (!empty($query)) $total_sql .= " AND scheme_name LIKE '%" . $conn->real_escape_string($query) . "%'";
if (!empty($state)) $total_sql .= " AND state = '" . $conn->real_escape_string($state) . "'";
if (!empty($age_group)) $total_sql .= " AND age_group = '" . $conn->real_escape_string($age_group) . "'";
if (!empty($caste)) $total_sql .= " AND caste LIKE '%" . $conn->real_escape_string($caste) . "%'";

$total_result = $conn->query($total_sql);
$total_rows = $total_result->fetch_row()[0];
$total_pages = ceil($total_rows / $results_per_page);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scheme Results</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Scheme Results</h2>
    <?php if ($result->num_rows > 0): ?>
        <div class="row">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($row['scheme_name']); ?></h5>
                            <p class="card-text">State: <?php echo htmlspecialchars($row['state']); ?></p>
                            <p class="card-text">Age Group: <?php echo htmlspecialchars($row['age_group']); ?></p>
                            <p class="card-text">Caste: <?php echo htmlspecialchars($row['caste']); ?></p>
                            <a href="<?php echo htmlspecialchars($row['scheme_link']); ?>" class="btn btn-primary" target="_blank">Details</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>No schemes found.</p>
    <?php endif; ?>

    <!-- Pagination -->
    <nav>
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                    <a class="page-link" href="?query=<?php echo urlencode($query); ?>&state=<?php echo urlencode($state); ?>&age_group=<?php echo urlencode($age_group); ?>&caste=<?php echo urlencode($caste); ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>
</body>
</html>

<?php $conn->close(); ?>