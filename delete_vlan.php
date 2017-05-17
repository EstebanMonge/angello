<?php
    include 'database.php';

    $vlan = $_GET['vlan'];
        $pdo = Database::connect();
<<<<<<< HEAD
        $sql= "DELETE FROM vlans WHERE vlan LIKE '".$vlan."'";
	$q = $pdo->prepare($sql);
	$q->execute();
	$sql="DELETE FROM hostnames WHERE vlan LIKE '".$vlan."'";
	$q = $pdo->prepare($sql);
	$q->execute();
        $sql= "INSERT INTO logs(username,date,action) VALUES ('".$_COOKIE['username']."',now(),'VLAN ".$vlan." removed')";
        $q = $pdo->prepare($sql);
        $q->execute();
	Database::disconnect();
	header("Location: vlans.php"); /* Redirect browser */
	exit();
?>
=======
        $sql = "DELETE FROM vlans WHERE vlan LIKE '".$vlan."'";
    $q = $pdo->prepare($sql);
    $q->execute();
    $sql = "DELETE FROM hostnames WHERE vlan LIKE '".$vlan."'";
    $q = $pdo->prepare($sql);
    $q->execute();
    Database::disconnect();
    header('Location: vlans.php'); /* Redirect browser */
    exit();
>>>>>>> a0904be705d6269af051b9e9ae3184873b74e65b
