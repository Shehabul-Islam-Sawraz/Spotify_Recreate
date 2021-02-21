<?php
    include("includes/configs.php");
    /*session_destroy();*/ //we will use it when we want to logout manually.
    if(isset($_SESSION['userLoggedIn'])){
        $userLoggedIn = $_SESSION['userLoggedIn'];
    }
    else{
        header("Location: register.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/css/index.css">
    <title>Welcome to Spotify!</title>
</head>
<body>
    <div id="nowPlayingBarContainer">
        <div id="nowPlayingBar">
            <div id="nowPlayingLeft">
            </div>
            <div id="nowPlayingCenter">
                <div class="content playerControls">
                    <div class="buttons">
                        <buttons class="controlButton shuffle" title="Shuffle">
                            <img src="assets/images/icons/shuffle.png" alt="shuffle">
                        </buttons>
                        <buttons class="controlButton previous" title="Previous">
                            <img src="assets/images/icons/previous.png" alt="Previous">
                        </buttons>
                        <buttons class="controlButton play" title="Play">
                            <img src="assets/images/icons/play.png" alt="Play">
                        </buttons>
                        <buttons class="controlButton pause" title="Pause" style="display: none;">
                            <img src="assets/images/icons/pause.png" alt="Pause">
                        </buttons>
                        <buttons class="controlButton next" title="Next">
                            <img src="assets/images/icons/next.png" alt="Next">
                        </buttons>
                        <buttons class="controlButton repeat" title="Repeat">
                            <img src="assets/images/icons/repeat.png" alt="Repeat">
                        </buttons>
                    </div>
                    <div class="playBackBar">
                        <span class="progressTime current">0.00</span>
                        <div class="progressBar">
                            <div class="progressBarBackground">
                                <div class="progress"></div>
                            </div>
                        </div>
                        <span class="progressTime remaining">0.00</span>
                    </div>
                </div>
            </div>
            <div id="nowPlayingRight">
            </div>
        </div>
    </div>
</body>
</html>