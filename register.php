<!DOCTYPE html>
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
                <input id="username" name="username" type="text" placeholder="Shehabul Islam Sawraz" required>
            </p>
            <p>
                <label for="firstname">First Name: </label>
                <input id="firstname" name="firstname" type="text" placeholder="Shehabul Islam" required>
            </p>
            <p>
                <label for="lastname">Last Name: </label>
                <input id="lastname" name="lastname" type="text" placeholder="Sawraz" required>
            </p>
            <p>
                <label for="email">E-mail: </label>
                <input id="email" name="email" type="email" placeholder="sawraz@gmail.com" required>
            </p>
            <p>
                <label for="email2">Confirm E-mail: </label>
                <input id="email2" name="email2" type="email" placeholder="sawraz@gmail.com" required>
            </p>
            <p>
                <label for="password">Password: </label>
                <input id="password" name="password" type="password" placeholder="Your Password" required>
            </p>
            <p>
                <label for="password2">Confirm Password: </label>
                <input id="password2" name="password2" type="password" placeholder="Your Password" required>
            </p>
            <button type="submit" name="signInButton">Sign Up</button>
        </form>
    </div>
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
        if(isset($_POST['loginButton'])){
            echo "Login Button Pressed.<br>";
        }
        elseif(isset($_POST['signInButton'])){
            $username = setUsername($_POST['username']);
            $firstname = setString($_POST['firstname']);
            $lastname = setString($_POST['lastname']);
            $email = setString($_POST['email']);
            $email2 = setString($_POST['email2']);
            $password = setPassword($_POST['password']);
            $password2 = setPassword($_POST['password2']);
        }
    ?>
</body>
</html>