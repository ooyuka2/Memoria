<?php
	$pagetype = "MDBpages";
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	include_once($ini['dirWin'].'/pages/function.php');
	
	$todo = readCsvFile2($ini['dirWin'].'/data/todo.csv');
	$id = 0;
	for($i=count($todo)-1; $i>0; $i--) {
		if($todo[$i]['ƒe[ƒ}'] == $_GET['theme'] && $todo[$i]['íœ'] == 0) {
			$id = $i;
			header( "Location: /Memoria/MDBpages/todo.php?d=renew&p=".$id );
			exit();
		}
	}
	header( "Location: /Memoria/MDBpages/todo.php?d=new&theme=".$_GET['theme'] );
	exit();
?>