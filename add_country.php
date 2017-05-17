<!DOCTYPE html>
<?php
        include 'header.php';
?>
<body>
<?php
    echo drawHeader();
?>
    <div class="container-fluid">
            <div class="row">
                <h3>Add Country</h3>
 <form role="form" action="insert_country.php" method="POST">
  <div class="form-group">
    <label for="vlan">Country name:</label>
    <input type="text" class="form-control" name="country">
    <label for="vlan">Comment:</label>
    <input type="text" class="form-control" name="description">
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>
            </div>
        </div>
    </div> <!-- /container -->
  </body>
</html>
