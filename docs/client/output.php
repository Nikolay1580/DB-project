<?php
include './access_log.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Finder - Output</title>
    <link rel="stylesheet" href="output.css">
    <script src="output.js"></script>
</head>

<body>

    <!-- Navbar -->
    <div id="navbar">
        <div class="logo">
            <a href="../../index.php">
                <img src="../content/symbol-transp.png"
                    alt="FindYourGspot Logo"
                    class="logo-img">
            </a>
        </div>
        <div>
            <a href="../../index.php">Home</a>
            <a href="About.php">About</a>
            <a href="GDPR.php">GDPR</a>S
            <a href="Login_page.php">Log In</a>
            <a href="Register_page.php">Register</a>
        </div>
    </div>

    <!-- Container for displaying the result -->
    <div id="table-container">
        <!-- The JavaScript will fill up this area based on if it found a room or not -->
    </div>

    <!-- Footer -->
    <footer>
        <div>&copy; 2024 FindYourGspot</div>
        <div id="social-media">
            <a href="#" target="_blank"><i class="fab fa-facebook"></i></a>
            <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
        </div>
    </footer>
</body>

</html>