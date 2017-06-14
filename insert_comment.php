<?php
    require 'database.php';
    $ip = $_POST['ip'];
    $vlan = $_POST['vlan'];
    $reserved = $_POST['reserved'];
    $item = $_POST['item'];
    $comment = $_POST['comment'];
    $pdo = Database::connect();
    $url = 'index.php';
    if ($reserved == "")
	$reserved = 0;
    switch ($item) {
	case "Interface":
    		$sql = "UPDATE hostnames SET interface='".$comment."' where ip like '".$ip."'";
    		$url = 'hosts.php?vlan='.$vlan;
                break;
        case "Switch":
    		$sql = "UPDATE hostnames SET switch='".$comment."' where ip like '".$ip."'";
    		$url = 'hosts.php?vlan='.$vlan;
                break;
        case "Switch Interface":
    		$sql = "UPDATE hostnames SET switch_interface='".$comment."' where ip like '".$ip."'";
    		$url = 'hosts.php?vlan='.$vlan;
                break;
        case "Comment";
    		$sql = "UPDATE hostnames SET comments='".$comment."',reserved=".$reserved." where ip like '".$ip."'";
    		$url = 'hosts.php?vlan='.$vlan;
                break;
        case "Description";
    		$sql = "UPDATE vlans SET description='".$comment."' where vlan like '".$vlan."'";
    		$url = 'vlans.php';
                break;
    }

    $q = $pdo->prepare($sql);
    $q->execute();
    Database::disconnect();
    header("Location: $url"); /* Redirect browser */
    exit();
