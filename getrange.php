<?php
function get_list_ip($ip_addr_cidr){

        $ip_arr = explode("/", $ip_addr_cidr);    
        $bin = "";

        for($i=1;$i<=32;$i++) {
            $bin .= $ip_arr[1] >= $i ? '1' : '0';
        }

        $ip_arr[1] = bindec($bin);

        $ip = ip2long($ip_arr[0]);
        $nm = $ip_arr[1];
        $nw = ($ip & $nm);
        $bc = $nw | ~$nm;
        $bc_long = ip2long(long2ip($bc));

//        echo "Number of Hosts:    " . ($bc_long - $nw - 1) . "<br/>";
//        echo "Host Range:         " . long2ip($nw + 1) . " -> " . long2ip($bc - 1) . "<br/>". "<br/>";

        for($zm=1;($nw + $zm)<=($bc_long - 1);$zm++)
        {
            echo long2ip($nw + $zm).  "<br/>";
        }
    }
    get_list_ip("10.149.128.0/24");
?>
