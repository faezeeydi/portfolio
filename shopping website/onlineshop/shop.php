<?php

include("./include/header.php");

// if (isset($_GET['order-by']) && isset($_GET['order-by'])=='lowest') {
//   Show();            
// }

// if (isset($_GET['order-by']) && isset($_GET['order-by'])=='highest') {
//   Show();              
// }

?>
<div class="container">
        <div class="row">
                <div class="col-md-3 mt-5">
                        <div class="card rounded-0" style="width: 17rem;">
                                <div class="card-body">
                                        <h6 class="card-title">دسته بندی محصولات</h6>
                                        <hr>
                                        <?php
                                        Category();
                                        ?>
                                </div>
                        </div>
                </div>
                <div class="col-md-9 mt-3">
                <div class="row">
                        <div class="col-md-4 pt-2">
                        <nav aria-label="breadcrumb">
                        <ol class="breadcrumb" style="font-size:15px">
                                <li class="breadcrumb-item"><a href="home.php">خانه</a></li>
                                <?php
                                if(isset($_GET['discounts'])){
                                ?>
                                <li class="breadcrumb-item active text-dark" aria-current="page">تخفیف ها و پیشنهادها</li>
                                <?php
                                }else{
                                ?>
                                <li class="breadcrumb-item active text-dark" aria-current="page">فروشگاه</li>
                                <?php
                                }
                                ?>
                        </ol>
                        </nav>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4 text-end">
                        <div class="btn-group">
                                <button class="btn btn-secondary btn-sm dropdown-toggle opacity-75" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                مرتب سازی پیش فرض
                                </button>
                                <ul class="dropdown-menu rounded-0">
                                <li><a class="dropdown-item active" href="category.php?order-by=newest">مرتب سازی بر اساس آخرین</a></li>
                                <li><a class="dropdown-item" href="category.php?order-by=lowest">مرتب سازی بر اساس ارزانترین</a></li>
                                <li><a class="dropdown-item" href="category.php?order-by=highest">مرتب سازی بر اساس گرانترین</a></li>
                                </ul>
                                </div>
                        </div>
                        <hr>
                </div>
                <div class="row">
                <?php  
                include("./include/db.php");
                if(isset($_GET['discounts'])){
                $alldiscounts=mysqli_query($con,"Call alldiscounts()");
                  foreach ($alldiscounts as $all) {
                  $pro_id=$all['p_id'];
                ?>
                <div class="col-md-4 mb-4">
                <div class="card cd rounded-0" style="width:19rem;height:24.5rem">
                        <a href="product.php?product-id=<?php echo $pro_id ?>"><img src="./upload/posts/<?php echo $all['p_image'] ?>" class="card-img-top p-3" alt="..."></a>
                <div class="card-body">
                <div class="link">
                <a href="product.php?product-id=<?php echo $pro_id ?>"><p class="card-title"><?php echo $all['p_title']; ?></p></a>
                </div>
                <div class="mb-3">
                <?php
                if (empty($all['p_discount'])) {
                ?>
                        <p class="fw-semibold" style="color:#B00D15"><?php echo $all['p_price']; ?> تومان</p>
                <?php
                }else{
                ?>
                        <p class="fw-semibold" style="color:#B00D15"><del class="text-black-50"><?php echo $all['p_price']; ?></del> <?php echo $all['p_discount']; ?> تومان</p>
                <?php
                }
                ?>
                </div>
                <div class="text-end">
                        <a href="shop.php?discounts&add_whishlist=<?php echo $pro_id ?>"><i class="bi bi-suit-heart" style="font-size:18px"></i></a>
                        <a href="shop.php?discounts&add_cart=<?php echo $pro_id ?>" class="cart-link mx-2"><i class="bi bi-cart3"></i></a>
                </div>
  </div>
  </div>
  </div>
  <?php        
    }
  }else{
        $Shop=mysqli_query($con,"Call allproducts()");
                foreach ($Shop as $show) {
                $pro_id=$show['p_id'];
        ?>
        <div class="col-md-4 mb-4">
        <div class="card cd rounded-0" style="width:19rem;height:24.5rem">
                <a href="product.php?product-id=<?php echo $pro_id ?>"><img src="./upload/posts/<?php echo $show['p_image'] ?>" class="card-img-top p-3" alt="..."></a>
        <div class="card-body">
          <div class="link">
          <a href="product.php?product-id=<?php echo $pro_id ?>"><p class="card-title"><?php echo $show['p_title']; ?></p></a>
          </div>
        <div class="mb-3">
<?php
if (empty($show['p_discount'])) {
?>
        <p class="fw-semibold" style="color:#B00D15"><?php echo $show['p_price']; ?> تومان</p>
<?php
}else{
  ?>
        <p class="fw-semibold" style="color:#B00D15"><del class="text-black-50"><?php echo $show['p_price']; ?></del> <?php echo $show['p_discount']; ?> تومان</p>
<?php
}
?>
</div>
        <div class="text-end">
                <a href="shop.php?add_whishlist=<?php echo $pro_id ?>"><i class="bi bi-suit-heart" style="font-size:18px"></i></a>
                <a href="shop.php?add_cart=<?php echo $pro_id ?>" class="cart-link mx-2"><i class="bi bi-cart3"></i></a>
</div>
</div>
</div>
</div>
<?php        
}
  }              
?>
                </div>
                </div>
        </div>
</div>
<br>
<br>
<br>
<?php

include("./include/footer.php");

?>