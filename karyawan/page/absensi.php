<!-- tables -->
<script type="text/javascript">
    $(document).ready(function() {
      $('.chosen').chosen();
	  $('.dataShow').hide();
	  var dTable;
      var table = $('#table1').dataTable({
		ajax: {
			url:  EmployeeUrl + '/index.php?tag=absensi&ajax=true&level=employee&uid=<?php echo $_SESSION["uid"];?>',
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
		
		$('.viewData').on('click', function(e){
			e.preventDefault();
			table.api().ajax.reload();
			$('.dataShow').show();
		});
		
		$('.printData').on('click', function(e){
			e.preventDefault();
			$.ajax ({
				url:  EmployeeUrl + '/index.php?tag=absensi&method=print',
				type: 'POST',
				dataType: 'json',
				data: {table:dTable},
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
    });
</script>
<!-- //tables -->


<!--four-grids here-->
<div class="agileinfo-grap">
<div class="agileits-box">
<header class="agileits-box-header clearfix">
 <div class="grid-form1">
  	       <h3>Absen Saya</h3>
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
									<div class="col-sm-8"><select name="selector1" id="tahun" class="chosen form-control1">
										<option>- Tahun -</option>
										<?php echo $Helper->years();?>
									</select></div>
								</div>
                                    <br /><div class="panel-footer">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<button class="btn-primary viewData btn">Lihat</button>
				<button class="btn-default printData btn">Cetak</button>
			</div>
		</div>
	 </div>
							</form>
						</div>
					</div>
            </div>
</header>

<hr>
 <div class="grid-form1 dataShow">
<table width="100%" id="table1" class="display">
	
	<thead>
           <tr>
                <th>KODE</th><th>NAMA</th>
				<th>PERIODE</th>
				<th>TAHUN</th>
				<th>ABSENSI</th>
				<th>TELAT</th>
				<th>DEPARTEMEN</th>				
				
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>KODE</th><th>NAMA</th>
				<th>PERIODE</th>
				<th>TAHUN</th>
				<th>ABSENSI</th>
				<th>TELAT</th>
				<th>DEPARTEMEN</th>				
				
            </tr>
        </tfoot>
  </table>

<div class="agileits-box-body clearfix">
<div id="hero-area"></div>
</div>
</div>
</div>
<!--//four-grids here-->