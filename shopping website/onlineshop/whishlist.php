<?php

include("./include/header.php");

?>
<div class="container">
<div class="row mt-5 text-center">
        <div class="col-md-4"></div>
        <div class="col-md-4">
        <p class="fw-bold fs-3">لیست علاقه مندی</p>
        <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                <nav aria-label="breadcrumb">
  <ol class="breadcrumb" style="font-size:14px">
  <li class="breadcrumb-item"><a href="home.php">خانه</a></li>
  <li class="breadcrumb-item active text-dark" aria-current="page">علاقه مندی</li>
  </ol>
</nav>
                </div>
                <div class="col-md-4"></div>
        </div>
</div>
<div class="col-md-4"></div>
</div>
</div>
<hr>
<div class="container">
<?php
        include("./include/db.php");
        //creating or using cookie 
if(isset($_COOKIE["ipUser"]))
{
  $ip= $_COOKIE["ipUser"];
}else{
  $ip=getIp();
  setcookie("ipUser",$ip,time()+3600);
}
$Qtywhishlist=mysqli_query($con,"call Qtywhishlist('$ip')");
foreach ($Qtywhishlist as $qty) {
  if ( $qty['total']==0) {
?>
  <div class="row mt-5">
    <div class="col-md-1"></div>
    <div class="col-md-10 text-center">
    <i class="bi bi-heart opacity-25" style="font-size:11rem"></i>
    <p class="fw-bold" style="font-size:35px">لیست علاقه مندی خالی است.</p>
    <p class="text-secondary">هیچ محصولی در لیست علاقمندی افزوده نشده است.</p>
    <button type="button" class="button" onclick="location.href='shop.php';">بازگشت به فروشگاه</button>
    </div>
    <div class="col-md-1"></div>
  </div>
<?php
}
  else
{
?>
<div class="row g-5">
                <?php
        include("./include/db.php");
        $Userwhishlist=mysqli_query($con,"call Userwhishlist('$ip')");
        foreach ($Userwhishlist as $whishlist) {
                $pro_id=$whishlist['p_id'];
                ?>
            <div class="col-md-3">
                <div class="text-center mb-2">
                <a href="whishlist.php?action=deletewhishlist&id=<?php echo $pro_id?>"><i class="bi bi-x-lg text-dark"></i> حذف</a>
                </div>
            <div class="card cd rounded-0" style="width:19rem;height:24.5rem">

      <a href="product.php?product-id=<?php echo $pro_id ?>"><img src="./upload/posts/<?php echo $whishlist['p_image'] ?>" class="card-img-top p-3" alt="..."></a>
      <div class="card-body">
        <div class="link">
        <a href="product.php?product-id=<?php echo $pro_id ?>"><p class="card-title"><?php echo $whishlist['p_title']; ?></p></a>
        </div>
        <div class="mb-3">
        <?php
        if (empty($whishlist['p_discount'])) {
        ?>
        <p class="fw-semibold" style="color:#B00D15"><?php echo $whishlist['p_price']; ?> تومان</p>
    
        <?php
        }else{
          ?>
          <p class="fw-semibold" style="color:#B00D15"><del class="text-black-50"><?php echo $whishlist['p_price']; ?></del> <?php echo $whishlist['p_discount']; ?> تومان</p>
    <?php
        }
        ?>
        </div>
        <div class="text-end">
        <a href="whishlist.php?add_cart=<?php echo $pro_id ?>" class="cart text-white">افزودن به سبد خرید</a>
        </div>
        
      </div>
    </div>
    </div>
<?php
}
?>
</div>
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