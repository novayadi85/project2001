<?php
    global $mysqli;
	$Connection = new \SqlFire\Connection();
	$mysqli = $Connection->connect();
	
	error_reporting(false);
	//Panggil Class
	$Helper = new \SqlFire\Helper();
	$Constant = new \SqlFire\Constant();
	$Constant->path = "D:/INDOSOFT-KOMANG/server/xampp7/htdocs/penggajian/wkhtmltopdf/bin/wkhtmltopdf";
?>