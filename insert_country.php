<?php
	include 'database.php';

	$country=$_POST['country'];
	$description=$_POST['description'];
        $pdo = Database::connect();
        $sql= "INSERT INTO countries (name,description) VALUES ('".$country."','".$description."')";
	$q = $pdo->prepare($sql);
	$q->execute();
        $sql= "INSERT INTO logs(username,date,action) VALUES ('".$_COOKIE['username']."',now(),'Country ".$country." added')";
        $q = $pdo->prepare($sql);
        $q->execute();
	Database::disconnect();
	header("Location: countries.php"); /* Redirect browser */
	exit();
?>
