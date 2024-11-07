<?php
include './access_log.php';
include "./docs/error_log.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>FindYourGspot</title>
    <!-- Font Awesome for Social Media Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <script src="index.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="GDPR.css">
</head>

<body>

    <!-- Navbar -->
    <div id="navbar">
        <div class="logo">
            <a href="../index.php">
                <img src="./content/symbol-transp.png"
                    alt="FindYourGspot Logo"
                    class="logo-img">
            </a>
        </div>
        <div>
            <a href="../index.php">Home</a>
            <a href="About.php">About</a>
            <a href="GDPR.php">GDPR</a>
            <a href="Login_page.php">Log In</a>
            <a href="Register_page.php">Register</a>
        </div>
    </div>

    <div class="main-gdpr">
        <p class="main-text-gdpr">
            This website is student lab work and does not necessarily reflect Constructor University opinions.
            Constructor University does not endorse this site, nor is it checked by Constructor University
            regularly, nor is it part of the official Constructor University web presence.
            For each external link existing on this website, we initially have checked that the target page
            does not contain contents which is illegal wrt. German jurisdiction. However, as we have no in-
            fluence on such contents, this may change without our notice. Therefore we deny any responsib-
            ility for the websites referenced through our external links from here.
            No information conflicting with GDPR is stored in the server. We are not using cookies to track
        </p>

    </div>

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