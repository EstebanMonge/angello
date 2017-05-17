<?php
    require 'database.php';

    $vlan = $_GET['vlan'];
        $pdo = Database::connect();
        $sql = "DELETE FROM vlans WHERE vlan LIKE '".$vlan."'";
    $q = $pdo->prepare($sql);
    $q->execute();
    $sql = "DELETE FROM hostnames WHERE vlan LIKE '".$vlan."'";
    $q = $pdo->prepare($sql);
    $q->execute();
        $sql = "INSERT INTO logs(username,date,action) VALUES ('".$_COOKIE['username']."',now(),'VLAN ".$vlan." removed')";
        $q = $pdo->prepare($sql);
        $q->execute();
    Database::disconnect();
    header('Location: vlans.php'); /* Redirect browser */
    exit();
