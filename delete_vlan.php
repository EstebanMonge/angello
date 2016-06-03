<?php
	include 'database.php';

	$vlan=$_GET['vlan'];
        $pdo = Database::connect();
        $sql= "DELETE FROM vlans WHERE vlan LIKE '".$vlan."'";
	$q = $pdo->prepare($sql);
	$q->execute();
	$sql="DELETE FROM hostnames WHERE vlan LIKE '".$vlan."'";
	$q = $pdo->prepare($sql);
	$q->execute();
	Database::disconnect();
	header("Location: vlans.php"); /* Redirect browser */
	exit();
?>
