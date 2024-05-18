<?php

include('include/header.php');

include('./server.php');

?>

<div class="container">

<div class="row mt-1 g-5">
        <div class="col-md-1"></div>
        <div class="col-md-10">
        <h5 class="card-title">فرم ثبت نام</h5>
        <div class="card px-4 mt-3 rounded-0">
  <div class="card-body">
        <form method="post" action="user_register.php" enctype="multipart/form-data">
        <?php include('include/errors.php'); ?>
                <div class="row">
                        <div class="col-md-4">
                        <div class="mb-4">
                                <label for="u_name" class="form-label">نام</label>
                                <input name="u_name" type="text" class="form-control" id="u_name" value="<?php echo $u_name; ?>">
                        </div>
                        </div>
                        <div class="col-md-4">
                        <div class="mb-4">
                                <label for="u_lastname" class="form-label">نام خانوادگی</label>
                                <input name="u_lastname" type="text" class="form-control" id="u_lastname" value="<?php echo $u_lastname; ?>">
                        </div>
                        </div>
                        <div class="col-md-4">
                        <div class="mb-4">
                                <label for="u_phone" class="form-label">تلفن همراه</label>
                                <input name="u_phone" type="text" class="form-control" id="u_phone" placeholder="*********09" value="<?php echo $u_phone; ?>">
                        </div>
                        </div>
                </div>
                <div class="row">
                        <di class="col-md-4">
                        <div class="mb-4">
                        <label for="u_address" class="form-label">آدرس</label>
                        <input name="u_address" type="text" class="form-control" id="u_address" value="<?php echo $u_address; ?>">
                </div>
                        </di>
                        <di class="col-md-4">
                        <div class="mb-4">
                        <label for="u_city" class="form-label">شهر</label>
                        <input name="u_city" type="text" class="form-control" id="u_city" value="<?php echo $u_city; ?>">
                </div>
                        </di>
                        <di class="col-md-4">
                        <div class="mb-4">
                        <label class="form-label">استان</label>
                        <select name="u_province" class="form-select" aria-label="Default select example" onChange="this.value">
                        <?php 
				if(isset($u_province) && $u_province!=0){
					echo ('<option value="'.$u_province.'" >'.$u_province.'</option>"');
				}
                                ?>
                                <option value="0">لطفا استان را انتخاب نمایید</option>
				<option value="تهران">تهران</option>
				<option value="گیلان">گیلان</option>
				<option value="آذربایجان شرقی">آذربایجان شرقی</option>
				<option value="خوزستان">خوزستان</option>
				<option value="فارس">فارس</option>
				<option value="اصفهان">اصفهان</option>
				<option value="خراسان رضوی">خراسان رضوی</option>
				<option value="قزوین">قزوین</option>
				<option value="سمنان">سمنان</option>
				<option value="قم">قم</option>
				<option value="مرکزی">مرکزی</option>
				<option value="زنجان">زنجان</option>
				<option value="مازندران">مازندران</option>
				<option value="گلستان">گلستان</option>
				<option value="اردبیل">اردبیل</option>
				<option value="آذربایجان غربی">آذربایجان غربی</option>
				<option value="همدان">همدان</option>
				<option value="کردستان">کردستان</option>
				<option value="کرمانشاه">کرمانشاه</option>
				<option value="لرستان">لرستان</option>
				<option value="بوشهر">بوشهر</option>
			        <option value="کرمان">کرمان</option>
				<option value="هرمزگان">هرمزگان</option>
				<option value="چهارمحال و بختیاری">چهارمحال و بختیاری</option>
				<option value="یزد">یزد</option>
				<option value="سیستان و بلوچستان">سیستان و بلوچستان</option>
				<option value="ایلام">ایلام</option>
				<option value="کهگلویه و بویراحمد">کهگلویه و بویراحمد</option>
				<option value="خراسان شمالی">خراسان شمالی</option>
				<option value="خراسان جنوبی">خراسان جنوبی</option>
		                <option value="البرز">البرز</option>
			</select>
                </div>

                        </div>
                        <div class="row">
                                <div class="col-md-4">
                                <div class="">
    <label for="u_email" class="form-label">آدرس ایمیل</label>
    <input name="u_email" type="email" class="form-control" id="u_email" aria-describedby="emailHelp" value="<?php echo $u_email; ?>">
    <div id="emailHelp" class="form-text"></div>
  </div>
                                </div>
                                <div class="col-md-4">
                                <div class="">
    <label for="myInput_1" class="form-label">رمز عبور</label>
    <!-- An element to toggle between password visibility -->
    <input type="checkbox" class="form-check-input" id="exampleCheck1" onclick="myFunction()" style="margin-right:150px">
    <label class="form-check-label" for="exampleCheck1" style="font-size:12.5px">نمایش رمز عبور</label>
							<script>
								function myFunction() {
									var x = document.getElementById("myInput_1");
									var y = document.getElementById("myInput_2");
									if (x.type === "password") {
										x.type = "text";
										} else {
										x.type = "password";
									}
									if (y.type === "password") {
										y.type = "text";
										} else {
										y.type = "password";
									}
								}
							</script>
    <input name="u_password1" type="password" class="form-control" id="myInput_1" value="<?php echo $u_password1; ?>">
<p class="mt-1" style="font-size:12.5px">
کلمه عبور باید به زبان انگلیسی و شامل 8 کاراکتر و متشکل از حروف بزرگ و کوچک، عدد و یکی از نشانه‌های (*!@) باشد.
</p>
</div>
                                </div>
                                <div class="col-md-4">
                                <div>
    <label for="myInput_2" class="form-label">تکرار رمز عبور</label>
    <input name="u_password2" type="password" class="form-control" id="myInput_2" value="<?php echo $u_password2; ?>">
  </div>
                                </div>
                        </div>
                </div>

  <!-- <div class="mb-3 form-check" style="font-size:14px">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">مرا به خاطر بسپار</label>
  </div> -->
  
</div>
</div>
<div class="row mt-3">
        <div class="col-md-1"></div>
        <div class="col-md-10">
        <div class="link text-end">
        <a class="mx-4" href="user_login.php" style="font-size:15px">بازگشت به فرم ورود</a>

  <button name="register" type="submit" class="log px-5">ثبت نام</button>

  </div>
        </div>
        <div class="col-md-1"></div>

  </div>

        </div>
        <div class="col-md-1"></div>
</div>

</div>
</form>

<br><br><br><br><br>
<?php

include("./include/footer.php");

?>