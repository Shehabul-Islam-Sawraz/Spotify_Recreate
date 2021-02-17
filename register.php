<!DOCTYPE html>
<?php
    include("includes/configs.php");
    include("includes/classes/Account.php");
    include("includes/classes/Errors.php");
    $user_account = new Account($conn);
    include("includes/handler/handleRegistration.php");
    include("includes/handler/handleLogin.php");
    //This function is used for keeping the last values of the fields of the registration form when they are posted once with some errors
    function getValue($field){
        if(isset($_POST[$field])){
            echo $_POST[$field];
        }
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Spotify!</title>
</head>
<body>
    <div id="inputContainer">
        <form id="loginForm" action="register.php" method="POST">
            <h3>Login to Your Account</h3>
            <p>
                <label for="loginUsername">Name: </label>
                <input id="loginUsername" name="loginUsername" type="text" placeholder="Shehabul Islam Sawraz" required>
            </p>
            <p>
                <label for="loginPassword">Password: </label>
                <input id="loginPassword" name="loginPassword" type="password" placeholder="Your Password" required>
            </p>
            <button type="submit" name="loginButton">Log In</button>
        </form>

        <form id="registerForm" action="register.php" method="POST">
            <h3>Create Account for Free</h3>
            <p>
                <label for="username">Name: </label>
                <input id="username" name="username" type="text" placeholder="Shehabul Islam Sawraz" value="<?php getValue('username') ?>" required>
                <?php 
                    echo $user_account->getError(Errors::$username_error); 
                ?>
                <?php 
                    echo $user_account->getError(Errors::$username_taken); 
                ?>
            </p>
            <p>
                <label for="firstname">First Name: </label>
                <input id="firstname" name="firstname" type="text" placeholder="Shehabul Islam" value="<?php getValue('firstname') ?>" required>
                <?php 
                    echo $user_account->getError(Errors::$firstname_error); 
                ?>
            </p>
            <p>
                <label for="lastname">Last Name: </label>
                <input id="lastname" name="lastname" type="text" placeholder="Sawraz" value="<?php getValue('lastname') ?>" required>
                <?php 
                    echo $user_account->getError(Errors::$lastname_error); 
                ?>
            </p>
            <p>
                <label for="email">E-mail: </label>
                <input id="email" name="email" type="email" placeholder="sawraz@gmail.com" value="<?php getValue('email') ?>" required>
                <?php 
                    echo $user_account->getError(Errors::$email_unmatch); 
                ?>
                <?php 
                    echo $user_account->getError(Errors::$invalid_email); 
                ?>
                <?php 
                    echo $user_account->getError(Errors::$email_taken); 
                ?>
            </p>
            <p>
                <label for="email2">Confirm E-mail: </label>
                <input id="email2" name="email2" type="email" placeholder="sawraz@gmail.com" value="<?php getValue('email2') ?>" required>
            </p>
            <p>
                <label for="password">Password: </label>
                <input id="password" name="password" type="password" placeholder="Your Password" required>
                <?php 
                    echo $user_account->getError(Errors::$password_unmatch); 
                ?>
                <?php 
                    echo $user_account->getError(Errors::$invalid_password); 
                ?>
            </p>
            <p>
                <label for="password2">Confirm Password: </label>
                <input id="password2" name="password2" type="password" placeholder="Your Password" required>
            </p>
            <button type="submit" name="signInButton">Sign Up</button>
        </form>
    </div>
</body>
</html>