<?php

include("./include/header.php");
$con=mysqli_connect("localhost","root","","online_shop");

if (isset($_GET['entity']) && isset($_GET['action']) && isset($_GET['id'])) {

        $entity = $_GET['entity'];
        $action = $_GET['action'];
        $id = $_GET['id'];
    
        if ($action == "delete") {
    
            if ($entity == "product") {
                $deleteproduct=mysqli_query($con,"call deleteproduct('$id')");
            }
        }
    }

?>

<div class="container-fluid">
    <div class="row">

        <?php include('./include/sidebar.php') ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">داشبورد</h1>
            </div>

            <h5>محصولات</h5>
            <table class="table text-center">
  <thead>
  <tr>
      <th scope="col">کد</th>
      <th scope="col">تصویر</th>
      <th scope="col">محصول</th>
      <th scope="col">قیمت</th>
      <th scope="col">تخفیف</th>
      <!-- <th scope="col">تنظیمات</th> -->


    </tr>
  </thead>
  <tbody class="table-group-divider">
<?php
$allproducts=mysqli_query($con,"call allproducts()");
foreach ($allproducts as $all){
        $pro_id=$all['p_id'];
?>
    <tr>
      <th scope="row"><?php echo $pro_id ; ?></th>
      <td><a><img src="../upload/posts/<?php echo $all['p_image'] ?>" width="35px" height="35px" alt=""></a></td>
      <td><a><p><?php echo $all['p_title'] ; ?></p></a></td>
      <td class="opacity-75" style="font-size:14px"><?php echo $all['p_price'] ; ?> تومان</td>
      <td class="opacity-75" style="font-size:14px"><?php echo $all['p_discount'] ; ?> تومان</td>
      <!-- <td>
        <a href="edit_post.php?id=<?php echo $pro_id ?>" class="btn btn-outline-info">ویرایش</a>
        <a href="index.php?entity=product&action=delete&id=<?php echo $pro_id ?>" class="btn btn-outline-danger">حذف</a>
        </td> -->
    </tr>
<?php
}
?>
  </tbody>
</table>

        </main>

    </div>

</div>
