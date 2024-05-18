<?php

include("./include/header.php");
$con=mysqli_connect("localhost","root","","online_shop");
if (isset($_GET['action']) && isset($_GET['id'])) {

        $id = $_GET['id'];
    
        $deleteuser=mysqli_query($con,"call DeleteUser('$id')");
    
        header("Location:user.php");
        exit();
    }
?>

<div class="container-fluid">
    <div class="row">

        <?php include('./include/sidebar.php') ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

            <div class="d-flex justify-content-between mt-5">
                <h3>کاربران</h3>
            </div>

            <table class="table text-center mt-3">
  <thead>
  <tr>
      <th scope="col">کد</th>
      <th scope="col">نام و نام خانوادگی</th>
      <th scope="col">ایمیل</th>
      <th scope="col">آدرس</th>
      <th scope="col">تلفن</th>
      <th scope="col">تنظیمات</th>

    </tr>
  </thead>
  <tbody class="table-group-divider">
<?php
$users=mysqli_query($con,"call users()");
foreach ($users as $user){
?>
    <tr>
      <th scope="row"><?php echo $user['u_id'] ; ?></th>
      <td><?php echo $user['u_name']." ".$user['u_lastname'] ; ?></td>
      <td><?php echo $user['u_email'] ; ?></td>
      <td><?php echo $user['u_province']." - ".$user['u_city']."<br/>".$user['u_address'] ; ?></td>
      <td><?php echo $user['u_phone'] ; ?></td>
      <td>
      <a href="user.php?action=delete&id=<?php echo $user['u_id'] ?>" class="btn btn-outline-danger">حذف</a>
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
