<?php

include("./include/header.php");

if(isset($_GET['product-id']) || isset($_GET['add_whishlist']) || isset($_GET['add_cart']))
{        
        if(isset($_GET['product-id'])){
                $pro_id=$_GET['product-id'];
        }
        
        if(isset($_GET['add_whishlist'])){
                $pro_id=$_GET['add_whishlist'];
        }

        if(isset($_GET['add_cart'])){
                $pro_id=$_GET['add_cart'];
        }

        include("./include/db.php");
        $Product=mysqli_query($con,"call product('$pro_id')");
        foreach ($Product as $pro) {
                ?>


        <div class="row mt-5 align-items-center">
                <div class="col-md-1"></div>
                <div class="col-md-4">
                <img src="./upload/posts/<?php echo $pro['p_image'] ?>" class="card-img-top" alt="...">
                </div>
                <div class="col-md-6">
                <div class="card rounded-0 shadow-sm p-3 mb-2">
  <div class="card-body">
  <nav aria-label="breadcrumb">
  <ol class="breadcrumb" style="font-size:14px">
  <li class="breadcrumb-item"><a href="home.php">خانه</a></li>
  <li class="breadcrumb-item"><a href="category.php?categories=<?php echo $pro['c_name'] ?>"><?php echo $pro['c_name']; ?></a></li>
  <li class="breadcrumb-item"><a href="category.php?categories=<?php echo $pro['c_name'] ?>&category=<?php echo $pro['o_name'] ?>"><?php echo $pro['o_name']; ?></a></li>  
  <li class="breadcrumb-item active text-dark" aria-current="page"><?php echo $pro['p_title']; ?></li>
  </ol>
</nav>
<br>

<h5 class="card-title"><?php echo $pro['p_title']; ?></h5>
<br>
        <?php
        if (empty($pro['p_discount'])) {
        ?>
        <p style="color:#B52510;font-size:22px"><?php echo $pro['p_price']; ?> تومان</p>
        <?php
        }else{
          ?>
          <p style="color:#B52510;font-size:22px"><del class="text-black-50" style="font-size:20px"><?php echo $pro['p_price']; ?></del> <?php echo $pro['p_discount']; ?> تومان</p>
    <?php
        }
        ?>
        <p><?php echo $pro['p_description']; ?></p>
        <br>
        <div class="row">
                <div class="col-md-4">
                <!-- <form action="product.php" method="post" enctype="multipart/form-data"> -->
                <input class="text-center rounded-1 opacity-75 border border-dark border-opacity-75" type="number" min="1" max="50" value="1" name="qty" style="font-size:17.5px"/>

                <button type="submit" name="add_cart" class="cart" onclick="location.href='product.php?add_cart=<?php echo $pro_id ?>';">افزودن به سبد خرید</button>
        <!-- </form> -->
                </div>
                <div class="col-md-8 mt-1">
        <div class="link">
        <a href="product.php?add_whishlist=<?php echo $pro_id ?>" style="font-size:14px"><i class="bi bi-suit-heart"></i> افزودن به علاقه مندی ها</a>
        </div>
        </div>
        </div>

        <hr>
<p style="font-size:14px">دسته: <a href="category.php?categories=<?php echo $pro['c_name'] ?>"><?php echo $pro['c_name']; ?></a> , <a href="category.php?categories=<?php echo $pro['c_name'] ?>&category=<?php echo $pro['o_name'] ?>"><?php echo $pro['o_name'] ?></a> </p>      
    <?php        
          }
?>
<p style="font-size:14px">
        اشتراک گذاری: 
        <a href=""><i class="bi bi-instagram mx-1" style="font-size:15px"></i></a>
        <a href=""><i class="bi bi-whatsapp mx-1" style="font-size:16px"></i></a>
        <a href=""><i class="bi bi-telegram mx-1" style="font-size:17px"></i></a>
</p>
  </div>
</div>
                </div>
                <div class="col-md-1"></div>
        </div>
        <hr>

        <?php
        include("./include/db.php");
        $CountComment=mysqli_query($con,"call CountComment('$pro_id')");
        foreach ($CountComment as $count) {
        ?>
        <div class="row">
           <div class="col-md-4"></div>
           <div class="col-md-4 text-center">
                <h4>نظرات</h4>
           </div>
           <div class="col-md-4"></div>
        </div>
        <div class="row mt-5  pb-4">
        <div class="col-md-1"></div>
        <?php
        if($count['count']==0)
        {
                ?>
          <div class="col-md-5">
                <p>نقد و بررسی ها</p>
                <p class="text-secondary">هیچ دیدگاهی برای این محصول نوشته نشده است.</p>
          </div>
          <div class="col-md-5">
                <p><strong>اولین کسی باشید که دیدگاهی می نویسد “<?php echo $pro['p_title']; ?>”</strong></p>
                <br>
                <form action="product.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                        <label for="text" class="form-label">دیدگاه شما</label>
                        <textarea class="form-control" id="text" rows="6" name="text1"></textarea>
                </div>
                <div class="row">
                        <div class="col-md-6">
                        <div class="mb-3">
                        <label for="name" class="form-label">نام</label>
                        <input type="text" class="form-control" id="name" name="name1">
                </div>
                        </div>
                        <div class="col-md-6">
                <div class="mb-3">
                        <label for="email" class="form-label">ایمیل</label>
                        <input type="email" class="form-control" id="email" name="email1">
                </div>
                        </div>
                </div>
                
                <button type="submit" name="add_comment1" class="button">ثبت</button>
                
                </form>
          </div>
<?php
        }
        else{
?>      
        <div class="col-md-4">
        <?php
        include("./include/db.php");
        $showComment=mysqli_query($con,"call showComment('$pro_id')");
        foreach ($showComment as $show) {
                if ($show['com_status']==1) {
        ?>
                <p><?php echo $show['com_name'] ;?></p>
                <p class="text-secondary"><?php echo $show['com_text'] ; ?></p>
                <hr>
                <?php
                }
                else{
?>
                <p>نقد و بررسی ها</p>
                <p class="text-secondary">هیچ دیدگاهی برای این محصول نوشته نشده است.</p>
<?php
                }
        }
        ?>
          </div>
          <div class="col-md-1"></div>

          <div class="col-md-5">
                <p><strong>دیدگاه خود را بنویسید</strong></p>
                <br>
                <form action="product.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                        <label for="text" class="form-label">دیدگاه شما</label>
                        <textarea class="form-control" id="text" rows="6" name="text"></textarea>
                </div>
                <div class="row">
                        <div class="col-md-6">
                        <div class="mb-3">
                        <label for="name" class="form-label">نام</label>
                        <input type="text" class="form-control" id="name" name="name">
                </div>
                        </div>
                        <div class="col-md-6">
                <div class="mb-3">
                        <label for="email" class="form-label">ایمیل</label>
                        <input type="email" class="form-control" id="email" name="email">
                </div>
                        </div>
                </div>

                <button type="submit" name="add_comment" class="button">ثبت</button>
                
                </form>
          </div>
<?php
        }
?>
          <div class="col-md-1"></div>
        </div>
        <hr>
<?php
}
?>

<div class="row mt-5">
        <div class="col-md-1"></div>
        <div class="col-md-2">
        <h5>
                        محصولات مرتبط
                </h5>
        </div> 
        <div class="col-md-9"></div>
        </div>
<div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
        <div class="row">
<?php
        $o_name=$pro['o_name'];
        include("./include/db.php");
        $RelatedProducts=mysqli_query($con,"call NewestCategory('$o_name')");
        $post=0;
        foreach ($RelatedProducts as $Related) {
                $id=$Related['p_id'];
                if ($id!=$pro_id){
                        $post+=1;
?>
        <div class="col-md-3 g-3">
            
            <div class="card cd rounded-0" style="width:19rem;height:24.5rem">
      <a href="product.php?product-id=<?php echo $id ?>"><img src="./upload/posts/<?php echo $Related['p_image'] ?>" class="card-img-top p-3" alt="..."></a>

      <div class="card-body">
        <div class="link">
        <a href="product.php?product-id=<?php echo $id ?>"><p class="card-title"><?php echo $Related['p_title']; ?></p></a>
        </div>
        <div class="mb-3">
        <?php
        if (empty($Related['p_discount'])) {
        ?>
        <p class="fw-semibold" style="color:#B00D15"><?php echo $Related['p_price']; ?> تومان</p>
    
        <?php
        }else{
          ?>
          <p class="fw-semibold" style="color:#B00D15"><del class="text-black-50"><?php echo $Related['p_price']; ?></del> <?php echo $Related['p_discount']; ?> تومان</p>
          
    <?php
        }
        ?>
        </div>
        <div class="text-end">
        <a href="product.php?add_whishlist=<?php echo $id ?>&product-id=<?php echo $id ?>"><i class="bi bi-suit-heart" style="font-size:18px"></i></a>
        <a href="product.php?add_cart=<?php echo $id ?>&product-id=<?php echo $id ?>" class="cart-link mx-2"><i class="bi bi-cart3"></i></a>
        </div>
      </div>
    </div>
    </div>
<?php        
}
}
if ($post==0){
        ?>
        <p class="text-secondary" style="font-size:14px">محصولی یافت نشد!!!</p>
        <?php
        } 
?>
        </div>
        </div>
        <div class="col-md-1"></div>   
</div>
<br>
<br>
<br>
<?php
if (isset($_POST['add_cart'])){
        include("./include/db.php");			
			//creating or using cookie 
			if(isset($_COOKIE["ipUser"]))
			{
				$ip= $_COOKIE["ipUser"];
			}else{
				$ip=getIp();
				setcookie("ipUser",$ip,time()+3600);
			}
                        $CheckCart=mysqli_query($con,"call CheckCart('$pro_id','$ip')");
                        $qty=$_POST['qty'];
                foreach ($CheckCart as $check) {
                include("./include/db.php");
                if($check['rowcount']==0)
                {          
                        $InsertCart=mysqli_query($con,"call InsertCart('$pro_id','$ip')");
        }
                else
                {
                        $UpdateQty=mysqli_query($con,"call UpdateQty('$pro_id','$ip','$qty')");
                } 
        }
        }
if (isset($_POST['add_comment1'])) {
        $text=$_POST['text1'];
        $name=$_POST['name1'];
        $email=$_POST['email1'];
        if(isset($_COOKIE["ipUser"]))
                {
                        $ip= $_COOKIE["ipUser"];
                }else{
                        $ip=getIp();
                        setcookie("ipUser",$ip,time()+3600);
                }
                include("./include/db.php");
                $InsertComment=mysqli_query($con,"call InsertComment('$name','$email','$text','$pro_id','$ip')");
                if ($InsertComment) {
                ?>
                <script>alert('دیدگاه شما با موفقیت ثبت شد')</script>
<?php
}
        }
}


include("./include/footer.php");

?>
