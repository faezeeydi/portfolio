<?php

include("./include/header.php");
require_once("zarinpal_function.php");

// We connect to the database	
include("include/db.php");
	
	$order_id=$_SESSION['order_id'];
	$MerchantID = 'XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX';
	$Amount = $_GET['Amount']; //Amount will be based on Toman
	$ZarinGate = false;
	$SandBox = True;
		
	$zp = new zarinpal();
	$result = $zp->verify($MerchantID, $Amount, $SandBox, $ZarinGate);

	?>
	<div class="row mt-5">
		<div class="col-md-4"></div>
		<div class="col-md-4 mt-5 mx-5">
		<?php
	if (isset($result["Status"]) && $result["Status"] == 100)
	{
	$authority=$result["Authority"];
	$refid=$result["RefID"];

	$UpdateOrder=mysqli_query($con,"call UpdateOrder('$order_id','$authority','$refid')");
	//creating or using cookie for ip customer
if(isset($_COOKIE["ipUser"]))
{
$ip	= $_COOKIE["ipUser"];
}else{
$ip=getIp();
setcookie('ipUser',$ip,time()+1206900);
}			

//Copy the data from the cart data table to the pay _cart data table
include("include/db.php");
$pay_cart=mysqli_query($con,"call pay_cart('$ip')");

//Insert the value in the order_id
include("include/db.php");
$time_pay_cart=mysqli_query($con,"call time_pay_cart('$ip')");
foreach($time_pay_cart as $tim)
{
$time=$tim['order_time'];
}
//Updating the order_id filde in the pay_cart table, of course, based on the payout time of the sales order
include("include/db.php");
$UpdatePaycart=mysqli_query($con,"call UpdatePaycart('$time','$order_id')");

//destroying the session 
unset($_SESSION["total_price"]);
unset($_SESSION["order_id"]);

//Delete customer data from the cart data table
include("include/db.php");
$DeleteCartuser=mysqli_query($con,"call DeleteCartuser('$ip')");
?>
		<div class="card text-center" style="width: 22rem;">
  <div class="card-body p-4">
    <h3 class="card-title text-success">پرداخت موفق</h3>
    <hr>
    <p class="card-text lh-lg fs-5">
    	تراکنش با موفقیت انجام شد.
	<br>
	مبلغ : <?php echo $result["Amount"]; ?>
	<br>
	کد پیگیری : <?php echo $result["RefID"]; ?>
    </p>
  </div>
</div>
<?php
	} else {
?>
<div class="card text-center" style="width: 22rem;">
  <div class="card-body p-4">
    <h3 class="card-title text-danger">پرداخت ناموفق</h3>
    <hr>
    <p class="card-text lh-lg fs-5">
	تراکنش انجام نشد.
	<br>
	کد خطا : <?php echo $result["Status"]; ?>
	<br>
	<?php echo $result["Message"]; ?>
	</p>
  </div>
</div>
<?php
		// error
		// echo "پرداخت ناموفق";
		// echo "<br />کد خطا : ". $result["Status"];
		// echo "<br />تفسیر و علت خطا : ". $result["Message"];
	}
?>
		</div>
		<div class="col-md-4"></div>
	</div>
	<br>
<br>
<br>
<br>
<br>
<?php
include("./include/footer.php");
?>