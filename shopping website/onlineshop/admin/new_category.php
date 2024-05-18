<?php

include("./include/header.php");
if (isset($_GET['entity']) && isset($_POST['add_category']) ) {
    $entity = $_GET['entity'];
    $con=mysqli_connect("localhost","root","","online_shop");      
    
    if ($entity == "category" && trim($_POST['c_name']) != "") {

        $c_name = $_POST['c_name'];
        
        $insertcategory=mysqli_query($con,"call InsertCategory('$c_name')");

        header("Location:category.php");
        exit();
    }
    elseif ($entity == "ordercategory" && trim($_POST['o_name']) != "" && trim($_POST['c_id']) != "") {

        $o_name = $_POST['o_name'];
        $c_id = $_POST['c_id'];
        
        $insertordercat=mysqli_query($con,"call InsertOrdercat('$o_name','$c_id')");

        header("Location:category.php");
        exit();
    }else {
        header("Location:new_category.php?err_msg= تمام فیلد ها الزامی هست");
        exit();
    }
}
?>

<div class="container-fluid">
    <div class="row">

        <?php include('./include/sidebar.php') ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

            
            <div class="row">
                <div class="col-md-3"></div>
<?php                
            if (isset($_GET['entity'])) {

                $entity = $_GET['entity'];
            
                if ($entity == "category") {
?>
<div class="col-md-6">
                <div class="d-flex justify-content-between mt-5">
                <h3>دسته جدید</h3>
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
                    <div class="form-group">
                    <label for="c_name">نام : </label>
                    <input type="text" class="form-control" name="c_name" id="c_name">
                    </div>
                <button type="submit" name="add_category" class="btn btn-outline-primary mt-3">ثبت</button>
            </form>
<?php
            }elseif ($entity == "ordercategory") {
?>
                <div class="col-md-6">
                <div class="d-flex justify-content-between mt-5">
                <h3>زیر دسته جدید</h3>
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
            $con=mysqli_connect("localhost","root","","online_shop");
            $category=mysqli_query($con,"call category()");
?>
                <form method="post" class="mb-5" enctype="multipart/form-data">
                    <div class="form-group">
                    <label for="o_name">نام : </label>
                    <input type="text" class="form-control" name="o_name" id="o_name">
                    </div>
                    <div class="form-group">
                    <label for="c_id">کد دسته : </label>
                    <select class="form-control" name="c_id" id="c_id">
                    <option selected>کد دسته را وارد کنید</option>
                        <?php
                        foreach ($category as $cat){
                                ?>
                                <option value="<?php echo $cat['c_id'] ?>"> <?php echo $cat['c_name'] ?> </option>

                        <?php
                        
                        }
                        ?>
                    </select>
                    </div>

                <button type="submit" name="add_category" class="btn btn-outline-primary mt-3">ثبت</button>
            </form>
<?php
            }
        }
?>
                
                </div>
                <div class="col-md-3"></div>

            </div>

        </main>

    </div>

</div>

</body>

<script>
</script>

</html>
