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
<!-- //tables -->

<?php
	$periode = '';
	$tahun = '';
	if(@$_GET['aksi']=="edit"){
		$kode_bonus=$_GET['kode_bonus'];
		$datau=editBonus($kode_bonus);
		// $datau=mysqli_fetch_array($editUser);
			$kode_bonus=$datau['kode_bonus'];
			$kode_karyawan=$datau['kode_karyawan'];
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
  	       <h3>Data Bonus</h3>
  	         <div class="tab-content">
						<div class="tab-pane active" id="horizontal-form">
							<form class="form-horizontal" method="post" action="">
								<?php if(@$_GET['aksi']=="edit"){?>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Kode Bonus</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="focusedinput" placeholder="Kode Bonus" name="kode_bonus" value="<?php echo @$kode_bonus; ?>" <?php if(@$_GET['aksi']=="edit"){ echo "readonly"; } ?> >
									</div>
								</div>
								<?php } ?>
                               
                                <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Periode</label>
									<div class="col-sm-8">
										<select name="periode" id="selector1" class="chosen form-control">
                                            <?php echo $Helper->months($periode);?>
                                        </select>
									</div>
								</div>
                                <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Tahun</label>
									<div class="col-sm-8">
										<select name="tahun" id="selector1" class="chosen form-control">
                                            <?php echo $Helper->years($tahun);?>
                                        </select>
									</div>
								</div>
                               	<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Pendapatan Bengkel</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="focusedinput" placeholder="Pendapatan Bengkel"  name="pendapatan_bengkel" value="<?php echo @$pendapatan_bengkel; ?>">
									</div>
								</div>
                                    <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Pendapatan Oli</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="focusedinput" placeholder="Pendapatan Oli"  name="pendapatan_oli" value="<?php echo @$pendapatan_oli; ?>">
									</div>
                                    </div>
                                    <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Jumlah Bonus</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="focusedinput" placeholder="Jumlah Bonus"  name="jumlah_bonus" value="<?php echo @$jumlah_bonus; ?>">
									</div>
                                    </div>
                                    <br /><div class="panel-footer">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<?php
					if(@$_GET['aksi']=="edit"){
						echo '<input type="submit" value="Update Bonus" name="submit_edit" class="btn-primary btn">';
					}else{
						echo '<input type="submit" value="Tambah Bonus" name="submit_add" class="btn-primary btn">';
					}
				?>
				
				<a href="index.php?tag=bonus"><input type="button" value="Reset" class="btn-default btn" /></a>
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
        <td width="6%">Kode Karyawan</td>
        <td width="6%">Periode</td>
        <td width="6%">Tahun</td>
 		<td width="10%">Pendapatan Bengkel</td>
	  	<td width="10%">Pendapatan Oli</td>
        <td width="10%">Jumlah Bonus</td>
        <td width="3%">Aksi</td>
        
  </tr>
    <?php
  	$no=1;
  	$listBonus=listBonus();
	while ($data=mysqli_fetch_array($listBonus)) {
	
  ?>
  <tr>
  	  	<td width="6%"> <?php echo $no; ?> </td>
        <td width="6%"> <?php echo $data['kode_bonus']; ?> </td>
 		<td width="6%"> <?php echo $data['kode_karyawan']; ?> </td>
        <td width="6%"> <?php echo $data['periode']; ?> </td>
        <td width="6%"> <?php echo $data['tahun']; ?> </td>
	  	<td width="6%"> <?php echo $data['pendapatan_bengkel']; ?> </td>
        <td width="6%"> <?php echo $data['pendapatan_oli']; ?> </td>
        <td width="6%"> <?php echo $data['jumlah_bonus']; ?> </td>
        <td width="3%" align="center">
        		<a href="index.php?tag=bonus&aksi=edit&kode_bonus=<?php echo $data['kode_bonus']; ?>"><i class="fa fa-pencil" title="Edit"> </i></a>
        		&nbsp;&nbsp;
        		<a href="index.php?tag=bonus&aksi=delete&kode_bonus=<?php echo $data['kode_bonus']; ?>"><i class="fa fa-trash" title="Delete"> </i></a>
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