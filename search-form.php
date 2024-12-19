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
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .search-container {
            margin-top: auto;
            margin-bottom: auto;
            width: 70%;
        }

        .search-bar, .search-button {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .search-bar {
            border: none;
        }

        .search-button {
            background-color: #ffffff;
            color: #000000;
            border: none;
            border-radius: 0;
        }

        .search-button:hover {
            background-color: #000000;
            color: #ffffff;
        }

        .filter-dropdown {
            border-radius: 0;
            border: 2px solid #000000;
            background-color: #ffffff;
            color: #000000;
        }

        footer {
            margin-top: auto;
        }

        #dynamic-title {
            transition: opacity 1s ease-in-out;
            opacity: 1;
        }

        .scheme-word {
            transition: opacity 1s ease-in-out;
            opacity: 1;
        }

        .description {
            font-size: 1.2rem;
            color: #333;
            margin-top: 30px;
            margin-bottom: 30px;
        }

        .white-text {
            color: #ffffff;
        }
    </style>
</head>
<body>
    <div class="container text-center search-container">
        <h1 id="dynamic-title">Search Government <span id="scheme-word" class="scheme-word">Schemes</span></h1>

        <form action="results.php" method="GET" class="mt-4">
            <!-- Search Bar and Button -->
            <div class="input-group mb-4 justify-content-center">
                <input type="text" class="form-control search-bar" name="query" placeholder="Start typing scheme name...">
                <div class="input-group-append">
                    <button class="btn search-button" type="submit">Search</button>
                </div>
            </div>
            <div class="form-row justify-content-center">
                <!-- State Dropdown -->
                <div class="col-md-3 mb-3">
                    <select class="form-control filter-dropdown" name="state">
                        <option value="">Select State</option>
                        <option value="Karnataka">Karnataka</option>
                        <option value="Andhra Pradesh">Andhra Pradesh</option>
                        <option value="Telangana State">Telangana State</option>
                        <option value="Tamil Nadu">Tamil Nadu</option>
                    </select>
                </div>
                <!-- Age Group Dropdown -->
                <div class="col-md-3 mb-3">
                    <select class="form-control filter-dropdown" name="age_group">
                        <option value="">Select Age Group</option>
                        <option value="0-18">0-18</option>
                        <option value="19-60">19-60</option>
                        <option value="60+">60 and above</option>
                    </select>
                </div>
                <!-- Caste Dropdown -->
                <div class="col-md-3 mb-3">
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
        

        <!-- Description Section placed right above footer -->
        <p id="description-text" class="description">
            This website helps you find a list of government schemes currently available from state and central governments of India. It is a platform where you can find all government schemes in one place.
        </p>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="homepage-lang-translation.js"></script>
</body>
</html>