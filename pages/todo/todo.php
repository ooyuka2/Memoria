<?php
	//$sa = sort_by_noki_priority($todo);
	for($i=0; $i<count($sa); $i++) {
		if($todo[$sa[$i]]['level'] == 1 && $todo[$sa[$i]]['完了']==0 && $todo[$sa[$i]]['削除']==0) {
			
			echo "<div class='panel panel-primary'>";
			
			echo "<div class='panel-heading'>";
			echo "<a href='./todo.php?d=detail&p={$sa[$i]}' style='color:#ffffff;'>";
			echo "<h3 class='panel-title'>{$todo[$sa[$i]]['タイトル']}</h3>";
			echo "</a></div>";
			echo "<div class='panel-body'>";
			echo "{$todo[$sa[$i]]['作業内容']}<br>";
			echo "<div class='col-xs-11'><div class='progress'><div class='progress-bar progress-bar-info progress-bar-striped active' role='progressbar' style='width: {$todo[$sa[$i]]['パーセンテージ']}%;'>";
			echo "{$todo[$sa[$i]]['パーセンテージ']}%";
			echo "</div></div></div>";
			if($todo[$sa[$i]]['パーセンテージ']!=100) 
			echo "<div class='col-xs-1'><a href='todo.php?page=finish&p={$sa[$i]}' class='btn btn-success'>完了</a></div>";//todo.php?page=finish
			echo "</div>";
			echo "<div class='panel-footer'>{$todo[$sa[$i]]['開始予定日']}　～　{$todo[$sa[$i]]['納期']} {$todo[$sa[$i]]['納期時間']}</div>";
			echo "</div>";
		}
	}
?>