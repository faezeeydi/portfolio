<?php

include("./include/header.php");
$con=mysqli_connect("localhost","root","","online_shop");

if (isset($_GET['action']) && isset($_GET['id'])) {

    $id = $_GET['id'];

    $deleteproduct=mysqli_query($con,"call DeleteProduct('$id')");

    header("Location:product.php");
    exit();
}

?>

<div class="container-fluid">
    <div class="row">

        <?php include('./include/sidebar.php') ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

            <div class="d-flex justify-content-between mt-5">
                <h3>محصولات</h3>
                <a href="new_product.php" class="btn btn-outline-primary">محصول جدید</a>
            </div>

            <table class="table text-center mt-3">
  <thead>
  <tr>
      <th scope="col">کد</th>
      <th scope="col">تصویر</th>
      <th scope="col">محصول</th>
      <th scope="col">قیمت</th>
      <th scope="col">تخفیف</th>
      <th scope="col">تنظیمات</th>


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
      <td><img src="../upload/posts/<?php echo $all['p_image'] ?>" width="35px" height="35px" alt=""></td>
      <td><?php echo $all['p_title'] ; ?></td>
      <td><?php echo $all['p_price'] ; ?> تومان</td>
      <td><?php echo $all['p_discount'] ; ?> تومان</td>
      <td>
        <a href="edit_product.php?id=<?php echo $pro_id ?>" class="btn btn-outline-info">ویرایش</a>
        <a href="product.php?action=delete&id=<?php echo $pro_id ?>" class="btn btn-outline-danger">حذف</a>
        </td>
    </tr>
<?php
}
?>
  </tbody>
</table>

        </main>

    </div>

</div>
