<!DOCTYPE html>
<?php
        include 'header.php';
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/sortable.min.js"></script>
</head>
<body>
    <div class="container">
	<?php
		echo drawHeader();
		$username=$_GET["username"];
	?>
            <div class="row">
                <h3>Users</h3>
            </div>
            <div class="row">
                <h3>Add User</h3>
 <form role="form" action="insert_user.php" method="POST">
  <div class="form-group">
    <label for="username">Username:</label>
    <input type="text" class="form-control" name="username">
    <label for="password">Password:</label>
    <input type="password" class="form-control" name="password">
    <label for="name">Name:</label>
    <input type="text" class="form-control" name="name">
    <label for="email">E-Mail:</label>
    <input type="text" class="form-control" name="email">
    <label for="isadmin"><input type="checkbox" value="1" name="isadmin">Is Admin</label>
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>
            </div>
        </div>
    </div> <!-- /container -->
  </body>
</html>