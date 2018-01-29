<?php
	function listAbsensi(){
		global $mysqli;
		$list= $mysqli->query("SELECT tb_absensi.*, tb_karyawan.nama_karyawan FROM tb_absensi INNER JOIN tb_karyawan ON tb_karyawan.kode_karyawan = tb_absensi.kode_karyawan");
		return $list;
	}
	
	function editAbsensi($id){
		global $mysqli;
		$edit = mysqli_fetch_array( $mysqli->query("SELECT a.*, k.* FROM tb_absensi a, tb_karyawan k WHERE a.id='$id'"));
		return $edit;
	}

	function updateAbsensi($id,$keterlambatan){
		global $mysqli;
		$update = $mysqli->query("UPDATE tb_absensi SET keterlambatan='$keterlambatan' WHERE id='$id'")or die(mysqli_connect_error());
		return $update;
	}
	function addAbsensi($karyawanname,$password,$level,$photo){
		$add= $mysqli->query("INSERT INTO tb_karyawan VALUES('','$karyawanname','$password','$level','$photo')")or die(mysqli_connect_error());
		return $add;
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
	// 	$edit=mysql_fetch_array( $mysqli->query("SELECT * FROM tb_karyawan WHERE id_karyawan='$id_karyawan'"));
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
	// 	$foto=mysql_fetch_array( $mysqli->query("SELECT * FROM tb_karyawan WHERE id_karyawan='$id_karyawan'"));
	// 	$namaPhoto=$foto['photo'];
	// 	if(file_exists("assets/upload/karyawan/$namaPhoto")){
	// 		@unlink("assets/upload/karyawan/$namaPhoto");
	// 	}
	// }

?>