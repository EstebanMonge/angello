<?php
	include 'database.php';

	$username=$_POST['username'];
	$password=$_POST['password'];
	$name=$_POST['name'];
	$email=$_POST['email'];
	$isadmin=$_POST['isadmin'];
        if ($isadmin != 1) {
		$isadmin=0;
	}	
        $pdo = Database::connect();
        $sql= "INSERT INTO users (username,password,name,email,is_admin,is_active) VALUES ('".$username."','".$password."','".$name."','".$email."',".$isadmin.",1)";
	$q = $pdo->prepare($sql);
	$q->execute();

	Database::disconnect();
	header("Location: users.php"); /* Redirect browser */
	exit();
?>
