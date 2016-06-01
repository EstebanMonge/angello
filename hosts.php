<!DOCTYPE html>
<?php
        include 'header.php';
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/sortable.min.js"></script>
</head>
<body>
    <div class="container">
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
            <div class="row">
                <h3>Hostnames</h3>
            </div>
            <div class="row">
                <h3>Hosts for vlan <?php echo $vlan;?></h3>
                <table class="table table-striped table-bordered" data-sortable>
                  <thead>
                    <tr>
                      <th>IP</th>
                      <th>DNS</th>
                      <th>OS</th>
                      <th>MAC</th>
                      <th>Interface</th>
                      <th>Comment</th>
                      <th>Services</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   $pdo = Database::connect();
                   $sql = "SELECT * FROM hostnames WHERE vlan LIKE '".$vlan."' ORDER BY ip DESC";
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
			    $iplast=explode(".", $row['ip']);
                            echo '<td data-value="'.$iplast[3].'">'. $row['ip'] . '</td>';
                            echo '<td>'. $row['hostname'] . '</td>';
                            echo '<td>'. $row['os'] . '</td>';
                            echo '<td>'. $row['mac'] . '</td>';
                            echo '<td>'. $row['interface'] . '</td>';
			    if ($row['comments'] == "")
			    {
                            	echo '<td><a href="comments.php?ip='.$row['ip'].'&type=Add">Add</a></td>';
			    }
			    else
			    {
				echo '<td><a href="comments.php?ip='.$row['ip'].'&vlan='.$row['vlan'].'&type=Modify">'.$row['comments'].'</a></td>';
			    }
                            echo '<td><a href="ports.php?ip='.$row['ip'].'">Details</a></td>';
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
