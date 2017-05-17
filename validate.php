<?php

require 'database.php';
        $pdo = Database::connect();
        $sql = "SELECT password,is_admin FROM users WHERE username LIKE '".$_POST['username']."'";
foreach ($pdo->query($sql) as $row) {
    $password = $row['password'];
    $isadmin = $row['is_admin'];
}
    Database::disconnect();

if (isset($_POST['username']) && isset($_POST['password'])) {
    if ($_POST['password'] == $password) {
        /* Cookie expires when browser closes */
            setcookie('username', $_POST['username'], false, '/angello', 'ms.gbmcloud.com');
        setcookie('password', md5($_POST['password']), false, '/angello', 'ms.gbmcloud.com');
        if ($isadmin == 1) {
            setcookie('isadmin', 'yes', false, '/angello', 'ms.gbmcloud.com');
        }
        header('Location: index.php');
    } else {
        header('Location: login.php');
    }
} else {
    header('Location: login.php');
}
