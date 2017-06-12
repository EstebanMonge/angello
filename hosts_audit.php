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
        <div class="pull-right" style="padding-bottom:20px">
            <p><button type="button" class="btn btn-info" onclick="location.href='hosts_compare.php?vlan=<?=$vlan?>&scanid=<?=$scanid?>';">Compare scan</button> <button id="export" data-export="export" type="button" class="btn btn-info">Export</button></p>
        </div>
                <table id="hosts_table" class="table table-striped table-bordered" data-sortable>
                  <thead>
                    <tr>
                      <th>IP <span class="caret"></span></th>
                      <th>DNS <span class="caret"></span></th>
                      <th>OS <span class="caret"></span></th>
                      <th>MAC <span class="caret"></span></th>
                      <th>Interface <span class="caret"></span></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql = "SELECT * FROM hostnames_audit WHERE scanid = '".$scanid."' ORDER BY INET_ATON(ip) ASC";
                    foreach ($pdo->query($sql) as $row) {
                        echo '<tr>';
                        $iplast = explode('.', $row['ip']);
                        echo '<td data-value="'.$iplast[3].'">'.$row['ip'].'</td>';
                        echo '<td>'.$row['hostname'].'</td>';
                        echo '<td>'.$row['os'].'</td>';
                        echo '<td>'.$row['mac'].'</td>';
                        echo '<td>'.$row['interface'].'</td>';
                    }
                    Database::disconnect();
                    ?>
                  </tbody>
            </table>
        </div>
    </div> <!-- /container -->
  </body>
</html>
