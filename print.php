<?php //print $table;?>
<!DOCTYPE HTML>
<html>
<head>
<link href="../assets/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<link href="../assets/css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="../assets/libs/datatables/DataTables-1.10.16/css/table.css"/>
<script src="../assets/js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="../assets/libs/datatables/DataTables-1.10.16/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="../assets/libs/datatables/DataTables-1.10.16/js/dataTables.bootstrap.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
		$("#table").DataTable({
			"paging": false,
			"searching": false,
			"info": false,
			ordering: false
		});
	});
</script>
<?php 
//$exe = exec("D:/SERVER/Program/wkhtmltopdf/bin/wkhtmltopdf http://doc.qt.io/archives/qt-4.8/qstring.html files/tes.pdf");
?>
</head>
<body style="background:#FFF;">
<div class="text-center" style="text-align:center;margin-bottom:50px;">
	<h3>PT. Denpasar Agung Indah Motor</h3><br>
	<h1><?php echo $title; ?></h1><br>
	<p><?php echo "Periode $periode - $year ";?></p>
</div>
<div class="container">
	<p style="font-size:11px;float:right;margin:0px;padding:0px;"><?php echo date("d F Y");?> oleh <?php echo $_SESSION["nama"]; ?></p>
	<div style="clear:both;"></div>
	<hr>
	<table id="table" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <?php 
					$th = "";
					foreach($headers as $header){
						$th .= " <th>$header</th>";
					}
					
					print $th;
				?>
            </tr>
        </thead>
        <tfoot>
            <tr>
               <?php print $th; ?>
            </tr>
        </tfoot>
        <tbody>
			<?php 
			if(isset($table["data"]) && sizeof($table["data"])){
				foreach($table["data"] as $data){
					print "<tr>";
					if(is_array($data)){
						foreach($data as $td){
							print "<td> $td </td>";
						}
					}
					print "</tr>";
				}
			}
			?>
            
        </tbody>
    </table>
</div>
</body>
</html>