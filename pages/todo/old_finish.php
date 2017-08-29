
<?php

	
	if(isset($_GET['p']) && !isset($_GET['startTime']) && !isset($_GET['finishTime'])) {
		$working = readCsvFile2('../data/working.csv');
	} else if(isset($_GET['p']) && isset($_GET['startTime']) && isset($_GET['finishTime'])) {
		include('../function.php');
		$todo = readCsvFile2('../../data/todo.csv');
		$working = readCsvFile2('../../data/working.csv');
		//id,dictionary,author,year,commentary,floor,place,img
		$todo[$_GET['p']]['完了'] = 1;
		$fdo = 100-$todo[$_GET['p']]['パーセンテージ'];
		$todo[$_GET['p']]['パーセンテージ'] = 100;
		$www = count($working);
		$working[$www]['id'] = $todo[$_GET['p']]['id'];
		if(isset($_GET['date'])) $working[$www]['day'] = date($_GET['date']);
		else $working[$www]['day'] = date('Y/m/d H:i:s');
		$working[$www]['per'] = 100;
		$working[$www]['startTime'] = $_GET['startTime'];
		$working[$www]['finishTime'] = $_GET['finishTime'];
		$working[$www]['keeper'] = $_GET['keeper'];
		$working[$www]['note'] = "";//$_GET['note'];
		
		writeCsvFile2("../../data/working.csv", $working);
		$todo = check_child_finish($todo, $todo[$_GET['p']]['id']);
		if($todo[$_GET['p']]['level']!=1) {
			$todo = check_parent_finish($todo, $_GET['p'], $fdo);
		}
		writeCsvFile2("../../data/todo.csv", $todo);
		header( "Location: /Memoria/pages/todo.php?d=detail&p=".$todo[$_GET['p']]['top'] );
		exit();
	} else {
		header( "Location: /Memoria/pages/todo.php" );
		exit();
	}
	

?>
		
