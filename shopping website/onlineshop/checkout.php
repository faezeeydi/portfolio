<?php

session_start();

if(!isset($_SESSION['u_email']))
{
    include("./user_login.php");
					
}
else
{
    include("./payment.php");
				
}
												
?>
