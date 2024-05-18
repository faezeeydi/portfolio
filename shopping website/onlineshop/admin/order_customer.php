<?php

include("./include/header.php");
?>

<div class="container-fluid">
    <div class="row">

        <?php include('./include/sidebar.php') ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

            <div class="d-flex justify-content-between mt-5">
                <h3>فاکتور فروش</h3>
            </div>

            <table class="table text-center mt-3">
  <thead>
  <tr>
      <th scope="col">تصویر محصول</th>
      <th scope="col">نام محصول</th>
      <th scope="col">قیمت محصول</th>
      <th scope="col">تعداد</th>
      <th scope="col">جمع جزء</th>


    </tr>
  </thead>
  <tbody class="table-group-divider">
<?php
//Obtaining a customer's email from the global variable $_GET['order_customer']
$customer_email=$_GET['order_customer'];

//Customer search on customer data table based on customer's email
include("./include/db.php");
$SelectUser=mysqli_query($con,"call SelectUser('$customer_email')");
foreach ($SelectUser as $sel){
        /* Obtaining a user's ip from a customer's data table and using it to
	search the cart data table and pay table _cart */
	$customer_ip=$sel['u_ip'];
}
/* Understanding whether a customer
is paying money using a global variable $_GET['pay'] */
$pay=$_GET['pay'];
$order_id=$_GET['order_id'];
include("./include/db.php");
if($pay=='no'){
        $User=mysqli_query($con,"call UserCart('$customer_ip')");
}else{
	$User=mysqli_query($con,"call UserPaycart('$order_id')");				
}	

$total=0;

foreach ($User as $user) {
?>
    <tr>
      <td><img src="../upload/posts/<?php echo $user['p_image'] ?>" width="35px" height="35px" alt=""></td>
      <td><?php echo $user['p_title'] ; ?></td>
      <td><?php if (empty($user['p_discount'])) {
        $price=$user['p_price'];
?>
        <p class="fw-semibold" style="color:#B00D15"><?php echo $user['p_price']; ?> تومان</p>
<?php
}else{
        $price=$user['p_discount'];
  ?>
        <p class="fw-semibold" style="color:#B00D15"><del class="text-black-50"><?php echo $user['p_price']; ?></del> <?php echo $user['p_discount']; ?> تومان</p>
<?php
} ?></td>
      <td><?php echo $user['qty'] ; ?></td>
<?php
$price=
      $prc = str_replace(",", "", "$price");
      intval($prc);
?>
      <td><?php echo $user['qty'] * $price ; ?></td>
    </tr>
<?php
}
?>
<tr>
        <td></td>
        <td></td>
        <td></td>
        <td>جمع کل</td>
        <td><?php echo $_GET['Total_Amount']; ?></td>
</tr>
  </tbody>
</table>

        </main>

    </div>

</div>