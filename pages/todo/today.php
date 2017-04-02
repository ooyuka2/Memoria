<?php
	for($i=0; $i<count($todo); $i++) {
		$day1 = new DateTime($todo[$i]['開始予定日']);
		$day2 = new DateTime(date('Y/m/d'));
		$interval = $day1->diff($day2);
		if($todo[$i]['完了']==0 && $interval->format('%r%a 日')>=0) { //$todo[$i]['level'] == 1 && 
			
			echo "<div class='panel panel-primary'>";
			
			echo "<div class='panel-heading'>";
			if($todo[$i]['level'] == 1) {
				echo "<a href='./todo.php?page=detail&p={$i}' style='color:#ffffff;'>";
				echo "<h3 class='panel-title'>{$todo[$i]['タイトル']}</h3>";
			}
			else {
				$b = $todo[$i]['top']-1;
				echo "<a href='./todo.php?page=detail&p={$b}' style='color:#ffffff;'>";
				echo "<h3 class='panel-title'>{$todo[$i]['タイトル']}<span class='pull-right'>:{$todo[$todo[$i]['top']]['タイトル']}</span></h3>";
			}
			echo "</a></div>";
			echo "<div class='panel-body'>";
			echo "{$todo[$i]['作業内容']}<br>";
			echo "<div class='col-xs-10'><div class='progress'><div class='progress-bar progress-bar-info progress-bar-striped active' role='progressbar' style='width: {$todo[$i]['パーセンテージ']}%;'>";
			echo "{$todo[$i]['パーセンテージ']}%";
			echo "</div></div></div>";
			echo "<div class='col-xs-1'><a href='todo.php?page=do&p={$i}' class='btn btn-default'>作業</a></div>";
			echo "<div class='col-xs-1'><a href='todo.php?page=finish&p={$i}' class='btn btn-success'>完了</a></div>";
			echo "</div>";
			echo "<div class='panel-footer'>{$todo[$i]['開始予定日']}　～　{$todo[$i]['納期']}</div>";
			echo "</div>";
		}
	}
?>