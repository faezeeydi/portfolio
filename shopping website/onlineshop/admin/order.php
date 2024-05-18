<?php

include("./include/header.php");
?>

<div class="container-fluid">
    <div class="row">

        <?php include('./include/sidebar.php') ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

            <div class="d-flex justify-content-between mt-5">
                <h3>سفارش ها</h3>
            </div>

            <table class="table text-center mt-3">
  <thead>
  <tr>
      <th scope="col">کد فاکتور</th>      
      <th scope="col">ایمیل مشتری</th>
      <th scope="col">تاریخ فاکتور</th>
      <th scope="col">قیمت کل فاکتور</th>
      <th scope="col">وضعیت</th>
      <th scope="col"></th>

    </tr>
  </thead>
  <tbody class="table-group-divider">
<?php
include("./include/db.php");
$orders=mysqli_query($con,"call orders()");
foreach ($orders as $ord){
  $id=$ord['order_id'];
  $email=$ord['u_email'];
  $total_price=$ord['total_price'];
  $order_status=$ord['order_status'];
  $time_pay="";
				if($order_status=="true"){
          include("./include/db.php");
          $time_pay_order=mysqli_query($con,"call time_pay_order('$id')");
					foreach($time_pay_order	as $time)
						{
						 $time_pay=$time['order_time'];
             $status="پرداخت شده";
						}
					}else{
					$order_time=$ord['order_time'];
          $status="پرداخت نشده";
				}
?>
    <tr>
      <th scope="row"><?php echo $id ; ?></th>
      <td><?php echo $email; ?></td>
      <td><?php if($order_status=="true"){echo $time_pay;}else{echo $order_time;} ?></td>
      <td><?php echo $total_price; ?> تومان</td>
      <td style="color:<?php if($order_status=="true"){echo"green";}else{echo"red";}?>"><?php echo $status; ?></td>
      <td>
      <a href="order_customer.php?pay=<?php if($order_status=="true"){echo"yes";}else{echo"no";}?>&order_customer=<?php echo $email; ?>&Total_Amount=<?php echo $total_price ?>&order_id=<?php echo $id; ?>" class="btn btn-outline-info">جزئیات</a>
      </td>
    </tr>
<?php
}
?>
  </tbody>
</table>

        </main>

    </div>

</div>
