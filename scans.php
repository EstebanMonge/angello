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
                <h3>Scans</h3>
            </div>
            <div>
                <table class="table table-striped table-bordered" data-sortable>
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>VLAN</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $pdo = Database::connect();
                    $sql = 'SELECT * FROM scans ORDER BY id ASC';
                    foreach ($pdo->query($sql) as $row) {
                        echo '<tr>';
                        echo '<td>'.$row['date'].'</td>';
                        echo '<td><a href="hostnames_scan.php?id='.$row['id'].'">'.$row['vlan'].'</a></td>';
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
