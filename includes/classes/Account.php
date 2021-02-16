<?php
    class Account{
        private $errorArray;
        public function __construct(){
            $this->errorArray = array();
        }
        public function register($username,$firstname,$lastname,$email,$email2,$password,$password2){
            $this->validateUsername($username);
            $this->validateFirstname($firstname);
            $this->validateLastname($lastname);
            $this->validateEmail($email,$email2);
            $this->validatePassword($password,$password2);

            if(empty($this->errorArray)==true){
                //save into database
                return true;
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
        private function validateUsername($un){
            if(strlen($un)<5 || strlen($un)>25){
                array_push($this->errorArray, Errors::$username_error);
                return;
            }

            //Check whether the username exists
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