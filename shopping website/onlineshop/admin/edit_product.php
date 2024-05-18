<?php

include("./include/header.php");

if (isset($_GET['id'])) {
    $pro_id = $_GET['id'];

    $con=mysqli_connect("localhost","root","","online_shop");
    $showproduct=mysqli_query($con,"call showproduct('$pro_id')");

    $con=mysqli_connect("localhost","root","","online_shop");
    $ordercategory=mysqli_query($con,"call ordercategory()");

}

if (isset($_POST['edit_product'])) {

    if (trim($_POST['p_title']) != "" && trim($_POST['p_price']) != "" && trim($_POST['p_description']) != "" && trim($_POST['o_id']) != "") {

        $p_title = $_POST['p_title'];
        $p_price = $_POST['p_price'];
        $p_discount = $_POST['p_discount'];
        $p_description = $_POST['p_description'];
        $o_id = $_POST['o_id'];
         
        $con=mysqli_connect("localhost","root","","online_shop");

        if( trim($_FILES['p_image']['name']) != "" ){
            $p_image = $_FILES['p_image']['name'];
            $tmp_name = $_FILES['p_image']['tmp_name'];
            if (move_uploaded_file($tmp_name, "../upload/posts/$p_image")) {
                echo "Upload Success";
            } else {
                echo "Upload Error";
            }

            $updateproduct=mysqli_query($con,"call UpdateProduct('$pro_id','$p_title','$p_price','$p_discount','$p_description','$p_image','$o_id')");
        }else{
            $updateproduct=mysqli_query($con,"call UpdatePro('$pro_id','$p_title','$p_price','$p_discount','$p_description','$o_id')");
        }
                header("Location:product.php");
                exit();

    } else {
        header("Location:edit_product.php?id=$pro_id&err_msg= تمام فیلد ها الزامی هست");
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
                <h3>ویرایش محصول</h3>
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
<?php
        foreach ($showproduct as $show){
?>
                <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                    <label for="p_title">عنوان : </label>
                    <input type="text" class="form-control" name="p_title" id="p_title" value="<?php echo $show['p_title'] ?>">
                </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                    <label for="o_id">دسته بندی : </label>
                    <select class="form-control" name="o_id" id="o_id">
                        <?php
                        foreach ($ordercategory as $order){
                                ?>
                                <option value="<?php echo $order['o_id'] ?>" <?php echo ($order['o_id'] == $show['o_id']) ? "selected" : "" ?>> <?php echo $order['o_name'] ?> </option>

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
                    <input type="text" class="form-control" name="p_price" id="p_price" value="<?php echo $show['p_price'] ?>">
                </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                    <label for="p_discount">تخفیف : </label>
                    <input type="text" class="form-control" name="p_discount" id="p_discount" value="<?php echo $show['p_discount'] ?>">
                </div>
                        </div>
                </div>
                
                
                <div class="form-group">
                    <label for="p_description">توضیحات</label>
                    <textarea class="form-control" name="p_description" id="p_description" rows="3"><?php echo $show['p_description'] ?>
                    </textarea>
                </div>
                <img class="img-fluid" src="../upload/posts/<?php echo $show['p_image'] ?>" alt="">
                <div class="form-group">
                    <label for="p_image">تصویر : </label>
                    <input type="file" class="form-control" name="p_image" id="p_image">
                </div>

                <button type="submit" name="edit_product" class="btn btn-outline-primary">ویرایش</button>
<?php
        }
?>
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
