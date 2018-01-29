<link rel="stylesheet" type="text/css" href="../assets/libs/chosen/chosen.css" />
<script type="text/javascript" src="../assets/libs/chosen/chosen.jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
	   /*  $('.datepicker').datepicker({
			autoclose: true,
			format: " yyyy",
			startView: 'decade',
			minView: 'decade',
			viewSelect: 'decade',
		}); */
		$("select.chosen").chosen();
		var table = $('#table1').dataTable({
			ajax: {
				url:  adminUrl + '/index.php?tag=absensi&ajax=true',
				type: 'POST',
				dataType: 'json',
				data: function(d){
				  d.cmd = "refresh",
				  d.periode = $(".periode").val(),
				  d.year  =  $(".tahun").val()
				}
			}
		});
		
		$('.date-range-filter').on('click', function(e){
			e.preventDefault();
			table.api().ajax.reload();
		});
    });
	
	<?php 
	if(isset($_GET["success"]) && $_GET["success"] == "true"){
		print 'swal("Success!", "Data sudah terimport...!", "success");';
		print 'setTimeout(function(){ 
			window.location = "/penggajian/admin/index.php?tag=absensi";
		}, 2000);';
	}
	?>

	function importnow(){
		swal({
		  title: "Apakah anda yakin untuk import file ini??",
		  icon: "warning",
		  buttons: true,
		  dangerMode: true,
		})
		.then((willDelete) => {
		  if (willDelete) {
			return true;
		  } else {
			return false;
		  }
		});
	}
	
</script>
<!-- //tables -->
<?php
	if(@$_GET['aksi']=="edit"){
		$kode_absensi=$_GET['kode_absensi'];
		$datau = editAbsensi($kode_absensi);
		// $datau=mysqli_fetch_array($editKaryawan);
			$id=$datau['id'];
			$kode_absensi=$datau['kode_absensi'];
			$kode_karyawan=$datau['kode_karyawan'];
			$nama_karyawan=$datau['nama_karyawan'];
			$periode=$datau['periode'];
			$tahun=$datau['tahun'];
			$alamat=$datau['alamat'];
			$jumlah_absensi=$datau['jumlah_absensi'];
			$keterlambatan=$datau['keterlambatan'];
		// }	
		
	}
?>


<!--four-grids here-->
<div class="agileinfo-grap">
<div class="agileits-box">
<header class="agileits-box-header clearfix">
 <div class="grid-form1">
  	       <h3>Data Absensi</h3>
  	         <div class="tab-content">
						<div class="tab-pane active" id="horizontal-form">
                        	<?php if(@$_GET['aksi']=="edit"){ ?>
								<form class="form-horizontal" method="post" action="">
                                    <input type="hidden" name="id" value="<?php echo @$id; ?>">
									<div class="form-group">
                                        <label for="focusedinput" class="col-sm-2 control-label">Kode Absensi</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control1" id="focusedinput" placeholder="Kode Absensi" name="kode_absensi" value="<?php echo @$kode_absensi; ?>" <?php if(@$_GET['aksi']=="edit"){ echo "readonly"; } ?> >
                                        </div>
                                    </div>
                     
                                   	<div class="form-group">
									<label for="selector1" class="col-sm-2 control-label">Kode Karyawan</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="focusedinput" placeholder="Kode Absensi" name="kode_karyawan" value="<?php echo @$kode_karyawan; ?>" <?php if(@$_GET['aksi']=="edit"){ echo "readonly"; } ?> >
									</div>
								</div>
                                <div class="form-group">
                                        <label for="focusedinput" class="col-sm-2 control-label">Nama Karyawan</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control1" id="focusedinput" placeholder="Nama Karyawan"name="nama_karyawan" value="<?php echo @$nama_karyawan; ?>" <?php if(@$_GET['aksi']=="edit"){ echo "readonly"; } ?>>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="selector1" class="col-sm-2 control-label">Periode</label>
                                        <div class="col-sm-8">
										<select name="periode" id="selector1" class="form-control1" disabled>
                                            <?php echo $Helper->months($periode);?>
                                        </select></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="selector1" class="col-sm-2 control-label">Tahun</label>
                                        <div class="col-sm-8">
											<select name="tahun" id="selector1" class="form-control1" disabled>
												<?php echo $Helper->years($tahun);?>
											</select>
										</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="disabledinput" class="col-sm-2 control-label">Jumlah Absensi</label>
                                        <div class="col-sm-8">
                                            <input disabled="" type="text" class="form-control1" id="disabledinput" placeholder="Jumlah Absensi" name="jumlah_absensi" value="<?php echo @$jumlah_absensi; ?>"disabled>
                                        </div>
                                    </div>
                                        <div class="form-group">
                                        <label for="focusedinput" class="col-sm-2 control-label">Keterlambatan</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control1" id="focusedinput" placeholder="Keterlambatan" name="keterlambatan" value="<?php echo @$keterlambatan; ?>">
                                        </div>
                                        </div>
                                        <br /><div class="panel-footer">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <input type="submit" value="Update Data" name="submit_edit" class="btn-primary btn">
                    <a href="index.php?tag=absensi"><input type="button" value="BACK" class="btn-default btn" /></a>
                </div>
            </div>
         </div>
							</form>
                            <?php }else{ ?>
                            	<form class="form-horizontal"  method="post" action="" enctype="multipart/form-data">
                                    <div class="form-group">
                                    <div class="col-sm-8">
										<input type="file" class="form-control" id="focusedinput" name="file_absensi">
										<input type="hidden" name="importdata" value="import">
                                    </div>
									<div class="col-sm-4">
                                        <input class="btn-primary btn" type="submit" value="Import Now">
									</div>
                                    </div>
                                </form>
                            <?php } ?>
						</div>
					</div>
            </div>
    
	
	<?php 
	$fields = array(
		"kode_absensi" => "Kode",
		"kode_karyawan" => "Nama",
		"periode" => "Periode",
		"tahun" => "tahun",
		"jumlah_absensi" => "absensi",
		"keterlambatan" => "Telat",
		"departemen" => "departemen",
	);

	$listAbsensi = $mysqli->query("SELECT * FROM tb_absensi");
	$headtables = $Connection->columns("tb_absensi");
	
	?>
    <div class="grid-form1">
		<div class="row">
			<div class="col-md-3">
				<label class="form-label">Periode </label>
				<br>
				<select class="chosen form-control periode">
					<?php echo $Helper->months();?>
				</select>
			</div>
			<div class="col-md-2">
				<label class="form-label">Tahun </label>
				<br>
				<select class="chosen form-control tahun">
					<?php 
					echo $Helper->years();
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
    <table id="table1" class="display " cellspacing="0" width="100%">
        <thead>
           <tr>
                <th>KODE</th><th>NAMA</th>
				<th>PERIODE</th>
				<th>TAHUN</th>
				<th>ABSENSI</th>
				<th>TELAT</th>
				<th>DEPARTEMEN</th>				
				<th>ACTION</th>
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
				<th>ACTION</th>
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