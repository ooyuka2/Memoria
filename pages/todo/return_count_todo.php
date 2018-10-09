<?php
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	include_once($ini['dirWin'].'/pages/function.php');
	$todo = readCsvFile2($ini['dirWin'].'/data/todo.csv');
	$tmp = count($todo);
	echo $tmp;
?>