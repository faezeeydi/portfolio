<?php

include("./include/db.php");
	
	// initializing variables
	$u_name = "";
	$u_lastname = "";
	$u_address = "";
	$u_city = "";
	$u_phone = "";
        $u_email = "";
	$u_password1 = "";
	$u_password2 = "";
	$errors = array(); 
	
	// REGISTER USER
	if(isset($_POST['register'])) {
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
		if (empty($u_province)) { array_push($errors, "استان خود را وارد کنید."); }  

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

		// receive email value from the form and validation email value
		$u_email_no_empty = mysqli_real_escape_string($con ,$_POST['u_email']);
		if (empty($u_email_no_empty)) 
		{
			array_push($errors, "ایمیل خود را وارد کنید."); 
			}else{
			$u_email_validate=$u_email_no_empty;
			if(filter_var($u_email_validate,FILTER_VALIDATE_EMAIL) == true){
				$u_exist_email=$u_email_validate;

				//Has this email already existed?
				include("./include/db.php");
                        	$CheckUser=mysqli_query($con,"call CheckUser('$u_exist_email')");
				foreach ($CheckUser as $check)
				if($check['count'] == 0)
				{
					$u_email=$u_exist_email;
				
				}else{
				
				array_push($errors, "ایمیل وارد شده در سیستم ثبت شده است، لطفا ایمیل جدیدی وارد نمایید.");
				
				}				
				
				}else{
				array_push($errors, "ایمیل خود را به طور صحیح وارد کنید.");
			}
		}

		// receive password value from the form and validation password value
		$u_password1_validate=mysqli_real_escape_string($con ,$_POST['u_password1']);
		if (empty($u_password1_validate)) 
		{
			array_push($errors, "رمزعبور خود را وارد کنید."); 
			}else{
			if(preg_match("/^(?=.*[A-z])(?=.*[0-9])(?=.*[*!@])\S{8,12}$/", $u_password1_validate))
			{
				// phone is valid
				$u_password1 = $u_password1_validate;
				}else{
				array_push($errors, "کلمه عبور باید به زبان انگلیسی و شامل 8 کاراکتر و متشکل از حروف بزرگ و کوچک، عدد و یکی از نشانه‌های (*!@) باشد.");
			} 
		}
		
		$u_password2 =mysqli_real_escape_string($con ,$_POST['u_password2']);
		if (empty($u_password2)){array_push($errors, "رمزعبور خود را مجددا وارد کنید.");}
		
		if((!empty($u_password1_validate))&&(!empty($u_password2)))
		{
			
			if ($u_password1 != $u_password2)
			{
				array_push($errors, "رمزهای عبور وارد شده یکسان نیستند.");
			}
		}

		//creating or using cookie for ip customer
		if(isset($_COOKIE["ipUser"]))
		{
			$ip= $_COOKIE["ipUser"];
			}else{
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
			setcookie('ipUser',$ip,time()+3600);
		}
		
		// Finally, register user if there are no errors in the form
		if (count($errors) == 0) {
			//confirm email
			$u_confirmcode = rand();
			include("./include/db.php");
                        $InsertUser=mysqli_query($con,"call InsertUser('$ip','$u_name','$u_lastname','$u_email','$u_password1','$u_province','$u_city','$u_address','$u_phone','$u_confirmcode')");
			if ($InsertUser)
			{
			// 	$message="
			// 	به منظور تکمیل کردن ثبت‌نام خود، لطفا با کلیک کردن روی لینک زیر آدرس ایمیل خود را تائید کنید.
			// 	https://4f37-2-181-100-184.ngrok-free.app/online_shop/emailconfirm.php?u_name=$u_name&u_ip=$ip&code=$u_confirmcode";
			// 	mail($u_email,"از طرف سایت جهانگیر پچکم", $message ,"Form:DoNotReplay@yoursite.com");
				
			// 	echo "<script>alert('با تشکر از ثبت نام شما. برای تکمیل فرآیند ثبت نام لطفا بر روی لینک فعال سازی که از طریق ایمیل برای شما ارسال شده است، کلیک کنید. ')</script>";
			// 	echo "<script>window.open('emailconfirm.php','_self')</script>";
			include("./include/db.php");

                                        $QtyCart=mysqli_query($con,"call QtyCart('$ip')");
					foreach ($QtyCart as $qty) {
                                                if($qty['total']==NULL){
						
                                                        $_SESSION['u_name'] = $u_name;
                                                        $_SESSION['u_lastname'] = $u_lastname;
                                                        $_SESSION['u_email'] = $u_email;
                                                        echo "<script>window.open('user/my_account.php','_self')</script>";
                                                        
                                                        }else{
                                                        
                                                        $_SESSION['u_name'] = $u_name;
                                                        $_SESSION['u_lastname'] = $u_lastname;
                                                        $_SESSION['u_email'] = $u_email;
                                                        echo "<script>window.open('checkout.php','_self')</script>";
                                                }
                                        }	
			echo "<script>alert('با تشکر از ثبت نام شما. ')</script>";
				// echo "<script>window.open('emailconfirm.php?u_ip=$ip','_self')</script>";

			}
		}

		// // receive image value from the form and validation image value
		// if (empty($_FILES["u_image"]["name"])) 
		// { 
		// 	array_push($errors, "تصویر خود را انتخاب کنید."); 
		// }else{
		// 	$Allowextension = array("jpeg" , "jpg" , "png");
		// 	$FileExtension=explode(".",$_FILES["u_image"]["name"]);
		// 	$extension=end($FileExtension);
		// 	echo $extension;
		// 	if(in_array($extension,$Allowextension )&&($_FILES["u_image"]["size"]<=20971520))
		// 	{
		// 		if($_FILES["u_image"]["error"]==0)
		// 		{
		// 			$c_image = $_FILES['u_image']['name'];
		// 			$c_image_tmp = $_FILES['u_image']['tmp_name'];
		// 			$new_address_image ="user/user_images/".$u_image;
		// 			move_uploaded_file($u_image_tmp,$new_address_image);
					
		// 			}else{
		// 			array_push($errors, "فایل به درستی آپلود نشد!!!");	
		// 		}
		// 		}else{
		// 		array_push($errors, "تصویر مناسب را انتخاب کنید. پسوند مجاز برای تصویر شامل jpeg و jpg و png می باشد و حجم آن نباید بیشتر از 2 مگابایت باشد.");
		// 	}
		// }
        }
?>