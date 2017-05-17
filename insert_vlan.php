<?php
    require 'database.php';

    $vlan = $_POST['vlan'];
    $description = $_POST['description'];
    $mask = $_POST['mask'];
    $iprange = $_POST['iprange'];
        $pdo = Database::connect();
        $sql = "INSERT INTO vlans (vlan,description,mask,iprange) VALUES ('".$vlan."','".$description."','".$mask."','".$iprange."')";
    $q = $pdo->prepare($sql);
    $q->execute();
        $sql = "INSERT INTO logs(username,date,action) VALUES ('".$_COOKIE['username']."',now(),'VLAN ".$vlan." added')";
        $q = $pdo->prepare($sql);
        $q->execute();
        $ip_arr = explode('/', $iprange.'/'.$mask);
        $bin = '';

for ($i = 1; $i <= 32; $i++) {
    $bin .= $ip_arr[1] >= $i ? '1' : '0';
}

        $ip_arr[1] = bindec($bin);

        $ip = ip2long($ip_arr[0]);
        $nm = $ip_arr[1];
        $nw = ($ip & $nm);
        $bc = $nw | ~$nm;
        $bc_long = ip2long(long2ip($bc));

for ($zm = 1; ($nw + $zm) <= ($bc_long - 1); $zm++) {
    $sql = "INSERT INTO hostnames (ip,vlan,hostname) VALUES ('".long2ip($nw + $zm)."','".$vlan."','free')";
    $q = $pdo->prepare($sql);
    $q->execute();
}
    Database::disconnect();
    header('Location: vlans.php'); /* Redirect browser */
    exit();
