<!-- tables -->
<link rel="stylesheet" type="text/css" href="../assets/css/datepicker.css" />
<link rel="stylesheet" type="text/css" href="../assets/css/sweetalert.css" />
<script type="text/javascript" src="../assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="../assets/js/sweetalert.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
		var table = $('#table1').dataTable({
			ajax: {
				url:  adminUrl + '/index.php?tag=karyawan&ajax=true',
				type: 'POST',
				dataType: 'json',
				data: function(d){
				  d.cmd = "refresh"
				}
			}
		});
		
		$('.date-range-filter').on('click', function(e){
			e.preventDefault();
			table.api().ajax.reload();
		});
		
		$('.datepicker').datepicker({
			autoclose: true,
			format: "yyyy-mm-dd",
		});
    });
</script>
<!-- //tables -->

<?php
	if(@$_GET['aksi']=="edit"){
		$kode_karyawan=$_GET['kode_karyawan'];
		$datau=editKaryawan($kode_karyawan);
		// $datau=mysqli_fetch_array($editKaryawan);
			$kode_karyawan=$datau['kode_karyawan'];
			$kode_absensi=$datau['kode_absensi'];
			$nama_karyawan=$datau['nama_karyawan'];
			$jenis_kelamin=$datau['jenis_kelamin'];
			$tanggal_lahir=$datau['tanggal_lahir'];
			$alamat=$datau['alamat'];
			$tgl_mulai_kerja=$datau['tgl_mulai_kerja'];
			$jabatan=$datau['jabatan'];
			$no_telepon=$datau['no_telepon'];
			$no_rekening=$datau['no_rekening'];
		// }	
		
	}
?>

