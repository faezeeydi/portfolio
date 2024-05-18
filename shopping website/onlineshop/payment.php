<?php

include('include/db.php');
	
	//creating or using cookie for ip customer
	if(isset($_COOKIE["ipUser"]))
	{
		$ip	= $_COOKIE["ipUser"];
		}else{
		$ip=getIp();
		setcookie('ipUser',$ip,time()+1206900);
	}
	
	//Gaining the amount to be paid by the customer
        $TotalPrice=mysqli_query($con,"call TotalPrice('$ip')");

	foreach ($TotalPrice as $total)
	{
		$total_price = $total['total_price'];
	}
	
	//Gaining customer email
	
		$u_email = $_SESSION['u_email'];
	
	//Submit the record in the order table
        include('include/db.php');
        $InsertOrder=mysqli_query($con,"call InsertOrder('$total_price','$u_email')");

	//Last id based on customer email
	include('include/db.php');
        $order_id=mysqli_query($con,"call order_id('$u_email')");
        foreach ($order_id as $ord) {
                $id=$ord['order_id'];
        }

	//Gaining last id
	$_SESSION["order_id"]=$id;
	
	// Set session variables
	$_SESSION["total_price"] = $total_price;	
	
	if($InsertOrder){
		echo "<script>window.open('request.php','_self')</script>";
	}
?>