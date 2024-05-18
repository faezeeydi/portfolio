<?php

//getting categories
function getCat()
{
        include("./include/db.php");
        $category=mysqli_query($con,"call category()");
        foreach ($category as $cat) {
?>
<li class="menu__item controll" style="margin-left:12px;">
<a href="category.php?categories=<?php echo $cat['c_name'] ?>" class="menu__link arrow_icon">
<?php echo $cat['c_name']; ?> </a> 
         <ul class="sub_menu">
           <li>
           <?php
          $c_id=$cat['c_id'];
          include("./include/db.php");
          $OrderCat=mysqli_query($con,"call OrderCat('$c_id')");
          foreach ($OrderCat as $ord) {
?>
          <a href="category.php?categories=<?php echo $cat['c_name'] ?>&category=<?php echo $ord['o_name'] ?>"><?php echo $ord['o_name']; ?></a>
<?php
          }       
?> 
           </li>
           
         </ul>
       </li>
<?php 
          }
}

//getting NewProducts
function getNewProducts()
{
        include("./include/db.php");
        $NewProducts=mysqli_query($con,"call NewProducts()");
        foreach ($NewProducts as $new) {
                $pro_id=$new['p_id'];
                ?>
            <div class="col-xxl-3 col-lg-4 col-md-6 g-4">
            
            <div class="card pro-card rounded-0">
            
      <a href="product.php?product-id=<?php echo $pro_id ?>"><img src="./upload/posts/<?php echo $new['p_image'] ?>" class="card-img-top p-3" alt="..."></a>
      

      <div class="card-body">
        <div class="link" style="height:4rem">
        <a href="product.php?product-id=<?php echo $pro_id ?>"><p class="card-title"><?php echo $new['p_title']; ?></p></a>

        </div>
      <div class="mb-3">
        <?php
        if (empty($new['p_discount'])) {
        ?>
        <p class="fw-semibold" style="color:#B00D15"><?php echo $new['p_price']; ?> تومان</p>
    
        <?php
        }else{
          ?>
          <p class="fw-semibold" style="color:#B00D15"><del class="text-black-50"><?php echo $new['p_price']; ?></del> <?php echo $new['p_discount']; ?> تومان</p>
          
    <?php
        }
        ?>
        </div>
        <div class="text-end">
        <a href="home.php?add_whishlist=<?php echo $pro_id ?>" class="favorite-btn-card"><i class="bi bi-suit-heart"></i></a>
        <a href="home.php?add_cart=<?php echo $pro_id ?>" class="cart-btn-card"><i class="bi bi-cart3"></i></a>
        </div>
      </div>
    </div>
    </div>
    <?php        
          }
}

function getDiscounts(){
        include("./include/db.php");
        $getDiscounts=mysqli_query($con,"call getDiscounts()");
        foreach ($getDiscounts as $get) {
                $pro_id=$get['p_id'];
                ?>
            <div class="col-xxl-3 col-lg-4 col-md-6 g-4">
            
            <div class="card pro-card rounded-0">
            
      <a href="product.php?product-id=<?php echo $pro_id ?>"><img src="./upload/posts/<?php echo $get['p_image'] ?>" class="card-img-top p-3" alt="..."></a>


      <div class="card-body">
        <a href="product.php?product-id=<?php echo $pro_id ?>"><p class="card-title" style="height:4rem"><?php echo $get['p_title']; ?></p></a>
        <div class="mb-3">
        <?php
        if (empty($get['p_discount'])) {
        ?>
        <p class="fw-semibold" style="color:#B00D15"><?php echo $get['p_price']; ?> تومان</p>
    
        <?php
        }else{
          ?>
          <p class="fw-semibold" style="color:#B00D15"><del class="text-black-50"><?php echo $get['p_price']; ?></del> <?php echo $get['p_discount']; ?> تومان</p>
          
    <?php
        }
        ?>
        </div>
        <div class="text-end">
        <a href="home.php?add_whishlist=<?php echo $pro_id ?>" class="favorite-btn-card"><i class="bi bi-suit-heart"></i></a>
        <a href="home.php?add_cart=<?php echo $pro_id ?>" class="cart-btn-card"><i class="bi bi-cart3"></i></a>
        </div>
      </div>
    </div>
    </div>
    <?php        
          }
}

