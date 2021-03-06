<?php
        require 'header.php';
        $pdo = Database::connect();
?>
<body>
    <?php
        echo drawHeader();
    if (!$_GET) {
        $vlan = 128;
    } else {
        $vlan = htmlentities($_GET["vlan"],  ENT_QUOTES,  "utf-8");
    }
        $sql = "select count(*) AS total from hostnames where vlan='".$vlan."'";
        $total_ip = $pdo->query($sql)->fetch();
        $sql = "select count(*) AS free from hostnames where hostname='free' and vlan='".$vlan."'";
        $free_ip = $pdo->query($sql)->fetch();
        $used_ip = $total_ip[total] - $free_ip[free];
        $perc_used_ip = ($used_ip * 100) / $total_ip[total];
    ?>
    <div class="container-fluid">
            <div class="row">
                <h3>Hosts for VLAN <?php echo $vlan; ?></h3>
        <p class="text-right"><?php echo '<strong>'.number_format((float) $perc_used_ip, 2, '.', '').'%</strong> network usage and <strong>'.$free_ip[free].' free</strong> IPs of '.$total_ip[total]; ?></p>
        <div class="pull-right" style="padding-bottom:20px">
            <p><button id="export" data-export="export" type="button" class="btn btn-info">Export</button></p>
        </div>
                <table id="hosts_table" class="table table-striped table-fixed table-fixed-hosts" data-sortable>
                  <thead>
                    <tr>
                      <th>IP <span class="caret"></span></th>
                      <th>DNS <span class="caret"></span></th>
                      <th>OS <span class="caret"></span></th>
                      <th>MAC <span class="caret"></span></th>
                      <th>Host Interface <span class="caret"></span></th>
                      <th>Switch <span class="caret"></span></th>
                      <th>Switch Interface <span class="caret"></span></th>
                      <th>Comment <span class="caret"></span></th>
                      <th>Services</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql = "SELECT * FROM hostnames WHERE vlan LIKE '".$vlan."' ORDER BY INET_ATON(ip) ASC";
                    foreach ($pdo->query($sql) as $row) {
                        echo '<tr>';
                        $iplast = explode('.', $row['ip']);
                        echo '<td data-value="'.$iplast[3].'">'.$row['ip'].'</td>';
                        echo '<td>'.$row['hostname'].'</td>';
                        echo '<td>'.$row['os'].'</td>';
                        echo '<td>'.$row['mac'].'</td>';
                        if ($row['interface'] == '') {
                            echo '<td><a href="comments.php?source=hosts&ip='.$row['ip'].'&vlan='.$row['vlan'].'&type=Add&item=Interface">Add</a></td>';
                        } else {
                            echo '<td><a href="comments.php?source=hosts&ip='.$row['ip'].'&vlan='.$row['vlan'].'&type=Modify&item=Interface">'.$row['interface'].'</a></td>';
                        }
                        if ($row['switch'] == '') {
                            echo '<td><a href="comments.php?source=hosts&ip='.$row['ip'].'&vlan='.$row['vlan'].'&type=Add&item=Switch">Add</a></td>';
                        } else {
                            echo '<td><a href="comments.php?source=hosts&ip='.$row['ip'].'&vlan='.$row['vlan'].'&type=Modify&item=Switch">'.$row['switch'].'</a></td>';
                        }
                        if ($row['switch_interface'] == '') {
                            echo '<td><a href="comments.php?source=hosts&ip='.$row['ip'].'&vlan='.$row['vlan'].'&type=Add&item=Switch Interface">Add</a></td>';
                        } else {
                            echo '<td><a href="comments.php?source=hosts&ip='.$row['ip'].'&vlan='.$row['vlan'].'&type=Modify&item=Switch Interface">'.$row['switch_interface'].'</a></td>';
			}
                        if ($row['comments'] == '') {
                            echo '<td><a href="comments.php?source=hosts&ip='.$row['ip'].'&vlan='.$row['vlan'].'&type=Add&item=Comment">Add</a></td>';
                        } else {
                            echo '<td><a href="comments.php?source=hosts&ip='.$row['ip'].'&vlan='.$row['vlan'].'&type=Modify&item=Comment">'.$row['comments'].'</a></td>';
                        }
                        echo '<td><a href="ports.php?source=hosts&ip='.$row['ip'].'">Details</a></td>';
                        echo '</tr>';
                    }
                    Database::disconnect();
                    ?>
                  </tbody>
            </table>
        </div>
    </div> <!-- /container -->
  </body>
</html>
