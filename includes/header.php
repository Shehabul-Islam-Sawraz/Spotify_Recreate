<?php
    include("includes/configs.php");
    include("includes/classes/Artist.php");
    include("includes/classes/Album.php");
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
    <div id="mainContainer">
        <div id="topContainer">
            <?php
                include("includes/navBarContainer.php");
            ?>
            <div id="mainViewContainer">
                <div id="mainContent">