<?php

include("./include/header.php");

if(isset($_POST['checkout']))
			
			{
				//creating or using cookie 
				if(isset($_COOKIE["ipUser"]))
				{
					$ip	= $_COOKIE["ipUser"];
					}else{
					$ip=getIp();
					setcookie('ipUser',$ip,time()+1206900);
				}
				$total_price = $_SESSION['total_price'];
				
				
        include("./include/db.php");
        $CheckTotal=mysqli_query($con,"call CheckTotal('$ip')");
        foreach ($CheckTotal as $check) {
				
        include("./include/db.php");

				if($check['count'] == 0){

          $InsertTotal=mysqli_query($con,"call InsertTotal('$ip','$total_price')");

				}else{
					
          $UpdateTotal=mysqli_query($con,"call UpdateTotal('$ip','$total_price')");
					
				}
				
				echo "<script>window.open('checkout.php','_self')</script>";
      }
			}		
?>

<div class="container">
<?php
//creating or using cookie 
if(isset($_COOKIE["ipUser"]))
{
  $ip= $_COOKIE["ipUser"];
}else{
  $ip=getIp();
  setcookie("ipUser",$ip,time()+3600);
}
include("./include/db.php");
$QtyCart=mysqli_query($con,"call QtyCart('$ip')");
foreach ($QtyCart as $qty) {
  if ( $qty['total']==NULL) {
?>
<div class="row mt-5">
<div class="col-md-4"></div>
<div class="col-md-5 text-center fs-4">
<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb link">
    <li class="breadcrumb-item active" aria-current="page"><u><a href="cart.php">سبد خرید</a></u></li>
    <li class="breadcrumb-item"><a>تسویه حساب</a></li>
    <li class="breadcrumb-item">تکمیل سفارش</li>
  </ol>
</nav>
</div>
<div class="col-md-3"></div>
</div>
  <div class="row mt-5">
    <div class="col-md-1"></div>
    <div class="col-md-10 text-center">
    <i class="bi bi-cart-x opacity-25" style="font-size:11rem"></i>
    <p class="fw-bold" style="font-size:35px">سبد خرید شما در حال حاضر خالی است.</p>
    <p class="text-secondary">قبل از شروع پرداخت ، باید برخی از محصولات را به سبد خرید خود اضافه کنید.

<br>
    بسیاری از محصولات را در صفحه "فروشگاه" ما پیدا خواهید کرد.</p>
    <button type="button" class="button" onclick="location.href='shop.php';">بازگشت به فروشگاه</a>
    </div>
    <div class="col-md-1"></div>
  </div>
<?php
}
  else
{
?>
        <div class="row mt-5">
<div class="col-md-4"></div>
<div class="col-md-5 text-center fs-4">
<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb link">
    <li class="breadcrumb-item active" aria-current="page"><u><a href="cart.php">سبد خرید</a></u></li>
    <li class="breadcrumb-item"><a href="checkout.php">تسویه حساب</a></li>
    <li class="breadcrumb-item">تکمیل سفارش</li>
  </ol>
</nav>
</div>
<div class="col-md-3"></div>
</div>
        <div class="row mt-5">
                <div class="col-md-8">
                <form action="cart.php" method="post" enctype="multipart/form-data">
                <table class="table text-center">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col">محصول</th>
      <th scope="col">قیمت</th>
      <th scope="col">تعداد</th>
      <th scope="col">جمع جزء</th>

    </tr>
  </thead>
  <tbody>
<?php
include("./include/db.php");
$UserCart=mysqli_query($con,"call UserCart('$ip')");
    $total=0;
    foreach ($UserCart as $cart){
      if (empty($cart['p_discount'])) {
        $price= $cart['p_price'];
      }else{
        $price= $cart['p_discount'];
      }
      $pro_id=$cart['p_id'];
      $pro_qty=$cart['qty'];
?>
  <tr>
      <td><a href="cart.php?action=deletecart&id=<?php echo $pro_id?>"><i class="bi bi-x-lg text-dark"></i></a></td>
      <td><a href="product.php?product-id=<?php echo $pro_id ?>"><img src="./upload/posts/<?php echo $cart['p_image'] ?>" width="35px" height="35px" alt=""></a></td>
      <td><a href="product.php?product-id=<?php echo $pro_id ?>"><p><?php echo $cart['p_title'] ; ?></p></a></td>
      <td class="opacity-75" style="font-size:14px"><?php echo $price ; ?>
        </td>
      <td>
      <?php
	//enter qty user in table cart
	if(isset($_POST['update_cart']))
	
	{
    

    $str_ip = str_replace(".", "", "$ip");

      $qty = $_POST["$str_ip$pro_id"];
          
      include("./include/db.php");
	
		$UpdateCart=mysqli_query($con,"call UpdateCart('$pro_id','$ip','$qty')");

    $_SESSION["$str_ip"]["$pro_id"]=$qty;	
}

$str_ip = str_replace(".", "", "$ip");

		if(isset($_SESSION["$str_ip"]["$pro_id"]))

		{
      echo  "<input class='text-center rounded-1 opacity-75 border border-dark border-opacity-75' type='number' min='1' max='50' value='" .$_SESSION["$str_ip"]["$pro_id"]. "' name='$str_ip$pro_id' > " ;
  
            $quantity = $_SESSION["$str_ip"]["$pro_id"];
            $prc = str_replace(",", "", "$price");
            intval($prc);
            $total=$total+$quantity*$prc;
?>
      <td style="color:#B52510;font-size:18px"><?php echo $quantity*$prc; ?> تومان</td>
      
      <?php
}else		
{
    echo  "<input class='text-center rounded-1 opacity-75 border border-dark border-opacity-75' type='number' min='1' max='50' value='$pro_qty' name='$str_ip$pro_id' > " ;
    $prc = str_replace(",", "", "$price");
    intval($prc);
    $total=$total+$pro_qty*$prc;
    ?>
            </td>
      <td style="color:#B52510;font-size:18px"><?php echo $pro_qty*$prc; ?> تومان</td>
      <?php
}
      unset($_SESSION["$str_ip"]["$pro_id"]);
		}

?>
  </tbody>
</table>
<div class="row text-end">
<div class="col-md-12">
<input class="cart" name="update_cart" type="submit" value="بروزرسانی سبد خرید" />
</div>
</div> 
</div>
                <div class="col-md-4">
                <div class="card w-60 p-2">
  <div class="card-body">
    <h5 class="card-title py-2">جمع کل سبد خرید</h5>
    <table class="table table-borderless">
  <tbody>
 
  <tr class="border-bottom">
      <th colspan="2">جمع جزء</th>
      <td class="text-end opacity-75" style="font-size:14px"><?php echo $total ; ?> تومان</td>
</tr>
    <tr>
      <th class="fs-5" colspan="2">جمع کل</th>
      <td class="text-end fs-4" style="color:#B52510"><?php echo $total ; ?> تومان</td>
<?php
      $_SESSION['total_price'] = $total;
?>
    </tr>
  </tbody>
</table>    
<div class="d-grid gap-2">
<button type="submit" name="checkout" class="log mt-2">ادامه جهت تسویه حساب</button>
</div>
  </div>
</div>
                </div>
        </div>
</form>
<?php
}
}
?>
</div>

<br>
<br>
<br>
<br>
<br>
<br>
<?php
include("./include/footer.php");
?>