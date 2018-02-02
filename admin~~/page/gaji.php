<!-- tables -->
<link rel="stylesheet" type="text/css" href="../assets/libs/chosen/chosen.css" />
<script type="text/javascript" src="../assets/libs/chosen/chosen.jquery.js"></script>
<link rel="stylesheet" type="text/css" href="../assets/css/datepicker.css" />
<script type="text/javascript" src="../assets/js/bootstrap-datepicker.js"></script>
<?php
	$tahun = "";
	$periode = "";
	if(@$_GET['aksi']=="edit"){
		$kode_gaji=$_GET['kode_gaji'];
		$datau=editGaji($kode_gaji);
		// $datau=mysqli_fetch_array($editUser);
			$kode_gaji=$datau['kode_gaji'];
			$kode_karyawan=$datau['kode_karyawan'];
			$kode_bonus=$datau['kode_bonus'];
			$periode=$datau['periode'];
			$tahun=$datau['tahun'];
			$tanggal=$datau['tanggal'];
			$gaji_pokok=$datau['gaji_pokok'];
			$presentase_bengkel=$datau['presentase_bengkel'];
			$bonus_bengkel=$datau['bonus_bengkel'];
			$presentase_oli=$datau['presentase_oli'];
			$bonus_oli=$datau['bonus_oli'];
			$bonus_full_absen=$datau['bonus_full_absen'];
			$jumlah_bonus=$datau['jumlah_bonus'];
			$thr=$datau['thr'];
			$potong_terlambat=$datau['potong_terlambat'];
			$total_gaji=$datau['total_gaji'];
		// }	
		
	}
	
?>
<script type="text/javascript">
    $(document).ready(function() {
		var bonus;
		var absensi;
		
		function num(s){
			var num = parseFloat(s) || 0;
			return num;
		}
		
		
		var table = $('#table1').dataTable({
			ajax: {
				url:  adminUrl + '/index.php?tag=gaji&ajax=true',
				type: 'POST',
				dataType: 'json',
				data: function(d){
				  d.cmd = "refresh",
				  d.periode = $(".periode").val(),
				  d.year  =  $(".tahun").val()
				}
			}
		});
		$('.chosen').chosen();
		$('.datepicker').datepicker({
			autoclose:true,
			format:"yyyy-mm-dd"
		});
		$("select[name='kode_bonus']").change(function(){
			var id = $(this).val();
			$.ajax ({
				url:  adminUrl + '/index.php?tag=bonus&method=get_hitung',
				type: 'POST',
				dataType: 'json',
				data: {"id": id},
				success: function(xhr){
					bonus = xhr.list;
				}
			});
		});
		$('.calculate').change(function(){
			if(bonus == "" || typeof bonus == 'undefined'){
				swal("Sorry!", "Tentukan Jenis Bonus terlebih dahulu...!", "error");
				$(this).val('');
				return false;
			}
			
			if(absensi == "" || typeof absensi == 'undefined'){
				//alert("Tentukan data absensi terlebih dahulu...");
				swal("Sorry!", "Tentukan data absensi terlebih dahulu...!", "error");
				$(this).val('');
				return false;
			}
			
			
			var pokok = $("input[name=gaji_pokok]").val();
			var presentase_bengkel = $("input[name=presentase_bengkel]").val();
			var presentase_oli = $("input[name=presentase_oli]").val();
			var bonus_full_absen = $("input[name=bonus_full_absen]").val();
			
			var thr = $("input[name=thr]").val();
			var potong_terlambat = $("input[name=potong_terlambat]").val();
			
			var oli = num(bonus.pendapatan_oli) * num(presentase_oli)/100;
			var bengkel = num(bonus.pendapatan_bengkel) * num(presentase_bengkel)/100;

			var jumlah_bonus = oli + bengkel;
			$("input[name=bonus_bengkel]").val(bengkel);
			$("input[name=bonus_oli]").val(oli);
			$("input[name=jumlah_bonus]").val(jumlah_bonus);
			$("input#bonus_oli").val(oli);
			$("input#bonus_bengkel").val(bengkel);
			var total = 0;
			total = (num(pokok) + num(bengkel) +  num(oli) + num(bonus_full_absen)  + num(thr) - num(potong_terlambat));
			if(total < 0){
				total = 0;
			}
			$("input[name=total_gaji]").val(total);
			
			
			
			
		});
		$('.date-range-filter').on('click', function(e){
			e.preventDefault();
			table.api().ajax.reload();
		});
		
		$("select[name='kode_karyawan'] , select[name='periode'], select[name='tahun']").change(function(){ 
			var kode = $("select[name='kode_karyawan']").val();
			var periode = $("select[name='periode']").val();
			var tahun = $("select[name='tahun']").val();
			$.ajax ({
				url:  adminUrl + '/index.php?tag=absensi&method=getData',
				type: 'POST',
				dataType: 'json',
				data: {"kode": kode ,periode:periode,tahun:tahun },
				success: function(xhr){
					absensi = xhr.data;
					if(absensi.keterlambatan){
						$("input[name='potong_terlambat']").val(num(absensi.keterlambatan) * 21000);
					}
					if(absensi.full_absen){
						$("input[name='bonus_full_absen']").val(num(absensi.full_absen) * 10000);
					}
				}
			});
		});
		
		<?php 
		if(@$_GET['aksi']=="edit"){
		?>
		$("select[name='kode_bonus']").trigger("change");
		$("select[name='kode_karyawan']").trigger("change");
		<?php 
		}
		?>
		
    });
