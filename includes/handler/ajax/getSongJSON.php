<?php
    include("../../configs.php");
    if(isset($_POST['songId'])){
        $songId = $_POST['songId'];
        $query = mysqli_query($conn,"SELECT * FROM songs WHERE id='$songId'");
        $result = mysqli_fetch_array($query);
        echo json_encode($result);
    }
?>