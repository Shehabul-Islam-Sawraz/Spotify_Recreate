<?php
    class Account{
        private $errorArray;
        private $conn;
        public function __construct($conn){
            $this->errorArray = array();
            $this->conn = $conn;
        }
        public function register($username,$firstname,$lastname,$email,$email2,$password,$password2){
            $this->validateUsername($username);
            $this->validateFirstname($firstname);
            $this->validateLastname($lastname);
            $this->validateEmail($email,$email2);
            $this->validatePassword($password,$password2);

            if(empty($this->errorArray)==true){
                //save into database
                return $this->insertUserInfo($username,$firstname,$lastname,$email,$password);
            }
            else{
                return false;
            }
        }
        public function getError($error){
            if(!in_array($error,$this->errorArray)){
                $error="";
            }
            return "<span class='errormessage'>$error</span>";
        }
        private function insertUserInfo($un,$fn,$ln,$em,$pw){
            $encryptedPw = md5($pw);
            $profilePic = "assets/images/profile_pics/profilepic1.png";
            $date = date("Y-m-d");
            $result = mysqli_query($this->conn, "INSERT INTO userinfo VALUES ('','$un','$fn','$ln','$em','$encryptedPw','$date','$profilePic')");
            return $result;
        }
        private function validateUsername($un){
            if(strlen($un)<5 || strlen($un)>25){
                array_push($this->errorArray, Errors::$username_error);
                return;
            }

            //Check whether the username exists
            $checkUsername = mysqli_query($this->conn,"SELECT username FROM userinfo WHERE username='$un'");
            if(mysqli_num_rows($checkUsername)!=0){
                array_push($this->errorArray, Errors::$username_taken);
                return;
            }
        }
        private function validateFirstname($fn){
            if(strlen($fn)<3 || strlen($fn)>25){
                array_push($this->errorArray,Errors::$firstname_error);
                return;
            }
        }
        private function validateLastname($ln){
            if(strlen($ln)<3 || strlen($ln)>25){
                array_push($this->errorArray, Errors::$lastname_error);
                return;
            }
        }
        private function validateEmail($em1,$em2){
            if($em1!=$em2){
                array_push($this->errorArray,Errors::$email_unmatch);
                return;
            }
            if(!filter_var($em1, FILTER_VALIDATE_EMAIL)){
                array_push($this->errorArray, Errors::$invalid_email);
                return;
            }

            //Check that the email hasn't already be used.
            $checkemail = mysqli_query($this->conn,"SELECT email FROM userinfo WHERE email='$em1'");
            if(mysqli_num_rows($checkemail)!=0){
                array_push($this->errorArray, Errors::$email_taken);
                return;
            }
        }
        private function validatePassword($pw1,$pw2){
            if($pw1!=$pw2){
                array_push($this->errorArray,Errors::$password_unmatch);
                return;
            }
            $pattern = "/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/";
            if(!preg_match($pattern,$pw1)){
                array_push($this->errorArray,Errors::$invalid_password);
                return;
            }
        }
    }
?>