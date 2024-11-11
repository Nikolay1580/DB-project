<?php
include './docs/access_log.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>FindYourGspot</title>
    <!-- Font Awesome for Social Media Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <script src="./docs/client/index.js"></script>
    <script src="./docs/client/jquery/jquery-3.6.0.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="./docs/client/style.css">
    <style>
        #input-form {
            display: none;
        }
    </style>

</head>

<body>
    <!-- Navbar -->
    <div id="navbar">
        <div class="logo">
            <a href="index.php">
                <img src="./docs/content/symbol-transp.png"
                    alt="FindYourGspot Logo"
                    class="logo-img">
            </a>
        </div>
        <div>
            <a href="index.php">Home</a>
            <a href="./docs/client/About.php">About</a>
            <a href="./docs/client/GDPR.php">GDPR</a>
            <a href="./docs/client/Login_page.php">Log In</a>
            <a href="./docs/client/Register_page.php">Register</a>
        </div>
    </div>

    <!-- Content -->
    <div class="welcome-box">
        <!-- Logo Section -->
        <div class="welcome-text">
            <h1>FindYourGspot</h1>
            <p>The Pleasure of Finding your Home</p>
        </div>
        <br>

        <!-- this gives a breif description and then procceds to the form -->
    </div id="before-form" class="before-form">
    <h2 id="before-form-text" class="before-form-text">
        Everyone deserves to call their place Home...sadly this is not always the case.
        This is why we at Findyourgspot have made this form for you to find the college and block
        that best fits your personality and one that you can call home.
    </h2>
    <button id="next-button" class="before-form-button" type="button" onclick="showForm()">Next</button>
    <div>


    </div>
    <!-- Input form that when submited send an AJAX to the back_end.php file which for now 
        just sends a error or suscess message. The inpput habndling is done on the front-end
        to not waste bandwith sending incorrect data
    -->
    <form id="input-form" class="input-form">

        <input type="text" id="search" placeholder="What College were you in">

        <script>
       $(document).ready(function() {
        $("#search").on("input", function() {  
            const searchTerm = $(this).val(); 
            
            if (searchTerm.length > 0) {
                $.ajax({
                    url: 'http://5.75.182.107/~tlachezarov/docs/server/auto_complete.php',
                    type: 'GET',
                    data: { term: searchTerm },
                    success: function(data) {
                        const suggestions = data.split(", ");
                        $("#search").autocomplete({
                            source: suggestions
                        });
                    }
                });
            }
        });
    });
    </script>

        <div class="slider-test">
            <label class="slider-prompt">How much do you care about food quality at the servery?</label>

            <input class="slider" type="range" id="slider-js" name="servery" step="25" min="-100" max="100" value="0">
            <div class="slider-labels">
                <span>Not</span>
                <span>Neutral</span>
                <span>Very</span>
            </div>

            <label class="slider-prompt">How much do you care about the CO members friendliness?</label>

            <input class="slider" type="range" id="slider-js" name="CO-friendly" step="25" min="-100" max="100" value="0">
            <div class="slider-labels">
                <span>Meh</span>
                <span>Neutral</span>
                <span>Very</span>
            </div>

            <label class="slider-prompt">How much do you care about the CO members strictness?</label>

            <input class="slider" type="range" id="slider-js" name="CO-strict" step="25" min="-100" max="100" value="0">
            <div class="slider-labels">
                <span>Meh</span>
                <span>Neutral</span>
                <span>Very</span>
            </div>

            <label class="slider-prompt">What is the ideal level of activity in your block?</label>
            <input class="slider" type="range" id="slider-js" name="activity" step="25" min="-100" max="100" value="0">
            <div class="slider-labels">
                <span>Meh</span>
                <span>Neutral</span>
                <span>Very</span>
            </div>

            <label class="slider-prompt">Do you care for the fellow blockmates to be friendly?</label>
            <input class="slider" type="range" id="slider-js" name="blockmate" step="25" min="-100" max="100" value="0">
            <div class="slider-labels">
                <span>Meh</span>
                <span>Neutral</span>
                <span>Very</span>
            </div>


            <label class="slider-prompt">Do you care for the noise level of fellow blockmates?</label>
            <input class="slider" type="range" id="slider-js" name="noise" step="25" min="-100" max="100" value="0">
            <div class="slider-labels">
                <span>Meh</span>
                <span>Neutral</span>
                <span>Very</span>
            </div>

            <label class="slider-prompt"> How close do you wish to go to most of the classes?</label>
            <input class="slider" type="range" id="slider-js" name="nearby" step="25" min="-100" max="100" value="0">
            <div class="slider-labels">
                <span>Meh</span>
                <span>Neutral</span>
                <span>Very</span>
            </div>

            <button id="form-button" class="form-button" type="button" onclick="submitForm()">Submit</button>
        </div>
    </form>



    <!-- Footer -->
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