<?php
include("./include/header.php");

if(isset($_GET['search']))
{	
        $search_query=$_GET['user_query'];
        include("./include/db.php");
        $SearchQuery=mysqli_query($con,"Call SearchQuery('%$search_query%')");
?>
<div class="container mt-5">
  <h5>نتایج جستجو برای : <?php echo $search_query ?></h5>
<div class="row">
<?php
        foreach ($SearchQuery as $search) {
                $pro_id=$search['p_id'];
                ?>
            <div class="col-md-3 g-4">
            
            <div class="card cd rounded-0" style="width:19rem;height:24.5rem">
            
      <a href="product.php?product-id=<?php echo $pro_id ?>"><img src="./upload/posts/<?php echo $search['p_image'] ?>" class="card-img-top p-3" alt="..."></a>
      

      <div class="card-body">
        <div class="link">
        <a href="product.php?product-id=<?php echo $pro_id ?>"><p class="card-title"><?php echo $search['p_title']; ?></p></a>

        </div>
      <div class="mb-3">
        <?php
        if (empty($search['p_discount'])) {
        ?>
        <p class="fw-semibold" style="color:#B00D15"><?php echo $search['p_price']; ?> تومان</p>
    
        <?php
        }else{
          ?>
          <p class="fw-semibold" style="color:#B00D15"><del class="text-black-50"><?php echo $search['p_price']; ?></del> <?php echo $search['p_discount']; ?> تومان</p>
          
    <?php
        }
        ?>
        </div>
        <div class="text-end">
        <a href="home.php?add_whishlist=<?php echo $pro_id ?>"><i class="bi bi-suit-heart" style="font-size:18px"></i></a>
        <a href="home.php?add_cart=<?php echo $pro_id ?>" class="cart-link mx-2"><i class="bi bi-cart3"></i></a>
        </div>
      </div>
    </div>
    </div>
    
    <?php        
          }
?>
    </div>
    </div>
<br>
<br>
<br>
<?php
        }
        
include("./include/footer.php");

?>