<!DOCTYPE html>
<?php
        include 'header.php';
?>
<html lang="en">
<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/sortable.min.js"></script>
</head>
 
<body>
	<?php
		echo drawHeader();
		if (!$_GET)
		{
			$vlan=128;
		}
		else
		{
			$vlan=$_GET["vlan"];
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
			<a data-toggle="modal" href="#myModal" title="Show hosts">
				<img src="icons/flaticon/svg/television-1.svg" />
			</a>
                        <!-- Modal -->
                        <div class="modal fade" id="myModal" role="dialog">
                                <div class="modal-dialog">
                                <!-- Modal content-->
                                        <div class="modal-content">
                                                <div class="modal-body">
                                                        <form action="hosts.php" method="GET">
                                                                 <div align="center">
                                                                        <select name="vlan" onchange="this.form.submit();">
                                                                                <option>Select VLAN</option>
                                                                                <?php
                                                                                        $pdo = Database::connect();
                                                                                        $sql = 'SELECT * FROM vlans ORDER BY vlan ASC';
                                                                                        foreach ($pdo->query($sql) as $row) {
                                                                                                echo '<option value="'.$row['vlan'].'">'.$row['vlan'].'</option>';
                                                                                        }
                                                                                        Database::disconnect();
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
