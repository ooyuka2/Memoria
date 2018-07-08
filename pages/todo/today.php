<?php

	if(!isset($todo)) {
		include_once('../function.php');
		header("Content-type: text/html; charset=SJIS-win");
		$todo = readCsvFile2('../../data/todo.csv');
	}
	$sa = sort_by_noki_priority($todo);
	for($i=0; $i<count($sa); $i++) {
		date_default_timezone_set('Asia/Tokyo');
		$day1 = new DateTime($todo[$sa[$i]]['�J�n�\���']);
		$day2 = new DateTime(date('Y/m/d'));
		$interval = $day1->diff($day2);
		if($todo[$sa[$i]]['����']==0 && $interval->format('%r%a ��')>=0 && $todo[$sa[$i]]['�ۗ�']==0 && $todo[$sa[$i]]['child']==0 && $todo[$sa[$i]]['�폜']==0) { //$todo[$i]['level'] == 1 && 
			$finishday = new DateTime($todo[$sa[$i]]['�[��']);
			$today = new DateTime(date('Y/m/d'));
			if($finishday->diff($day2->modify('+1 day'))->format('%r%a ��') >= 0) {
				last_todo_panel($todo, $sa[$i],'primary', 'todo');
			}else if($finishday->diff($today->modify('+3 day'))->format('%r%a ��') >= 0) {
				last_todo_panel($todo, $sa[$i],'warning', 'todo');
			} else {
				last_todo_panel($todo, $sa[$i],'danger', 'todo');
			}
		}
	}
	for($i=0; $i<count($sa); $i++) {
		$day1 = new DateTime($todo[$sa[$i]]['�J�n�\���']);
		$day2 = new DateTime(date('Y/m/d'));
		$interval = $day1->diff($day2);
		if ($todo[$sa[$i]]['����']==0 && $interval->format('%r%a ��')>=0 && $todo[$sa[$i]]['�ۗ�']==1 && $todo[$sa[$i]]['child']==0 && $todo[$sa[$i]]['�폜']==0) {
			last_todo_panel($todo, $sa[$i], 'info', 'todo');
		}
	}
?>

