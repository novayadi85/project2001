<!-- tables -->
<!-- tables -->
<link rel="stylesheet" type="text/css" href="../assets/libs/chosen/chosen.css" />
<script type="text/javascript" src="../assets/libs/chosen/chosen.jquery.js"></script>
<link rel="stylesheet" type="text/css" href="../assets/css/datepicker.css" />
<script type="text/javascript" src="../assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
		$('.viewData').on('click', function(e){
			e.preventDefault();
			var periode = $(".periode").val();
			var tahun = $(".tahun").val();
			var kode_karyawan = $(".kode_karyawan").val();
			$.ajax ({
				url:  adminUrl + '/index.php?tag=slipgaji&method=print',
				type: 'POST',
				dataType: 'json',
				data: {kode_karyawan:kode_karyawan, periode: periode , tahun: tahun},
				success: function(xhr){
					if(xhr.error){
						swal("Sorry!", "Data tidak valid...!", "error");
					}
					else{
						window.open(xhr.file);
					}
					
				}
			});
		});
		
	  $('.chosen').chosen();
    });
</script>
<!-- //tables -->


<!--four-grids here-->
<div class="agileinfo-grap">
<div class="agileits-box">
<header class="agileits-box-header clearfix">
 <div class="grid-form1">
  	       <h3>Slip Gaji Karyawan</h3>
  	         <div class="tab-content">
						<div class="tab-pane active" id="horizontal-form">
							<form class="form-horizontal">
                                <div class="form-group">
									<label for="selector1" class="col-sm-2 control-label">Karyawan</label>
									<div class="col-sm-8"><select placeholder="Pilih Karyawan" name="selector1" id="selector1" class="chosen kode_karyawan form-control1">
										<option></option>
										<?php 
										include_once "../model/karyawan/m_karyawan.php";
                                       		$listBonus=listKaryawan();
											$bonus_options = array();
											while ($datab=mysqli_fetch_assoc($listBonus)){
												$bonus_options[$datab['kode_karyawan']]  = $datab['nama_karyawan'];
												
												
											}
											
											echo $Helper->dropdown($bonus_options , $kode_bonus);
										?>
									</select></div>
								</div>
                                    <div class="form-group">
									<label for="selector1" class="col-sm-2 control-label">Bulan</label>
									<div class="col-sm-8"><select placeholder="Pilih Periode" name="selector1" id="selector1" class="chosen periode form-control1">
										<option></option>
										<?php echo $Helper->months();?>
									</select></div>
								</div>
                                <div class="form-group">
									<label for="selector1" class="col-sm-2 control-label">Tahun</label>
									<div class="col-sm-8"><select placeholder="Pilih Tahun" name="selector1" id="selector1" class="chosen tahun form-control1">
										<option></option>
										<?php echo $Helper->years();?>
									</select></div>
								</div>
                                    <br /><div class="panel-footer">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<button class="btn-primary viewData btn">Cetak</button>
			</div>
		</div>
	 </div>
							</form>
						</div>
					</div>
            </div>
    
</header>
<div class="agileits-box-body clearfix">
<div id="hero-area"></div>
</div>
</div>
</div>
<!--//four-grids here-->