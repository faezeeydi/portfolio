<?php
	
	session_start();
	
	unset($_SESSION['u_email']);
	
	echo "<script>window.open('home.php','_self')</script>";

?>