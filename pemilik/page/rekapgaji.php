<script type="text/javascript">
    $(document).ready(function() {
	  var dTable;
      var table = $('#table1').dataTable({
			ajax: {
				url:  OwnerUrl + '/index.php?tag=gaji&ajax=true',
				type: 'POST',
				dataType: 'json',
				data: function(d){
				  d.cmd = "refresh",
				  d.periode = $("#periode").val(),
				  d.year  =  $("#tahun").val()
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
			var periode = $("#periode").val();
		    var year  =  $("#tahun").val();
			$.ajax ({
				url:  OwnerUrl + '/index.php?tag=rekapgaji&method=print',
				type: 'POST',
				dataType: 'json',
				data: {table:dTable, periode:periode , year:year},
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
  	       <h3>Rekap Gaji Karyawan</h3>
  	         <div class="tab-content">
						<div class="tab-pane active" id="horizontal-form">
							<form class="form-horizontal">
                                    <div class="form-group">
									<label for="selector1" class="col-sm-2 control-label">Bulan</label>
									<div class="col-sm-8"><select name="selector1" id="periode" class="chosen form-control1">
										<option>- Bulan -</option>
										<?php echo $Helper->months();?>
									</select></div>
								</div>
                                <div class="form-group">
									<label for="selector1" class="col-sm-2 control-label">Tahun</label>
									<div class="col-sm-8"><select name="selector1" id="tahun" class="chosen form-control1">
										<option>- Tahun -</option>
										<?php echo $Helper->years();?>
									</select></div>
								</div>
                                    <br /><div class="panel-footer">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<button class="btn-primary viewTable btn">Lihat</button>
				<button class="btn-default printTable btn">Cetak</button>
			</div>
		</div>
	 </div>
							</form>
						</div>
					</div>
            </div>
    
</header>
<table width="100%" id="table1" class="display dt-body-center">
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

        
  </tr>
  </table>
<div class="agileits-box-body clearfix">
<div id="hero-area"></div>
</div>
</div>
</div>
<!--//four-grids here-->