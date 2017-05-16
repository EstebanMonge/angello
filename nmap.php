<?php

require_once 'Net/Nmap.php';
require_once 'database.php';

try {
    $nmap = new Net_Nmap();

    //Get arguments from CLI and validate it
    if (count($argv) != 3) {
        echo 'Usage: '.$argv[0]." /path/nmap_scan.xml vlan\n";
        exit;
    }
    if (!is_file($argv[1])) {
        echo "File does not exist\n";
        echo 'Usage: '.$argv[0]." /path/nmap_scan.xml vlan\n";
        exit;
    }

    //Parse XML Output to retrieve Hosts Object
    $hosts = $nmap->parseXMLOutput($argv[1]);

    //Print results
    foreach ($hosts as $key => $host) {
        switch (true) {
        case strstr($host->getOS(), 'fingerprints'):
            $os = 'unknown';
            break;
        case strstr($host->getOS(), 'AIX'):
            $os = 'AIX';
            break;
        case strstr($host->getOS(), 'Linux'):
            $os = 'Linux';
            break;
    }
        $sql = "UPDATE hostnames SET ip = '".$host->getAddress(ipv4)."', hostname = '".$host->getHostname()."', os = '".$os."', mac = '".$host->getAddress(mac)."', vlan = '".$argv[2]."' WHERE ip = '".$host->getAddress(ipv4)."' AND vlan = '".$argv[2]."'";
//	$sql = "INSERT INTO hostnames (ip,hostname, os, mac,vlan) VALUES ('".$host->getAddress(ipv4)."', '".$host->getHostname()."', '".$os."','".$host->getAddress(mac)."','".$argv[2]."')";
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec($sql);
        $services = $host->getServices();
        foreach ($services as $key => $service) {
            $sql = "INSERT INTO services (ip, name,port_number, type) VALUES ('".$host->getAddress(ipv4)."','".$service->name."','".$service->port."','".$service->protocol."')";
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec($sql);
        }
    }
} catch (Net_Nmap_Exception $ne) {
    echo $ne->getMessage();
}
