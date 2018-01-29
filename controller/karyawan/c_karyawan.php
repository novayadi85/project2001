<?php

	/* ============================  ADD FUNCTION  ============================ */
	if(isset($_POST['submit_add'])){

			$kode_absensi=$_POST['kode_absensi'];
			$nama_karyawan=$_POST['nama_karyawan'];
			$jenis_kelamin=$_POST['jenis_kelamin'];
			$tanggal_lahir=$_POST['tanggal_lahir'];
			$alamat=$_POST['alamat'];
			$tgl_mulai_kerja=$_POST['tgl_mulai_kerja'];
			$jabatan=$_POST['jabatan'];
			$no_telepon=$_POST['no_telepon'];
			$no_rekening=$_POST['no_rekening'];
		
		$addAdmin=addKaryawan($kode_absensi,$nama_karyawan,$jenis_kelamin,$tanggal_lahir,$alamat,$tgl_mulai_kerja,$jabatan,$no_telepon,$no_rekening);

		if($addAdmin){
			$_SESSION['notice']="301";
		}else{
			$_SESSION['notice']="101";
		}

	    header("location:index.php?tag=karyawan&success=true");
	    exit();
	}



	/* ============================  EDIT DATA FUNCTION  ============================ */
	elseif(isset($_POST['submit_edit'])){
			
			$kode_karyawan=$_POST['kode_karyawan'];
			$kode_absensi=$_POST['kode_absensi'];
			$nama_karyawan=$_POST['nama_karyawan'];
			$jenis_kelamin=$_POST['jenis_kelamin'];
			$tanggal_lahir=$_POST['tanggal_lahir'];
			$alamat=$_POST['alamat'];
			$tgl_mulai_kerja=$_POST['tgl_mulai_kerja'];
			$jabatan=$_POST['jabatan'];
			$no_telepon=$_POST['no_telepon'];
			$no_rekening=$_POST['no_rekening'];

		$change=updateKaryawan($kode_karyawan,$nama_karyawan,$jenis_kelamin,$tanggal_lahir,$alamat,$tgl_mulai_kerja,$jabatan,$no_telepon,$no_rekening,$kode_absensi);
		
		if($change){
			$_SESSION['notice']="305";
		}else{
			$_SESSION['notice']="105";
		}

	    header("location:index.php?tag=karyawan&success=true");
	    exit();
	}
	
	if(isset($_GET["ajax"])){
		$listKaryawan = listKaryawan();
		$x=0;
		$print = array();
		if($listKaryawan){
			while ($data=mysqli_fetch_assoc($listKaryawan)) {
				
				$no = ($x + 1);
				$print[$x][] = $no;
				$print[$x][] = $data["kode_karyawan"];
				$print[$x][] = $data["nama_karyawan"];
				$print[$x][] = $data["jenis_kelamin"];
				$print[$x][] = $data["tgl_mulai_kerja"];
				$print[$x][] = $data["jabatan"];
				$print[$x][] = $data["no_rekening"];
				$print[$x][] = $data["no_telepon"];
				if(!isset($_GET["level"])){
					$print[$x][] = "<a class=\"btn btn-default\" href=\"index.php?tag=karyawan&aksi=edit&kode_karyawan=".$data["kode_karyawan"]."\"><i class=\"fa fa-pencil\" title=\"Edit\"> </i></a>";
				}
				$x++;
			}
		}
		print json_encode(array("data" => $print));
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