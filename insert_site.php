<?php
	include 'database.php';

	$site=$_POST['site'];
	echo $client=$_POST['client'];
	echo $country=$_POST['country'];
	echo $description=$_POST['description'];
        $pdo = Database::connect();
        $sql= "INSERT INTO sites (name,description,id_client,id_country) VALUES ('".$site."','".$description."','".$client."','".$country."')";
	$q = $pdo->prepare($sql);
	$q->execute();
        $sql= "INSERT INTO logs(username,date,action) VALUES ('".$_COOKIE['username']."',now(),'Site ".$site." added')";
        $q = $pdo->prepare($sql);
        $q->execute();
	Database::disconnect();
	header("Location: sites.php"); /* Redirect browser */
	exit();
?>
