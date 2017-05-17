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
        $pdo = Database::connect();
        $sql = 'select * from countries ORDER BY name ASC';
    $countries = $pdo->query($sql);
        $sql = 'select * from clients ORDER BY name ASC';
    $clients = $pdo->query($sql);
?>
    <div class="container-fluid">
            <div class="row">
                <h3>Add Site</h3>
 <form role="form" action="insert_site.php" method="POST">
  <div class="form-group">
    <label for="site">Site name:</label>
    <input type="text" class="form-control" name="site">
    <label for="country">Country:</label>
    <select class="form-control" name="country">
    <option></option>;
    <?php
    foreach ($countries as $row) {
        echo '<option value="'.$row['id_country'].'">'.$row['name'].'</option>';
    }
    ?>
    </select>
    <label for="client">Client name:</label>
    <select class="form-control" name="client">
    <option></option>;
    <?php
    foreach ($clients as $row) {
        echo '<option value="'.$row['id_client'].'">'.$row['name'].'</option>';
    }
    ?>
    </select>
    <label for="description">Comment:</label>
    <input type="text" class="form-control" name="description">
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>
            </div>
        </div>
    </div> <!-- /container -->
  </body>
</html>
