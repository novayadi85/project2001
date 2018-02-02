<?PHP
	session_start();
	if(!isset($_SESSION['logged_in'])){
		header("location:../index.php");
		exit();
	}else{
		if($_SESSION['level']=="karyawan"){
			header("location:../karyawan/index.php");
			exit();
		}elseif($_SESSION['level']=="admin"){
			header("location:../admin/index.php");
			exit();
		}
	}
	if(isset($_GET['tag'])){
		$tag=$_GET['tag'];
	}else{
		$tag="beranda";
	}
	require_once '../vendor/autoload.php';
	require_once "../db/koneksi.php";
	include_once "../model/$tag/m_$tag.php";
	include_once "../controller/$tag/c_$tag.php";

?>


<!DOCTYPE HTML>
<html>
<head>
<title>Sistem Informasi Penggajian PT. DAIM</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Pooled Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="../assets/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="../assets/css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="../assets/css/morris.css" type="text/css"/>
<!-- Graph CSS -->
<link href="../assets/css/font-awesome.css" rel="stylesheet"> 
<!-- jQuery -->
<script src="../assets/js/jquery-2.1.4.min.js"></script>
<!-- //jQuery -->
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<!-- lined-icons -->
<link rel="stylesheet" href="../assets/css/icon-font.min.css" type='text/css' />
<!-- //lined-icons -->
<link rel="stylesheet" type="text/css" href="../assets/libs/datatables/DataTables-1.10.16/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="../assets/libs/datatables/DataTables-1.10.16/css/table.css"/>
<script type="text/javascript" src="../assets/libs/datatables/DataTables-1.10.16/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="../assets/libs/datatables/DataTables-1.10.16/js/dataTables.bootstrap.js"></script>

<link rel="stylesheet" type="text/css" href="../assets/libs/chosen/chosen.css" />
<script type="text/javascript" src="../assets/libs/chosen/chosen.jquery.js"></script>
<script src="../assets/js/app.js"></script>
</head> 
<body>
   <div class="page-container">
   <!--/content-inner-->
<div class="left-content">
	   <div class="mother-grid-inner">
             <!--header start here-->
				<div class="header-main">
				<div class="logo-w3-agile">
								<h1><a href="index.php">PT. DAIM</a></h1>
							</div>
							<div class="clearfix"> </div>				
						</div>
						<div class="profile_details w3l">		
								<ul>
									<li class="dropdown profile_details_drop">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
											<div class="profile_img">	
												<span class="prfil-img"><img src="../assets/images/user.png" alt=""> </span> 
												<div class="user-name">
													<p><?php  print ($_SESSION["nama"]);?></p>
													<span><?php print ($_SESSION["level"]);?></span>
												</div>
												<i class="fa fa-angle-down"></i>
												<i class="fa fa-angle-up"></i>
												<div class="clearfix"></div>	
											</div>	
										</a>
										<ul class="dropdown-menu drp-mnu">
											<li> <a href="../controller/c_logout.php"><i class="fa fa-sign-out"></i> Logout</a> </li>
										</ul>
									</li>
								</ul>
							</div>
							
				     <div class="clearfix"> </div>	
				</div>
<!--heder end here-->
		<ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Halaman Pemilik Perusahaan</a> <i class="fa fa-angle-right"></i></li>
				<span style="text-transform:capitalize;"><?=$tag;?></span>
            </ol>

<?PHP
include "page/".$tag.".php";

?>


<!--agileinfo-grap-->
<!--copy rights start here-->
<div class="copyrights">
	 <p>© 2017 Payroll PT. DAIM. All Rights Reserved | Design by  Hari Purnami </p>
