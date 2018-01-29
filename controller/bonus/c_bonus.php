<?php
	
	/* ============================  ADD FUNCTION  ============================ */
	if(isset($_POST['submit_add'])){

			$kode_bonus=$_POST['kode_bonus'];
			$kode_karyawan=$_POST['kode_karyawan'];
			$periode=$_POST['periode'];
			$tahun=$_POST['tahun'];
			$pendapatan_bengkel=$_POST['pendapatan_bengkel'];
			$pendapatan_oli=$_POST['pendapatan_oli'];
			$jumlah_bonus=$_POST['jumlah_bonus'];
		
		//Tambah Data Ke Database 
		$addAdmin=addBonus($kode_bonus,$kode_karyawan,$periode,$tahun,$pendapatan_bengkel,$pendapatan_oli,$jumlah_bonus);

		if($addAdmin){
			$_SESSION['notice']="301";
		}else{
			$_SESSION['notice']="101";
		}

	    header("location:index.php?tag=bonus");
	    exit();
	}



	/* ============================  EDIT DATA FUNCTION  ============================ */
	if(isset($_POST['submit_edit'])){
			$kode_bonus=$_POST['kode_bonus'];
			$kode_karyawan = "";
			$periode=$_POST['periode'];
			$tahun=$_POST['tahun'];
			$pendapatan_bengkel=$_POST['pendapatan_bengkel'];
			$pendapatan_oli=$_POST['pendapatan_oli'];
			$jumlah_bonus=$_POST['jumlah_bonus'];

		$change=updateBonus($kode_bonus,$kode_karyawan,$periode, $tahun, $pendapatan_bengkel,$pendapatan_oli,$jumlah_bonus);
		if($change){
			$_SESSION['notice']="305";
		}else{
			$_SESSION['notice']="105";
		}

	    header("location:index.php?tag=bonus");
	    exit();
	}
	
	if(isset($_GET['aksi']) && $_GET['aksi'] == "delete"){
		$kode_bonus=$_GET['kode_bonus'];
		$delete = $mysqli->query("DELETE FROM tb_bonus WHERE kode_bonus = '$kode_bonus'");
		header("location:index.php?tag=bonus");
	    exit();
	}
	
	if(isset($_REQUEST['method'])){
		include_once "../model/bonus/m_bonus.php";
		if($_REQUEST['method'] == "get_hitung"){
			$list = editBonus($_POST["id"]);
			print json_encode(array("list" => $list));
		}
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