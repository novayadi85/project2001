<!-- tables -->
<link rel="stylesheet" type="text/css" href="../assets/libs/chosen/chosen.css" />
<script type="text/javascript" src="../assets/libs/chosen/chosen.jquery.js"></script>
<link rel="stylesheet" type="text/css" href="../assets/css/datepicker.css" />
<script type="text/javascript" src="../assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
	  var dTable;
     var table = $('#table1').dataTable({
			ajax: {
				url:  adminUrl + '/index.php?tag=gaji&ajax=true',
				type: 'POST',
				dataType: 'json',
				data: function(d){
				  d.cmd = "refresh",
				  d.periode = $(".periode").val(),
				  d.year  =  $(".tahun").val()
				},
				dataSrc: function(xhr){
					dTable = xhr
					return xhr.data;
				}
			}
		});
		
		$('.viewTable').on('click', function(e){
			e.preventDefault();
			table.api().ajax.reload();
		});
		
		$('.printTable').on('click', function(e){
			e.preventDefault();
			var periode = $(".periode").val();
		    var year  =  $(".tahun").val();
			$.ajax ({
				url:  adminUrl + '/index.php?tag=rekapgaji&method=print',
				type: 'POST',
				dataType: 'json',
				data: {table:dTable , periode:periode , year:year},
				success: function(xhr){
					if(xhr.error){
						alert("Error, Data tidak valid.")
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
  	       <h3>Rekap Gaji Karyawan</h3>
  	         <div class="tab-content">
						<div class="tab-pane active" id="horizontal-form">
							<form class="form-horizontal">
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
				<button class="btn-primary viewTable btn">Lihat</button>
				<button class="btn-default btn printTable">Cetak</button>
			</div>
		</div>
	 </div>
							</form>
						</div>
					</div>
            </div>
    
 
 </header>
 <hr>
 <div class="grid-form1">
  
  <table id="table1" class="display " cellspacing="0" width="100%">
        <thead>
           <tr>
                <th width="2%">No.</th>
				<th width="">Nama</th>
				<th width="">Periode</th>
				<th width="">Tanggal</th>
				<th width="">Pokok</th>
				<th width="">B.Bengkel</th>
				<th width="">B.Oli</th>
				<th width="">Potong</th>
				<th width="">Total</th>
				<th width="">Aksi</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th width="2%">No.</th>
				<th width="">Nama</th>
				<th width="">Periode</th>
				<th width="">Tanggal</th>
				<th width="">Pokok</th>
				<th width="">B.Bengkel</th>
				<th width="">B.Oli</th>
				<th width="">Potong</th>
				<th width="">Total</th>
				<th width="">Aksi</th>
            </tr>
        </tfoot>
        
    </table>
 </div>
<div class="agileits-box-body clearfix">
<div id="hero-area"></div>
</div>
</div>
</div>
<!--//four-grids here-->