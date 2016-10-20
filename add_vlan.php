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
                <h3>VLANs</h3>
            </div>
            <div class="row">
                <h3>Add VLAN</h3>
 <form role="form" action="insert_vlan.php" method="POST">
  <div class="form-group">
    <label for="vlan">VLAN name:</label>
    <input type="text" class="form-control" name="vlan">
    <label for="vlan">Comment:</label>
    <input type="text" class="form-control" name="description">
    <label for="vlan">Mask:</label>
    <input type="text" class="form-control" name="mask">
    <label for="vlan">IP Range:</label>
    <input type="text" class="form-control" name="iprange">
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>


            </div>
        </div>
    </div> <!-- /container -->
  </body>
</html>
