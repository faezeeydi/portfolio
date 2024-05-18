<?php 

include("./include/header.php");
$con=mysqli_connect("localhost","root","","online_shop");
if (isset($_GET['entity']) && isset($_GET['action']) && isset($_GET['id'])) {

    $entity = $_GET['entity'];
    $id = $_GET['id'];

    if ($entity == "category") {
        $deletecategory=mysqli_query($con,"call DeleteCategory('$id')");
        header("Location:category.php");
        exit();
    }
    elseif ($entity == "ordercategory") {
        $deleteordercat=mysqli_query($con,"call DeleteOrdercat('$id')");
        header("Location:category.php");
        exit();
    }
    
}

?>

<div class="container-fluid">
    <div class="row">

        <?php include('./include/sidebar.php') ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

            <div class="d-flex justify-content-between mt-5">
                <h3>دسته</h3>
                <a href="new_category.php?entity=category" class="btn btn-outline-primary">دسته جدید</a>
            </div>

            <table class="table text-center mt-3">
  <thead>
  <tr>
      <th scope="col">کد</th>
      <th scope="col">نام</th>
      <th scope="col">تنظیمات</th>

    </tr>
  </thead>
  <tbody class="table-group-divider">
<?php
$category=mysqli_query($con,"call category()");
foreach ($category as $cat){
?>
    <tr>
      <th scope="row"><?php echo $cat['c_id'] ; ?></th>
      <td><?php echo $cat['c_name'] ; ?></td>
      <td>
        <a href="edit_category.php?entity=category&id=<?php echo $cat['c_id'] ?>" class="btn btn-outline-info">ویرایش</a>
        <a href="category.php?entity=category&action=delete&id=<?php echo $cat['c_id'] ?>" class="btn btn-outline-danger">حذف</a>
        </td>
    </tr>
<?php
}
?>
  </tbody>
</table>

<div class="d-flex justify-content-between mt-5">
                <h3>زیر دسته</h3>
                <a href="new_category.php?entity=ordercategory" class="btn btn-outline-primary">زیر دسته جدید</a>
            </div>

            <table class="table text-center mt-3">
  <thead>
  <tr>
      <th scope="col">کد</th>
      <th scope="col">نام</th>
      <th scope="col">نام دسته</th>
      <th scope="col">تنظیمات</th>

    </tr>
  </thead>
  <tbody class="table-group-divider">
<?php
$con=mysqli_connect("localhost","root","","online_shop");
$ordercategory=mysqli_query($con,"call ordercategory()");
foreach ($ordercategory as $order){
?>
    <tr>
      <th scope="row"><?php echo $order['o_id'] ; ?></th>
      <td><?php echo $order['o_name'] ; ?></td>
      <td><?php echo $order['c_name'] ; ?></td>
      <td>
        <a href="edit_category.php?entity=ordercategory&id=<?php echo $order['o_id'] ?>" class="btn btn-outline-info">ویرایش</a>
        <a href="category.php?entity=ordercategory&action=delete&id=<?php echo $order['o_id'] ?>" class="btn btn-outline-danger">حذف</a>
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