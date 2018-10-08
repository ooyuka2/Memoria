<?php
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	include_once($ini['dirWin'].'/pages/function.php');
	include($ini['dirWin'].'/pages/todo/do.php');
?>
		
