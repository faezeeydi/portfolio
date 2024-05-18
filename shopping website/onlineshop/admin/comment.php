<?php

include("./include/header.php");
$con=mysqli_connect("localhost","root","","online_shop");

if (isset($_GET['action']) && isset($_GET['id'])) {

    $action = $_GET['action'];
    $id = $_GET['id'];

    if ($action == "delete") {

        $deletecomment=mysqli_query($con,"call DeleteComment('$id')");

        header("Location:comment.php");
        exit();
        
    } else {
        $updatecomment=mysqli_query($con,"call UpdateComment('$id')");

        header("Location:comment.php");
        exit();
    }

}

?>

<div class="container-fluid">
    <div class="row">

        <?php include('./include/sidebar.php') ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

            <div class="d-flex justify-content-between mt-5">
                <h3>نظرات</h3>
            </div>

            <table class="table text-center mt-3">
  <thead>
  <tr>
      <th scope="col">کد</th>
      <th scope="col">نام</th>
      <th scope="col">ایمیل</th>
      <th scope="col">متن</th>
      <th scope="col">وضعیت</th>
      <th scope="col">کد محصول</th>
      <th scope="col">تنظیمات</th>


    </tr>
  </thead>
  <tbody class="table-group-divider">
<?php
$comments=mysqli_query($con,"call comments()");
foreach ($comments as $com){
        $pro_id=$com['p_id'];
        if($com['com_status']==1){
               $status="تایید شده";
        }else{
            $status="تایید نشده";
                  }
?>
    <tr>
      <th scope="row"><?php echo $com['com_id'] ; ?></th>
      <td><?php echo $com['com_name'] ; ?></td>
      <td><?php echo $com['com_email'] ; ?></td>
      <td><?php echo $com['com_text'] ; ?></td>
      <td style="color:<?php if($com['com_status']==1){echo"green";}else{echo"red";}?>"><?php echo $status ; ?></td>
      <td><?php echo $pro_id ; ?></td>
      <td>
      <?php
        if ($com['com_status']==0) {
?>
            <a href="comment.php?action=approve&id=<?php echo $com['com_id'] ?>" class="btn btn-outline-success">تایید</a>
<?php
        } 
?>
            <a href="comment.php?action=delete&id=<?php echo $com['com_id'] ?>" class="btn btn-outline-danger">حذف</a>
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
