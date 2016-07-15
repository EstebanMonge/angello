<?php
	setcookie('username', '',time() - 3600,'/angello','kanboard.gbmcloud.com');	
	setcookie('password', '',time() - 3600,'/angello','kanboard.gbmcloud.com');	
	setcookie('isadmin', '',time() - 3600,'/angello','kanboard.gbmcloud.com');	
        header('Location: login.php');
?>
