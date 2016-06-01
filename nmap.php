<?php

require_once 'Net/Nmap.php';
require_once 'database.php';

try {
    $nmap = new Net_Nmap();

    //Get arguments from CLI and validate it
    if ( count($argv) != 3 ) {
	echo "Usage: ".$argv[0]." /path/nmap_scan.xml vlan\n";
    	exit;
    }
   if ( !is_file($argv[1]) ) {
	echo "File does not exist\n";
	echo "Usage: ".$argv[0]." /path/nmap_scan.xml vlan\n"; 
	exit;
   }

    //Parse XML Output to retrieve Hosts Object
    $hosts = $nmap->parseXMLOutput($argv[1]);

    //Print results
    echo "IP,hostname,description,site,type,AI,comment,network,BM,network category,MAC,switch,port</br>";
    foreach ($hosts as $key => $host) {
        echo $host->getAddress(ipv4) . ",";
        echo $host->getHostname() . ",";
	echo ",,,,";
       // echo $host->getOS() . ",";
	switch (true) {
		case strstr($host->getOS(),'fingerprints'):
			$os="unknown";
			break;
		case strstr($host->getOS(),'AIX'):
			$os="AIX";
			break;
		case strstr($host->getOS(),'Linux'):
			$os="Linux";
			break;
	}
	echo ",,,";
        echo $host->getAddress(mac) . ",";
	echo ",";
        $sql = "UPDATE hostnames SET ip = '".$host->getAddress(ipv4)."', hostname = '".$host->getHostname()."', os = '".$os."', mac = '".$host->getAddress(mac)."', vlan = '".$argv[2]."' WHERE ip = '".$host->getAddress(ipv4)."' AND vlan = '".$argv[2]."'";
//	$sql = "INSERT INTO hostnames (ip,hostname, os, mac,vlan) VALUES ('".$host->getAddress(ipv4)."', '".$host->getHostname()."', '".$os."','".$host->getAddress(mac)."','".$argv[2]."')";
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->exec($sql);
        $services = $host->getServices();
        foreach ($services as $key => $service) {
            echo $service->port . " " . $service->name ." ".$service->protocol. " ";
	    $sql = "INSERT INTO services (ip, name,port_number, type) VALUES ('".$host->getAddress(ipv4)."','".$service->name."','".$service->port."','".$service->protocol."')";
	    $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec($sql);
        }
	echo "</br>";
    }
} catch (Net_Nmap_Exception $ne) {
    echo $ne->getMessage();
}
?>
