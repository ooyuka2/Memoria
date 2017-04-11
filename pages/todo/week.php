<?php //$day2 = $day2->modify('friday this week'); ?>
<?php
	for($i=1; $i<count($todo); $i++) {
		date_default_timezone_set('Asia/Tokyo');
		$day1 = new DateTime($todo[$i]['開始予定日']);
		$day2 = new DateTime(date('Y/m/d'));
		$day2 = $day2->modify('friday this week'); 
		$interval = $day1->diff($day2);
		if($todo[$i]['完了']==0 && $interval->format('%r%a 日')>=0 && $todo[$i]['保留']==0 && $todo[$i]['child']==0 && $todo[$i]['削除']==0) { //$todo[$i]['level'] == 1 && 
			
			echo "<div class='panel panel-primary'>";
			
			echo "<div class='panel-heading'>";
			if($todo[$i]['level'] == 1) {
				echo "<a href='./todo.php?d=detail&p={$i}' style='color:#ffffff;'>";
				echo "<h3 class='panel-title'>{$todo[$i]['タイトル']}</h3>";
			}
			else {
				$b = $todo[$i]['top'];
				echo "<a href='./todo.php?d=detail&p={$b}' style='color:#ffffff;'>";
				echo "<h3 class='panel-title'>{$todo[$i]['タイトル']}<span class='pull-right'>{$todo[$todo[$i]['top']]['タイトル']}</span></h3>";
			}
			echo "</a></div>";
			echo "<div class='panel-body'>";
			echo "";
			echo "<div class='col-md-9 col-xs-6'><strong>作業内容　: </strong>{$todo[$i]['作業内容']}<br><strong>成果物　　: </strong>{$todo[$i]['成果物']}<br><strong>期間　　　: </strong>{$todo[$i]['開始予定日']}　～　{$todo[$i]['納期']}</div>";
			//echo "<div class='col-md-1 col-xs-2'><a href='todo.php?page=do&p={$i}' class='btn btn-default'>作業</a></div>";
			echo "<div class='btn-group col-md-1 col-xs-2'><button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>作業 <span class='caret'></span></button><ul class='dropdown-menu' role='menu'>";
			for($j=ceil($todo[$i]['パーセンテージ']/10)*10; $j<100; $j+=10) 
			echo "<li role='presentation'><a role='menuitem' tabindex='-1' href='todo.php?page=do&p={$i}&f={$j}'>{$j}％まで完了</a></li>";
			echo "</ul></div>";
			echo "<div class='col-md-1 col-xs-2'><a href='todo.php?page=wait&p={$i}' class='btn btn-warning'>保留</a></div>";
			echo "<div class='col-md-1 col-xs-2'><a href='todo.php?page=finish&p={$i}' class='btn btn-success'>完了</a></div>";
			echo "</div>";
			echo "</div>";
		}
	}
	for($i=1; $i<count($todo); $i++) {
		$day1 = new DateTime($todo[$i]['開始予定日']);
		$day2 = new DateTime(date('Y/m/d'));
		$interval = $day1->diff($day2);
		if ($todo[$i]['完了']==0 && $interval->format('%r%a 日')>=0 && $todo[$i]['保留']==1 && $todo[$i]['child']==0 && $todo[$i]['削除']==0) {
			echo "<div class='panel panel-info'>";
			
			echo "<div class='panel-heading'>";
			if($todo[$i]['level'] == 1) {
				echo "<a href='./todo.php?d=detail&p={$i}'>"; // style='color:#ffffff;'
				echo "<h3 class='panel-title'>{$todo[$i]['タイトル']}</h3>";
			}
			else {
				$b = $todo[$i]['top'];
				echo "<a href='./todo.php?d=detail&p={$b}'>";
				echo "<h3 class='panel-title'>{$todo[$i]['タイトル']}<span class='pull-right'>{$todo[$todo[$i]['top']]['タイトル']}</span></h3>";
			}
			echo "</a></div>";
			echo "<div class='panel-body'>";
			echo "";
			echo "<div class='col-md-9 col-xs-6'><strong>作業内容　: </strong>{$todo[$i]['作業内容']}<br><strong>成果物　　: </strong>{$todo[$i]['成果物']}<br><strong>期間　　　: </strong>{$todo[$i]['開始予定日']}　～　{$todo[$i]['納期']}</div>";
			echo "<div class='btn-group col-md-1 col-xs-2'><button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>作業 <span class='caret'></span></button><ul class='dropdown-menu' role='menu'>";
			for($j=ceil($todo[$i]['パーセンテージ']/10)*10; $j<100; $j+=10) 
			echo "<li role='presentation'><a role='menuitem' tabindex='-1' href='todo.php?page=do&p={$i}&f={$j}'>{$j}％まで完了</a></li>";
			echo "</ul></div>";
			echo "<div class='col-md-1 col-xs-2'><a href='todo.php?page=nowait&p={$i}' class='btn btn-warning'>解除</a></div>";
			echo "<div class='col-md-1 col-xs-2'><a href='todo.php?page=finish&p={$i}' class='btn btn-success'>完了</a></div>";
			
			echo "</div>";
			echo "</div>";
		}
	}
?>

