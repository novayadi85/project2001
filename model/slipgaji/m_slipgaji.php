<?php
	function listGaji(){
		global $mysqli;
		$list= $mysqli->query("SELECT * FROM tb_gaji");
		return $list;
	}

	function addGaji($kode_gaji,$kode_karyawan,$kode_bonus,$periode,$tanggal,$gaji_pokok,$presentase_bengkel,$bonus_bengkel,$presentase_oli,$bonus_oli,$bonus_full_absen,$jumlah_bonus,$thr,$potong_terlambat,$total_gaji){
		global $mysqli;
		$add= $mysqli->query("INSERT INTO tb_gaji VALUES('','$kode_karyawan','$kode_bonus','$periode,$tanggal','$gaji_pokok','$presentase_bengkel','$bonus_bengkel','$presentase_oli','$bonus_oli','$bonus_full_absen','$jumlah_bonus','$thr','$potong_terlambat','$total_gaji')")or die(mysqli_connect_error());
		return $add;
	}
	function editGaji($kode_gaji){
		global $mysqli;
		$edit=mysqli_fetch_array( $mysqli->query("SELECT * FROM tb_gaji WHERE kode_gaji='$kode_gaji'"));
		return $edit;
	}

	function updateGaji($kode_gaji,$kode_karyawan,$kode_bonus,$periode,$tanggal,$gaji_pokok,$presentase_bengkel,$bonus_bengkel,$presentase_oli,$bonus_oli,$bonus_full_absen,$jumlah_bonus,$thr,$potong_terlambat,$total_gaji){
		global $mysqli;
		$update= $mysqli->query("UPDATE tb_gaji SET kode_karyawan='$kode_karyawan',kode_bonus='$kode_bonus',periode='$periode',tanggal='$tanggal',gaji_pokok='$gaji_pokok',presentase_bengkel='$presentase_bengkel',bonus_bengkel='$bonus_bengkel',presentase_oli='$presentase_oli',bonus_oli='$bonus_oli',bonus_full_absen='$bonus_full_absen',jumlah_bonus='$jumlah_bonus',thr='$thr',potong_terlambat='$potong_terlambat',total_gaji='$total_gaji' WHERE kode_gaji='$kode_gaji'")or die(mysqli_connect_error());
		return $update;
	}
	
	// function deleteUser($kode_user){
	// 	$delete= $mysqli->query("DELETE FROM tb_user WHERE kode_user='$kode_user'")or die(mysqli_connect_error());
	// 	return $delete;
	// }

	// function deleteFoto($kode_user){
	// 	$foto=mysqli_fetch_array( $mysqli->query("SELECT * FROM tb_user WHERE kode_user='$kode_user'"));
	// 	$namaPhoto=$foto['photo'];
	// 	if(file_exists("assets/upload/user/$namaPhoto")){
	// 		@unlink("assets/upload/user/$namaPhoto");
	// 	}
	// }

?>