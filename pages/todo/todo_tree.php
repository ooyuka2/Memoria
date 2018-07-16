<?php
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	if(!isset($todo)) {
		include_once($ini['dirWin'].'/pages/function.php');
		header("Content-type: text/html; charset=SJIS-win");
		$todo = readCsvFile2($ini['dirWin'].'/data/todo.csv');
		if(isset($_GET['file']) && $_GET['file'] == "old201804") {
			$todo = readCsvFile2($ini['dirWin'].'/data/old201804todo.csv');
			$file = "old201804";
		} else {
			$todo = readCsvFile2($ini['dirWin'].'/data/todo.csv');
			$file = "todo";
		}
	}
	if(isset($_GET['d']) && $_GET['d']=="detail" && isset($_GET['p'])) $sa[0] = $todo[$_GET['p']]['top'];
	else if((isset($_GET['list']) && $_GET['list']=="finishlist") || (isset($_GET['p']) && $_GET['p'] != 0 && $todo[$todo[$_GET['p']]['top']]['КоЧ╣']==1))
		$sa = sort_by_noki_todo_priority($todo, false);
	else $sa = sort_by_noki_todo_priority($todo, true);
	for($i=0; $i<count($sa); $i++) {
		if($sa[$i]!=0) { 
			write_todo_tree($todo, $sa[$i], date('Y/m/d'));
		} else if($sa[$i]==0) {
			echo "<hr>";
		}
	}
	//$_GET['d']
	//$_GET['p']
	//$_GET['list']
?>