<?php
    class Errors{
        public static $username_error = "The username must be between 5 and 25 characters.";
        public static $username_taken = "The username already exists.";
        public static $firstname_error = "The firstname must be between 3 and 25 characters.";
        public static $lastname_error = "The lastname must be between 3 and 25 characters.";
        public static $email_unmatch = "The emails don't match.";
        public static $invalid_email = "The email is invalid.";
        public static $email_taken = "The email is already in use. Use another Account!";
        public static $password_unmatch = "The passwords don't match.";
        public static $invalid_password = "The password must contain at least one uppercase and one lowercase letter, at least one special character or number and it must be at least 8 characters long.";
        public static $loginFailed = "Incorrect Username or Password.";
    }
?>