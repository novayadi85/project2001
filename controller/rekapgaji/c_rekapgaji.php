<?php

	/* ============================  EDIT DATA FUNCTION  ============================ */
	if(isset($_GET['method']) && $_GET['method'] =="print"){
		
		array_map('unlink', glob("../files/*"));
		
		$table = array();
		$periode = '0';
		$year = '0000';
		if(isset($_POST["periode"])){
			$periode = $_POST["periode"];
			//$periode = date("F",strtotime($periode));
			$dateObj   = DateTime::createFromFormat('!m', $periode);
			$periode = $dateObj->format('F');			
		}
		if(isset($_POST["year"])){
			$year = $_POST["year"];
		}
		if(isset($_POST["table"]))
		$table = $_POST["table"];
		$headers = array(
			"No.",
			"Nama",
			"Periode",
			"Tanggal",
			"Pokok",
			"B.Bengkel",
			"B.Oli",
			"Potong",
			"Total",
			""
		);
		$title = "LAPORAN REKAP GAJI KARYAWAN";
		ob_start();
			include_once "../print.php";
			$html = ob_get_contents();
		ob_get_clean();
		$filePath = '../files/tmp_'.time().".html";
		@file_put_contents($filePath, $html);
		$path = $Constant->wkhtmltopdf();
		$exe = exec("$path $filePath ../files/$filePath.pdf");
		print json_encode(array("file" => $filePath . ".pdf"));
		exit();
	}
?>