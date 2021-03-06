<?php
/**
 * Angello IP Management 
 * PHP Version 7
 *
 * @category PHP
 * @package  Angello
 * @author   Esteban Monge <estebanmonge@riseup.net> 
 * @license  https://opensource.org/licenses/BSD-2-Clause BSD 
 * @link     http://www.hashbangcode.com/
 */
?>
<body>
    <?php
    require 'header.php';
    echo drawHeader();
    try {
    if (!$_GET) {
        $vlan = 128;
    } else {
        $vlan = $_GET['vlan'];
    }
    }
    catch (Exception $e){
       echo "Problem detected: ".$e->getMessage()."\n";
    }
    ?>
    <div class="container-fluid">
            <div class="row">
            <div class="col-sm-4">
            <a href="vlans.php" title="Admin VLANs">
                <img src="icons/flaticon/svg/network.svg" />
            </a>
            </div>
                <div class="col-sm-4">
            <a data-toggle="modal" href="#VlanModal" title="Show hosts">
                <img src="icons/flaticon/svg/television-1.svg" />
            </a>
                        <!-- Modal -->
                        <div class="modal fade" id="VlanModal" role="dialog">
                                <div class="modal-dialog">
                                <!-- Modal content-->
                                        <div class="modal-content">
                                                <div class="modal-body">
                                                        <form action="hosts.php" method="GET">
                                                                 <div align="center">
                                                                        <select name="vlan" onchange="this.form.submit();">
                                                                                <option>Select VLAN</option>
                                                                                <?php
										try {
                                                                                $pdo = Database::connect();
                                                                                $sql = 'SELECT * FROM vlans ORDER BY vlan ASC';
                                                                                foreach ($pdo->query($sql) as $row) {
                                                                                    echo '<option value="'.$row['vlan'].'">'.$row['vlan'].'</option>';
                                                                                }
                                                                                Database::disconnect();
										}
										catch (Exception $e){
											echo "Problem detected: ".$e->getMessage()."\n";
										}
                                                                                ?>
                                                                        </select>
                                                                </div>
                                                        </form>
                                                </div>
                                        </div>
                                </div>
                        </div>
        </div>
        <div class="col-sm-4">
            <a href="scans.php" title="Admin scans">
                <img src="icons/flaticon/svg/list.svg" />
            </a>
            </div>
    </div><!-- /container -->
  </body>
</html>
