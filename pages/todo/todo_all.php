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
		if($todo[$sa[$i]]['level'] == 1 && $todo[$sa[$i]]['����']==0 && $todo[$sa[$i]]['�폜']==0) {
			
			echo "<div class='panel panel-primary' id='todoid{$todo[$sa[$i]]['id']}'>";
			
			echo "<div class='panel-heading'>";
			echo "<a href='./todo.php?d=detail&p={$sa[$i]}' style='color:#ffffff;'>";
			echo "<h3 class='panel-title'>{$todo[$sa[$i]]['�^�C�g��']}</h3>";
			echo "</a></div>";
			echo "<div class='panel-body'>";
			echo "{$todo[$sa[$i]]['��Ɠ��e']}<br>";
			echo "<div class='col-xs-11'><div class='progress'><div class='progress-bar progress-bar-info progress-bar-striped active' role='progressbar' style='width: {$todo[$sa[$i]]['�p�[�Z���e�[�W']}%;'>";
			echo "{$todo[$sa[$i]]['�p�[�Z���e�[�W']}%";
			echo "</div></div></div>";
			if($todo[$sa[$i]]['�p�[�Z���e�[�W']!=100) 
			echo "<div class='col-xs-1'><a href='todo.php?page=finish&p={$sa[$i]}' class='btn btn-success'>����</a></div>";//todo.php?page=finish
			echo "</div>";
			echo "<div class='panel-footer'>{$todo[$sa[$i]]['�J�n�\���']}�@�`�@{$todo[$sa[$i]]['�[��']} {$todo[$sa[$i]]['�[������']}</div>";
			echo "</div>";
		}
	}
?>