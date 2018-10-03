<?php

	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	include_once($ini['dirWin'].'/pages/function.php');
	
	$todo = readCsvFile2($link_data . 'todo.csv');


	if($_GET['type'] == "turn" && isset($_GET['turn']) && isset($_GET['p'])) {
		$todo[$_GET['p']]['������邱��'] = $_GET['turn'];
		writeCsvFile2($ini['dirWin']."/data/todo.csv", $todo);
	}
	
	if($_GET['type'] == "wait" && isset($_GET['p'])) {//id,dictionary,author,year,commentary,floor,place,img
		if($todo[$_GET['p']]['�ۗ�'] == 1) $todo = todo_wait_child($todo, $_GET['p'], 0);
		else {
			$todo = todo_wait_child($todo, $_GET['p'], 1);
			$todo[$_GET['p']]['������邱��'] = 0;
		}
		writeCsvFile2($link_data . 'todo.csv', $todo);
	}

	if($_GET['type'] == "nowait" && isset($_GET['p'])) {//id,dictionary,author,year,commentary,floor,place,img
		$todo[$_GET['p']]['�ۗ�'] = 0;
		writeCsvFile2($link_data . 'todo.csv', $todo);
	}
	
	function todo_wait_child($todo, $id, $wait) {
		$todo[$id]['�ۗ�'] = $wait;
		if($todo[$id]['child'] != 0) {
			for($i=1; $i<count($todo); $i++) {
				if($todo[$i]['parent']==$id && $todo[$i]['����']==0 && $todo[$i]['�폜']==0) {
					$todo = todo_wait_child($todo, $i, $wait);
				}
			}
		}
		return $todo;
	}
?>