<?php
	function listBonus(){
		global $mysqli;
		$list= $mysqli->query("SELECT * FROM tb_bonus");
		return $list;
	}
	
	function addBonus($kode_bonus,$kode_karyawan,$periode,$tahun,$pendapatan_bengkel,$pendapatan_oli,$jumlah_bonus){
		global $mysqli;  
		$add= $mysqli->query("INSERT INTO tb_bonus VALUES('$kode_bonus','$kode_karyawan','$periode','$tahun','$pendapatan_bengkel','$pendapatan_oli','$jumlah_bonus')")or die(mysqli_connect_error());
		return $add;
	}
	
	function editBonus($kode_bonus){
		global $mysqli;
		$edit=mysqli_fetch_array( $mysqli->query("SELECT * FROM tb_bonus WHERE kode_bonus='$kode_bonus'"));
		return $edit;
	}
	

	function updateBonus($kode_bonus,$kode_karyawan,$periode, $tahun, $pendapatan_bengkel,$pendapatan_oli,$jumlah_bonus){
		global $mysqli;
		//echo "UPDATE tb_bonus SET kode_bonus='$kode_bonus', kode_karyawan='$kode_karyawan', periode='$periode', tahun='$tahun', pendapatan_bengkel='$pendapatan_bengkel', pendapatan_oli='$pendapatan_oli', jumlah_bonus='$jumlah_bonus' WHERE kode_bonus='$kode_bonus'";
		$update= $mysqli->query("UPDATE tb_bonus SET kode_bonus='$kode_bonus', kode_karyawan='$kode_karyawan', periode='$periode', tahun='$tahun', pendapatan_bengkel='$pendapatan_bengkel', pendapatan_oli='$pendapatan_oli', jumlah_bonus='$jumlah_bonus' WHERE kode_bonus='$kode_bonus'")or die(mysqli_connect_error());
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
?>