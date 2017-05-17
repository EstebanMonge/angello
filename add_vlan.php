<!DOCTYPE html>
<?php
        require 'header.php';
?>
<body>
<<<<<<< HEAD
<?php
    echo drawHeader();
?>
=======
    <?php
        echo drawHeader();
    if (!$_GET) {
        $vlan = 128;
    } else {
        $vlan = $_GET['vlan'];
    }
    ?>
>>>>>>> a0904be705d6269af051b9e9ae3184873b74e65b
    <div class="container-fluid">
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
