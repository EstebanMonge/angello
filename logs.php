<?php
        include 'header.php';
?>
<body>
	<?php
        echo drawHeader();
    ?>
    <div class="container-fluid">
            <div class="row">
                <h3>Logs</h3>
            </div>
            <div>
                <table class="table table-striped table-bordered" data-sortable>
                  <thead>
                    <tr>
                      <th>Date <span class="caret"></span></th>
                      <th>Username <span class="caret"></span></th>
                      <th>Details</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM logs ORDER BY date DESC';
                   foreach ($pdo->query($sql) as $row) {
                       echo '<tr>';
                       echo '<td>'.$row['date'].'</td>';
                       echo '<td>'.$row['username'].'</td>';
                       echo '<td>'.$row['action'].'</td>';
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
