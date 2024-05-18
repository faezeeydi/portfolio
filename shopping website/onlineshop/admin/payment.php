<?php

include("./include/header.php");
?>

<div class="container-fluid">
    <div class="row">

        <?php include('./include/sidebar.php') ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

            <div class="d-flex justify-content-between mt-5">
                <h3>پرداخت ها</h3>
            </div>

            <table class="table text-center mt-3">
  <thead>
  <tr>
      <th scope="col">نام و نام خانوادگی</th>
      <th scope="col">راه های ارتباطی</th>
      <th scope="col">شماره و تاریخ فاکتور</th>
      <th scope="col">قیمت کل فاکتور</th>

    </tr>
  </thead>
  <tbody class="table-group-divider">
<?php

include("./include/db.php");
$payments=mysqli_query($con,"call payments()");

foreach ($payments as $pay){
        $order_id=$pay['order_id'];
        include("./include/db.php");
        $time_pay_order=mysqli_query($con,"call time_pay_order('$order_id')");
        foreach ($time_pay_order as $time) {
                $order_time=$time['order_time'];
        }
?>
    <tr>
    <td><?php echo $pay['u_name']." ".$pay['u_lastname'] ; ?></td>
    <td>آدرس:<?php echo $pay['u_province']." - ".$pay['u_city']." - ".$pay['u_address'] ; ?><br>
    تلفن همراه:<?php echo $pay['u_phone']; ?>
    <br>
    ایمیل:<?php echo $pay['u_email']; ?>
</td>
    <td>شماره فاکتور:<?php echo $pay['order_id']; ?>
    <br>
    زمان پرداخت:<?php echo $order_time; ?></td>
    <td><?php echo $pay['total_price']; ?> تومان</td>  
    </tr>
<?php
}
?>
  </tbody>
</table>

        </main>

    </div>

</div>