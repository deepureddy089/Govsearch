<?php 
include 'header.php'; 
include 'db_connection.php'; // Make sure you have a database connection

// Capture form data if submitted
$state = isset($_POST['state']) ? $_POST['state'] : '';
$age_group = isset($_POST['age_group']) ? $_POST['age_group'] : '';
$caste = isset($_POST['caste']) ? $_POST['caste'] : '';
$scheme_name = isset($_POST['query']) ? $_POST['query'] : '';

// Construct the SQL query based on form data
$query = "SELECT * FROM schemes WHERE 1";

// Filter by state if selected
if (!empty($state)) {
    $query .= " AND state = '$state'";
}

// Filter by age group if selected
if (!empty($age_group)) {
    if ($age_group == '60+') {
        $query .= " AND age_bracket = '60+'";
    } elseif ($age_group == '19-60') {
        $query .= " AND age_bracket = '19-60'";
    } elseif ($age_group == '0-18') {
        $query .= " AND age_bracket = '0-18'";
    }
}

// Filter by caste if selected
if (!empty($caste)) {
    $query .= " AND caste LIKE '%$caste%'";
}

// Filter by scheme name if provided
if (!empty($scheme_name)) {
    $query .= " AND scheme_name LIKE '%$scheme_name%'";
}

// Execute the query
$result = mysqli_query($conn, $query);

?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Search Results</h2>

    <!-- Include the search form -->


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