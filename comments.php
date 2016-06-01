<!DOCTYPE html>
<?php
        include 'header.php';
	$ip=$_GET["ip"];
	$vlan=$_GET["vlan"];
	$type=$_GET["type"];
	$pdo = Database::connect();
        $sql = "SELECT comments FROM hostnames WHERE ip LIKE '".$ip."'";
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
	?>
            <div class="row">
                <h3>Hostnames</h3>
            </div>
            <div class="row">
                <h3><?php echo $type?> comment for <?php 
		if ($ip) {
			echo "host ".$ip;
		}
		else {
			echo "vlan ".$vlan;
		
		}
		?>
		
		</h3>
		<form class="form-inline" role="form" action="insert_comment.php" method="POST">
 		<div class="form-group">
			<TEXTAREA NAME="comment" COLS=40 ROWS=6><?php
			foreach ($pdo->query($sql) as $row) {
				echo $row['comments'];
			}
			?></TEXTAREA>
 			<input type="hidden" name="ip" value="<?php echo $ip?>">
 		</div>
  		<button type="submit" class="btn btn-default">Submit</button>
		</form>
            </div> <!-- /row -->
    </div> <!-- /container -->
  </body>
</html>
