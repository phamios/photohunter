<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html lang="en">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Login</title>
<link rel="stylesheet" href="<?php echo base_url('back_src/login');?>/css/style.css">
<!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body> 
   <?php echo form_open_multipart('admincp/login',array('class'=>'login')); ?>
    <p>
		<label for="login">Đăng nhập:</label> 
		
		<input type="text" name="adminname" id="login" value="">
	</p>

	<p>
		<label for="password">Mật khẩu:</label>
		
		<input type="password" name="adminpass" id="password" value="">
	</p>

	<p class="login-submit">
		<button type="submit" name="submit_login" class="login-button">Login</button>
	</p>

	<!--     <p class="forgot-password"><a href="index.html">Forgot your password?</a></p> -->
  <?php echo form_close(); ?>

   
</body>
</html>
