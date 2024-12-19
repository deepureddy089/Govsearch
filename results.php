<?php
include 'header.php';
include 'db_connection.php'; // Ensure you have a database connection

// Capture form data if submitted
$state = isset($_POST['state']) ? $_POST['state'] : '';
$age_group = isset($_POST['age_group']) ? $_POST['age_group'] : '';
$caste = isset($_POST['caste']) ? $_POST['caste'] : '';
$query = isset($_POST['query']) ? $_POST['query'] : ''; // Search query for scheme name

// Construct the SQL query based on form data
$sql_conditions = [];

if (!empty($state)) {
    $sql_conditions[] = "state = '$state'";
}

if (!empty($age_group)) {
    $sql_conditions[] = "age_bracket = '$age_group'";
}

if (!empty($caste)) {
    $sql_conditions[] = "caste LIKE '%$caste%'";
}

if (!empty($query)) {
    // If user entered a scheme name, match it anywhere in the name field
    $sql_conditions[] = "scheme_name LIKE '%$query%'";
}

// If no conditions were set, show all records (this is fallback)
if (count($sql_conditions) > 0) {
    $query = "SELECT * FROM schemes WHERE " . implode(" AND ", $sql_conditions);
} else {
    $query = "SELECT * FROM schemes"; // Return all results if no filter
}

$result = mysqli_query($conn, $query);

?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Search Results</h2>

    <!-- Display search results -->
    <?php if (mysqli_num_rows($result) > 0): ?>
        <div class="row">
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="col-md-4 mb-4">
                    <div class="card" style="border: 1px solid #ddd; padding: 20px;">
                        <h5 class="card-title"><?php echo $row['scheme_name']; ?></h5>
                        <p><strong>State:</strong> <?php echo $row['state']; ?></p>
                        <p><strong>Eligibility:</strong> <?php echo $row['eligibility']; ?></p>
                        <p><strong>Age Group:</strong> <?php echo $row['age_bracket']; ?></p>
                        <p><strong>Caste:</strong> <?php echo $row['caste']; ?></p>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>No schemes found matching your criteria.</p>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>