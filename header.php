<?php
include 'database.php';
if (!isset($_COOKIE['username']) || !isset($_COOKIE['password'])) {
	header('Location: login.php');
}
function drawHeader() {
	$pdo = Database::connect();
	$sql = 'SELECT * FROM vlans ORDER BY vlan ASC';
	$output='<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	    <div class="container">
	        <div class="navbar-header">
	            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	                <span class="sr-only">Toggle navigation</span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	            </button>
	            <a class="navbar-brand" href="index.php">IP Management</a>
	        </div>
    		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                	<ul class="nav navbar-nav">
                                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#">VLANs</a>
					<ul class="dropdown-menu">';
						foreach ($pdo->query($sql) as $row) {
            						$output .='<li><a href="hosts.php?vlan='.$row['vlan'].'">'.$row['vlan'].'</a></li>';
						}
         				$output .='</ul>
				</li>
				<li>
					<a href="users.php">Users</a>
				</li>
				<li>
					<a href="logout.php">Logout</a>
				</li>
                        </ul>
		</div>
	    </div>
	</nav>';
	Database::disconnect();
	return $output;
}
?>
