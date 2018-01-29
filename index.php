<?PHP
	session_start();
	include_once "controller/c_cek_session.php";
	require_once 'vendor/autoload.php';
	require_once "db/koneksi.php";
	include_once "model/user/m_user.php";
	include_once "controller/c_login.php";
	include_once "model/karyawan/m_karyawan.php";
?>


<!DOCTYPE html>
<head>
<title>Login User Payroll PT. DAIM</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="assets/css/style.css" rel='stylesheet' type='text/css' />
<link href="assets/css/style-responsive.css" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="assets/css/font.css" type="text/css"/>
<link href="assets/css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<script src="assets/js/jquery-2.1.4.min.js"></script>
</head>
<body>
<div class="main-wthree">
	<div class="container">
		<div class="sin-w3-agile">
			<div class="w3layouts-main">
				<h2>Sign In Now</h2>
				<form action="" method="post">
					<div class="username">
						<span class="username">Username:</span>
						<input type="text" class="ggg name" name="username" placeholder="USERNAME" required>
						<div class="clearfix"></div>
					</div>
					
					<div class="password-agileits">
						<span class="username">Pasword:</span>
						<input type="password" class="ggg password" name="password" placeholder="PASSWORD" required>
						<div class="clearfix"></div>
					</div>
					
						<div class="clearfix"></div>
					<div class="login-w3">
						<input class="login" type="submit" value="Sign In" name="btn_login">
					</div>
					</form>

			</div>
		</div>
	</div>
</div>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="assets/js/scripts.js"></script>
<script src="assets/js/jquery.slimscroll.js"></script>
<script src="assets/js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="assets/js/jquery.scrollTo.js"></script>
<?php include_once "controller/c_notice.php"; ?>
</body>
</html>
