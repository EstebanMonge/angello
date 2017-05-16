<?php
        include 'header.php';
?>
<body>
	<?php
           echo drawHeader();
       $ip = $_GET['ip'];
    ?>
    <div class="container-fluid">
            <div class="row">
                <h3>Services for host <?php echo $ip?></h3>
                <table class="table table-striped table-bordered" data-sortable>
                  <thead>
                    <tr>
                      <th>Port number <span class="caret"></th>
                      <th>Protocol <span class="caret"></th>
                      <th>Description <span class="caret"></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   $pdo = Database::connect();
                   $sql = 'SELECT port_number,type,name FROM services WHERE ip LIKE "'.$ip.'" ORDER BY ip DESC';
                   foreach ($pdo->query($sql) as $row) {
                       echo '<tr>';
                       echo '<td>'.$row['port_number'].'</td>';
                       echo '<td>'.$row['type'].'</td>';
                       echo '<td>'.$row['name'].'</td>';
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
