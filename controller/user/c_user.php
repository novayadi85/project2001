<?php

	/* ============================  ADD FUNCTION  ============================ */
	if(isset($_POST['submit_add'])){

		$kode_user=$_POST['kode_user'];
		$kode_karyawan=$_POST['kode_karyawan'];
		$nama_user=$_POST['nama_user'];
		$username=$_POST['username'];
		$password=$_POST['password'];
		$level=$_POST['level'];
		
		//Tambah Data Ke Database 
		$addAdmin=addUser($kode_user,$kode_karyawan,$nama_user,$username,$password,$level);

		if($addAdmin){
			$_SESSION['notice']="301";
		}else{
			$_SESSION['notice']="101";
		}

	    header("location:index.php?tag=user");
	    exit();
	}



	/* ============================  EDIT DATA FUNCTION  ============================ */
	elseif(isset($_POST['submit_edit'])){

		$kode_user=$_POST['kode_user'];
		$kode_karyawan=$_POST['kode_karyawan'];
		$nama_user=$_POST['nama_user'];
		$username=$_POST['username'];
		$password=$_POST['password'];
		$level=$_POST['level'];

		$change=updateUser($kode_user,$kode_karyawan,$nama_user,$username,$password,$level);
		if($change){
			$_SESSION['notice']="305";
		}else{
			$_SESSION['notice']="105";
		}

	    header("location:index.php?tag=user");
	    exit();
	}


	/* ============================  DELETE FUNCTION  ============================ */ 
	// elseif(@$_GET['aksi']=="delete"){

	// 	$id_admin=$_GET['id_admin'];
	// 	//Delete Foto Admin Terlebih Dahulu
	// 	deleteFoto($id_admin);
	// 	//Delete Data Admin Dari Database
	// 	$delete=deleteAdmin($id_admin);

	// 	if($delete){
	// 		$_SESSION['notice']="303";
	// 	}else{
	// 		$_SESSION['notice']="103";
	// 	}

	//     header("location:$baseurl");
	//     exit();

	// }

?>