</div>	
<!--COPY rights end here-->
</div>
</div>
  <!--//content-inner-->
			<!--/sidebar-menu-->
				<div class="sidebar-menu">
					<header class="logo1">
						<a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> 
					</header>
						<div style="border-top:1px ridge rgba(255, 255, 255, 0.15)"></div>
                           <div class="menu">
									<ul id="menu" >
										<li><a href="index.php"><i class="fa fa-home"></i> <span>Dashboard</span><div class="clearfix"></div></a></li>
										
										
										 <li id="menu-academico" ><a href="index.php?tag=karyawan"><i class="fa fa-user"></i><span>Data Karyawan</span><div class="clearfix"></div></a></li>
										 <li id="menu-academico" ><a href="index.php?tag=absensi"><i class="fa fa-user"></i><span>Data Absensi</span><div class="clearfix"></div></a></li>
									<li id="menu-academico" ><a href="index.php?tag=bonus"><i class="fa fa-asl-interpreting (alias)" aria-hidden="true"></i><span>Data Bonus</span><div class="clearfix"></div></a></li>
									 <li><a href="index.php?tag=rekapgaji"><i class="fa  fa-plus-square"></i>  <span>Laporan Rekap Gaji</span><div class="clearfix"></div></a></li>
									<li><a href="../controller/c_logout.php"><i class="fa fa-external-link"></i><span>Logout</span><div class="clearfix"></div></a>
									  
									</li>
								  </ul>
								</div>
							  </div>
							  <div class="clearfix"></div>		
							</div>
							<script>
							var toggle = true;
										
							$(".sidebar-icon").click(function() {                
							  if (toggle)
							  {
								$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
								$("#menu span").css({"position":"absolute"});
							  }
							  else
							  {
								$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
								setTimeout(function() {
								  $("#menu span").css({"position":"relative"});
								}, 400);
							  }
											
											toggle = !toggle;
										});
							</script>
<!--js -->
<script src="../assets/js/jquery.nicescroll.js"></script>
<script src="../assets/js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
   <script src="../assets/js/bootstrap.min.js"></script>
   <!-- /Bootstrap Core JavaScript -->	   
<!-- morris JavaScript -->	
<script src="../assets/js/raphael-min.js"></script>
<script src="../assets/js/morris.js"></script>
<script>

	//$(document).ready(function() {
		//BOX BUTTON SHOW AND CLOSE
	  // jQuery('.small-graph-box').hover(function() {
		// jQuery(this).find('.box-button').fadeIn('fast');
	  // }, function() {
		//  jQuery(this).find('.box-button').fadeOut('fast');
	   // });
	   // jQuery('.small-graph-box .box-close').click(function() {
		 // jQuery(this).closest('.small-graph-box').fadeOut(200);
		  // return false;
	    // }); 
	   
	    //CHARTS
	//    function gd(year, day, month) {
		//	return new Date(year, month - 1, day).getTime();
		// }
		
		// graphArea2 = Morris.Area({
		//	element: 'hero-area',
		//	padding: 10,
       // behaveLikeLine: true,
       // gridEnabled: false,
       // gridLineColor: '#dddddd',
       // axes: true,
       // resize: true,
       // smooth:true,
       // pointSize: 0,
       // lineWidth: 0,
       // fillOpacity:0.85,
		//	data: [
			//	{period: '2014 Q1', iphone: 2668, ipad: null, itouch: 2649},
			//	{period: '2014 Q2', iphone: 15780, ipad: 13799, itouch: 12051},
			//	{period: '2014 Q3', iphone: 12920, ipad: 10975, itouch: 9910},
			//	{period: '2014 Q4', iphone: 8770, ipad: 6600, itouch: 6695},
			//	{period: '2015 Q1', iphone: 10820, ipad: 10924, itouch: 12300},
			//	{period: '2015 Q2', iphone: 9680, ipad: 9010, itouch: 7891},
			//	{period: '2015 Q3', iphone: 4830, ipad: 3805, itouch: 1598},
			//	{period: '2015 Q4', iphone: 15083, ipad: 8977, itouch: 5185},
			//	{period: '2016 Q1', iphone: 10697, ipad: 4470, itouch: 2038},
			//	{period: '2016 Q2', iphone: 8442, ipad: 5723, itouch: 1801}
		//	],
		//	lineColors:['#ff4a43','#a2d200','#22beef'],
		//	xkey: 'period',
         //   redraw: true,
         //   ykeys: ['iphone', 'ipad', 'itouch'],
          //  labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
		//	pointSize: 2,
		//	hideHover: 'auto',
		//	resize: true
	//	});
		
	   
//	});
//	</script> 
</body>
</html>