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
	   $ip=$_GET["ip"];
	?>
            <div class="row">
                <h3>Hostnames</h3>
            </div>
            <div class="row">
                <h3>Services for host <?php echo $ip?></h3>
                <table class="table table-striped table-bordered" data-sortable>
                  <thead>
                    <tr>
                      <th>Port number</th>
                      <th>Protocol</th>
                      <th>Description</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   $pdo = Database::connect();
                   $sql = 'SELECT port_number,type,name FROM services WHERE ip LIKE "'.$ip.'" ORDER BY ip DESC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['port_number'] . '</td>';
                            echo '<td>'. $row['type'] . '</td>';
                            echo '<td>'. $row['name'] . '</td>';
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
