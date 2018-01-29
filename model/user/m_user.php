<?php
	function listUser(){
		global $mysqli;
		$list= $mysqli->query("SELECT * FROM tb_user");
		return $list;
	}

	function addUser($kode_user,$kode_karyawan,$nama_user,$username,$password,$level){
		global $mysqli;
		$add= $mysqli->query("INSERT INTO tb_user VALUES('','$kode_karyawan','$nama_user','$username','$password','$level')")or die(mysqli_connect_error());
		return $add;
	}
	function editUser($kode_user){
		global $mysqli;
		$result = $mysqli->query("SELECT * FROM tb_user WHERE kode_user='$kode_user'");
		$edit = mysqli_fetch_array($result);
		return $edit;
	}

	function updateUser($kode_user,$kode_karyawan,$nama_user,$username,$password,$level){
		global $mysqli;
		$update= $mysqli->query("UPDATE tb_user SET kode_karyawan='$kode_karyawan', nama_user='$nama_user', username='$username', password='$password', level='$level' WHERE kode_user='$kode_user'")or die(mysqli_connect_error());
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
	function loginUser($username,$password){
		global $mysqli;
		$login = $mysqli->query("SELECT * FROM tb_user WHERE username='$username' AND password='$password'") or die (mysqli_connect_error());
		return $login;
	}
?>