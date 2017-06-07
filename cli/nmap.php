<?php

require_once 'Net/Nmap.php';
require_once '../database.php';

//Get arguments from CLI and validate it
if (count($argv) != 4) {
    echo 'Usage: '.$argv[0]." /path/nmap_scan.xml vlan type\n";
    exit;
}
if (!is_file($argv[1])) {
    echo "File does not exist\n";
    echo 'Usage: '.$argv[0]." /path/nmap_scan.xml vlan type\n";
    exit;
}

try {
    $nmap = new Net_Nmap();

    //Parse XML Output to retrieve Hosts Object
    $hosts = $nmap->parseXMLOutput($argv[1]);
	

}
catch (Net_Nmap_Exception $ne) {
    echo $ne->getMessage();
}

if ( $argv[3] == "complete" ) {
    complete($argv[2],$hosts);
}
if ( $argv[3] == "audit" ) {
    audit($argv[2],$hosts);
}
else {
    echo "Scan type are complete or audit\n";
}

function complete($vlan,$hosts) {
    //Print results
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
        $sql = "UPDATE hostnames SET ip = '".$host->getAddress(ipv4)."', hostname = '".$host->getHostname()."', os = '".$os."', mac = '".$host->getAddress(mac)."' WHERE ip = '".$host->getAddress(ipv4)."' AND vlan = '".$vlan."'";
        $pdo->exec($sql);
        $services = $host->getServices();
        foreach ($services as $key => $service) {
            $sql = "INSERT INTO services (ip, name,port_number, type) VALUES ('".$host->getAddress(ipv4)."','".$service->name."','".$service->port."','".$service->protocol."')";
            $pdo->exec($sql);
        }
    }
    Database::disconnect();
}

function audit($vlan,$hosts) {
    //Print results
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO scans (date,vlan) VALUES ('".date('Y-m-d H:i:s')."','".$vlan."')";
    $pdo->exec($sql);
    $sql = $pdo->prepare("SELECT id FROM scans ORDER BY id DESC LIMIT 1");
    $sql->execute();
    $scanid=$sql->fetchAll();
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
        $sql = "INSERT INTO hostnames_audit (ip,hostname, mac,scanid) VALUES ('".$host->getAddress(ipv4)."', '".$host->getHostname()."', '".$host->getAddress(mac)."','".$scanid[0]['id']."')";
        $pdo->exec($sql);
    }
    Database::disconnect();
}
