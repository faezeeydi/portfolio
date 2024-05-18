<?php
	$errors = array();	
?>
<div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-6">
        <h5 class="">تغییر رمز عبور</h5>
        <div class="card px-4 mt-3 rounded-0 pb-2">
  <div class="card-body">
        <form action="my_account.php?change_pass" method="post" enctype="multipart/form-data" >
        <label for="old_pass" class="form-label">رمز عبور فعلی</label>
        <input name="old_pass" type="password" class="form-control mb-4" id="old_pass">
 
        <label for="new_pass" class="form-label">رمز عبور جدید</label>
        <input name="new_pass" type="password" class="form-control" id="new_pass">
        <p class="mt-1" style="font-size:12.5px">
کلمه عبور باید به زبان انگلیسی و شامل 8 کاراکتر و متشکل از حروف بزرگ و کوچک، عدد و یکی از نشانه‌های (*!@) باشد.
        </p>

    <label for="repeat_new_pass" class="form-label">تکرار رمز عبور جدید</label>
    <input name="repeat_new_pass" type="password" class="form-control" id="repeat_new_pass">

    <div class="link text-end d-grid gap-2 mt-5">

<button name="update_pass" type="submit" class="log px-5">ویرایش</button>

</div>
</form>
        </div>
        </div>
        </div>

        <div class="col-md-4"></div>

</div>

<?php
	include("./include/db.php");

	if(isset($_POST['update_pass']))
	{
		// receive old password value from the form and validation password value
		$old_pass=mysqli_real_escape_string($con ,$_POST['old_pass']);
		if (empty($old_pass)) 
		{
			array_push($errors, "رمزعبور فعلی خود را وارد کنید."); 
			
			}else{
			
			// receive password value from the form and validation password value
			$new_pass_validate=mysqli_real_escape_string($con ,$_POST['new_pass']);
			if (empty($new_pass_validate)) 
			{
				array_push($errors, "رمزعبور جدید خود را وارد کنید."); 
				}else{
				if(preg_match("/^(?=.*[A-z])(?=.*[0-9])(?=.*[*!@])\S{8,12}$/", $new_pass_validate))
				{
					// Password is valid
					$new_pass = $new_pass_validate;
					
					// receive repeat password value from the form and validation password value
					$repeat_new_pass =mysqli_real_escape_string($con ,$_POST['repeat_new_pass']);
					if (empty($repeat_new_pass)){
						array_push($errors, "رمز عبور جدید را مجددا وارد کنید.");
					}
					
					//comparison between repeat password value and  password value
					if((!empty($new_pass))&&(!empty($repeat_new_pass)))
					{
						if ($new_pass != $repeat_new_pass)
						{
							array_push($errors, "رمزعبورهای وارد شده یکسان نیستند.");
						}
					}							
					
					}else{
                                                array_push($errors, "کلمه عبور باید به زبان انگلیسی و شامل 8 کاراکتر و متشکل از حروف بزرگ و کوچک، عدد و یکی از نشانه‌های (*!@) باشد.");
                                        } 
			}	
			
		}
		
		// Finally, update user account if there are no errors in the form
		if (count($errors) == 0) {
			$u_email = $_SESSION['u_email'];
			include("./include/db.php");
			$SearchUser=mysqli_query($con,"call SearchUser('$u_email','$old_pass')");
			foreach ($SearchUser as $user){			
			if($user['count']==0)
			{
				echo "<script>alert('رمز عبور فعلی شما صحیح نیست، لطفا دوباره امتحان کنید.')</script>";
			}elseif($user['count'] > 0)
			{
				include("./include/db.php");
				$UpdatePass=mysqli_query($con,"call UpdatePass('$u_email','$new_pass')");

				echo "<script>alert('رمزعبور شما با موفقیت به روزرسانی شد.')</script>";
				echo "<script>window.open('my_account.php?change_pass','_self')</script>";
			}			
			}
		}else{
			include('include/errors.php');
		}		
		
	}	
?>