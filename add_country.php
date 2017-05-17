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
