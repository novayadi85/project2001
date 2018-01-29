<?php
	function listKaryawan(){
		global $mysqli;
		$list= $mysqli->query("SELECT * FROM tb_karyawan");
		return $list;
	}
	
	
	function addKaryawan($kode_absensi,$nama_karyawan,$jenis_kelamin,$tanggal_lahir,$alamat,$tgl_mulai_kerja,$jabatan,$no_telepon,$no_rekening){
		global $mysqli;
		//echo "INSERT INTO tb_karyawan VALUES('','$kode_absensi','$nama_karyawan','$jenis_kelamin','$tanggal_lahir','$alamat','$tgl_mulai_kerja','$jabatan','$no_telepon','$no_rekening')";
		$add= $mysqli->query("INSERT INTO tb_karyawan VALUES('','$kode_absensi','$nama_karyawan','$jenis_kelamin','$tanggal_lahir','$alamat','$tgl_mulai_kerja','$jabatan','$no_telepon','$no_rekening')")or die(mysqli_connect_error());
		return $add;
	}
	function editKaryawan($kode_karyawan){
		global $mysqli;
		$edit=mysqli_fetch_array( $mysqli->query("SELECT * FROM tb_karyawan WHERE kode_karyawan='$kode_karyawan'"));
		return $edit;
	}

	function updateKaryawan($kode_karyawan,$nama_karyawan,$jenis_kelamin,$tanggal_lahir,$alamat,$tgl_mulai_kerja,$jabatan,$no_telepon,$no_rekening,$kode_absensi){
		global $mysqli;
		print "UPDATE tb_karyawan SET kode_karyawan='$kode_karyawan', nama_karyawan='$nama_karyawan',kode_absensi='$kode_absensi' , jenis_kelamin='$jenis_kelamin', tanggal_lahir='$tanggal_lahir', alamat='$alamat', tgl_mulai_kerja='$tgl_mulai_kerja', jabatan='$jabatan', no_telepon='$no_telepon', no_rekening='$no_rekening' WHERE kode_karyawan='$kode_karyawan'";
		$update= $mysqli->query("UPDATE tb_karyawan SET kode_karyawan='$kode_karyawan', nama_karyawan='$nama_karyawan',kode_absensi='$kode_absensi' , jenis_kelamin='$jenis_kelamin', tanggal_lahir='$tanggal_lahir', alamat='$alamat', tgl_mulai_kerja='$tgl_mulai_kerja', jabatan='$jabatan', no_telepon='$no_telepon', no_rekening='$no_rekening' WHERE kode_karyawan='$kode_karyawan'")or die(mysqli_connect_error());
		return $update;
	}

	// function addKaryawan($karyawanname,$password,$level,$photo){
	// 	$add= $mysqli->query("INSERT INTO tb_karyawan VALUES('','$karyawanname','$password','$level','$photo')")or die(mysqli_connect_error());
	// 	return $add;
	// }
	// function editKaryawanLevel($id_karyawan,$level){
	// 	$change= $mysqli->query("UPDATE tb_karyawan SET level='$level' WHERE id_karyawan='$id_karyawan'")or die(mysqli_connect_error());
	// 	return $change;
	// }
	// function editKaryawan($id_karyawan){
	// 	$edit=mysqli_fetch_array( $mysqli->query("SELECT * FROM tb_karyawan WHERE id_karyawan='$id_karyawan'"));
	// 	return $edit;
	// }

	// function updateKaryawan($id_karyawan,$karyawanname,$encript,$level,$photo){
	// 	$update= $mysqli->query("UPDATE tb_karyawan SET karyawanname='$karyawanname', password='$encript', level='$level' $photo WHERE id_karyawan='$id_karyawan'")or die(mysqli_connect_error());
	// 	return $update;
	// }
	
	// function deleteKaryawan($id_karyawan){
	// 	$delete= $mysqli->query("DELETE FROM tb_karyawan WHERE id_karyawan='$id_karyawan'")or die(mysqli_connect_error());
	// 	return $delete;
	// }

	// function deleteFoto($id_karyawan){
	// 	$foto=mysqli_fetch_array( $mysqli->query("SELECT * FROM tb_karyawan WHERE id_karyawan='$id_karyawan'"));
	// 	$namaPhoto=$foto['photo'];
	// 	if(file_exists("assets/upload/karyawan/$namaPhoto")){
	// 		@unlink("assets/upload/karyawan/$namaPhoto");
	// 	}
	// }
	function loginKaryawan($karyawanname,$password){
		global $mysqli;
		$login= $mysqli->query("SELECT * FROM tb_karyawan WHERE karyawanname='$karyawanname' AND password='$password'") or die (mysqli_connect_error());
		return $login;
	}
?>