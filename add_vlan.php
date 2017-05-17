<?php
/**
 * Angello IP Management
 * PHP Version 7
 *
 * @category PHP
 * @package  Angello
 * @author   Esteban Monge <estebanmonge@riseup.net>
 * @license  https://opensource.org/licenses/BSD-2-Clause BSD
 * @link     http://www.hashbangcode.com/
 */

        require 'header.php';
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
