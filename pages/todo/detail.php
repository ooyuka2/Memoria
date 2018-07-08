<?php
	if(!isset($todo)) $todo = readCsvFile2('../data/todo.csv');
?>

<?php

	if($todo[$_GET['p']]['level'] == 1) {
		echo "<div class='clearfix'><a href='todo.php?d=change&p={$_GET['p']}&file={$file}' class='btn btn-info pull-right btn-sm'>編集</a><a href='todo.php?d=renew&p={$_GET['p']}&file={$file}' class='btn btn-warning pull-right btn-sm' style='margin:0 10px'>流用</a>";
		if(!(isset($_GET['d']) && $_GET['d']=="detail")) echo "<a href='todo.php?d=detail&p={$_GET['p']}&file={$file}' class='btn btn-primary pull-right btn-sm'>詳細</a>";
		echo "</div>";
	} else {
		echo "<div class='clearfix'><a href='/Memoria/pages/todo.php?d=detail&p={$todo[$_GET['p']]['top']}&file={$file}'  class='btn btn-link pull-right btn-sm'>一番上の階層へ</a>";
		echo "<a href='/Memoria/pages/todo.php?d=detail&p={$todo[$_GET['p']]['parent']}&file={$file}' class='btn btn-link pull-right btn-sm'>上の階層へ</a></div>";
	}

	panel_child($todo, $todo[$_GET['p']]['id'], $working, $file);

?>



<?php

function panel_child($todo, $todoid, $working, $file) {
	//echo $todo[12]['child'];
//	if($todo[$todoid]['child'] != 0) {
//		for($todoid=1; $todoid<count($todo); $todoid++) {
//			if($todo[$todoid]['parent']==$todoid && $todo[$todoid]['削除']==0) {
				if($todo[$todoid]['level']==1) echo "<div class='panel panel-primary'>";
				else if($todo[$todoid]['完了']==1) { echo "<div class='panel panel-success'>"; }
				else echo "<div class='panel panel-danger'>";
				echo "<div class='panel-heading' id='todoid{$todo[$todoid]['id']}'>";
				echo "<div class='clearfix'><span class='pull-right close' onClick='todo_delete_check(&quot;{$todo[$todoid]['タイトル']}&quot;, &quot;{$todoid}&quot;)'>&times;</span><h3 class='panel-title'>{$todo[$todoid]['タイトル']}</h3></div>";
				echo "</div>";
				echo "<div class='panel-body'>";
				echo "<div class='alert alert-dismissible alert-warning' style='margin-bottom:0'>{$todo[$todoid]['作業内容']}</div>";
				if($todo[$todoid]['成果物']!="") {
					echo "<div class='alert alert-dismissible alert-info' style='margin-bottom:0'><!--<strong style='font-size:150%'>成果物</strong>-->{$todo[$todoid]['成果物']}</div>";
				} 
				if($todo[$todoid]['所感']!="" && $todo[$todoid]['所感']!="no comment") {
					echo "<div class='alert alert-dismissible alert-danger' style='margin-bottom:0'><!--<strong style='font-size:150%'>コメント</strong>-->{$todo[$todoid]['所感']}</div>";
				}
				$whendo = "";
				for($i=1; $i<count($working); $i++) {
					if ($working[$i]['id'] == $todoid) {
						if($whendo != "") $whendo = $whendo." : ";
						$comDay = new DateTime($working[$i]['day']);
						$comDay = $comDay->format('Y/m/d');
						$whendo = $whendo.$comDay;
					}
				}
				if($whendo != "") {
					echo "<div class='alert alert-dismissible alert-success' style='margin-bottom:0'>{$whendo}</div>";
				}
				echo "<div style='height:20px;'></div>";
				echo "<div class='col-xs-9'><div class='progress'><div class='progress-bar progress-bar-info progress-bar-striped active' role='progressbar' style='width: {$todo[$todoid]['パーセンテージ']}%;'>";
				echo "{$todo[$todoid]['パーセンテージ']}%";
				echo "</div></div></div>";
				if($todo[$todoid]['パーセンテージ']!=100) {
					echo "<div class='col-xs-1'>";
					if($todo[$todoid]['child'] == 0) {
						echo "<button type='button' class='btn btn-default dropdown-toggle btn-xs' data-toggle='dropdown' aria-expanded='false'>作業<span class='caret'></span></button><ul class='dropdown-menu' role='menu'>";
						for($j=ceil($todo[$todoid]['パーセンテージ']/10)*10; $j<100; $j+=10) 
						echo "<li role='presentation'><a role='menuitem' tabindex='-1' href='todo.php?page=whatdo&p={$todoid}&f={$j}'>{$j}％まで完了</a></li>";
						echo "</ul>";
					}
					echo "</div>";

					if($todo[$todoid]['保留'] == 0) echo "<div class='col-xs-1'><a href='todo.php?page=wait&p={$todoid}&file={$file}' class='btn btn-info btn-xs'>保留</a></div>";
					else echo "<div class='col-xs-1'><a href='todo.php?page=wait&p={$todoid}&file={$file}' class='btn btn-link btn-xs'>解除</a></div>";
					echo "<div class='col-xs-1'><a href='todo.php?page=whatdo&f=100&p={$todoid}&file={$file}' class='btn btn-success btn-xs'>完了</a></div>";
				} else {
					echo "<div class='col-xs-1 pull-right'><a href='todo.php?page=whatdo&f=100&p={$todoid}&file={$file}' class='btn btn-success btn-xs'>完了</a></div>";
					echo "<div class='col-md-1 pull-right'><a href='./todo/nofinish.php?p={$todoid}' class='btn btn-warning btn-xs'>未完了</a></div>";
				}
				echo "<div style='height:50px;'></div>";
				//panel_child($todo, $todo[$todoid]['id']);
				
				/*
				if($todo[$todoid]['child'] != 0) {
					for($i=1; $i<count($todo); $i++) {
						if($todo[$i]['parent']==$todoid && $todo[$i]['削除']==0) {
							panel_child($todo, $todo[$i]['id'], $working);
						}
					}
				}*/
				
				$count = $todo[$todoid]['順番']+1;
				$next_id = todo_next_child($todo, $todoid, $count);
				while($next_id != 0) {
					//$count = write_todo_tree($todo, $next_id, $date);
					$count = panel_child($todo, $todo[$next_id]['id'], $working, $file);
					//$count++;
					$next_id = todo_next_child($todo, $todoid, $count);
				}
				
				
				echo "</div>";
				echo "<div class='panel-footer'>{$todo[$todoid]['開始予定日']}　～　{$todo[$todoid]['納期']} {$todo[$todoid]['納期時間']}</div>";
				echo "</div>";
				
//			}
//		}
//	}
	return $count;
}







?>
