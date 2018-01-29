<script type="text/javascript">
    $(document).ready(function() {
      $('.chosen').chosen();
	  $('.dataShow').hide();
	  var dTable;
      var table = $('#table1').dataTable({
		ajax: {
			url:  OwnerUrl + '/index.php?tag=absensi&ajax=true&level=owner&uid=false',
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
				url:  OwnerUrl + '/index.php?tag=rekapgaji&method=print',
				type: 'POST',
				dataType: 'json',
				data: {table:dTable},
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
    });
	
	
	
</script>
<!--four-grids here-->
<div class="agileinfo-grap">
<div class="agileits-box">
<header class="agileits-box-header clearfix">
<div class="grid-form1">
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
                                    <br><div class="panel-footer">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<button class="btn-primary viewData btn">Filter</button>
				
			</div>
		</div>
	 </div>
							</form>
						</div>
					</div>
	</div>
 <div class="grid-form1">
  	       <h3>Data Absensi Karyawan</h3>
  	         <div class="tab-content">	
    
   <table id="table1" class="display " cellspacing="0" width="100%">
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
    
    
</header>
<div class="agileits-box-body clearfix">
<div id="hero-area"></div>
</div>
</div>
</div>
<!--//four-grids here-->