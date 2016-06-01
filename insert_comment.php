<?php
	include 'database.php';
	$ip=$_POST['ip'];
	$comment=$_POST['comment'];
        $pdo = Database::connect();
        $sql= "UPDATE hostnames SET comments='".$comment."' where ip like '".$ip."'";
	$q = $pdo->prepare($sql);
	$q->execute();
	Database::disconnect();
	header("Location: hosts.php"); /* Redirect browser */
	exit();
?>
