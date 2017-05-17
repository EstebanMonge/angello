<?php
    require 'database.php';

    $username = $_GET['username'];
        $pdo = Database::connect();
        $sql = "DELETE FROM users WHERE username LIKE '".$username."'";
    $q = $pdo->prepare($sql);
    $q->execute();
        $sql = "INSERT INTO logs(username,date,action) VALUES ('".$_COOKIE['username']."',now(),'User ".$username." removed')";
        $q = $pdo->prepare($sql);
        $q->execute();
    Database::disconnect();
    header('Location: users.php'); /* Redirect browser */
    exit();