//getting IP User
function getIp()
{
//whether ip is from remote address		
        $ip=$_SERVER['REMOTE_ADDR'];

//whether ip is from share internet		
        if(!empty($_SERVER['HTTP_CLIENT_IP']))
        {
                $ip=$_SERVER['HTTP_CLIENT_IP'];
        }

//whether ip is from proxy		
        elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
                $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];	
        }
        return $ip;
}

function whishlist()
	{
                include("./include/db.php");
		
		if(isset($_GET['add_whishlist']))
		{
			$pro_id=$_GET['add_whishlist'];
			
			//creating or using cookie 
			if(isset($_COOKIE["ipUser"]))
			{
				$ip= $_COOKIE["ipUser"];
			}else{
				$ip=getIp();
				setcookie("ipUser",$ip,time()+3600);
			}
                        $CheckWhishlist=mysqli_query($con,"call CheckWhishlist('$pro_id','$ip')");
                foreach ($CheckWhishlist as $check) {
                if($check['rowcount']==0)
                {          
                        include("./include/db.php");
                        $InsertWhishlist=mysqli_query($con,"call InsertWhishlist('$pro_id','$ip')");
        }
        }
        }
        
}

//creating the shopping cart
//import attribute product and IP address user with press buy button in cart table
function cart()
	{
                include("./include/db.php");
		
		if(isset($_GET['add_cart']))
		{
			$pro_id=$_GET['add_cart'];
			
			//creating or using cookie 
			if(isset($_COOKIE["ipUser"]))
			{
				$ip= $_COOKIE["ipUser"];
			}else{
				$ip=getIp();
				setcookie("ipUser",$ip,time()+3600);
			}
                        $CheckCart=mysqli_query($con,"call CheckCart('$pro_id','$ip')");
                        $qty=1;
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
}

function QtyWhishlist()
	{
                include("./include/db.php");
                //creating or using cookie 
			if(isset($_COOKIE["ipUser"]))
			{
				$ip= $_COOKIE["ipUser"];
			}else{
				$ip=getIp();
				setcookie("ipUser",$ip,time()+3600);
			}
                $QtyWhishlist=mysqli_query($con,"call QtyWhishlist('$ip')");
                ?>
                 <span class="qtywishlist">
                 <?php
                 foreach ($QtyWhishlist as $qty) {
                  echo $qty['total'] ; } ?>
                </span>
<?php
}

function QtyCart()
	{
                include("./include/db.php");
                //creating or using cookie 
			if(isset($_COOKIE["ipUser"]))
			{
				$ip= $_COOKIE["ipUser"];
			}else{
				$ip=getIp();
				setcookie("ipUser",$ip,time()+3600);
			}
                $QtyCart=mysqli_query($con,"call QtyCart('$ip')");
                ?>
                 <span class="qtycart">
                 <?php
                 foreach ($QtyCart as $qty) {
                        if ($qty['total']==NULL) {
                                ?>
                                <div>0</div>
                                <?php
                        }
                        else {
                                echo $qty['total'] ;
                        }
                }
                ?>
                </span>
<?php
}

function DeleteCart(){
        include("./include/db.php");
		
		if(isset($_GET['id']))
		{
			$pro_id=$_GET['id'];
			
			//creating or using cookie 
			if(isset($_COOKIE["ipUser"]))
			{
				$ip= $_COOKIE["ipUser"];
			}else{
				$ip=getIp();
				setcookie("ipUser",$ip,time()+3600);
			}
        $DeleteCart = mysqli_query($con,"call DeleteCart('$pro_id','$ip')");
}
}

function DeleteWhishlist(){
        include("./include/db.php");
		
		if(isset($_GET['id']))
		{
			$pro_id=$_GET['id'];
			//creating or using cookie 
			if(isset($_COOKIE["ipUser"]))
			{
				$ip= $_COOKIE["ipUser"];
			}else{
				$ip=getIp();
				setcookie("ipUser",$ip,time()+3600);
			}
        $DeleteWhishlist = mysqli_query($con,"call DeleteWhishlist('$pro_id','$ip')");
}
}

function Show(){
        include("./include/db.php");
        if(isset($_GET['categories']) && isset($_GET['category'])){
                $o_name=$_GET['category'];
                $c_name=$_GET['categories'];

                // if (isset($_GET['order-by']) && isset($_GET['order-by'])=='lowest') {
                //         $ShowCategory=mysqli_query($con,"Call LowestCategory('$o_name')");

                // }

                // if (isset($_GET['order-by']) && isset($_GET['order-by'])=='highest') {

                //         $ShowCategory=mysqli_query($con,"Call HighestCategory('$o_name')");
                        
                //       }

                // else{
                //         $ShowCategory=mysqli_query($con,"Call NewestCategory('$o_name')");

                // }
                $ShowCategory=mysqli_query($con,"Call NewestCategory('$o_name')");
                foreach ($ShowCategory as $show) {
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
                <a href="category.php?add_whishlist=<?php echo $pro_id ?>&categories=<?php echo $c_name ?>&category=<?php echo $o_name ?>"><i class="bi bi-suit-heart" style="font-size:18px"></i></a>
                <a href="category.php?add_cart=<?php echo $pro_id ?>&categories=<?php echo $c_name ?>&category=<?php echo $o_name ?>" class="cart-link mx-2"><i class="bi bi-cart3"></i></a>
</div>
</div>
</div>
</div>
<?php        
  }
}


elseif(isset($_GET['categories']) && !isset($_GET['category'])){
        $c_name=$_GET['categories'];
        // if (isset($_GET['order-by']) && isset($_GET['order-by'])=='lowest') {
        //         $ShowCategories=mysqli_query($con,"Call LowestCategories('$c_name')");

        // }

        // if (isset($_GET['order-by']) && isset($_GET['order-by'])=='highest') {

        //         $ShowCategories=mysqli_query($con,"Call HighestCategories('$c_name')");
                
        //       }

        // else{
        //         $ShowCategories=mysqli_query($con,"Call NewestCategories('$c_name')");

        // }
        $ShowCategories=mysqli_query($con,"Call NewestCategories('$c_name')");
        foreach ($ShowCategories as $show) {
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
        <a href="category.php?add_whishlist=<?php echo $pro_id ?>&categories=<?php echo $c_name ?>"><i class="bi bi-suit-heart" style="font-size:18px"></i></a>
        <a href="category.php?add_cart=<?php echo $pro_id ?>&categories=<?php echo $c_name ?>" class="cart-link mx-2"><i class="bi bi-cart3"></i></a>
</div>
</div>
</div>
</div>
<?php        
}
}
}

function Category(){
        include("./include/db.php");
        $category=mysqli_query($con,"call category()");
        foreach ($category as $cat) {
        ?>
        <a style="font-size:14px" href="category.php?categories=<?php echo $cat['c_name'] ?>"><h6><?php echo $cat['c_name']; ?></h6></a> 
        <?php
        $c_id=$cat['c_id'];
        $con=mysqli_connect("localhost","root","","online_shop");
        $OrderCat=mysqli_query($con,"call OrderCat('$c_id')");
        foreach ($OrderCat as $ord) {
        ?>
        <a style="font-size:13.5px;margin:0;" href="category.php?categories=<?php echo $cat['c_name'] ?>&category=<?php echo $ord['o_name'] ?>"><?php echo $ord['o_name']; ?></a> <br>
        <?php
        }
        ?> 
        <br> 
        <?php    
  }
}

function LinkCategory(){
        include("./include/db.php");
        
        if(isset($_GET['categories']) && isset($_GET['category'])){
                $c_name=$_GET['categories'];      
                $o_name=$_GET['category']; 
        ?>
    <li class="breadcrumb-item"><a href="category.php?categories=<?php echo $c_name ?>"><?php echo $c_name; ?></a></li>
    <li class="breadcrumb-item active text-dark" aria-current="page"><?php echo $o_name; ?></li>

<?php        
  }
if(isset($_GET['categories']) && !isset($_GET['category'])){          
        $c_name=$_GET['categories'];
?>
<li class="breadcrumb-item active text-dark" aria-current="page"><?php echo $c_name; ?></li>
<?php        
}
}

?>