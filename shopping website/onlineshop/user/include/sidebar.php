
<?php
$u_email=$_SESSION['u_email'];
include("./include/db.php");
$SelectUser=mysqli_query($con,"call SelectUser('$u_email')");
foreach ($SelectUser as $sel) {
?>
  <div class="card rounded-0" style="width: 15rem;">
  <div class="card-body">
  <h6 class="card-title" style="margin-right:3px">حساب کاربری من</h6>
  <hr>
<?php
  if ($sel['u_image']!=NULL){
?>
  <img src="../<?php echo $sel['u_image'] ?>" class="border mb-4" style="margin-right:20px" alt="..." width="160" height="160">
<?php
}else{
?>
  <img src="./user_images/avatar.png" class="border mb-4" style="margin-right:20px" alt="..." width="160" height="160">
<?php
}
?>
<div class="link lh-lg" style="margin-right:20px;font-size:14px">
<a href="my_account.php?edit_account">ویرایش اطلاعات</a>
<br>
				<a href="my_account.php?change_pass">تغییر رمز عبور</a>
        <br>
				<a href="my_account.php?delete_account">حذف حساب کاربری</a>
        <br>
				<a href="../logout.php">خروج از حساب کاربری</a>
</div>
  </div>
</div>
<br>
<br>
<br>
<?php
}
?>