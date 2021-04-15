<?php
	include("../../configs.php");

	if(!isset($_POST['username'])) {
		echo "ERROR: Could not set username";
		exit();
	}

	if(!isset($_POST['oldPassword']) || !isset($_POST['newPassword1'])  || !isset($_POST['newPassword2'])) {
		echo "Not all passwords have been set";
		exit();
	}

	if($_POST['oldPassword'] == "" || $_POST['newPassword1'] == ""  || $_POST['newPassword2'] == "") {
		echo "Please fill in all fields";
		exit();
	}

	$username = $_POST['username'];
	$oldPassword = $_POST['oldPassword'];
	$newPassword1 = $_POST['newPassword1'];
	$newPassword2 = $_POST['newPassword2'];

	$oldMd5 = md5($oldPassword);

	$passwordCheck = mysqli_query($conn, "SELECT * FROM userinfo WHERE username='$username' AND password='$oldMd5'");
	if(mysqli_num_rows($passwordCheck) != 1) {
		echo "Password is incorrect";
		exit();
	}

	if($newPassword1 != $newPassword2) {
		echo "Your new passwords do not match";
		exit();
	}
	$pattern = "/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/";
	if(preg_match($pattern, $newPassword1)) {
		echo "The password must contain at least one uppercase and one lowercase letter, at least one special character or number and it must be at least 8 characters long.";
		exit();
	}

	$newMd5 = md5($newPassword1);

	$query = mysqli_query($conn, "UPDATE userinfo SET password='$newMd5' WHERE username='$username'");
	echo "Update successful";

?>