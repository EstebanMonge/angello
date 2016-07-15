<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <link   href="css/login.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/sortable.min.js"></script>
</head>

<div class="container">
    <div class="row">
        <div class="col-md-offset-5 col-md-3">
            <form name="login" action="validate.php" method="post"> 
            <div class="form-login">
            <h4>Angello IP Management</h4>
            <input type="text" id="username" name="username" class="form-control input-sm chat-input" placeholder="username" />
            </br>
            <input type="password" id="password" name="password" class="form-control input-sm chat-input" placeholder="password" />
            </br>
            <div class="wrapper">
            <span class="group-btn">     
		<input type="submit" class="btn btn-info" value="Login" /> 
            </span>
            </div>
            </div>
       	    </form> 
        </div>
    </div>
</div>
</html>
