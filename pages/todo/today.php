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
	$sa = sort_by_noki_priority($todo);
	for($i=0; $i<count($sa); $i++) {
		date_default_timezone_set('Asia/Tokyo');
		$day1 = new DateTime($todo[$sa[$i]]['ŠJŽn—\’è“ú']);
		$day2 = new DateTime(date('Y/m/d'));
		$interval = $day1->diff($day2);
		if($todo[$sa[$i]]['Š®—¹']==0 && $interval->format('%r%a “ú')>=0 && $todo[$sa[$i]]['•Û—¯']==0 && $todo[$sa[$i]]['child']==0 && $todo[$sa[$i]]['íœ']==0) { //$todo[$i]['level'] == 1 && 
			$finishday = new DateTime($todo[$sa[$i]]['”[Šú']);
			$today = new DateTime(date('Y/m/d'));
			if($finishday->diff($day2->modify('+1 day'))->format('%r%a “ú') >= 0) {
				last_todo_panel($todo, $sa[$i],'primary', 'todo');
			}else if($finishday->diff($today->modify('+3 day'))->format('%r%a “ú') >= 0) {
				last_todo_panel($todo, $sa[$i],'warning', 'todo');
			} else {
				last_todo_panel($todo, $sa[$i],'danger', 'todo');
			}
		}
	}
	for($i=0; $i<count($sa); $i++) {
		$day1 = new DateTime($todo[$sa[$i]]['ŠJŽn—\’è“ú']);
		$day2 = new DateTime(date('Y/m/d'));
		$interval = $day1->diff($day2);
		if ($todo[$sa[$i]]['Š®—¹']==0 && $interval->format('%r%a “ú')>=0 && $todo[$sa[$i]]['•Û—¯']==1 && $todo[$sa[$i]]['child']==0 && $todo[$sa[$i]]['íœ']==0) {
			last_todo_panel($todo, $sa[$i], 'info', 'todo');
		}
	}
?>

