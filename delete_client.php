<?php
    require 'database.php';

    $client = $_GET['client'];
        $pdo = Database::connect();
        $sql = "DELETE FROM clients WHERE name LIKE '".$client."'";
    $q = $pdo->prepare($sql);
    $q->execute();
        $sql = "INSERT INTO logs(username,date,action) VALUES ('".$_COOKIE['username']."',now(),'Client ".$client." removed')";
        $q = $pdo->prepare($sql);
        $q->execute();
    Database::disconnect();
    header('Location: clients.php'); /* Redirect browser */
    exit();
