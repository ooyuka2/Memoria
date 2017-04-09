<?php
	$todo = readCsvFile2('../data/todo.csv');
	$working = readCsvFile('../data/working.csv');
	function check_parent_do($todo, $child) {
		if($todo[$child]['level'] != 1) {
			$parent = $todo[$child]['parent'];
			$todo[$parent]['パーセンテージ'] += $todo[$child]['パーセンテージ']/$todo[$parent]['child'];
			writeCsvFile2("../data/todo.csv", $todo);
			
			//echo $todo[$parent]['id'];
			if($todo[$parent]['level']!=1) $todo = check_parent_do($todo, $parent);
		}
		return $todo;
	}
	
	
	if(isset($_GET['p'])) {//id,dictionary,author,year,commentary,floor,place,img
		$fdo = $_GET['f']-$todo[$_GET['p']]['パーセンテージ'];
		$todo[$_GET['p']]['パーセンテージ'] = $_GET['f'];
		$www = count($working);
		$working[$www]['id'] = $todo[$_GET['p']]['id'];
		$working[$www]['day'] = date('Y/m/d H:i:s');
		$working[$www]['per'] = $_GET['f'];
		writeCsvFile2("../data/working.csv", $working);
		if($todo[$_GET['p']]['level']!=1) {
			$parent = $todo[$_GET['p']]['parent'];
			$todo[$parent]['パーセンテージ'] += $fdo/$todo[$parent]['child'];
			//echo $todo[$parent]['id'];
			if($todo[$parent]['level']!=1) $todo = check_parent_do($todo, $parent);
		}
		writeCsvFile2("../data/todo.csv", $todo);
	}
	header( "Location: ./todo.php" );
	exit();
?>
		
