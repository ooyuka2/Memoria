<?php
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	include_once($ini['dirWin'].'/pages/function.php');

	if(isset($_GET['p'])) {

		$todo = readCsvFile2($ini['dirWin'].'/data/todo.csv');
		
		$todo[$_GET['p']]['パーセンテージ'] = 90;
		$todo[$_GET['p']]['完了'] = 0;
		
		//$fdo = $_POST['f']-$todo[$_POST['p']]['パーセンテージ'];
		//$todo[$_POST['p']]['パーセンテージ'] = $_POST['f'];

		//if($_POST['f']<100) {
		//	$todo = check_child_do($todo, $_POST['p'], $fdo);
		//	$todo = check_parent_do($todo, $_POST['p'], $fdo);
		//} else {
		//	$todo[$_POST['p']]['完了'] = 1;
		//	$todo = check_child_finish($todo, $todo[$_POST['p']]['id']);
		//	$todo = check_parent_finish($todo, $_POST['p'], $fdo);
		//}
		$todo = check_parent_nofinish($todo, $_GET['p'], -10);
		writeCsvFile2($ini['dirWin']."/data/todo.csv", $todo);

	}
	
	header( "Location: /Memoria/pages/todo.php" );

	exit();

?>
		
