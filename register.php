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
    <link rel="stylesheet" type="text/css" href="assets/css/register.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="assets/js/register.js"></script>
</head>
<body>
    <?php
        if(isset($_POST['signInButton'])){
            echo '<script>
            $(document).ready(function(){
                $("#loginForm").hide();
                $("#registerForm").show();
            });
            </script>';
        }
        else{
            echo '<script>
            $(document).ready(function(){
                $("#loginForm").show();
                $("#registerForm").hide();
            });
            </script>';
        }
    ?>
    <div id="background">
        <div id="loginContainer">
            <div id="inputContainer">
                <form id="loginForm" action="register.php" method="POST">
                    <h2>Login to Your Account</h3>
                    <?php 
                        echo $user_account->getError(Errors::$loginFailed); 
                    ?>
                    <p>
                        <label for="loginUsername">Name </label>
                        <input id="loginUsername" name="loginUsername" type="text" placeholder="e.g. Shehabul Islam" value="<?php getValue('loginUsername') ?>" required>
                    </p>
                    <p>
                        <label for="loginPassword">Password </label>
                        <input id="loginPassword" name="loginPassword" type="password" placeholder="Your Password" required>
                    </p>
                    <button type="submit" name="loginButton">Log In</button>
                    <div class="hasAccount">
                        <span id="hideLogin">Don't have an account yet? Sign Up here.</span>
                    </div>
                </form>

                <form id="registerForm" action="register.php" method="POST">
                    <h2>Create Account for Free</h3>
                    <p>
                        <label for="username">Name </label>
                        <input id="username" name="username" type="text" placeholder="e.g. Shehabul Islam" value="<?php getValue('username') ?>" required>
                        <?php 
                            echo $user_account->getError(Errors::$username_error); 
                        ?>
                        <?php 
                            echo $user_account->getError(Errors::$username_taken); 
                        ?>
                    </p>
                    <p>
                        <label for="firstname">First Name </label>
                        <input id="firstname" name="firstname" type="text" placeholder="Shehabul Islam" value="<?php getValue('firstname') ?>" required>
                        <?php 
                            echo $user_account->getError(Errors::$firstname_error); 
                        ?>
                    </p>
                    <p>
                        <label for="lastname">Last Name </label>
                        <input id="lastname" name="lastname" type="text" placeholder="Sawraz" value="<?php getValue('lastname') ?>" required>
                        <?php 
                            echo $user_account->getError(Errors::$lastname_error); 
                        ?>
                    </p>
                    <p>
                        <label for="email">E-mail </label>
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
                        <label for="email2">Confirm E-mail </label>
                        <input id="email2" name="email2" type="email" placeholder="sawraz@gmail.com" value="<?php getValue('email2') ?>" required>
                    </p>
                    <p>
                        <label for="password">Password </label>
                        <input id="password" name="password" type="password" placeholder="Your Password" required>
                        <?php 
                            echo $user_account->getError(Errors::$password_unmatch); 
                        ?>
                        <?php 
                            echo $user_account->getError(Errors::$invalid_password); 
                        ?>
                    </p>
                    <p>
                        <label for="password2">Confirm Password </label>
                        <input id="password2" name="password2" type="password" placeholder="Your Password" required>
                    </p>
                    <button type="submit" name="signInButton">Sign Up</button>
                    <div class="hasAccount">
                        <span id="hideRegister">Already have an account? Log In here.</span>
                    </div>
                </form>
            </div>
            <div id="loginText">
                <h1>Music is the shorthand of emotion-Leo Tolstoy</h1>
                <h2>Where words fail, music speaks</h2>
                <ul>
                    <li>Listen to lots of songs for free</li>
                    <li>Discover music of your own interest</li>
                    <li>Create your own playlist</li>
                    <li>Follow artists to keep up to date</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>