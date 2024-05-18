<?php

include("./include/header.php");

?>

<div class="container">

<div class="row mt-5">
        <div class="col-md-1"></div>
        <div class="col-md-4">
        <h5>آدرس ما</h5>
                <hr>
                
                <p>
                قاین - خیابان مهدیه - میدان مبارزان
                
                <br>
                <br>
                تلفن: 05632537187
                <br>
                <br>
                تلفن پشتیبانی: 09905401138
                <br>
                <br>
                ایمیل پشتیبانی: sedaghatshop@gmail.com                
                </p>
        </div>
        <div class="col-md-1"></div>

        <div class="col-md-5">
                <h5>فرم تماس</h5>
                <hr>
                <br>
                
        <form method="post" action="customer_register.php" enctype="multipart/form-data">
        <div class="row">
                        <div class="col-md-6">
                        <div class="mb-3">
                                <label for="con_name" class="form-label">نام</label>
                                <input name="con_name" type="text" class="form-control" id="con_name">
                        </div>
                        <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">آدرس ایمیل</label>
                                <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text"></div>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="mb-3">
                                <label for="u_phone" class="form-label">تلفن همراه</label>
                                <input name="u_phone" type="text" class="form-control" id="u_phone">
                        </div>
                        <div class="mb-3">
                                <label for="con_title" class="form-label">موضوع پیام</label>
                                <input name="con_title" type="text" class="form-control" id="con_title">
                        </div>
                        </div>

                </div>
                <div class="mb-3">
                        <label for="con_text" class="form-label">پیام شما</label>
                        <textarea name="con_text" type="text" class="form-control" id="con_text" rows="5"></textarea>
                </div>  
  <button name="contact" type="submit" class="button">ارسال</button>
</form>
        </div>
        <div class="col-md-1"></div>
</div>

</div>
<br><br><br><br><br>
<?php

include("./include/footer.php");

?>