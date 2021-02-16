<?php
        function setPassword($inputText){
            $inputText = strip_tags($inputText);
            return $inputText;
        }
        function setUsername($inputText){
            $inputText = strip_tags($inputText);
            $inputText = str_replace(" ","",$inputText);
            return $inputText;
        }
        function setString($inputText){
            $inputText = strip_tags($inputText);
            $inputText = str_replace(" ","",$inputText);
            $inputText = ucfirst(strtolower($inputText));
            return $inputText;
        }
        
        if(isset($_POST['signInButton'])){
            $username = setUsername($_POST['username']);
            $firstname = setString($_POST['firstname']);
            $lastname = setString($_POST['lastname']);
            $email = setString($_POST['email']);
            $email2 = setString($_POST['email2']);
            $password = setPassword($_POST['password']);
            $password2 = setPassword($_POST['password2']);
            
            $successful_reg = $user_account->register($username,$firstname,$lastname,$email,$email2,$password,$password2);
            /*if($successful_reg == true){
                header('Location: index.php');
            }*/
        }
?>