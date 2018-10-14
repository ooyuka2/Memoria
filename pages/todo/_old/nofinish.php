<?php
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	include_once($ini['dirWin'].'/pages/function.php');

	if(isset($_GET['p'])) {

		$todo = readCsvFile2($ini['dirWin'].'/data/todo.csv');
		
		$todo[$_GET['p']]['パーセンテージ'] = 90;
		$todo[$_GET['p']]['完了'] = 0;

		$todo = check_parent_nofinish($todo, $_GET['p'], -10);
		writeCsvFile2($ini['dirWin']."/data/todo.csv", $todo);

	}
	
	header( "Location: /Memoria/pages/todo.php" );

	exit();

?>
		
