<?php
        include 'header.php';
?>
<body>
	<?php
        echo drawHeader();
        if (!$_GET) {
            $vlan = 128;
        } else {
            $vlan = $_GET['vlan'];
        }
    ?>
    <div class="container-fluid">
            <div class="row">
                <h3>VLANs</h3>
            </div>
            <div class="pull-right" style="padding-bottom:20px">
	    <?php
        if (isset($_COOKIE['isadmin'])) {
            echo '<a href="add_vlan.php" class="btn btn-info" role="button">Add VLAN</a>';
        }
        ?>
            </div>
            <div>
                <table class="table table-striped table-bordered" data-sortable>
                  <thead>
                    <tr>
                      <th>VLAN <span class="caret"></span></th>
                      <th>Site <span class="caret"></span></th>
                      <th>IP Range <span class="caret"></span></th>
                      <th>Mask</th>
                      <th>Comment <span class="caret"></th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM vlans ORDER BY vlan ASC';
                   foreach ($pdo->query($sql) as $row) {
                       echo '<tr>';
                       echo '<td><a href="hosts.php?vlan='.$row['vlan'].'">'.$row['vlan'].'</a></td>';
                       echo '<td>'.$row['id_site'].'</td>';
                       echo '<td>'.$row['iprange'].'</td>';
                       echo '<td>'.$row['mask'].'</td>';
                       if ($row['description'] == '') {
                           echo '<td><a href="comments.php?vlan='.$row['vlan'].'&type=Add">Add</a></td>';
                       } else {
                           echo '<td><a href="comments.php?vlan='.$row['vlan'].'&type=Modify">'.$row['description'].'</a></td>';
                       }
                       if (isset($_COOKIE['isadmin'])) {
                           echo '<td><a href="#" data-href="delete_vlan.php?vlan='.$row['vlan'].'" data-toggle="modal" data-target="#confirm-delete"><button type="button" class="btn btn-info">Delete</button></a></td>';
                           echo '</tr>';
                       } else {
                           echo '<td>None</td>';
                           echo '</tr>';
                       }
                   }
                   Database::disconnect();
                  ?>
                  </tbody>
            </table>
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
            Please confirm deletion 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>
        </div>
    </div> <!-- /container -->
    <script>
	$('#confirm-delete').on('show.bs.modal', function(e) {
	$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	});
    </script>
  </body>
</html>
