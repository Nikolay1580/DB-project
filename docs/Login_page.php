<?php
include './access_log.php';
// include "./docs/error_log.php";
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
            <a href="../../index.html">
                <img src="./content/symbol-transp.png" alt="FindYourGspot Logo" class="logo-img">
            </a>
        </div>
        <div>
            <a href="../../index.html">Home</a>
            <a href="about.html">About</a>
            <a href="GDPR.html">GDPR</a>
            <a href="Login_page.html">Log In</a>
            <a href="Register_page.html">Register</a>
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