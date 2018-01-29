<?php
	error_reporting(0);
	/* ============================  EDIT DATA FUNCTION  ============================ */
	if(isset($_POST['submit_edit'])){

			$kode_absensi=$_POST['kode_absensi'];
			$id=$_POST['id'];
			$keterlambatan=$_POST['keterlambatan'];

		$change = updateAbsensi($id,$keterlambatan);
		if($change){
			$_SESSION['notice']="305";
		}else{
			$_SESSION['notice']="105";
		}

	    header("location:index.php?tag=absensi");
	    exit();
	}
	
	if(isset($_GET['method']) && $_GET['method'] =="getData"){
		
		$periode = $_REQUEST["periode"];
		$year = $_REQUEST["tahun"];
		$kode_karyawan = $_REQUEST["kode"];
		$listAbsensi = $mysqli->query("SELECT tb_absensi.*, tb_karyawan.nama_karyawan,tb_karyawan.kode_absensi FROM tb_absensi INNER JOIN tb_karyawan ON tb_karyawan.kode_absensi = tb_absensi.kode_absensi WHERE periode=". $periode ." AND tahun=".$year ." AND tb_karyawan.kode_karyawan = '".$kode_karyawan."' ");
		//echo "SELECT tb_absensi.*, tb_karyawan.nama_karyawan,tb_karyawan.kode_absensi FROM tb_absensi INNER JOIN tb_karyawan ON tb_karyawan.kode_absensi = tb_absensi.kode_absensi WHERE periode=". $periode ." AND tahun=".$year ." AND tb_karyawan.kode_karyawan = '".$kode_karyawan."' ";
		if($listAbsensi->num_rows > 0){
			echo json_encode(array("data" => mysqli_fetch_assoc($listAbsensi)));
		}
		else{
			echo json_encode(array("data" => ""));
		}
		exit();
	}
	
	if(isset($_GET['method']) && $_GET['method'] =="print"){
		$table = $_POST["table"];
		$headers = array(
			"No.",
			"Nama",
			"Periode",
			"Tahun",
			"Absensi",
			"Telat",
			"Departemen"
		);
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
	
	if(isset($_POST['importdata'])){
		
		$employes = $mysqli->query("SELECT * FROM tb_karyawan");
		$employesData =  array();
		
		if($employes->num_rows > 0){
			while ($row = mysqli_fetch_assoc($employes)){
				if($row["kode_absensi"] != ""){
					$employesData[$row["kode_absensi"]] =  $row["kode_karyawan"];
				}
			}
		}
		
		
		
		/**
		`kode_absensi`, 
		`kode_karyawan`, 
		`periode`,
		`tahun`, 
		`jumlah_absensi`, 
		`keterlambatan`, 
		`tanggal`, 
		`jam_kerja`,
		`jam_masuk`, 
		`jam_pulang`, 
		`departemen`, 
		`scan_masuk`,
		`scan_pulang
		**/
		
		$schema = $Connection->columns("tb_absensi");
		if(sizeof($_FILES) && is_array($_FILES) && !$_FILES['file_absensi']["error"]){
			$inputFileName = $_FILES['file_absensi']['tmp_name'];
			$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
			$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
			foreach($sheetData as $key => $data){
				if($key == 2){
					$header = $data;
				}
				
				if(($data["A"] == "Shift" || $data["B"] == "" || $data["B"] == "No. ID"))
					continue;
				
				$item = $data["B"];
				
				$datetime1 = new DateTime($data["F"]);
				$datetime2 = new DateTime($data["G"]);
				$interval = $datetime1->diff($datetime2);
				$std = $interval->format('%h:%I');

				$importData[$item]["B"] = $data["B"]; 
				$importData[$item]["C"] = $data["C"]; 
				$importData[$item]["D"] = $data["D"]; 
				$importData[$item]["L"] = $data["L"]; 
				$importData[$item]["E"] = $data["E"]; 
				$importData[$item]["F"] = $data["F"]; 
				$importData[$item]["G"] = $data["G"]; 
				$importData[$item]["H"] = $data["H"]; 
				$importData[$item]["I"] = $data["I"]; 
				$importData[$item]["O"] = $std; 
				$std = strtotime($std);
				$importData[$item]["P"] = $std / 2; 
				
				$A = strtotime($data["F"]) - 900;
				$fullAbsenIF = date("H:i:s",$A);
				
				$IzinIF = strtotime($data["G"]) - 3600;
				$IzinIF = date("H:i:s",$IzinIF);
				$sheetData[$key]["P"] = $IzinIF; 
				//Jika terlambat kerja
				if(!empty($data["J"])){
					$data["J"] = 1;
				}
				
				if(!isset($importData[$item]["full_absen"])){
					$importData[$item]["full_absen"] = 0;
				}
				
				if(!isset($importData[$item]["J"])){
					$importData[$item]["J"] = $data["J"];
				}
				else{
					$importData[$item]["J"] += $data["J"];
				}
				
				if($data["H"] != "" && $data["I"] != "" && strtotime($data["H"]) <= strtotime($fullAbsenIF) && strtotime($data["I"]) >= strtotime($data["G"])){
					$importData[$item]["full_absen"] += 1;
				}
				
				
				
				//Jika terlambat kerja
				
				
				if($data["M"] != "" &&  strtotime($data["M"]) <= ($std / 2) &&  strtotime($data["M"]) < $std && strtotime($data["M"]) > 0 ) {
					$data["M"] = 0.5;
				}
				else if($data["M"] != "" && strtotime($data["M"]) > ($std / 2) &&  strtotime($data["M"]) < $std  && strtotime($data["M"]) > 0 ) {
					$data["M"] = 0.5;
					if(strtotime($data["I"]) >= strtotime($IzinIF)){
						$data["M"] = 1;
					}
				}
				else if($data["M"] != "" && strtotime($data["M"]) > ($std / 2) &&  strtotime($data["M"]) > $std  && strtotime($data["M"]) > 0 ) {
					$data["M"] = 1;
				}
				else{
					$data["M"] = 0;
				}
				
				$sheetData[$key]["P"] = $data["M"];
				
				if(!isset($importData[$item]["M"])){
					$importData[$item]["M"] = $data["M"]; 
				}
				else{
					$importData[$item]["M"] += $data["M"]; 
				}
			}
			 
			$year = "20";
			if(is_array($importData)){
				foreach($importData as $data){
					if(is_array($data)){
						if(isset($employesData[$data["B"]])){
							$periode = explode("-",$data["D"]);   
							$values = array();
							$values["kode_karyawan"] = $employesData[$data["B"]];
							$values["kode_absensi"] = $data["B"];
							$values["periode"] = trim($periode["0"]);
							$values["tahun"]  = $year . $periode["2"]; 
							$values["jumlah_absensi"]  = $data["M"];
							$values["keterlambatan"]  = $data["J"];
							$values["tanggal"]  = $data["D"];
							$values["jam_kerja"] = $data["O"];
							$values["jam_masuk"]  = $data["F"];
							$values["jam_pulang"]  = $data["G"];
							$values["departemen"]  = $data["L"];
							$values["scan_masuk"] = $data["H"];
							$values["scan_pulang"]  = $data["I"];
							$values["full_absen"]  = 0;
							if($data["full_absen"] > 0 && $data["full_absen"] >= $data["M"]){
								$values["full_absen"] =  $data["full_absen"];
							}

							$values["periode"] = (int) $values["periode"];	
							
							$list = $mysqli->query("SELECT * FROM tb_absensi WHERE `kode_karyawan` = '".trim($values["kode_karyawan"]) ."' AND `periode` = " . trim($values["periode"]) ." AND `tahun`=".trim($values["tahun"]));
							if($list->num_rows <= 0){
								$Connection->insert("tb_absensi" , $values );
								
							}
							else{
								$mysqli->query("DELETE FROM tb_absensi WHERE `kode_karyawan` = '".trim($values["kode_karyawan"]) ."' AND `periode` = " . trim($values["periode"]) ." AND `tahun`=".trim($values["tahun"]));
								$Connection->insert("tb_absensi" , $values );
							}
							
							
							/* $valuesX = array(
								"kode_absensi" => $values["kode_absensi"],
								"nama_karyawan" =>  $data["C"],
								"jabatan" => $data["L"]
							);
							$Connection->insert("tb_karyawan" , $valuesX ); */
							
							
						}
					}	
				}
				
			}
		}
		else{
			$_SESSION["flashmessage"] = "File tidak valid";
		}
	
		header("location:index.php?tag=absensi&success=true");
		exit();
	}
	

	if(isset($_GET["ajax"])){
		$fields = array(
			"kode_absensi" => "Kode",
			"nama_karyawan" => "Nama",
			"periode" => "Periode",
			"tahun" => "tahun",
			"jumlah_absensi" => "absensi",
			"keterlambatan" => "Telat",
			"departemen" => "departemen",
		);
		$x=0;
		//print_r($_REQUEST);
		$periode = $_REQUEST["periode"];
		$year = $_REQUEST["year"];
		//$listAbsensi = $mysqli->query("SELECT * FROM tb_absensi WHERE periode=". $periode ." AND tahun=".$year );
		$listAbsensi = $mysqli->query("SELECT tb_absensi.*, tb_karyawan.nama_karyawan,tb_karyawan.kode_absensi FROM tb_absensi INNER JOIN tb_karyawan ON tb_karyawan.kode_absensi = tb_absensi.kode_absensi WHERE periode=". $periode ." AND tahun=".$year );
		if(isset($_GET["level"])){
			if($_GET["level"] == "employee"){
				$listAbsensi = $mysqli->query("SELECT tb_absensi.*, tb_karyawan.nama_karyawan,tb_karyawan.kode_absensi FROM tb_absensi INNER JOIN tb_karyawan ON tb_karyawan.kode_absensi = tb_absensi.kode_absensi WHERE tb_absensi.kode_karyawan = '".$_GET["uid"]."' AND periode=". $periode ." AND tahun=".$year );
			}
			 
		}

		$print = array();
		if($listAbsensi){
			while ($data = mysqli_fetch_assoc($listAbsensi)): 
				//$print[] = "<tr>";
					/* if(is_array($data)):
						foreach($data as $k => $td):
							if(in_array($k,array_keys($fields))){
								$print[$x][] = "$td";
							}
						endforeach;
					endif; */
					$dateObj   = DateTime::createFromFormat('!m', $data["periode"]);
					$monthName = $dateObj->format('F'); // March
					$print[$x][] = $data["kode_absensi"];
					$print[$x][] = $data["nama_karyawan"];
					$print[$x][] = $monthName;
					$print[$x][] = $data["tahun"];
					$print[$x][] = $data["jumlah_absensi"];
					$print[$x][] = $data["keterlambatan"];
					$print[$x][] = $data["departemen"];
					
					
					if(!isset($_GET["level"])){
						$print[$x][] = "<a class=\"btn btn-default\" href=\"index.php?tag=absensi&aksi=edit&kode_absensi=".$data["id"]."\"><i class=\"fa fa-pencil\" title=\"Edit\"> </i></a>";
					}
				
				//$print[] = "</tr>";
				$x++;
			endwhile;
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