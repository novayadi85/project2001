<?php

	/* ============================  EDIT DATA FUNCTION  ============================ */
	if(isset($_GET['method']) && $_GET['method'] =="print"){
		global $mysqli;
		$values = $_POST;
		$sql = "SELECT tb_gaji.* , tb_karyawan.nama_karyawan, tb_karyawan.jabatan  FROM `tb_gaji` INNER JOIN tb_karyawan ON tb_karyawan.kode_karyawan = tb_gaji.kode_karyawan WHERE tb_gaji.`kode_karyawan` = '".$values["kode_karyawan"]."' AND tb_gaji.periode = ".$values["periode"]." AND tb_gaji.tahun = ".$values["tahun"]."";
		//$list = $Connection->selectData("tb_gaji" , "*" , "WHERE `kode_karyawan` = ".$values["kode_karyawan"]." AND periode = " . $values["periode"] ." AND tahun = " . $values["tahun"]);
		
		$list = $mysqli->query($sql);
		if($list){
			$data = mysqli_fetch_assoc($list);
			ob_start();
				include_once "../slip.php";
				$html = ob_get_contents();
			ob_get_clean();
			$filePath = '../files/tmp_slip'.time().".html";
			@file_put_contents($filePath, $html);
			$path = $Constant->wkhtmltopdf();
			$exe = exec("$path $filePath ../files/$filePath.pdf");
			unlink($filePath);
			print json_encode(array("file" => $filePath . ".pdf"));
			exit();
		}
		else{
			print json_encode(array("error" => true));
		}
		
	}
?>