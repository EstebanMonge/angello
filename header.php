<?php
include 'database.php';
if (!isset($_COOKIE['username']) || !isset($_COOKIE['password'])) {
	header('Location: login.php');
}
function drawHeader() {
	$pdo = Database::connect();
	$sql = 'SELECT * FROM vlans ORDER BY vlan ASC';
	$output='<nav class="navbar navbar-light" style="background-color: #e3f2fd;">
	    <div class="container-fluid">
	        <div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainmenu">
		        <span class="icon-bar" style="background-color:	#00008B;"></span>
		        <span class="icon-bar" style="background-color: #00008B;"></span>
		        <span class="icon-bar" style="background-color: #00008B;"></span>
		      </button>
	            <a class="navbar-brand" href="index.php">IP Management</a>
	        </div>
    		<div class="collapse navbar-collapse" id="mainmenu">
                	<ul class="nav navbar-nav">
				<li class="nav-item">
					<a href="vlans.php">VLANs</a>
				</li>
                                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Hosts <span class="caret"></span></a>
					<ul class="dropdown-menu">';
						foreach ($pdo->query($sql) as $row) {
            						$output .='<li><a href="hosts.php?vlan='.$row['vlan'].'">'.$row['vlan'].'</a></li>';
						}
         				$output .='</ul>
				</li>
                                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#">Ubication <span class="caret"></span></a>
					<ul class="dropdown-menu">
            					<li><a href="countries.php">Countries</a></li>
            					<li><a href="sites.php">Sites</a></li>
					</ul>
				</li>
				<li>
					<a href="clients.php">Clients</a>
				</li>
				<li>
					<a href="users.php">Users</a>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
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
