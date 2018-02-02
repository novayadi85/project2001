<!-- tables -->
<link rel="stylesheet" type="text/css" href="../css/table-style.css" />
<link rel="stylesheet" type="text/css" href="../css/basictable.css" />
<script type="text/javascript" src="../js/jquery.basictable.min.js"></script>
<link rel="stylesheet" type="text/css" href="../assets/libs/chosen/chosen.css" />
<script type="text/javascript" src="../assets/libs/chosen/chosen.jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
      $('#table1').dataTable();
      $('.chosen').chosen();
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
      $('.chosen').chosen();
	  $('.dataShow').hide();
	  var dTable;
      var table = $('#table1').dataTable({
		ajax: {
			url:  OwnerUrl + '/index.php?tag=bonus&ajax=true&level=owner&uid=false',
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

<?php
	$periode = '';
	$tahun = '';
	if(@$_GET['aksi']=="edit"){
		$kode_bonus=$_GET['kode_bonus'];
		$datau=editBonus($kode_bonus);
		// $datau=mysqli_fetch_array($editUser);
			$kode_bonus=$datau['kode_bonus'];
			$periode=$datau['periode'];
			$tahun=$datau['tahun'];
			$pendapatan_bengkel=$datau['pendapatan_bengkel'];
			$pendapatan_oli=$datau['pendapatan_oli'];
			$jumlah_bonus=$datau['jumlah_bonus'];
		// }	
		
	}
?>
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
<h3>Data Bonus</h3>
    <table width="100%" id="table1">
	<thead>
  <tr  align="center">
  		<td width="6%">No.</td>
  		<td width="6%">Kode Bonus</td>
        <td width="6%">Periode</td>
        <td width="6%">Tahun</td>
 		<td width="10%">Pendapatan Bengkel</td>
	  	<td width="10%">Pendapatan Oli</td>
        <td width="10%">Jumlah Bonus</td>
        
  </tr>
    <?php
  	$no=1;
  	$listBonus=listBonus();
	while ($data=mysqli_fetch_array($listBonus)) {
	
  ?>
  <tr>
  	  	<td width="6%"> <?php echo $no; ?> </td>
        <td width="6%"> <?php echo $data['kode_bonus']; ?> </td>
        <td width="6%"> <?php echo $data['periode']; ?> </td>
        <td width="6%"> <?php echo $data['tahun']; ?> </td>
	  	<td width="6%"> <?php echo $data['pendapatan_bengkel']; ?> </td>
        <td width="6%"> <?php echo $data['pendapatan_oli']; ?> </td>
        <td width="6%"> <?php echo $data['jumlah_bonus']; ?> </td>
  </tr>  
  <?php $no++; } ?>
	</thead></table>
    
    
</header>
<div class="agileits-box-body clearfix">
<div id="hero-area"></div>
</div>
</div>
</div>
<!--//four-grids here-->