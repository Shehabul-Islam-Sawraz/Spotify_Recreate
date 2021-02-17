<?php
    ob_start();
    session_start();
    $timezone = date_default_timezone_set("Asia/Dhaka");
    $conn = mysqli_connect("localhost","root","","spotify_recreate");
    if(mysqli_connect_errno()){
        echo "failed to Connect: " . mysqli_connect_errno();
    }
?>