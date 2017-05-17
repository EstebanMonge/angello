<?php
<<<<<<< HEAD
	include 'database.php';
	$ip=$_POST['ip'];
	$vlan=$_POST['vlan'];
	$reserved=$_POST['reserved'];
	$comment=$_POST['comment'];
=======
    include 'database.php';
    $ip = $_POST['ip'];
    $vlan = $_POST['vlan'];
    $comment = $_POST['comment'];
>>>>>>> a0904be705d6269af051b9e9ae3184873b74e65b
        $pdo = Database::connect();
    $url = 'index.php';
        if ($ip) {
<<<<<<< HEAD
		if ($reserved) {
			$sql="UPDATE hostnames SET comments='".$comment."', reserved = 1, hostname = 'reserved' where ip like '".$ip."'";
		}
		else {
        		$sql= "UPDATE hostnames SET comments='".$comment."' where ip like '".$ip."'";
		}
      		$url= "hosts.php?vlan=".$vlan;
=======
            $sql = "UPDATE hostnames SET comments='".$comment."' where ip like '".$ip."'";
            $url = 'hosts.php?vlan='.$vlan;
        } else {
            $sql = "UPDATE vlans SET description='".$comment."' where vlan like '".$vlan."'";
            $url = 'vlans.php';
>>>>>>> a0904be705d6269af051b9e9ae3184873b74e65b
        }
    $q = $pdo->prepare($sql);
    $q->execute();
    Database::disconnect();
    header("Location: $url"); /* Redirect browser */
    exit();
