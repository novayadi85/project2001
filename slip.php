<?php 
if(isset($data["periode"])){
	$periode = $data["periode"];
	$dateObj   = DateTime::createFromFormat('!m', $periode);
	$data["periode"] = $dateObj->format('F');			
}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<link href="../assets/css/slip.css" rel='stylesheet' type='text/css' />
	</head>
	<body>
		<div class="container">
			<div class="text-center">
				<h3>PT. Denpasar Agung Indah Motor</h3>
				<h1>SLIP GAJI</h1>
			</div>
			<hr>
			<div class="pull-right">
				<div class="text-right">
				<p><label class="label">Tanggal </label><label class="value"><?=$data["tanggal"];?></label></p>
				<label class="label">Periode </label><label class="value"><?=$data["periode"];?></label>
				
				</div>	
			</div>	
			<div class="clearfix"></div>
			<div class="pull-left">
				<div class="text-left">
					<p><label class="label">Nama </label><label class="value"><?=$data["nama_karyawan"];?></label><p>
					<label class="label">Jabatan </label><label class="value"><?=$data["jabatan"];?></label>
				
				</div>	
			</div>	
			<div class="clearfix"></div>
			<br></br>
			
			<div class="pull-left">
				<label class="label">GAJI POKOK </label>
			</div>
			<div class="pull-right">
				<label class="value"><?=$data["gaji_pokok"];?></label>
			</div>
			<div class="clearfix"></div>
			
			<div class="pull-left">
				<label class="label">BONUS BENGKEL </label>
			</div>
			<div class="pull-right">
				<label class="value"><?=$data["bonus_bengkel"];?></label>
			</div>
			<div class="clearfix"></div>
			
			<div class="pull-left">
				<label class="label">BONUS OLI </label>
			</div>
			<div class="pull-right">
				<label class="value"><?=$data["bonus_oli"];?></label>
			</div>
			<div class="clearfix"></div>
			
			<div class="pull-left">
				<label class="label">BONUS FULL ABSEN </label>
			</div>
			<div class="pull-right">
				<label class="value"><?=$data["bonus_full_absen"];?></label>
			</div>
			<div class="clearfix"></div>
			
			<div class="pull-left">
				<label class="label">THR </label>
			</div>
			<div class="pull-right">
				<label class="value"><?=$data["thr"];?></label>
			</div>
			<div class="clearfix"></div>
			
			<div class="pull-left">&nbsp;</div>
			<div class="pull-right"><br>
				<label class="label">JUMLAH GAJI KOTOR </label>
				<label class="value"><?=($data["gaji_pokok"] + $data["bonus_bengkel"] + $data["bonus_oli"] +  $data["bonus_full_absen"] + $data["thr"]);?></label>
			</div>
			<div class="clearfix"></div>
			
			<div class="pull-left">
				<label class="label">Potongan </label>
			</div>
			<div class="pull-right">
				<label class="value">---------------</label>
			</div>
			<div class="clearfix"></div>
			
			<div class="pull-left">
				<label class="label">Potongan Keterlambatan </label>
			</div>
			<div class="pull-right">
				<label class="value"><?=$data["potong_terlambat"];?></label>
			</div>
			<div class="clearfix"></div>
			
			
			<div class="pull-right"><br>
				<label class="label">JUMLAH GAJI BERSIH </label>
				<label class="value"><?="Rp. ". number_format($data["total_gaji"],2);?></label>
			</div>
			<div class="clearfix"></div>
			
			</div>
		</div>
	</body>
</html>