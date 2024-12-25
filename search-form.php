<?php
// Include database connection file
$servername = "localhost"; // Database host
$username = "asse6007_admin"; // Database username (or your custom DB username)
$password = "00000000"; // Database password (or your custom DB password)
$dbname = "asse6007_gov_schemes"; // The database name for login functionality

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch unique states from the database
$stateQuery = "SELECT DISTINCT state FROM schemes";
$statesResult = $conn->query($stateQuery);

// Fetch unique age groups from the database
$ageGroupQuery = "SELECT DISTINCT age_group FROM schemes";
$ageGroupsResult = $conn->query($ageGroupQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Government Schemes Search</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffffff;
            color: #000000;
            font-family: Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            margin: 0;
        }
        .search-container {
            margin: auto;
            width: 100%;
            max-width: 500px;
            padding: 15px;
            flex-grow: 1;
        }
        .search-bar,
        .search-button {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .search-bar {
            border: none;
        }
        .search-button {
            background-color: #ffffff;
            color: #000000;
            border: none;
        }
        .search-button:hover {
            background-color: #000000;
            color: #ffffff;
        }
        .filter-dropdown {
            border: 2px solid #000000;
            background-color: #ffffff;
            color: #000000;
        }
        h1 {
            margin-bottom: 30px;
        }
        footer {
            background-color: #f8f9fa;
            text-align: center;
            padding: 10px 0;
            width: 100%;
        }
        @media (max-width: 576px) {
            .search-container {
                padding: 10px;
            }
            .form-row .col-md-3 {
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container text-center search-container">
        <h1>Search Government Schemes</h1>
        <form action="results.php" method="GET">
            <div class="input-group mb-4">
                <input type="text" class="form-control search-bar" name="query" placeholder="Type scheme name...">
                <div class="input-group-append">
                    <button class="btn search-button" type="submit">Search</button>
                </div>
            </div>
            <div class="form-row">
                <div class="col-12 col-md-3 mb-3">
                    <select class="form-control filter-dropdown" name="state">
                        <option value="">Select State</option>
                        <?php
                        while ($row = $statesResult->fetch_assoc()) {
                            echo "<option value='" . htmlspecialchars($row['state']) . "'>" . htmlspecialchars($row['state']) . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-12 col-md-3 mb-3">
                    <select class="form-control filter-dropdown" name="age_group">
                        <option value="">Select Age Group</option>
                        <?php
                        while ($row = $ageGroupsResult->fetch_assoc()) {
                            echo "<option value='" . htmlspecialchars($row['age_group']) . "'>" . htmlspecialchars($row['age_group']) . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-12 col-md-3 mb-3">
                    <select class="form-control filter-dropdown" name="caste">
                        <option value="">Select Caste</option>
                        <option value="OC">OC</option>
                        <option value="OBC">OBC</option>
                        <option value="BC">BC</option>
                        <option value="SC">SC</option>
                        <option value="ST">ST</option>
                    </select>
                </div>
            </div>
        </form>
    </div>
    
</body>
</html>

<?php $conn->close(); ?>
