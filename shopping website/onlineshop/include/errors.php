<style>
	/*  error message for page registry  */
.error{
	background: #fccfcf;
	padding: 10px;
	font-size: 12px;
	border-radius: 5px;
	border:1px solid #f79f9f;
	color: #890911;
}
</style>
<?php  if (count($errors) > 0) : ?>
<div>
  	<?php foreach ($errors as $error) : ?>
	<div class="error mb-2"><?php echo $error ?></div>
  	<?php endforeach ?>
	</div>
<?php  endif ?>