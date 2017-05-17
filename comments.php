<?php
    require 'header.php';
    $ip = $_GET['ip'];
    $vlan = $_GET['vlan'];
    $type = $_GET['type'];
    $pdo = Database::connect();
?>
<body>
    <?php
           echo drawHeader();
    ?>
    <div class="container-fluid">
            <div class="row">
                <h3>Hostnames</h3>
            </div>
            <div class="row">
                <h3><?php echo $type?> comment for <?php 
                if ($ip) {
                    echo 'host '.$ip;
                    $sql = "SELECT comments FROM hostnames WHERE ip LIKE '".$ip."'";
                } else {
                    echo 'vlan '.$vlan;
                    $sql = "SELECT description AS comments FROM vlans WHERE vlan LIKE '".$vlan."'";
                }
        ?>
    
    </h3>
    <form class="form-inline" role="form" action="insert_comment.php" method="POST">
     <div class="form-group">
            <TEXTAREA NAME="comment" COLS=40 ROWS=6>
        <?php
        foreach ($pdo->query($sql) as $row) {
            echo $row['comments'];
        }
            ?></TEXTAREA>
       <input type="hidden" name="ip" value="<?php echo $ip?>">
       <input type="hidden" name="vlan" value="<?php echo $vlan?>">
     </div>
        <?php
        if ($ip) {
            echo '<label for="reserved"><input type="checkbox" value="reserved" name="reserved">Reserved?</label>';
        }
        ?>
      <button type="submit" class="btn btn-default">Submit</button>
    </form>
            </div> <!-- /row -->
    </div> <!-- /container -->
  </body>
</html>
