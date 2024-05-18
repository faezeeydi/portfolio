<?php

include("./include/db.php");
$errors = array(); 
	// update USER
	if(isset($_POST['update_user'])) {
		// receive all input values from the form
		// form validation: ensure that the form is correctly filled ...
		// by adding (array_push()) corresponding error unto $errors array
		
		// receive name value from the form
		$u_name = mysqli_real_escape_string($con , $_POST['u_name']);
		if (empty($u_name)) { array_push($errors, "نام خود را وارد کنید."); }
		
		// receive lastname value from the form
		$u_lastname = mysqli_real_escape_string($con ,$_POST['u_lastname']);
		if (empty($u_lastname)) { array_push($errors, "نام خانوادگی خود را وارد کنید."); }

		// receive address value from the form
		$u_address = mysqli_real_escape_string($con ,$_POST['u_address']);
		if (empty($u_address)) { array_push($errors, "آدرس خود را وارد کنید."); }

		// receive city value from the form
		$u_city = mysqli_real_escape_string($con ,$_POST['u_city']);
		if (empty($u_city)) { array_push($errors, "شهر خود را وارد کنید."); }

		// receive state value from the form
		
		$u_province = $_POST['u_province'];

		// receive phone value from the form and validation phone value
		$u_phone_validate=mysqli_real_escape_string($con ,$_POST['u_phone']);
		if (empty($u_phone_validate)) 
		{
			array_push($errors, "شماره همراه خود را وارد کنید."); 
			}else{
			if(preg_match("/^[0]{1}[9]{1}\d{9}$/", $u_phone_validate))
			{
				// phone is valid
				$u_phone=$u_phone_validate;
				}else{
					array_push($errors, "شماره همراه خود را به طور صحیح وارد کنید.");
				} 
		}

		// receive image value from the form and validation image value
		if (empty($_FILES["u_image"]["name"])) 
		{ 
			$new_address_image = $image; 
			}else{
			$Allowextension = array("jpeg" , "jpg" , "png");
			$FileExtension=explode(".",$_FILES["u_image"]["name"]);
			$extension=end($FileExtension);
			if(in_array($extension,$Allowextension )&&($_FILES["u_image"]["size"]<=20971520))
			{
				if($_FILES["u_image"]["error"]==0)
				{
					$u_image = $_FILES['u_image']['name'];
					$u_image_tmp = $_FILES['u_image']['tmp_name'];
					$new_address_image="user/user_images/".$u_image;
					move_uploaded_file($u_image_tmp,"user_images/".$u_image);
					}else{
					array_push($errors, "فایل به درستی آپلود نشد!!!");	
				}
				}else{
				array_push($errors, "تصویر مناسب را انتخاب کنید! پسوند مجاز برای تصویر شامل jpeg و jpg و png می باشد و حجم آن نباید بیشتر از 2 مگابایت باشد!!!");
			}
		}

		// Finally, update user account if there are no errors in the form
		if (count($errors) == 0) {
			include("./include/db.php");
                        $UpdateProfile=mysqli_query($con,"call UpdateProfile('$id','$u_name','$u_lastname','$u_province','$u_city','$u_address','$u_phone','$new_address_image')");
			if ($UpdateProfile)
			{
			
					echo "<script>alert('$u_name عزیز ، اطلاعات شما به روز رسانی شد.')</script>";
					echo "<script>window.open('my_account.php?edit_account','_self')</script>";
				
			}
		}else{
			include('include/errors.php');
		}
	}
?>