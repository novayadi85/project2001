
<script type="text/javascript">
    $(document).ready(function() {
      $('#table').DataTable();
    });
</script>
<!-- //tables -->

<?php
	if(@$_GET['aksi']=="edit"){
		$kode_user=$_GET['kode_user'];
		$datau=editUser($kode_user);
		// $datau=mysqli_fetch_array($editUser);
			$kode_user=$datau['kode_user'];
			$kode_karyawan=$datau['kode_karyawan'];
			$nama_user=$datau['nama_user'];
			$username=$datau['username'];
			$password=$datau['password'];
			$level=$datau['level'];
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
									<label for="focusedinput" class="col-sm-2 control-label">Kode User</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="focusedinput" placeholder="Kode User" name="kode_user" value="<?php echo @$kode_user; ?>" <?php if(@$_GET['aksi']=="edit"){ echo "readonly"; } ?> >
									</div>
								</div>
                               	<!-- <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Nama Lengkap</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="focusedinput" placeholder="Nama Lengkap" name="nama_user">
									</div>
								</div> -->
                                <div class="form-group">
									<label for="selector1" class="col-sm-2 control-label">Kode Karyawan</label>
									<div class="col-sm-8">
										<select name="kode_karyawan" id="selector1" class="form-control1">
                                       	<?php
											include_once "../model/karyawan/m_karyawan.php";
                                       		$listKaryawan=listKaryawan();
											while ($datak=mysqli_fetch_array($listKaryawan)){
												if(@$_GET['aksi']=="edit"){

													if($kode_karyawan==$datak['kode_karyawan']){
														echo "<option selected value='".$datak['kode_karyawan']."'>".$datak['nama_karyawan']."</option>";
													}else{
														echo "<option value=".$datak['kode_karyawan'].">".$datak['nama_karyawan']."</option>";
													}
												}else{
													//echo "<option>- Kode Karyawan -</option>";
													echo "<option value=".$datak['kode_karyawan'].">".$datak['nama_karyawan']."</option>";
												}
											}
                                       	?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="selector1" class="col-sm-2 control-label">Level</label>
									<div class="col-sm-8">
										<select name="level" id="selector1" class="form-control1">
										<option value="admin" <?php if(@$level=='admin'){ echo "selected"; }  ?>> Admin </option>
										<option value="karyawan" <?php if(@$level=='karyawan'){ echo "selected"; }  ?>> Karyawan </option>
										<option value="pemilik" <?php if(@$level=='pemilik'){ echo "selected"; }  ?>> Pemilik </option>
										</select>
									</div>
								</div>
                                    <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Nama User</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="focusedinput" placeholder="Nama User" name="nama_user" value="<?php echo @$nama_user; ?>">
									</div>
                                    </div>
                                <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Username</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="focusedinput" placeholder="Username" name="username" value="<?php echo @$username; ?>">
									</div>
                                    </div>
                                 <div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Password</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="focusedinput" placeholder="Password" name="password" value="<?php echo @$password; ?>">
									</div>
                                    </div>
                                    <br /><div class="panel-footer">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<!-- <button class="btn-primary btn">Submit</button> -->
				<?php
					if(@$_GET['aksi']=="edit"){
						echo '<input type="submit" value="Update User" name="submit_edit" class="btn-primary btn">';
					}else{
						echo '<input type="submit" value="Tambah User" name="submit_add" class="btn-primary btn">';
					}
				?>
				
				<a href="index.php?tag=user"><input type="button" value="Reset" class="btn-default btn" /></a>
			</div>
		</div>
	 </div>
							</form>
						</div>
					</div>
            </div>
    
    
    
    
</header>
<br>
<div class="grid-form1">
	<table width="100%" id="table" border="1">
	<thead>
  <tr  align="center">
  		<td width="6%">No</td>
  		<td width="6%">Kode User</td>
        <td width="6%">Kode Karyawan</td>
 		<td width="13%">Nama User</td>
	  	<td width="6%">Username</td>
        <td width="6%">Passwod</td>
        <td width="3%">Aksi</td>
        
  </tr>
  </thead>
  <?php
  	$no=1;
  	$listUser=listUser();
	while ($data=mysqli_fetch_array($listUser)) {
	
  ?>
  <tr class="odd" style="border-bottom:1px solid #999;">
  	  	<td width="6%"> <?php echo $no; ?> </td>
        <td width="6%"> <?php echo $data['kode_user']; ?> </td>
 		<td width="13%"> <?php echo $data['kode_karyawan']; ?> </td>
	  	<td width="6%"> <?php echo $data['nama_user']; ?> </td>
        <td width="6%"> <?php echo $data['username']; ?> </td>
        <td width="6%"> <?php echo $data['password']; ?> </td>
        <td width="3%" align="center">
        		<a href="index.php?tag=user&aksi=edit&kode_user=<?php echo $data['kode_user']; ?>"><i class="fa fa-pencil" title="Edit"> </i></a>
        		&nbsp;&nbsp;
        		<a href="index.php?tag=user&aksi=delete&kode_user=<?php echo $data['kode_user']; ?>"><i class="fa fa-trash" title="Delete"> </i></a>
        </td>
  </tr>  
  <?php $no++; } ?>
	</table> </div>
<div class="agileits-box-body clearfix">
<div id="hero-area"></div>
</div>
</div>
</div>
<!--//four-grids here