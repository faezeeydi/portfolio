<?php

$email=$_SESSION['u_email'];
include("./include/db.php");
$SelectUser=mysqli_query($con,"call SelectUser('$email')");
foreach ($SelectUser as $sel) {
        $id=$sel['u_id'];
        $name=$sel['u_name'];
        $lastname= $sel['u_lastname'];
        $phone=$sel['u_phone'];
        $address=$sel['u_address'];
        $city=$sel['u_city'];
        $province=$sel['u_province'];
        $image=$sel['u_image'];
?>

        <h5 class="">ویرایش اطلاعات</h5>
        <div class="card px-4 mt-3 rounded-0 pb-2">
  <div class="card-body">
        <form action="my_account.php?edit_account" method="post" enctype="multipart/form-data">
                <div class="row">
                        <div class="col-md-4">
                        <div class="mb-4">
                                <label for="u_name" class="form-label">نام</label>
                                <input name="u_name" type="text" class="form-control" id="u_name" value="<?php echo $name; ?>">
                        </div>
                        </div>
                        <div class="col-md-4">
                        <div class="mb-4">
                                <label for="u_lastname" class="form-label">نام خانوادگی</label>
                                <input name="u_lastname" type="text" class="form-control" id="u_lastname" value="<?php echo $lastname; ?>">
                        </div>
                        </div>
                        <div class="col-md-4">
                        <div class="mb-4">
                                <label for="u_phone" class="form-label">تلفن همراه</label>
                                <input name="u_phone" type="text" class="form-control" id="u_phone" placeholder="*********09" value="<?php echo $phone; ?>">
                        </div>
                        </div>
                </div>
                <div class="row">
                        <di class="col-md-4">
                        <div class="mb-4">
                        <label for="u_address" class="form-label">آدرس</label>
                        <input name="u_address" type="text" class="form-control" id="u_address" value="<?php echo $address; ?>">
                </div>
                        </di>
                        <di class="col-md-4">
                        <div class="mb-4">
                        <label for="u_city" class="form-label">شهر</label>
                        <input name="u_city" type="text" class="form-control" id="u_city" value="<?php echo $city; ?>">
                </div>
                        </di>
                        <di class="col-md-4">
                        <div class="mb-4">
                        <label class="form-label">استان</label>
                        <select name="u_province" class="form-select" aria-label="Default select example" onChange="this.value">
                        <option><?php echo $province; ?></option>
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
                        <label for="u_image" class="form-label">تصویر</label>

                                <div class="col-md-1">
<?php
  if ($image!=NULL){
?>
        <img class="border" src="../<?php  echo $image;  ?>" width="50" height="40"/>
<?php
}else{
?>
        <img class="border" src="./user_images/avatar.png" width="50" height="40"/>
<?php
}
?>
                                </div>
                                <div class="col-md-3">
                                <div class="">

                    <input type="file" class="form-control" name="u_image" id="u_image">

                </div>
                                </div>
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                <div class="link text-end">

<button name="update_user" type="submit" class="log px-5">ویرایش</button>

</div>
                                </div>
                        </div>
                </div>
<?php
}
?>
  
</div>
  </form>
</div>

<?php
	
	include('server.php'); 
	
?>