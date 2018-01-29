<script type="text/javascript">
    $(document).ready(function() {
		var table = $('#table1').dataTable({
			ajax: {
				url:  OwnerUrl + '/index.php?tag=karyawan&ajax=true',
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
<!--four-grids here-->
<div class="agileinfo-grap">
<div class="agileits-box">
<header class="agileits-box-header clearfix">
  <div class="grid-form1">
  	       <h3>Data Karyawan</h3>
  	         <div class="tab-content">
    
    <table width="100%" id="table1">
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