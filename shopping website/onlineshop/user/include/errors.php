<?php  if (count($errors) > 0) 
	$message_error="";
	{ 
		
		foreach ($errors as $error) { 
			$message_error .=$error."&";	
		} 
		$error=str_ireplace('&',' \n',$message_error);
		echo "<script>alert(' $error ')</script>";
		
		if(isset($_GET['edit_account'])){
			
			echo "<script>window.open('my_account.php?edit_account','_self')</script>";
			
			}elseif(isset($_GET['change_pass'])){
			
			echo "<script>window.open('my_account.php?change_pass','_self')</script>";
			
		}
		
	} 
?>