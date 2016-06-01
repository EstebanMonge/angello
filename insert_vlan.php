<?php
	include 'database.php';
	$vlan=$_POST['vlan'];
	$description=$_POST['description'];
	$mask=$_POST['mask'];
	$iprange=$_POST['iprange'];
        $pdo = Database::connect();
        $sql= "INSERT INTO vlans (vlan,description,mask,iprange) VALUES ('".$vlan."','".$description."','".$mask."','".$iprange."')";
	$q = $pdo->prepare($sql);
	$q->execute();
	Database::disconnect();
	header("Location: vlans.php"); /* Redirect browser */
	exit();
?>
