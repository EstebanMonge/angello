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
	?>
    <div class="container-fluid">
            <div class="row">
                <h3>Clients</h3>
            </div>
            <div class="pull-right" style="padding-bottom:20px">
	    <?php
	    if ( isset($_COOKIE['isadmin']) ) {
		echo "<a href=\"add_client.php\" class=\"btn btn-info\" role=\"button\">Add Client</a>";
	    }
	    ?>
            </div>
            <div>
                <table class="table table-striped table-bordered" data-sortable>
                  <thead>
                    <tr>
                      <th>Client</th>
                      <th>Comment</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   $pdo = Database::connect();
                   $sql = "SELECT * FROM clients ORDER BY name ASC";
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['name'] . '</td>';
			    if ($row['description'] == "")
			    {
                            	echo '<td><a href="comments.php?client='.$row['client'].'&type=Add">Add</a></td>';
			    }
			    else
			    {
				echo '<td><a href="comments.php?client='.$row['client'].'&type=Modify">'.$row['description'].'</a></td>';
			    }
			    if ( isset($_COOKIE['isadmin']) ) {
			    	echo '<td><a href="#" data-href="delete_client.php?client='.$row['name'].'" data-toggle="modal" data-target="#confirm-delete"><button type="button" class="btn btn-info">Delete</button></a></td>';
                            	echo '</tr>';
			    }
			    else {
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
