<?php

include("./include/header.php");

?>
<div class="container mt-4">
<div class="row">
        <div class="col-md-12">
        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
  <div class="carousel-inner rounded-3">
    <div class="carousel-item active" data-bs-interval="3000">
      <img src="./upload/1.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item" data-bs-interval="3000">
      <img src="./upload/2.png" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
        </div>
</div>
</div>

<div class="row mt-5">
        <div class="col-md-12 text-center">
                <h5>
                        جدیدترین محصولات
                </h5>
        </div>
</div>

<div class="row justify-content-center">
        <?php
        getNewProducts();
        ?>
</div>
<div class="row mt-4">
        <div class="col-md-12 text-center">
                <button type="button" class="view-btn" style="vertical-align:middle" onclick="location.href='shop.php';"><span>مشاهده همه</span></button>
        </div>
</div>

<div class="row mt-5">
        <div class="col-md-12 text-center">
                <h5>
                        تخفیف ها و پیشنهادها
                </h5>
        </div>
</div>

<div class="row justify-content-center">
        <?php
        getDiscounts();
        ?>
        
</div>

<div class="row mt-4">
        <div class="col-md-12 text-center">
                <button type="button" class="view-btn" style="vertical-align:middle" onclick="location.href='shop.php?discounts';"><span>مشاهده همه</span></button>
        </div>
</div>

</div>
<br>
<br>
<br>
<?php

include("./include/footer.php");

?>