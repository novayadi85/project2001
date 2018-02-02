<script type="text/javascript">
    $(document).ready(function() {
      $('.chosen').chosen();
	  //$('.dataShow').hide();
		$('.printData').on('click', function(e){
			e.preventDefault();
			var periode = $("#periode").val();
			var tahun = $("#tahun").val();
			var kode_karyawan = '<?php echo $_SESSION["uid"];?>';
			$.ajax ({
				url:  EmployeeUrl + '/index.php?tag=slipgaji&method=print',
				type: 'POST',
				dataType: 'json',
				data: {kode_karyawan:kode_karyawan, periode: periode , tahun: tahun},
				success: function(xhr){
					if(xhr.error){
						//alert("Error, Data tidak valid.")
						swal("Sorry!", "Data tidak valid...!", "error");
					}
					else{
						window.open(xhr.file);
					}
					
				}
			});
		});
    });
</script>
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
									<label for="selector1" class="col-sm-2 control-label">Periode</label>
									<div class="col-sm-8"><select name="selector1" id="periode" class="chosen form-control1">
										<option>- Bulan -</option>
										<?php echo $Helper->months();?>
									</select></div>
								</div>
                                <div class="form-group">
									<label for="selector1" class="col-sm-2 control-label">Tahun</label>
									<div class="col-sm-8"><select name="selector1" id="tahun" class="chosen  form-control1">
										<option>- Tahun -</option>
										<?php echo $Helper->years();?>
									</select></div>
								</div>
                                    <br /><div class="panel-footer">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<button class="btn-primary printData btn"><i class="fa fa-print"></i> Cetak</button>
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