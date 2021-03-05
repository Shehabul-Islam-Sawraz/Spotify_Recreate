<?php
    include("../../configs.php");
    if(isset($_POST['artistId'])){
        $artistId = $_POST['artistId'];
        $query = mysqli_query($conn,"SELECT * FROM artists WHERE id='$artistId'");
        $result = mysqli_fetch_array($query);
        echo json_encode($result);
    }
?>