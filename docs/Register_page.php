<?php
include './access_log.php';
// include "./docs/error_log.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - FindYourGspot</title>
    <link rel="stylesheet" href="Register_page.css">
    <script src="Register_page.js" defer></script>
</head>
<body>

    <!-- Navbar (same as other pages) -->
    <div id="navbar">
        <div class="logo">
            <a href="../../index.php">
                <img src="./content/symbol-transp.png" alt="FindYourGspot Logo" class="logo-img">
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

    <!-- Registration Form Section -->
    <div class="register-container">
        <h2>Register</h2>
        <form id="registerForm">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Register</button>
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
