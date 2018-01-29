<?php

	if(isset($_POST['btn_login'])){

		$username=$_POST['username'];
		$password=$_POST['password'];

		
		// Cek Login Ke Database
		$cek = loginUser($username, $password);
		$jml= mysqli_num_rows($cek);

		if($jml==1){
			$data = mysqli_fetch_array($cek);
			$_SESSION['logged_in']=true;
			$_SESSION['nama']=$data['nama_user'];
			$_SESSION['username']=$data['username'];
			$_SESSION['password']=$data['password'];
			$_SESSION['uid']=$data['kode_karyawan'];
			$_SESSION['level']=$data['level'];

			if($_SESSION['level']=="admin"){
				header("location:admin/index.php");
				exit();
			}elseif($_SESSION['level']=="karyawan"){
				header("location:karyawan/index.php");
				exit();
			}elseif($_SESSION['level']=="pemilik"){
				header("location:pemilik/index.php");
				exit();
			}

		}else{
			$_SESSION['notice']="104";
			header("location:index.php?aksi=asas");
			exit();
		}
		
		
	}
?>