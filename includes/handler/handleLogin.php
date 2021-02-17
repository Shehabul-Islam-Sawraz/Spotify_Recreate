<?php
    if(isset($_POST['loginButton'])){
        $loginUsername = $_POST['loginUsername'];
        $loginPassword = $_POST['loginPassword'];
        $result = $user_account->login($loginUsername,$loginPassword);
        if($result == true){
            $_SESSION['userLoggedIn'] = $loginUsername;
            header("Location: index.php");
        }
    }
?>