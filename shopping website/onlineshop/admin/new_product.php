<?php

include("./include/header.php");
$con=mysqli_connect("localhost","root","","online_shop");
$ordercategory=mysqli_query($con,"call ordercategory()");

if ( isset($_POST['add_product']) ) {
    if (trim($_POST['p_title']) != "" && trim($_POST['p_price']) != "" && trim($_POST['p_description']) != ""  && trim($_FILES['p_image']['name']) != "" && trim($_POST['o_id']) != "") {

        $p_title = $_POST['p_title'];
        $p_price = $_POST['p_price'];
        $p_discount = $_POST['p_discount'];
        $p_description = $_POST['p_description'];
        $o_id = $_POST['o_id'];


        $p_image = $_FILES['p_image']['name'];
        $tmp_name = $_FILES['p_image']['tmp_name'];
        if (move_uploaded_file($tmp_name, "../upload/posts/$p_image")) {
            echo "Upload Success";
        } else {
            echo "Upload Error";
        }
        $con=mysqli_connect("localhost","root","","online_shop");
        $insertproduct=mysqli_query($con,"call InsertProduct('$p_title','$p_price','$p_discount','$p_description','$p_image','$o_id')");

        header("Location:product.php");
        exit();
    } else {
        header("Location:new_product.php?err_msg= تمام فیلد ها الزامی هست");
        exit();
    }
}
?>

<div class="container-fluid">
    <div class="row">

        <?php include('./include/sidebar.php') ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

            
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                <div class="d-flex justify-content-between mt-5">
                <h3>محصول جدید</h3>
            </div>

            <hr>
            <?php
            if (isset($_GET['err_msg'])) {
                ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $_GET['err_msg'] ?>
                </div>
            <?php
            }
            ?>
                <form method="post" class="mb-5" enctype="multipart/form-data">
                <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                    <label for="p_title">عنوان : </label>
                    <input type="text" class="form-control" name="p_title" id="p_title">
                </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                    <label for="o_id">دسته بندی : </label>
                    <select class="form-control" name="o_id" id="o_id">
                    <option selected>نام دسته را وارد کنید</option>
                        <?php
                        foreach ($ordercategory as $order){
                                ?>
                                <option value="<?php echo $order['o_id'] ?>"> <?php echo $order['o_name'] ?> </option>

                        <?php
                        
                        }
                        ?>
                    </select>
                </div>
                        </div>
                </div>
                <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                    <label for="p_price">قیمت : </label>
                    <input type="text" class="form-control" name="p_price" id="p_price">
                </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                    <label for="p_discount">تخفیف : </label>
                    <input type="text" class="form-control" name="p_discount" id="p_discount">
                </div>
                        </div>
                </div>
                
                
                <div class="form-group">
                    <label for="p_description">توضیحات</label>
                    <textarea class="form-control" name="p_description" id="p_description" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label for="p_image">تصویر : </label>
                    <input type="file" class="form-control" name="p_image" id="p_image">
                </div>

                <button type="submit" name="add_product" class="btn btn-outline-primary mt-3">ثبت</button>
            </form>
                </div>
                <div class="col-md-2"></div>

            </div>

        </main>

    </div>

</div>

</body>
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>

<script>
    CKEDITOR.replace('p_description');
</script>

</html>