</script>
<!-- //tables -->
<!--four-grids here-->
<div class="agileinfo-grap">
<div class="agileits-box">
<?php if(@$_GET['success']=="true"){?>
<div class="alert alert-success" id="success-alert" style="display: none; opacity: 500;">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>Success! </strong>
</div>
<?php 
$periode = $_GET["periode"];
$tahun = $_GET["tahun"];

} ?>
<header class="agileits-box-header clearfix">
  <div class="grid-form1">
  	       <h3>Data Gaji</h3>
  	         <div class="tab-content">
						<div class="tab-pane active" id="horizontal-form">
							<form class="form-horizontal" method="post" action="">
								<input type="hidden" name="bonus_bengkel" value="<?php echo @$bonus_bengkel;?>">
								<input type="hidden" name="bonus_oli" value="<?php echo @$bonus_bengkel;?>">
                            	<div class="form-group" style="display:none">
									<label for="focusedinput" class="col-sm-2 control-label">Kode Gaji</label>
									<div class="col-sm-8">
										<input type="hidden" class="form-control1" id="focusedinput" placeholder="Kode Gaji" name="kode_gaji" value="<?php echo @$kode_gaji; ?>" <?php if(@$_GET['aksi']=="edit"){ echo "readonly"; } ?>>
									</div>
								</div>
                                <div class="form-group">
									<label for="selector1" class="col-sm-2 control-label">Karyawan</label>
									<div class="col-sm-8">
										<select name="kode_karyawan" id="selector1" class="form-control chosen" placeholder="Pilih Karyawan">
										<option></option>
                                       	<?php
											include_once "../model/karyawan/m_karyawan.php";
                                       		$listKaryawan=listKaryawan();
											while ($datak=mysqli_fetch_array($listKaryawan)){
												if(@$_GET['aksi']=="edit"){

													if($kode_karyawan==$datak['kode_karyawan']){
														echo "<option selected value='".$datak['kode_karyawan']."'>".$datak['nama_karyawan']."</option>";
													}else{
														echo "<option value=".$datak['kode_karyawan'].">".$datak['nama_karyawan']."</option>";
													}
												}else{
													echo "<option value=".$datak['kode_karyawan'].">".$datak['nama_karyawan']."</option>";
												}
											}
                                       	?>
										</select>
									</div>
								</div>
                                <div class="form-group">
									<label for="selector1" class="col-sm-2 control-label">Kode Bonus</label>
									<div class="col-sm-8"><select placeholder="Pilih Bonus" name="kode_bonus" id="selector1" class="form-control chosen">
										<option></option>
                                        <?php
											include_once "../model/bonus/m_bonus.php";
                                       		$listBonus=listBonus();
											$bonus_options = array();
											while ($datab=mysqli_fetch_assoc($listBonus)){
												$bonus_options[$datab['kode_bonus']]  = $datab['kode_bonus']." - ".$datab['periode']." - ".$datab['tahun'];
												
												
											}
											
											echo $Helper->dropdown($bonus_options , $kode_bonus);
                                       	?>
									</select></div>
								</div>
                                <div class="form-group">
	                                <label for="selector1" class="col-sm-2 control-label ">Periode</label>
									<div class="col-sm-8"><select name="periode" id="selector1" class="form-control chosen" style="width:300px">
										<option></option>
										 <?php echo $Helper->months($periode);?>
									</select></div>
								</div>
								<div class="form-group">
                                        <label for="selector1" class="col-sm-2 control-label">Tahun</label>
                                        <div class="col-sm-8">
											<select name="tahun" id="selector1" class="chosen form-control1" style="max-width:300px;">
												<?php echo $Helper->years($tahun);?>
											</select>
										</div>
                                    </div>
                               	<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Tanggal</label>
									<div class="col-sm-8">
										<input type="text" class="form-control datepicker" id="focusedinput" placeholder="Tanggal" name="tanggal" value="<?php echo @$tanggal; ?>">
									</div>
								</div>
                                    <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Gaji Pokok</label>
									<div class="col-sm-8">
										<input type="text" class="form-control calculate" id="focusedinput" placeholder="Gaji Pokok" name="gaji_pokok" value="<?php echo @$gaji_pokok; ?>">
									</div>
                                    </div>
									<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Presentase Bengkel</label>
										<div class="col-sm-8">
											<input type="text" class="form-control calculate" id="focusedinput" placeholder="Presentase Bengkel" name="presentase_bengkel" value="<?php echo @$presentase_bengkel; ?>">
										</div>
                                    </div>
                                    <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Presentase Oli</label>
									<div class="col-sm-8">
										<input type="text" class="form-control calculate" id="focusedinput" placeholder="Presentase Oli" name="presentase_oli" value="<?php echo @$presenatse_oli; ?>">
									</div>
                                    </div>
									
									<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Bonus Bengkel</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="bonus_bengkel" placeholder="Bonus Bengkel" value="<?php echo @$bonus_bengkel; ?>">
										</div>
                                    </div>
									
									<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Bonus Oli</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="bonus_oli" placeholder="Bonus Bengkel"  value="<?php echo @$bonus_oli; ?>">
										</div>
                                    </div>
									
									
                                    <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Bonus Full Absen</label>
									<div class="col-sm-8">
										<input type="text" class="form-control calculate" id="focusedinput" placeholder="Bonus Full Absen" name="bonus_full_absen" value="<?php echo @$bonus_full_absen; ?>">
									</div>
                                    </div>
                                    <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Jumlah Bonus</label>
									<div class="col-sm-8">
										<input type="text" class="form-control calculate" id="focusedinput" placeholder="Jumlah Bonus" name="jumlah_bonus" value="<?php echo @$jumlah_bonus; ?>">
									</div>
                                    </div>
                                    <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">THR</label>
									<div class="col-sm-8">
										<input type="text" class="form-control calculate" id="focusedinput" placeholder="THR" name="thr" value="<?php echo @$thr; ?>">
									</div>
                                    </div>
                                    <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Potong Terlambat</label>
									<div class="col-sm-8">
										<input type="text" class="form-control calculate" id="focusedinput" placeholder="Potong Terlambat" name="potong_terlambat" value="<?php echo @$potong_terlambat; ?>">
									</div>
                                    </div>
                                    <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Total Gaji</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="focusedinput" placeholder="Total Gaji" name="total_gaji" value="<?php echo @$total_gaji; ?>">
									</div>
                                    </div>
                                    <br /><div class="panel-footer">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<!-- <button class="btn-primary btn">Submit</button> -->
				<?php
					if(@$_GET['aksi']=="edit"){
						echo '<input type="submit" value="Update Gaji" name="submit_edit" class="btn-primary btn">';
					}else{
						echo '<input type="submit" value="Tambah Gaji" name="submit_add" class="btn-primary btn">';
					}
				?>
				
				<a href="index.php?tag=gaji"><input type="button" value="Reset" class="btn-default btn" /></a>
			</div>
		</div>
	 </div>
							</form>
						</div>
					</div>
            </div>
    <div class="grid-form1">
		<div class="row">
			<div class="col-md-3">
				<label class="form-label">Periode </label>
				<br>
				<select class="chosen form-control periode">
					<?php echo $Helper->months($periode);?>
				</select>
			</div>
			<div class="col-md-2">
				<label class="form-label">Tahun </label>
				<br>
				<select class="chosen form-control tahun">
					<?php 
					echo $Helper->years($tahun);
					?>
				</select>
			</div>
			<div class="col-md-3">
				<label class="form-label">&nbsp; </label><br>
				<button class="btn date-range-filter btn-primary">Filter</button>
			</div>
		</div>
	</div>
	<hr>
    <table width="100%" id="table1" class="display">
	<thead>
  <tr  align="center">
  		<td width="2%">No.</td>
        <td width="">Nama</td>
        <td width="">Periode</td>
 		<td width="">Tanggal</td>
	  	<td width="">Pokok</td>
        <td width="">B.Bengkel</td>
        <td width="">B.Oli</td>
        <td width="">Potong</td>
        <td width="">Total</td>
        <td width="">Aksi</td>
        
  </tr>
    <?php
	/**
  	$no=1;
  	$listGaji=listGaji();
	while ($data=mysqli_fetch_array($listGaji)) {
	
  ?>
  <tr>
  	  	<td width="6%"> <?php echo $no; ?> </td>
        <td width="6%"> <?php echo $data['kode_gaji']; ?> </td>
 		<td width="6%"> <?php echo $data['kode_karyawan']; ?> </td>
	  	<td width="6%"> <?php echo $data['kode_bonus']; ?> </td>
        <td width="6%"> <?php echo $data['periode']; ?> </td>
        <td width="6%"> <?php echo $data['tanggal']; ?> </td>
        <td width="6%"> <?php echo $data['gaji_pokok']; ?> </td>
        <td width="6%"> <?php echo $data['presentase_bengkel']; ?> </td>
        <td width="6%"> <?php echo $data['bonus_bengkel']; ?> </td>
        <td width="6%"> <?php echo $data['presentase_oli']; ?> </td>
        <td width="6%"> <?php echo $data['bonus_oli']; ?> </td>
        <td width="6%"> <?php echo $data['bonus_full_absen']; ?> </td>
        <td width="6%"> <?php echo $data['total_bonus']; ?> </td>
        <td width="6%"> <?php echo $data['thr']; ?> </td>
        <td width="6%"> <?php echo $data['potong_terlambat']; ?> </td>
        <td width="6%"> <?php echo $data['total_gaji']; ?> </td>
        <td width="3%" align="center">
        		<a href="index.php?tag=gaji&aksi=edit&kode_gaji=<?php echo $data['kode_gaji']; ?>"><i class="fa fa-pencil" title="Edit"> </i></a>
        		&nbsp;&nbsp;
        		<a href="index.php?tag=gaji&aksi=delete&kode_gaji=<?php echo $data['kode_gaji']; ?>"><i class="fa fa-trash" title="Delete"> </i></a>
        </td>
  </tr>  
  <?php $no++; } **/ ?>
	</thead></table>
    
</header>
<div class="agileits-box-body clearfix">
<div id="hero-area"></div>
</div>
</div>
</div>
<!--//four-grids here-->