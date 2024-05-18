<?php
include("./include/header.php");
?>
<div class="container">
        <div class="row">
                <div class="col-md-3 mt-5">
<?php
include("./include/sidebar.php");
?>
</div>
                <div class="col-md-9 mt-5">
                <?php										
			//when nothing press keys right sidebar 				
				if(!isset($_GET['edit_account'])){
					if(!isset($_GET['change_pass'])){
						if(!isset($_GET['delete_account'])){			
?>
<div class="row">
	<div class="col-md-1"></div>
	<div class="col-md-10">
	<div class="card text-center rounded-0 mt-5 pt-5" style="width: 40rem;">
  <div class="card-body">
<?php
  $u_name = $_SESSION['u_name'];
		echo "<h2><span> سلام $u_name خوش آمدی <i class='bi bi-balloon-heart'></i> </span></h2><br/><br/><br/>";
		echo "<b><span style='font-size:18px;'>اگر میخواهید پروفایل تان را تکمیل کنید،  <a href='my_account.php?edit_account'> اینجا</a> کلیک کنید.</span></b><br/><br/><br/>";
?>			
  </div>
</div>
	</div>
	<div class="col-md-1"></div>

</div>
<?php
						}
					}
				}
			
			//when press edit account from right sidebar
			if(isset($_GET['edit_account']))
			{
				include('edit_account.php');
			}
                        //when press change password from right sidebar
			if(isset($_GET['change_pass']))
			{
				include('change_pass.php');
			}
			//when press delete account from right sidebar
			if(isset($_GET['delete_account']))
			{
				include('delete_account.php');
			}
		?>
                </div>
                </div>
        </div>
</div>
<br>
<br>
<br>
<?php

include("./include/footer.php");

?>