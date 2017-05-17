<?php
    include 'database.php';

    $country = $_GET['country'];
        $pdo = Database::connect();
        $sql = "DELETE FROM countries WHERE name LIKE '".$country."'";
    $q = $pdo->prepare($sql);
    $q->execute();
        $sql = "INSERT INTO logs(username,date,action) VALUES ('".$_COOKIE['username']."',now(),'Country ".$country." removed')";
        $q = $pdo->prepare($sql);
        $q->execute();
    Database::disconnect();
    header('Location: countries.php'); /* Redirect browser */
    exit();