<!--four-grids here-->
<div class="agileinfo-grap">
<div class="agileits-box">
<?php 
$status=$_GET['success'];
$transaction=$_GET['transaction'];
if(@$_GET['success']=="true"){
				
?>
<script>
	 <?php 
	 if($transaction=='add')
	 {
			echo "swal('Add Success!', 'You clicked the button!','success')";
	 } 
	 if($transaction=='update')
	 {
			echo "swal('Update Success!', 'You clicked the button!','success')";			
	 }
	 ?>
</script>
<!--
<div class="alert alert-success" id="success-alert" style="display: none; opacity: 500;">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>Success! </strong>
</div>-->
<?php } ?>
<?php
if(@$_GET['success']=="false")
{
	echo"<script>alert('false')</script>";
}
?>
<header class="agileits-box-header clearfix">
  <div class="grid-form1">
  	       <h3>Data Karyawan</h3>
  	         <div class="tab-content">
						<div class="tab-pane active" id="horizontal-form">
							<form class="form-horizontal" method="post" action="">
								<div class="form-group" <?php if(@$_GET['aksi']=="edit") echo "style=\"display:block;\""; else echo "style=\"display:none;\"";?>>
									<label for="focusedinput" class="col-sm-2 control-label">Kode Karyawan</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="focusedinput" <?php if(@$_GET['aksi']=="edit") echo " readonly "; ?> placeholder="Kode Karyawan" name="kode_karyawan" value="<?php echo @$kode_karyawan; ?>">
									</div>
								</div>
								
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Kode Absensi</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="focusedinput" placeholder="Kode Absensi" name="kode_absensi" value="<?php echo @$kode_absensi; ?>">
									</div>
								</div>
                               	<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Nama Karyawan</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="focusedinput" placeholder="Nama Karyawan" name="nama_karyawan" value="<?php echo @$nama_karyawan; ?>">
									</div>
								</div>
                                <div class="form-group">
									<label for="radio" class="col-sm-2 control-label">Jenis Kelamin</label>
									<div class="col-sm-8">
										<div class="radio-inline"><label><input <?php if(@$_GET['aksi']=="edit" && $jenis_kelamin == "Laki-laki"){ echo "selected"; } ?>  type="radio" name="jenis_kelamin" value="Laki-laki">Laki-laki</label></div>
										<div class="radio-inline"><label><input <?php if(@$_GET['aksi']=="edit" && $jenis_kelamin == "Perempuan"){ echo "selected"; } ?>  type="radio" name="jenis_kelamin" value="Perempuan">Perempuan</label></div>
									</div>
                                    </div>
                                    <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Tanggal Lahir</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1 datepicker" id="focusedinput" placeholder="Tanggal Lahir" name="tanggal_lahir" value="<?php echo @$tanggal_lahir; ?>">
									</div>
                                    </div>
                                  	<div class="form-group">
									<label for="txtarea1" class="col-sm-2 control-label">Alamat</label>
									<div class="col-sm-8">
                                    <textarea id="txtarea1" cols="50" rows="4" class="form-control1" name="alamat"><?php echo @$alamat; ?></textarea>
                                    </div>
								</div>
                                <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Tanggal Mulai Kerja</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1 datepicker" id="focusedinput" placeholder="Tanggal Mulai Kerja" name="tgl_mulai_kerja" value="<?php echo @$tgl_mulai_kerja; ?>">
									</div>
                                    </div>
                                    <div class="form-group">
									<label for="selector1" class="col-sm-2 control-label">Jabatan</label>
									<div class="col-sm-8"><select name="jabatan" id="selector1" class="form-control1">
										<option value="Manager Service" <?php if(@$jabatan=='mgr_service'){ echo "selected"; }  ?>>Manager Service</option>
										<option value="Manager Spare Part" <?php if(@$jabatan=='mgr_spart'){ echo "selected"; }  ?>>Manager Spare Part</option>
										<option value="Foreman" <?php if(@$jabatan=='foreman'){ echo "selected"; }  ?>>Foreman</option>
										<option value="Final Inspector" <?php if(@$jabatan=='final_inspector'){ echo "selected"; }  ?>>Final Inspector</option>
                                        <option value="Service Advisor" <?php if(@$jabatan=='service_advisor'){ echo "selected"; }  ?>>Service Advisor</option>
                                        <option value="Mekanik" <?php if(@$jabatan=='mekanik'){ echo "selected"; }  ?>>Mekanik</option>
                                        <option value="Service" <?php if(@$jabatan=='service'){ echo "selected"; }  ?>>Service</option>
                                        <option value="Staf Spare Part" <?php if(@$jabatan=='staf_spart'){ echo "selected"; }  ?>>Staf Spare Part</option>
                                        <option value="Head Administrasi" <?php if(@$jabatan=='head_adm'){ echo "selected"; }  ?>>Head Administrasi</option>
                                        <option value="Kasir" <?php if(@$jabatan=='kasir'){ echo "selected"; }  ?>>Kasir</option>
                                        <option value="Staf Administrasi" <?php if(@$jabatan=='staf_adm'){ echo "selected"; }  ?>>Staf Administrasi</option>
                                        <option value="CRO" <?php if(@$jabatan=='cro'){ echo "selected"; }  ?>>CRO</option>
                                        <option value="Samsat" <?php if(@$jabatan=='samsat'){ echo "selected"; }  ?>>Samsat</option>
                                        <option value="Office Girl/Boy" <?php if(@$jabatan=='ob'){ echo "selected"; }  ?>>Office Girl/Boy</option>
                                        <option value="Tukang Cuci" <?php if(@$jabatan=='tkg_cuci'){ echo "selected"; }  ?>>Tukang Cuci</option>
                                        <option value="Sopir" <?php if(@$jabatan=='sopir'){ echo "selected"; }  ?>>Sopir</option>
                                        <option value="Security" <?php if(@$jabatan=='security'){ echo "selected"; }  ?>>Security</option>
                                        
									</select></div>
								</div>
                                 <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">No. Telepon</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="focusedinput" placeholder="No. Telepon" name="no_telepon" value="<?php echo @$no_telepon; ?>">
									</div>
                                    </div>
                                    <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">No. Rekening</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="focusedinput" placeholder="No. Rekening" name="no_rekening" value="<?php echo @$no_rekening; ?>">
									</div>
                                    </div>
                                    <br /><div class="panel-footer">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<?php
					if(@$_GET['aksi']=="edit"){
						echo '<input type="submit" value="Update Karyawan" name="submit_edit" class="btn-primary btn">';
					}else{
						echo '<input type="submit" value="Tambah Karyawan" name="submit_add" class="btn-primary btn">';
					}
				?>
				<a href="index.php?tag=karyawan"><input type="button" value="Reset" class="btn-default btn" /></a>
			</div>
		</div>
	 </div>
							</form>
						</div>
					</div>
            </div>
    
    <table width="100%" id="table1" class="display">
	<thead>
		  <tr  align="center">
				<th width="2%">No</th>
				<th width="3%">Kode</th>
				<th width="10%">Nama </th>
				<th width="3%">J.Kel</th>
				<th width="6%">Mulai Kerja</th>
				<th width="9%">Jabatan</th>
				<th width="8%">Telepon</th>
				<th width="8%">Rekening</th>
				<th width="3%">Aksi</th>
				
		  </tr>
  
	</thead>
	<tfoot>
            <tr>
                <th width="2%">No</th>
				<th width="3%">Kode</th>
				<th width="10%">Nama </th>
				<th width="3%">J.Kel</th>
				<th width="6%">Mulai Kerja</th>
				<th width="9%">Jabatan</th>
				<th width="8%">Telepon</th>
				<th width="8%">Rekening</th>
				<th width="3%">Aksi</th>
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