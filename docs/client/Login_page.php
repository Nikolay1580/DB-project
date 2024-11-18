<?php
require __DIR__ . "../server/gspot_lib.php";

loadDotEnv(__DIR__ . "../server/.env");
$apiKey = getenv("API_Key");


$clientIp = getUserIP();

$geoUrl = "https://ipinfo.io/{$clientIp}/json?token={$apiKey}";

// Fetch geolocation data
$response = @file_get_contents($geoUrl);
$geoData = $response ? json_decode($response, true) : ['loc' => '0,0', 'ip' => $clientIp];

$location = $geoData['loc'];
$latitude = explode(',', $location)[0];
$longitude = explode(',', $location)[1];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - FindYourGspot</title>
    <link rel="stylesheet" href="Login_page.css">
    <script src="Login_page.js" defer></script>
</head>

<body>

    <!-- Navbar (same as other pages) -->
    <div id="navbar">
        <div class="logo">
            <a href="../../index.php">
                <img src="../content/symbol-transp.png" alt="FindYourGspot Logo" class="logo-img">
            </a>
        </div>
        <div>
            <a href="../../index.php">Home</a>
            <a href="about.php">About</a>
            <a href="GDPR.php">GDPR</a>
            <a href="Login_page.php">Log In</a>
            <a href="Register_page.php">Register</a>
        </div>
    </div>

    <!-- Login Form Section -->
    <div class="login-container">
        <h2>Login</h2>
        <!-- Add ID "loginForm" for JavaScript to target -->
        <form id="loginForm" action="/login" method="POST">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required maxlength="25">

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required maxlength="25">

            <button type="submit">Log In</button>
        </form>
    </div>

    <!-- Footer (same as other pages) -->
    <footer>
        <div>&copy; 2024 FindYourGspot</div>
        <div id="social-media">
            <i class="fab fa-facebook"></i>
            <i class="fab fa-instagram"></i>
            <i class="fab fa-twitter"></i>
        </div>
    </footer>
</body>

</html>