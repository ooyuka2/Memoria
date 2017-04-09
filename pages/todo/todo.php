<?php
	for($i=1; $i<count($todo); $i++) {
		if($todo[$i]['level'] == 1 && $todo[$i]['完了']==0 && $todo[$i]['削除']==0) {
			
			echo "<div class='panel panel-primary'>";
			
			echo "<div class='panel-heading'>";
			echo "<a href='./todo.php?d=detail&p={$i}' style='color:#ffffff;'>";
			echo "<h3 class='panel-title'>{$todo[$i]['タイトル']}</h3>";
			echo "</a></div>";
			echo "<div class='panel-body'>";
			echo "{$todo[$i]['作業内容']}<br>";
			echo "<div class='col-xs-11'><div class='progress'><div class='progress-bar progress-bar-info progress-bar-striped active' role='progressbar' style='width: {$todo[$i]['パーセンテージ']}%;'>";
			echo "{$todo[$i]['パーセンテージ']}%";
			echo "</div></div></div>";
			if($todo[$i]['パーセンテージ']!=100) 
			echo "<div class='col-xs-1'><a href='todo.php?page=finish&p={$i}' class='btn btn-success'>完了</a></div>";//todo.php?page=finish
			echo "</div>";
			echo "<div class='panel-footer'>{$todo[$i]['開始予定日']}　～　{$todo[$i]['納期']} {$todo[$i]['納期時間']}</div>";
			echo "</div>";
		}
	}
?>