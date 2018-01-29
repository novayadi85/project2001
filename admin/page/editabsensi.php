<!-- tables -->
<link rel="stylesheet" type="text/css" href="../css/table-style.css" />
<link rel="stylesheet" type="text/css" href="../css/basictable.css" />
<script type="text/javascript" src="../js/jquery.basictable.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
      $('#table').basictable();
    });
</script>
<!-- //tables -->

<?php
	if(@$_GET['aksi']=="edit"){
		$kode_absensi=$_GET['kode_absensi'];
		$datau=editAbsensi($kode_absensi);
		// $datau=mysqli_fetch_array($editKaryawan);
			$kode_absensi=$datau['kode_absensi'];
			$kode_karyawan=$datau['kode_karyawan'];
			$nama_karyawan=$datau['nama_karyawan'];
			$periode=$datau['periode'];
			$tahun=$datau['tahun'];
			$alamat=$datau['alamat'];
			$jumlah_absen=$datau['jumlah_absen'];
			$keterlambatan=$datau['keterlambatan'];
		// }	
		
	}
?>

<!--four-grids here-->
<div class="agileinfo-grap">
<div class="agileits-box">
<header class="agileits-box-header clearfix">
 <div class="grid-form1">
  	       <h3>Data User</h3>
  	         <div class="tab-content">
						<div class="tab-pane active" id="horizontal-form">
							
                            <form class="form-horizontal" method="post" action="">
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Kode Absensi</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="focusedinput" placeholder="Kode Absensi">
									</div>
								</div>
                               <div class="form-group">
									<label for="selector1" class="col-sm-2 control-label">Kode Karyawan</label>
									<div class="col-sm-8"><select name="selector1" id="selector1" class="form-control1">
										<option>- Kode Karyawan -</option>
                                       
									</select></div>
								</div>
                               	<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Nama Karyawan</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="focusedinput" placeholder="Nama Karyawan">
									</div>
								</div>
                                <div class="form-group">
									<label for="selector1" class="col-sm-2 control-label">Periode</label>
									<div class="col-sm-8"><select name="selector1" id="selector1" class="form-control1">
										<option>Januari</option>
                                        <option>Februari</option>
                                        <option>Maret</option>
                                        <option>April</option>
                                        <option>Mei</option>
                                        <option>Juni</option>
                                        <option>Juli</option>
                                        <option>Agustus</option>
                                        <option>September</option>
                                        <option>Oktober</option>
                                        <option>November</option>
                                        <option>Desember</option>
									</select></div>
								</div>
                               	<div class="form-group">
									<label for="disabledinput" class="col-sm-2 control-label">Jumlah Absensi</label>
									<div class="col-sm-8">
										<input disabled="" type="text" class="form-control1" id="disabledinput" placeholder="Jumlah Absensi">
									</div>
								</div>
                                    <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Keterlambatan</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="focusedinput" placeholder="Keterlambatan">
									</div>
                                    </div>
                                    <br /><div class="panel-footer">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<input type="submit" value="Update Karyawan" name="submit_edit" class="btn-primary btn">
				<a href="index.php?tag=absensi"><input type="button" value="Reset" class="btn-default btn" /></a>
			</div>
		</div>
	 </div>
							</form>
						</div>
					</div>
            </div>
    
    <table width="100%" id="tabel_alamat">
	<thead>
  <tr  align="center">
  		<td width="3%">No.</td>
  		<td width="6%">Kode Absensi</td>
        <td width="6%">Kode Karyawan</td>
 		<td width="13%">Nama Karyawan</td>
	  	<td width="8%">Periode</td>
        <td width="8%">Tahun</td>
        <td width="6%">Jumlah Absensi</td>
        <td width="6%">Keterlambatan</td>
        <td width="3%">Aksi</td>
        
  </tr>
    <?php
  	$no=1;
	$listAbsensi=listAbsensi();
	while ($data=mysqli_fetch_array($listAbsensi)) {
	
  ?>
  <tr>
  	  	<td width="3%"> <?php echo $no; ?> </td>
        <td width="6%"> <?php echo $data['kode_absensi']; ?> </td>
        <td width="6%"> <?php echo $data['kode_karyawan']; ?> </td>
 		<td width="13%"> <?php echo $data['nama_karyawan']; ?> </td>
	  	<td width="8%"> <?php echo $data['periode']; ?> </td>
        <td width="8%"> <?php echo $data['tahun']; ?> </td>
        <td width="6%"> <?php echo $data['jumlah_absensi']; ?> </td>
        <td width="6%"> <?php echo $data['keterlambatan']; ?> </td>
        <td width="3%" align="center">
        <a href="index.php?tag=editabsensi&kode_absensi=<?php echo $data['kode_absensi']; ?>"><i class="fa fa-pencil" title="Edit"> </i></a>
        		&nbsp;&nbsp;
        </td>
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