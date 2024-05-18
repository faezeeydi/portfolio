<?php

include("./include/db.php");
// include("./include/header.php");

?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ورود/ثبت نام</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-7mQhpDl5nRA5nY9lr8F1st2NbIly/8WqhjTp+0oFxEA/QUuvlbF6M1KXezGBh3Nb" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="./css/font.css">      
        <link rel="stylesheet" href="./css/style.css">    
         <style>
		body{
			background:#fefcf8;
		}
	 </style>
</head>

<body>
  
<div class="container mt-5">
        <div class="row mt-5">
                <div class="col-md-4"></div>
                <div class="col-md-4 mt-5">
		<div class="card px-4 py-3">
  <div class="card-body">
  <h4 class="card-title text-center">ورود/ثبت نام</h4>
  <hr>
                <form method="post" action="">
  <div class="mb-3 mt-4">
    <label for="exampleInputEmail1" class="form-label">ایمیل</label>
    <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text"></div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">رمز عبور</label>
    <input name="password" type="password" class="form-control" id="exampleInputPassword1">
  </div>
  <!-- <div class="mb-3 form-check" style="font-size:14px">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">مرا به خاطر بسپار</label>
  </div> -->
  <div class="d-grid gap-2 link text-center mt-5">
  <button name="login" type="submit" class="log mb-2">ورود</button>
  <!-- <a href="checkout.php?forgot_pass" style="font-size:14px">رمز عبور خود را فراموش کرده اید؟</a> -->
  
  <button type="button" onclick="location.href='user_register.php';" class="sig mb-3">ثبت نام</button>
  
  <a href="home.php" style="font-size:13px">بازگشت به صفحه اصلی سایت</a>

  </div>
</form>
</div>
</div>

<?php	
		
		if(isset($_POST['login']))
		
		{
			// receive email value from the form 
			$u_email_no_empty = mysqli_real_escape_string($con ,$_POST['email']);
			// receive password value from the form
			$u_password_validate=mysqli_real_escape_string($con ,$_POST['password']);
			
			if (empty($u_email_no_empty)) 
			{
				if (empty($u_password_validate)) 
				{
					echo "<script>alert('ایمیل و رمزعبور خود را وارد کنید.')</script>";
					}else{
					echo "<script>alert('ایمیل خود را وارد کنید.')</script>";
				}	
				}else{
				if (empty($u_password_validate)){
					echo "<script>alert('رمزعبور خود وارد کنید.')</script>";
					}else{
					$u_email_validate=$u_email_no_empty;
					if(filter_var($u_email_validate,FILTER_VALIDATE_EMAIL) == true){
						if(preg_match("/^(?=.*[A-z])(?=.*[0-9])(?=.*[*!@])\S{8,12}$/", $u_password_validate))
						{
							// email is valid
							$u_email=$u_email_validate;
							// password is valid
							$u_pass = $u_password_validate;
							
							}else{
							echo "<script>alert('رمزعبور خود را مطابق الگو وارد کنید: رمزعبور باید به زبان انگلیسی و شامل 8 کاراکتر و متشکل از حروف بزرگ و کوچک، عدد و یکی از نشانه‌های (*!@) باشد.')</script>";
						}
						}else{
						echo "<script>alert('ایمیل خود را به طور صحیح وارد کنید.')</script>";
						
					}
				}
			}	
			
			
			if(	(isset($u_pass))	 and	 (isset($u_email))	)
			{
	
        $SearchUser=mysqli_query($con,"call SearchUser('$u_email','$u_pass')");
				foreach ($SearchUser as $user){			
				if($user['count']==0)
				{
					echo "<script>alert('ایمیل و یا رمز عبور شما صحیح نیست، لطفا دوباره امتحان کنید.')</script>";
					}else{
	include("./include/db.php");			
        $SelectUser=mysqli_query($con,"call SelectUser('$u_email')");

					foreach ($SelectUser as $sel)
					{
						$u_login_name =	$sel['u_name'];
						
						$u_login_lastname =	$sel['u_lastname'];
						
						// $u_confirmed	=	$sel['confirmed'];
						
					}
					// if($u_confirmed==1){	
						//creating or using cookie 
						if(isset($_COOKIE["ipUser"]))
						{
							$ip	= $_COOKIE["ipUser"];
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
							setcookie('ipUser',$ip,time()+1206900);
						}
						
					include("./include/db.php");

                                        $QtyCart=mysqli_query($con,"call QtyCart('$ip')");
					$_SESSION['u_name'] = $u_login_name;
					$_SESSION['u_email'] = $u_email;
					foreach ($QtyCart as $qty) {
                                                if($qty['total']==NULL){
					
							echo "<script>alert('$u_login_name عزیز خوش آمدید، ورود شما با موفقیت انجام شد.')</script>";
                                                        echo "<script>window.open('user/my_account.php','_self')</script>";
                                                        
                                                        }else{
                        
							echo "<script>alert('$u_login_name عزیز خوش آمدید، ثبت نام شما با موفقیت انجام شد. اکنون برای پرداخت صورت حساب خود به درگاه زرین پال متصل خواهید شد.')</script>";
                                                        echo "<script>window.open('checkout.php','_self')</script>";
                                                }
                                        }
					// 	}else{
					// 	echo "<script>alert('$u_login_name  $u_login_lastname  چرا ایمیل خودت را تایید نکرده ایی؟ به ایمیل خودت مراجعه کن و لینک ثبت نام را تایید کن!!!')</script>";			
					// }						
					
				}	
      }
				
			}
		}
		
	?>
                </div>
                <div class="col-md-4"></div>

        </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>   
</body>
</html>
<!-- <br><br><br><br><br> -->

<?php

// include("./include/footer.php");

?>