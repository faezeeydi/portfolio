<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ورود</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-7mQhpDl5nRA5nY9lr8F1st2NbIly/8WqhjTp+0oFxEA/QUuvlbF6M1KXezGBh3Nb" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="../css/font.css">      
        <link rel="stylesheet" href="../css/style.css">    
         <style>
		body{
			background:#fafafa;
		}
	 </style>
</head>

<body>
  
<div class="container mt-5">
        <div class="row mt-5">
                <div class="col-md-4"></div>
                <div class="col-md-4 mt-5">
		<?php 
	if(isset($_GET['not_admin'])){
?>
		<div class="alert alert-danger text-center" role="alert">
		<?php
	echo $_GET['not_admin'];
?>
</div>
<?php
	}
?>
		<div class="card px-4 py-3">
  <div class="card-body">
  <h4 class="card-title text-center">ورود</h4>
  <hr>
                <form method="post" action="">
  <div class="mb-3 mt-4">
    <label for="exampleInputEmail1" class="form-label">ایمیل</label>
    <input name="loginEmail" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text"></div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">رمز عبور</label>
    <input name="loginPass" type="password" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="d-grid gap-2 link text-center mt-5">
  <button name="login" type="submit" class="btn btn-dark mb-2">ورود</button>
  </div>
</form>
</div>
</div>
                </div>
                <div class="col-md-4"></div>

        </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>   
</body>
</html>
<?php	

	session_start();
	
	require('include/db.php');

	if(isset($_POST['login'])){
	
		$email= mysqli_real_escape_string($con,$_POST['loginEmail']);
		
		$pass= mysqli_real_escape_string($con,$_POST['loginPass']);
		
		$AdminLogin=mysqli_query($con,"call AdminLogin('$email','$pass')");
		
		foreach ($AdminLogin as $log) {
		
		if($log['count']==0){
		
			echo "<script>alert('نام کاربری و یا رمز عبور شما صحیح نیست، لطفا دوباره امتحان کنید.')</script>";
		
		}else{
		
			$_SESSION['admin_email'] = $email;

			echo "<script>alert('سلام، به پنل مدیریت خوش آمدید!')</script>";

			echo "<script>window.open('dashboard.php','_self')</script>";
		
		}
	}
	
	}
?>