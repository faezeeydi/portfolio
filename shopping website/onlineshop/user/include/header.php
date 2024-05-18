<?php
session_start();

include("./functions.php");
if(isset($_GET['add_whishlist'])){
  whishlist();
}
if (isset($_GET['add_cart'])){
  cart();
  ?>
  <script>alert('محصول موردنظر به سبد خرید اضافه شد.')</script>
  <?php
}
if (isset($_GET['action']) && isset($_GET['id'])) {
  $action = $_GET['action'];
  if ($action=="deletecart") {
    DeleteCart(); 
  }
  elseif ($action=="deletewhishlist") {
    DeleteWhishlist(); 
  }
}

?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>زعفران و زرشک قائنات</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-7mQhpDl5nRA5nY9lr8F1st2NbIly/8WqhjTp+0oFxEA/QUuvlbF6M1KXezGBh3Nb" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="./css/font.css">      
        <link rel="stylesheet" href="./css/style.css"> 
        <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
</head>

<body>

<header class="header">

<div class="container">
<div class="row pt-3 pb-1 align-items-center justify-content-between text-center">

  <div class="col-lg-2 col-md-2 mb-2">
    <a href="home.php"><img src="./upload/logo.png" alt="logo" class="logo"></a>
  </div>


  <div class="col-lg-6 col-md-6 col-sm-7 mb-2">
  <form  method="get" action="result.php" class="d-flex">
        <input name="user_query" type="text" class="search-input" placeholder="جستجوی محصولات...">
        <button type="submit" name="search" class="search-button"><i class="fas fa-search"></i></button>
  </form>
  </div>


  <div class="col-lg-3 col-md-4 col-sm-5 mb-2 top-header-links">
  <?php
							if(!isset($_SESSION['u_email']))
							{
								echo "<a href='checkout.php' class='signop-signin'>ورود/ثبت نام</a>";
							}
							else
							{
								echo "<a href='user/my_account.php' class='signop-signin'>حساب کاربری</a>";
							}
						?>
  <a href="whishlist.php" class="mywishlist">
    <i class="bi bi-suit-heart"></i>
      <?php
        QtyWhishlist();
      ?>
  </a>
  <a href="cart.php" class="mycart">
  <i class="bi bi-basket"></i>
      <?php
        QtyCart();
      ?>
  </a>
</div>
</div>
</div>

<nav class="nav">
  <div class="container">
  <div class="row">
  <div class="col-md-12">
    <div class="nav__btn">
            <span class="nav__btn-line"></span>
    </div>
    <h6 class="nav-title"><a href="home.php">فروشگاه زعفران و خشکبار صداقت</a></h6>
    <ul class="menu">
      <li class="menu__item">
        <a href="home.php" class="menu__link"> صفحه اصلی</a>
      </li>
      <li class="menu__item">
        <a href="shop.php" class="menu__link">فروشگاه</a>
      </li>
      <?php
        getCat();
      ?>
      <li class="menu__item">
        <a href="about.php" class="menu__link">درباره ما</a>
      </li>
      <li class="menu__item">
        <a href="contact.php" class="menu__link">تماس با ما</a>
      </li>
    </ul>
    </div>
   </nav>
  </div>
</div>
</header>
  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>   
<script src="scripts/app.js"></script>