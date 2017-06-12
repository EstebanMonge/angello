<?php
        require 'header.php';
        $pdo = Database::connect();
?>
<body>
    <?php
        echo drawHeader();
	$vlan=$_GET['vlan'];
	$scanid=$_GET['scanid'];
    ?>
    <div class="container-fluid">
            <div class="row">
                <h3>Hosts for vlan <?php echo $vlan; ?></h3>
                <table id="hosts_table" class="table table-striped table-bordered" data-sortable>
                  <thead>
                    <tr>
                      <th>IP <span class="caret"></span></th>
                      <th>DNS <span class="caret"></span></th>
                      <th>MAC <span class="caret"></span></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql = "select h.ip AS origip,h.hostname AS orighostname,h.mac AS origmac,a.ip AS scanip,a.hostname AS scanhostname, a.mac AS scanmac FROM hostnames h LEFT JOIN hostnames_audit a ON h.ip = a.ip AND scanid = ".$scanid." WHERE h.vlan =".$vlan." ORDER BY INET_ATON(h.ip) ASC";
                    foreach ($pdo->query($sql) as $row) {
                        echo '<tr>';
                        $iplast = explode('.', $row['origip']);
                        echo '<td data-value="'.$iplast[3].'">'.$row['origip'].'</td>';
			if ( $row['orighostname'] != $row['scanhostname'] ) {
					if ( $row['orighostname'] == 'free' && $row['scanhostname'] == '') {
						echo '<td>'.$row['orighostname'].'</td>';
					}
					else {
                        			echo '<td bgcolor="#F78181">'.$row['orighostname'].' != '.$row['scanhostname'].'</td>';
					}
			}
			else {
				echo '<td>'.$row['orighostname'].'</td>';
			}
                        if ( $row['origmac'] != $row['scanmac'] ) {
                                        echo '<td bgcolor="#F78181">'.$row['origmac'].' != '.$row['scanmac'].'</td>';
                        }
                        else {
                                echo '<td>'.$row['origmac'].'</td>';
                        }
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
