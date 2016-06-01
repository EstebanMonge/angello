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
                <h3>VLANs</h3>
            </div>
            <div class="row">
                <h3>VLANs</h3>
            </div>
            <div class="pull-right" style="padding-bottom:20px">
		<a href="add_vlan.php" class="btn btn-info" role="button">Add VLAN</a>
            </div>
            <div>
                <table class="table table-striped table-bordered" data-sortable>
                  <thead>
                    <tr>
                      <th>VLAN</th>
                      <th>IP Range</th>
                      <th>Mask</th>
                      <th>Comment</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   $pdo = Database::connect();
                   $sql = "SELECT * FROM vlans ORDER BY vlan DESC";
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['vlan'] . '</td>';
                            echo '<td>'. $row['iprange'] . '</td>';
                            echo '<td>'. $row['mask'] . '</td>';
			    if ($row['description'] == "")
			    {
                            	echo '<td><a href="comments.php?vlan='.$row['vlan'].'&type=Add">Add</a></td>';
			    }
			    else
			    {
				echo '<td><a href="comments.php?vlan='.$row['vlan'].'&type=Modify">'.$row['description'].'</a></td>';
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
