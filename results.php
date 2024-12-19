<?php
// Include the database connection
include('db_connection.php'); 

// Fetch filters from the URL
$query = isset($_GET['query']) ? $_GET['query'] : '';
$state = isset($_GET['state']) ? $_GET['state'] : '';
$age_group = isset($_GET['age_group']) ? $_GET['age_group'] : '';
$caste = isset($_GET['caste']) ? $_GET['caste'] : '';

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

// Prepare and execute the query
$stmt = $conn->prepare($sql);

// Bind parameters to the query
if ($query) {
    $stmt->bind_param("s", $queryParam);
    $queryParam = "%" . $query . "%";
}
if ($state) {
    $stmt->bind_param("s", $stateParam);
    $stateParam = $state;
}
if ($age_group) {
    $stmt->bind_param("s", $ageGroupParam);
    $ageGroupParam = $age_group;
}
if ($caste) {
    $stmt->bind_param("s", $casteParam);
    $casteParam = "%" . $caste . "%";
}

// Execute the query
$stmt->execute();
$result = $stmt->get_result();
?>

<?php include('header.php'); ?>

<div class="container mt-5">
    <h2>Scheme Results</h2>

    <div class="row">
        <?php
        // Display results in a grid
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Display each scheme as a card in a flexible container
                echo '<div class="col-md-3 col-sm-6 col-12 mb-4">';
                echo '<div class="card scheme-card">';
                echo '<div class="card-header">' . htmlspecialchars($row['scheme_name']) . '</div>';
                echo '<div class="card-body">';
                echo '<p><strong>State:</strong> ' . htmlspecialchars($row['state']) . '</p>';
                echo '<p><strong>Age Group:</strong> ' . htmlspecialchars($row['age_group']) . '</p>';
                echo '<p><strong>Caste:</strong> ' . htmlspecialchars($row['caste']) . '</p>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>No schemes found based on your filters.</p>';
        }
        ?>
    </div>
</div>

<?php include('footer.php'); ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Close database connection
$stmt->close();
$conn->close();
?>