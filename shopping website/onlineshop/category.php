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
if(isset($_GET['categories'])){           
  LinkCategory();
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
if(isset($_GET['categories'])){           
  Show();            
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