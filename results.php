<?php
// Include the database connection
include('db_connection.php'); 

// Fetch filters from the URL
$query = isset($_GET['query']) ? $_GET['query'] : '';
$state = isset($_GET['state']) ? $_GET['state'] : '';
$age_group = isset($_GET['age_group']) ? $_GET['age_group'] : '';
$caste = isset($_GET['caste']) ? $_GET['caste'] : '';

// Pagination settings
$results_per_page = 6;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $results_per_page;

// Prepare SQL query with filters (using prepared statements to prevent SQL injection)
$sql = "SELECT * FROM schemes WHERE 1=1";

// Apply filters based on user input
if ($query) {
    $sql .= " AND scheme_name LIKE ?";
}
if ($state) {
    $sql .= " AND state = ?";
}
if ($age_group) {
    $sql .= " AND age_group = ?";
}
if ($caste) {
    $sql .= " AND caste LIKE ?";
}

// Apply pagination
$sql .= " LIMIT ?, ?";
$stmt = $conn->prepare($sql);

// Bind parameters to the query
$params = [];
if ($query) {
    $params[] = "%" . $query . "%";
}
if ($state) {
    $params[] = $state;
}
if ($age_group) {
    $params[] = $age_group;
}
if ($caste) {
    $params[] = "%" . $caste . "%";
}

// Bind the offset and limit
$params[] = $offset;
$params[] = $results_per_page;

// Execute the query
$stmt->bind_param(str_repeat("s", count($params) - 2) . "ii", ...$params);
$stmt->execute();
$result = $stmt->get_result();

// Fetch total count for pagination
$count_sql = "SELECT COUNT(*) AS total FROM schemes WHERE 1=1";
if ($query) {
    $count_sql .= " AND scheme_name LIKE ?";
}
if ($state) {
    $count_sql .= " AND state = ?";
}
if ($age_group) {
    $count_sql .= " AND age_group = ?";
}
if ($caste) {
    $count_sql .= " AND caste LIKE ?";
}

$count_stmt = $conn->prepare($count_sql);
$count_params = [];
if ($query) {
    $count_params[] = "%" . $query . "%";
}
if ($state) {
    $count_params[] = $state;
}
if ($age_group) {
    $count_params[] = $age_group;
}
if ($caste) {
    $count_params[] = "%" . $caste . "%";
}
$count_stmt->bind_param(str_repeat("s", count($count_params)), ...$count_params);
$count_stmt->execute();
$count_result = $count_stmt->get_result();
$total_results = $count_result->fetch_assoc()['total'];
$total_pages = ceil($total_results / $results_per_page);

// Close statement for total count
$count_stmt->close();
?>

<?php include('header.php'); ?>

<head>
    <style>
        .scheme-logo {
            width: 100px;
            height: auto;
        }

        .disclaimer {
            font-size: 0.8em;
            color: #6c757d;
            margin-top: 20px;
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        .btn-black {
            background-color: black;
            color: white;
            border: 1px solid black;
        }

        .btn-black:hover {
            background-color: #333;
            color: white;
        }

        .card {
            width: 18rem;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            margin: 0 5px;
            padding: 5px 10px;
            text-decoration: none;
            color: black;
            border: 1px solid #ccc;
        }

        .pagination a:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>

<div class="container mt-5">
    <h2>Scheme Results</h2>

    <div class="my-3">
        <small>Showing results for:
            <?php echo htmlspecialchars($query); ?>, 
            <?php echo htmlspecialchars($age_group); ?>, 
            <?php echo htmlspecialchars($caste); ?> 
            (<?php echo $total_results; ?> results)
        </small>
    </div>

    <div class="row">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="col-md-4 mb-4">';
                echo '<div class="card">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . htmlspecialchars($row['scheme_name']) . '</h5>';
                echo '<p class="card-text">State: ' . htmlspecialchars($row['state']) . '</p>';
                echo '<p class="card-text">Age Group: ' . htmlspecialchars($row['age_group']) . '</p>';
                echo '<p class="card-text">Caste: ' . htmlspecialchars($row['caste']) . '</p>';
                echo '<img src="' . htmlspecialchars($row['state_logo']) . '" class="img-fluid scheme-logo" alt="State Logo">';
                echo '<a href="' . htmlspecialchars($row['scheme_link']) . '" class="btn btn-black mt-3" target="_blank">Visit Scheme</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<div class="col-12"><p>No schemes found based on your filters.</p></div>';
        }
        ?>
    </div>

    <!-- Pagination -->
    <div class="pagination">
        <a href="?page=1&query=<?php echo htmlspecialchars($query); ?>&state=<?php echo htmlspecialchars($state); ?>&age_group=<?php echo htmlspecialchars($age_group); ?>&caste=<?php echo htmlspecialchars($caste); ?>">First</a>
        <a href="?page=<?php echo max(1, $page - 1); ?>&query=<?php echo htmlspecialchars($query); ?>&state=<?php echo htmlspecialchars($state); ?>&age_group=<?php echo htmlspecialchars($age_group); ?>&caste=<?php echo htmlspecialchars($caste); ?>">Prev</a>
        <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
            <a href="?page=<?php echo $i; ?>&query=<?php echo htmlspecialchars($query); ?>&state=<?php echo htmlspecialchars($state); ?>&age_group=<?php echo htmlspecialchars($age_group); ?>&caste=<?php echo htmlspecialchars($caste); ?>"><?php echo $i; ?></a>
        <?php } ?>
        <a href="?page=<?php echo min($total_pages, $page + 1); ?>&query=<?php echo htmlspecialchars($query); ?>&state=<?php echo htmlspecialchars($state); ?>&age_group=<?php echo htmlspecialchars($age_group); ?>&caste=<?php echo htmlspecialchars($caste); ?>">Next</a>
        <a href="?page=<?php echo $total_pages; ?>&query=<?php echo htmlspecialchars($query); ?>&state=<?php echo htmlspecialchars($state); ?>&age_group=<?php echo htmlspecialchars($age_group); ?>&caste=<?php echo htmlspecialchars($caste); ?>">Last</a>
    </div>

    <small class="text-muted d-block mt-3 disclaimer">
        Disclaimer: This information is provided from external websites, and we are not liable for the accuracy and validity of the data. Users should review and consume the information as per their own decision.
    </small>
</div>

<?php include('footer.php'); ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

