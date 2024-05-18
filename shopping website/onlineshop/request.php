<?php

require_once("zarinpal_function.php");

// We connect to the database	
include("include/db.php");

//We start the session
session_start();

//Initialization to variables
// $order_id=$_SESSION["order_id"];
$Amount=$_SESSION["total_price"]; //Amount will be based on Toman - Required
$MerchantID = 'XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX'; //Required
$Description = "تست درگاه زرین پال"; // Required
$Email = "info@email.com"; // Optional
$Mobile = '09121234567'; // Optional
$CallbackURL = "https://localhost/onlineshop/verify.php?Amount=$Amount"; // Required
$ZarinGate = false;
$SandBox = True;

$zp = new zarinpal();
$result = $zp->request($MerchantID, $Amount, $Description, $Email, $Mobile, $CallbackURL, $SandBox, $ZarinGate);

if (isset($result["Status"]) && $result["Status"] == 100)
{
	// Success and redirect to pay
	$zp->redirect($result["StartPay"]);
} else {
	// error
	echo "خطا در ایجاد تراکنش";
	echo "<br />کد خطا : ". $result["Status"];
	echo "<br />تفسیر و علت خطا : ". $result["Message"];
}