<div class="row mt-5">
        <div class="col-md-2"></div>
        <div class="col-md-6">
        <h5>حذف حساب کاربری</h5>
        <div class="card p-2 mt-3 rounded-0 text-center">
  <div class="card-body">
  <form action="my_account.php?delete_account" method="post" enctype="multipart/form-data" > 
        <p style="font-size:18px;">
                آیا از حذف حساب کاربری خود اطمینان دارید؟
        </p>
<br>
<div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-6">
        <button name="yes" type="submit" class="btn btn-danger">حذف حساب کاربری</button>
        </div>
        <div class="col-md-1">
        <button name="no" type="submit" class="btn btn-success">انصراف</button>
        </div>
        <div class="col-md-4"></div>
</div>

</div>
</form>
        </div>
        </div>
        </div>

        <div class="col-md-4"></div>

</div>

                  
<?php
	
	if(isset($_POST['yes']))
	{
		$u_email = $_SESSION['u_email'];		
		include("./include/db.php");
		$DeleteAccount=mysqli_query($con,"call DeleteAccount('$u_email')");
		echo "<script>alert('حساب کاربری شما با موفقیت حذف شد.')</script>";
		echo "<script>window.open('../logout.php','_self')</script>";
	}
	
	if(isset($_POST['no']))
	{
		echo "<script>window.open('my_account.php','_self')</script>";
	}

?>