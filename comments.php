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
    $ip =  htmlentities($_GET["ip"],  ENT_QUOTES,  "utf-8");
    $vlan =  htmlentities($_GET["vlan"],  ENT_QUOTES,  "utf-8");
    $type =  htmlentities($_GET["type"],  ENT_QUOTES,  "utf-8");
    $item =  htmlentities($_GET["item"],  ENT_QUOTES,  "utf-8");
    $reserved = 0;
    $pdo = Database::connect();
?>
<body>
    <?php
           echo drawHeader();
    ?>
    <div class="container-fluid">
            <div class="row">
                <h3><?php echo $type." <b>".$item."</b>  for ";?> <?php 
		switch ($item) {
			case "Interface":
                    		echo 'host '.$ip;
                    		$sql = "SELECT interface AS comments FROM hostnames WHERE ip LIKE '".$ip."'";
				break;
			case "Switch":
                    		echo 'host '.$ip;
                    		$sql = "SELECT switch AS comments FROM hostnames WHERE ip LIKE '".$ip."'";
				break;
			case "Switch Interface":
                    		echo 'host '.$ip;
                    		$sql = "SELECT switch_interface AS comments FROM hostnames WHERE ip LIKE '".$ip."'";
				break;
			case "Comment";
                    		echo 'host '.$ip;
                    		$sql = "SELECT reserved,comments FROM hostnames WHERE ip LIKE '".$ip."'";
				break;
			case "Description";
                    		echo 'VLAN '.$vlan;
                    		$sql = "SELECT description AS comments FROM vlans WHERE vlan LIKE '".$vlan."'";
				break;
		}
        ?>
    
    </h3>
    <form class="form-inline" role="form" action="insert_comment.php" method="POST">
     <div class="form-group">
            <TEXTAREA NAME="comment" COLS=40 ROWS=6><?php foreach ($pdo->query($sql) as $row) { echo $row['comments']; if ($row['reserved']== 1) $reserved=1;}?></TEXTAREA>
       <input type="hidden" name="ip" value="<?php echo $ip?>">
       <input type="hidden" name="vlan" value="<?php echo $vlan?>">
       <input type="hidden" name="item" value="<?php echo $item?>">
     </div>
        <?php
        if ($item == "Comment") {
		if ( $reserved == 1 ) {
            		echo '<label for="reserved"><input type="checkbox" value="1" name="reserved" checked>Reserved</label>';
		}
		else {
            		echo '<label for="reserved"><input type="checkbox" value="1" name="reserved">Reserved</label>';
		}
        }
        ?>
      <button type="submit" class="btn btn-default">Submit</button>
    </form>
            </div> <!-- /row -->
    </div> <!-- /container -->
  </body>
</html>
