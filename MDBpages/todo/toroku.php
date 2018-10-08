<?php
	if(!isset($ini)) $ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	$pagetype = "MDBpages";
	
	if($_GET['toroku'] == "toroku") {
		include($ini['dirWin'].'/pages/todo/toroku.php');
	} else if($_GET['toroku'] == "toroku2") {
		include($ini['dirWin'].'/pages/todo/toroku2.php');
	} else {
		header( "Location: /Memoria/mdbpages/Error.php" );
		exit();
	}

?>