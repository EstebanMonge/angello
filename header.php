<?php
include 'database.php';
if (!isset($_COOKIE['username']) || !isset($_COOKIE['password'])) {
	header('Location: login.php');
}
function drawHeader() {
	$pdo = Database::connect();
	$sql = 'SELECT * FROM vlans ORDER BY vlan ASC';
	$output='
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>Angello IP Management</title>
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/sortable.min.js"></script>
    <script type="text/javascript" src="js/jquery.tabletoCSV.js" > </script>
    <script>
        $(function(){
            $("#export").click(function(){
                $("#hosts_table").tableToCSV();
            });
        });
    </script>
</head>
<nav class="navbar navbar-light" style="background-color: #e3f2fd;">
	    <div class="container-fluid">
	        <div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainmenu">
		        <span class="icon-bar" style="background-color:	#00008B;"></span>
		        <span class="icon-bar" style="background-color: #00008B;"></span>
		        <span class="icon-bar" style="background-color: #00008B;"></span>
		      </button>
	            <a class="navbar-brand" href="index.php">IP Management <span class="glyphicon glyphicon-home"></span></a>
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
				<li>
					<a href="logs.php">Logs</a>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li>
					<a href="logout.php">Logout <span class="glyphicon glyphicon-log-out"></a>
				</li>
                        </ul>
		        <div class="col-sm-3 col-md-3 pull-right">
            			<form class="navbar-form" role="search" method="GET" action="search.php">
		                	<div class="input-group">
	                		    <input type="text" class="form-control" placeholder="Search" name="search">
			                    <div class="input-group-btn">
                			        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
        	        	    	    </div>
                			</div>
            			</form>
        		</div> 
		</div>
	    </div>
	</nav>';
	Database::disconnect();
	return $output;
}
?>
