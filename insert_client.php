<?php
	include 'database.php';

	$client=$_POST['client'];
	$description=$_POST['description'];
        $pdo = Database::connect();
        $sql= "INSERT INTO clients (name,description) VALUES ('".$client."','".$description."')";
	$q = $pdo->prepare($sql);
	$q->execute();
        $sql= "INSERT INTO logs(username,date,action) VALUES ('".$_COOKIE['username']."',now(),'Client ".$client." added')";
        $q = $pdo->prepare($sql);
        $q->execute();
	Database::disconnect();
	header("Location: clients.php"); /* Redirect browser */
	exit();
?>
