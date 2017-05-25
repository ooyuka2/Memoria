<?php
	$working = readCsvFile2('../data/working.csv');
	$c = 0;
	$ary = array();
	for($i=count($working)-1; $i>0; $i--) {
		if($todo[$todo[$working[$i]['id']]['top']]['完了'] == 1 && serch_word($todo[$working[$i]['id']]['top'], $ary)==0) {
			$ary[$c] = $todo[$working[$i]['id']]['top'];
			$c++;
			$top = $todo[$working[$i]['id']]['top'];
			echo "<div class='panel panel-primary'>";
			
			echo "<div class='panel-heading'>";
			echo "<a href='./todo.php?d=detail&p={$top}' style='color:#ffffff;'>";
			echo "<h3 class='panel-title'>{$todo[$top]['タイトル']}</h3>";
			echo "</a></div>";
			echo "<div class='panel-body'>";
			echo "{$todo[$top]['作業内容']}<br>";
			echo "<div class='col-xs-12'><div class='progress'><div class='progress-bar progress-bar-success progress-bar-striped active' role='progressbar' style='width: {$todo[$top]['パーセンテージ']}%;'>";
			echo "{$todo[$top]['パーセンテージ']}%";
			echo "</div></div></div>";
			echo "</div>";
			echo "<div class='panel-footer'>{$todo[$top]['開始予定日']}　～　{$todo[$top]['納期']}</div>";
			echo "</div>";
		}
	}
?>