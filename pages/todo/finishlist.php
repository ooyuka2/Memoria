<?php
	//$todo = readCsvFile2('../data/todo.csv');
	for($i=count($todo)-1; $i>0; $i--) {
		if($todo[$i]['level'] == 1 && $todo[$i]['完了']==1 && $todo[$i]['削除']==0) {
			
			echo "<div class='panel panel-primary'>";
			
			echo "<div class='panel-heading'>";
			echo "<a href='./todo.php?d=detail&p={$i}' style='color:#ffffff;'>";
			echo "<h3 class='panel-title'>{$todo[$i]['タイトル']}</h3>";
			echo "</a></div>";
			echo "<div class='panel-body'>";
			echo "{$todo[$i]['作業内容']}<br>";
			echo "<div class='col-xs-12'><div class='progress'><div class='progress-bar progress-bar-success progress-bar-striped active' role='progressbar' style='width: {$todo[$i]['パーセンテージ']}%;'>";
			echo "{$todo[$i]['パーセンテージ']}%";
			echo "</div></div></div>";
			echo "</div>";
			echo "<div class='panel-footer'>{$todo[$i]['開始予定日']}　～　{$todo[$i]['納期']}</div>";
			echo "</div>";
		}
	}
?>