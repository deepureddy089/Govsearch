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
            width: 70%; /* Increased width */
        }

        .search-bar, .search-button {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Shadow for the search bar and button */
        }

        .search-bar {
            border: none;
        }

        .search-button {
            background-color: #ffffff;
            color: #000000;
            border: none;
            border-radius: 0; /* Rectangular borders */
        }

        .search-button:hover {
            background-color: #000000; /* Button background turns black on hover */
            color: #ffffff; /* Text color turns white on hover */
        }

        .filter-dropdown {
            border-radius: 0; /* Rectangular borders */
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

        <form action="results.php" method="POST" class="mt-4">
    <!-- Search Bar and Button -->
    <div class="input-group mb-4 justify-content-center">
        <input type="text" class="form-control search-bar" name="query" placeholder="Start typing scheme name..." required>
        <div class="input-group-append">
            <button class="btn search-button" type="submit">Search</button>
        </div>
    </div>

    <div class="form-row justify-content-center">
        <!-- State Dropdown -->
        <div class="col-md-3 mb-3">
            <select class="form-control filter-dropdown" name="state" required>
                <option value="">Select State</option>
                <option value="National">National</option>
                <option value="Karnataka">Karnataka</option>
                <option value="Andhra Pradesh">Andhra Pradesh</option>
                <option value="Telangana State">Telangana State</option>
                <option value="Tamil Nadu">Tamil Nadu</option>
            </select>
        </div>

        <!-- Age Group Dropdown -->
        <div class="col-md-3 mb-3">
            <select class="form-control filter-dropdown" name="age_group" required>
                <option value="">Select Age Group</option>
                <option value="ALL">ALL</option>
                <option value="0-18">0-18</option>
                <option value="19-60">19-60</option>
                <option value="60+">60+</option>
            </select>
        </div>

        <!-- Caste Dropdown -->
        <div class="col-md-3 mb-3">
            <select class="form-control filter-dropdown" name="caste" required>
                <option value="">Select Caste</option>
                <option value="ALL">ALL</option>
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

    <script>
        const schemes = [
            "Schemes", // English
            "ಯೋಜನೆಗಳು", // Kannada
            "திட்டங்கள்", // Tamil
            "పథకాలు" // Telugu
        ];

        const descriptions = [
            "This website helps you find a list of government schemes currently available from state and central governments of India. It is a platform where you can find all government schemes in one place.", // English
            "ಈ ವೆಬ್‌ಸೈಟ್ ನೀವು ಕರ್ನಾಟಕ ಮತ್ತು ಕೇಂದ್ರ ಸರ್ಕಾರಗಳಿಂದ ಪ್ರಸ್ತುತ ಲಭ್ಯವಿರುವ ಸರ್ಕಾರದ ಯೋಜನೆಗಳ ಪಟ್ಟಿ ಕಂಡುಹಿಡಿಯಲು ಸಹಾಯ ಮಾಡುತ್ತದೆ. ಇದು ನೀವು ಎಲ್ಲಾ ಸರ್ಕಾರದ ಯೋಜನೆಗಳನ್ನು ಒಂದೇ ಸ್ಥಳದಲ್ಲಿ ಕಂಡುಹಿಡಿಯಬಹುದಾದ ವೇದಿಕೆ.", // Kannada
            "இந்த இணையதளம் இந்தியாவின் மாநில மற்றும் மைய அரசுகள் வழங்கும் தற்போதைய அரசு திட்டங்களின் பட்டியலை கண்டுபிடிப்பதில் உங்களுக்கு உதவும். இது நீங்கள் அனைத்து அரசு திட்டங்களையும் ஒரே இடத்தில் கண்டுபிடிக்கக்கூடிய தளம்.", // Tamil
            "ఈ వెబ్‌సైట్ మీరు తెలంగాణ మరియు కేంద్ర ప్రభుత్వాలు అందిస్తున్న ప్రస్తుత ప్రభుత్వ పథకాలను కనుగొనడంలో మీకు సహాయం చేస్తుంది. ఇది మీరు అన్ని ప్రభుత్వ పథకాలను ఒకే చోట కనుగొనగల వేదిక." // Telugu
        ];

        let currentIndex = 0;
        const schemeWordElement = document.getElementById('scheme-word');
        const descriptionElement = document.getElementById('description-text');

        setInterval(() => {
            // Change the description text
            descriptionElement.style.opacity = 0;
            setTimeout(() => {
                descriptionElement.textContent = descriptions[currentIndex];
                descriptionElement.style.opacity = 1;
            }, 500); // Delay before changing description

            // Change the scheme word text
            schemeWordElement.style.opacity = 0;
            setTimeout(() => {
                schemeWordElement.textContent = schemes[currentIndex];
                schemeWordElement.style.opacity = 1;
            }, 500); // Delay before changing scheme word

            currentIndex = (currentIndex + 1) % schemes.length; // Cycle through languages
        }, 10000); // Change every 10 seconds
    </script>
</body>
</html>