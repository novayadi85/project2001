<?php

	/* ============================  ADD FUNCTION  ============================ */
	if(isset($_POST['submit_add'])){
		
			$kode_gaji=$_POST['kode_gaji'];
			$kode_karyawan=$_POST['kode_karyawan'];
			$kode_bonus=$_POST['kode_bonus'];
			$periode=$_POST['periode'];
			$tanggal=$_POST['tanggal'];
			$gaji_pokok=$_POST['gaji_pokok'];
			$presentase_bengkel=$_POST['presentase_bengkel'];
			$bonus_bengkel=$_POST['bonus_bengkel'];
			$presentase_oli=$_POST['presentase_oli'];
			$bonus_oli=$_POST['bonus_oli'];
			$bonus_full_absen=$_POST['bonus_full_absen'];
			$jumlah_bonus=$_POST['jumlah_bonus'];
			$thr=$_POST['thr'];
			$potong_terlambat=$_POST['potong_terlambat'];
			$total_gaji=$_POST['total_gaji'];
			$_POST['kode_gaji'] = "";
			unset($_POST['submit_add']);
			unset($_POST['kode_gaji']);
		//Tambah Data Ke Database 
		//$addAdmin=addGaji($kode_gaji,$kode_karyawan,$kode_bonus,$periode,$tanggal,$gaji_pokok,$presentase_bengkel,$bonus_bengkel,$presentase_oli,$bonus_oli,$bonus_full_absen,$jumlah_bonus,$thr,$potong_terlambat,$total_gaji);
		//echo "INSERT INTO tb_gaji VALUES('','$kode_karyawan','$kode_bonus','$periode,$tanggal','$gaji_pokok','$presentase_bengkel','$bonus_bengkel','$presentase_oli','$bonus_oli','$bonus_full_absen','$jumlah_bonus','$thr','$potong_terlambat','$total_gaji')";
		$addAdmin = $Connection->insert("tb_gaji" , $_POST );
		if($addAdmin){
			$_SESSION['notice']="301";
		}else{
			$_SESSION['notice']="101";
		}

	    header("location:index.php?tag=gaji&success=true&periode=$periode&tahun=$tahun");
	    exit();
	}



	/* ============================  EDIT DATA FUNCTION  ============================ */
	elseif(isset($_POST['submit_edit'])){

			$kode_gaji=$_POST['kode_gaji'];
			$kode_karyawan=$_POST['kode_karyawan'];
			$kode_bonus=$_POST['kode_bonus'];
			$periode=$_POST['periode'];
			$tahun=$_POST['tahun'];
			$tanggal=$_POST['tanggal'];
			$gaji_pokok=$_POST['gaji_pokok'];
			$presentase_bengkel=$_POST['presentase_bengkel'];
			$bonus_bengkel=$_POST['bonus_bengkel'];
			$presentase_oli=$_POST['presentase_oli'];
			$bonus_oli=$_POST['bonus_oli'];
			$bonus_full_absen=$_POST['bonus_full_absen'];
			$jumlah_bonus=$_POST['jumlah_bonus'];
			$thr=$_POST['thr'];
			$potong_terlambat=$_POST['potong_terlambat'];
			$total_gaji=$_POST['total_gaji'];

		$change=updateGaji($kode_gaji,$kode_karyawan,$kode_bonus,$periode,$tahun,$tanggal,$gaji_pokok,$presentase_bengkel,$bonus_bengkel,$presentase_oli,$bonus_oli,$bonus_full_absen,$jumlah_bonus,$thr,$potong_terlambat,$total_gaji);
		if($change){
			$_SESSION['notice']="305";
		}else{
			$_SESSION['notice']="105";
		}

	    header("location:index.php?tag=gaji&success=true&updated=true&periode=$periode&tahun=$tahun");
	    exit();
	}
	
	if(isset($_GET["ajax"])){
		
		$x=0;
		$periode = $_REQUEST["periode"];
		$year = $_REQUEST["year"];
		$lists = $mysqli->query("SELECT tb_gaji.*, tb_karyawan.nama_karyawan FROM tb_gaji INNER JOIN tb_karyawan ON tb_karyawan.kode_karyawan = tb_gaji.kode_karyawan WHERE periode=". $periode ." AND tahun=".$year );
		//echo "SELECT tb_gaji.*, tb_karyawan.nama_karyawan FROM tb_gaji INNER JOIN tb_karyawan ON tb_karyawan.kode_karyawan = tb_gaji.kode_karyawan WHERE periode=". $periode ." AND tahun=".$year ;
		$print = array();
		if($lists){
			while ($data = mysqli_fetch_assoc($lists)): 
			$dateObj   = DateTime::createFromFormat('!m', $data["periode"]);
			$monthName = $dateObj->format('F');
			$no = ($x + 1);
			$print[$x][] = $no;
			$print[$x][] = $data["nama_karyawan"];
			$print[$x][] = $monthName;
			$print[$x][] = date("Y/m/d",strtotime($data["tanggal"]));
			//$print[$x][] = $data["tahun"];
			$print[$x][] = number_format($data["gaji_pokok"],0,",",".");
			$print[$x][] = number_format($data["bonus_bengkel"],0,",",".");
			$print[$x][] = number_format($data["bonus_oli"],0,",",".");
			$print[$x][] = number_format($data["potong_terlambat"],0,",",".");
			$print[$x][] = number_format($data["total_gaji"],0,",",".");
			$print[$x][] = "<a class=\"btn btn-default\" href=\"index.php?tag=gaji&aksi=edit&kode_gaji=".$data["kode_gaji"]."\"><i class=\"fa fa-pencil\" title=\"Edit\"> </i></a>
			<a href=\"index.php?tag=gaji&aksi=delete&kode_gaji=".$data["kode_gaji"]."\"><i class=\"fa fa-trash\" title=\"Delete\"> </i></a>
			";	
			$x++;
			endwhile;
		}
		
		
		print json_encode(array("data" => $print));
		exit();
	}

	if(isset($_GET['aksi']) && $_GET['aksi'] == "delete"){
		$kode_gaji=$_GET['kode_gaji'];
		$delete = $mysqli->query("DELETE FROM tb_gaji WHERE kode_gaji = '$kode_gaji'");
		header("location:index.php?tag=gaji&success=true&delete=true");
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