<?php
    include 'database.php';
    $ip = $_POST['ip'];
    $vlan = $_POST['vlan'];
    $comment = $_POST['comment'];
        $pdo = Database::connect();
    $url = 'index.php';
        if ($ip) {
            $sql = "UPDATE hostnames SET comments='".$comment."' where ip like '".$ip."'";
            $url = 'hosts.php?vlan='.$vlan;
        } else {
            $sql = "UPDATE vlans SET description='".$comment."' where vlan like '".$vlan."'";
            $url = 'vlans.php';
        }
    $q = $pdo->prepare($sql);
    $q->execute();
    Database::disconnect();
    header("Location: $url"); /* Redirect browser */
    exit();
