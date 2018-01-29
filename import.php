<?php
require_once __DIR__ . '/vendor/autoload.php';
/* $demo = new \SqlFire\SayHello();
echo $demo->world(); */
$inputFileName = "files/PERIODE FEBRUARI 2017.xls";
echo 'Loading file ',pathinfo($inputFileName,PATHINFO_BASENAME),' using IOFactory to identify the format<br />';
$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);


echo '<hr />';

/* Array
(
    [A] => 
    [B] => No. ID
    [C] => Nama
    [D] => Tanggal
    [E] => Jam Kerja
    [F] => Jam Masuk
    [G] => Jam Pulang
    [H] => Scan Masuk
    [I] => Scan Pulang
    [J] => Terlambat
    [K] => Plg. Cepat
    [L] => Departemen
    [M] => Jml Kehadiran
    [N] => 
) */

$importData = array();
$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
if(sizeof($sheetData)){
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
		$importData[$item]["L"] = $data["L"]; 
		$importData[$item]["E"] = $data["E"]; 
		$importData[$item]["F"] = $data["F"]; 
		$importData[$item]["G"] = $data["G"]; 
		$importData[$item]["O"] = $std; 
		
		//Jika terlambat kerja
		if(!empty($data["J"])){
			$data["J"] = 1;
		}
		
		if(!isset($importData[$item]["J"])){
			$importData[$item]["J"] = $data["J"];
		}
		else{
			$importData[$item]["J"] += $data["J"];
		}
		
		//Jika terlambat kerja
		if($data["M"] < $std){
			$data["M"] = 0;
		}
		else {
			$data["M"] = 1;
		}
		
		if(!isset($importData[$item]["M"])){
			$importData[$item]["M"] = $data["M"]; 
		}
		else{
			$importData[$item]["M"] += $data["M"]; 
		}
		
		
		 
		
		
	}
}

print "<pre>";
print_r($importData);
print "</pre>"; 

