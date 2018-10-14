<?php
	if(!isset($todo)) $todo = readCsvFile2('../data/todo.csv');
	date_default_timezone_set('Asia/Tokyo');
?>

<?php

	if($todo[$_GET['p']]['level'] == 1) {
		echo "<div class='clearfix'><a href='todo.php?d=change&p={$_GET['p']}&file={$file}' class='btn btn-info pull-right btn-sm'>編集</a><a href='todo.php?d=renew&p={$_GET['p']}&file={$file}' class='btn btn-warning pull-right btn-sm' style='margin:6 12px'>流用</a>";
		if(!(isset($_GET['d']) && $_GET['d']=="detail")) echo "<a href='todo.php?d=detail&p={$_GET['p']}&file={$file}' class='btn btn-primary pull-right btn-sm'>詳細</a>";
		echo "</div>";
	} else {
		echo "<div class='clearfix'><a href='/Memoria/MDBpages/todo.php?d=detail&p={$todo[$_GET['p']]['top']}&file={$file}'  class='btn btn-link pull-right btn-sm'>一番上の階層へ</a>";
		echo "<a href='/Memoria/MDBpages/todo.php?d=detail&p={$todo[$_GET['p']]['parent']}&file={$file}' class='btn btn-link pull-right btn-sm'>上の階層へ</a></div>";
	}

	panel_child($todo, $todo[$_GET['p']]['id'], $working, $file);

?>



<?php

function panel_child($todo, $todoid, $working, $file) {
	date_default_timezone_set('Asia/Tokyo');
	//echo $todo[12]['child'];
//	if($todo[$todoid]['child'] != 0) {
//		for($todoid=1; $todoid<count($todo); $todoid++) {
//			if($todo[$todoid]['parent']==$todoid && $todo[$todoid]['削除']==0) {

	$color = check_todo_color($todo, $todoid, date('Y/m/d'));
	//if($color == "future") $color = "";
	
	echo "<div class='card border-{$color} row col-12' style='padding:0'>";
	/*
	if($todo[$todoid]['level']==1) echo "<div class='card border-primary row col-12' style='padding:0'>";
	else if($finishday->diff($today->modify('+1 day'))->format('%r%a 日') >= 0) { echo "<div class='card border-success row col-12' style='padding:0'>"; }
	else if($finishday->diff($today->modify('+3 day'))->format('%r%a 日') >= 0) { echo "<div class='card border-warning row col-12' style='padding:0'>"; }
	else echo "<div class='card border-danger row col-12' style='padding:0'>";
	*/
	echo "<div class='card-header' id='todoid{$todo[$todoid]['id']}'>";
	echo "<div class='clearfix'><span class='pull-right close' onClick='todo_delete_check(&quot;{$todo[$todoid]['タイトル']}&quot;, &quot;{$todoid}&quot;)'>&times;</span><h3 class='card-title'>{$todo[$todoid]['タイトル']}</h3></div>";
	echo "</div>";
	echo "<div class='card-body row'>";
	echo "<div class='alert alert-dismissible alert-warning col-12' style='margin-bottom:0'>{$todo[$todoid]['作業内容']}</div>";
	if($todo[$todoid]['成果物']!="") {
		echo "<div class='alert alert-dismissible alert-info col-12' style='margin-bottom:0'><!--<strong style='font-size:150%'>成果物</strong>-->{$todo[$todoid]['成果物']}</div>";
	} 
	if($todo[$todoid]['所感']!="" && $todo[$todoid]['所感']!="no comment") {
		echo "<div class='alert alert-dismissible alert-danger col-12' style='margin-bottom:0'><!--<strong style='font-size:150%'>コメント</strong>-->{$todo[$todoid]['所感']}</div>";
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
		echo "<div class='alert alert-dismissible alert-success col-12' style='margin-bottom:0'>{$whendo}</div>";
	}
	
	echo "<div style='height:20px;'></div>";
	echo "<div class='col-9'><div class='progress'><div class='progress-bar progress-bar-striped progress-bar-animated bg-{$color}' role='progressbar' style='width: {$todo[$todoid]['パーセンテージ']}%;'>";
	echo "{$todo[$todoid]['パーセンテージ']}%";
	echo "</div></div></div>";
	if($todo[$todoid]['パーセンテージ']!=100) {
		echo "<div class='col-1'>";
		if($todo[$todoid]['child'] == 0) {
			echo "<button type='button' class='btn btn-default dropdown-toggle btn-sm' data-toggle='dropdown' aria-expanded='false'>作業<span class='caret'></span></button><ul class='dropdown-menu' role='menu'>";
			for($j=ceil($todo[$todoid]['パーセンテージ']/10)*10; $j<100; $j+=10) 
			echo "<li role='presentation'><a role='menuitem' tabindex='-1' href='todo.php?page=whatdo&p={$todoid}&f={$j}'>{$j}％まで完了</a></li>";
			echo "</ul>";
		}
		echo "</div>";

		if($todo[$todoid]['保留'] == 0) echo "<div class='col-1'><button class='btn btn-info btn-sm' onclick='todo_tree_wait({$todoid}, \"wait\", 0);setTimeout(\"location.reload()\",1000)'>保留</button></div>";
		else echo "<div class='col-1'><button class='btn btn-link btn-sm' onclick='todo_tree_wait({$todoid}, \"wait\", 0);setTimeout(\"location.reload()\",1000)'>解除</button></div>";
		echo "<div class='col-1'><a href='todo.php?page=whatdo&f=100&p={$todoid}&file={$file}' class='btn btn-success btn-sm'>完了</a></div>";
	} else {
		echo "<div class='col-1 pull-right'><a href='todo.php?page=whatdo&f=100&p={$todoid}&file={$file}' class='btn btn-success btn-sm'>完了</a></div>";
		echo "<div class='col-md-1 pull-right'><button class='btn btn-warning btn-sm' onclick='todo_tree_wait({$todoid}, \"nofinish\", 0);setTimeout(\"location.reload()\",1000)'>未完了</button></div>";
		
	}
	echo "<div style='height:50px;'></div>";
	//card_child($todo, $todo[$todoid]['id']);
	
	/*
	if($todo[$todoid]['child'] != 0) {
		for($i=1; $i<count($todo); $i++) {
			if($todo[$i]['parent']==$todoid && $todo[$i]['削除']==0) {
				card_child($todo, $todo[$i]['id'], $working);
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
	if($todo[$todoid]['level']==1) {
		date_default_timezone_set('Asia/Tokyo');
		if(!isset($ini)) $ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
		$weekly = readCsvFile2($ini['dirWin'].'/data/weekly.csv');
		$weeklyid = check2array($weekly, $todoid, "todoid");
		if($weeklyid != -1 && $weekly[$weeklyid]['表示'] == 0) {
			
			echo "<div class='alert alert-info  col-12' role='alert'><h5>週報（{$weekly[$weeklyid]['最終更新日時']}）</h5>";
			echo "<strong>KPI</strong>：　{$weekly[$weeklyid]['KPI']}<br>";
			echo "<strong>テーマ概要</strong>：　{$weekly[$weeklyid]['テーマ概要']}<br>";
			echo "<strong>担当</strong>：　{$weekly[$weeklyid]['担当']}<br>";
			echo "<strong>済み</strong>：　<br>";
			$workdetail = str_replace('<br>', '<br>　　　　', $weekly[$weeklyid]['済み']);
			echo "　　　　{$workdetail}<br><br>";
			echo "<strong>進捗</strong>：　<br>";
			$workdetail = str_replace('<br>', '<br>　　　　', $weekly[$weeklyid]['進捗']);
			echo "　　　　{$workdetail}<br><br>";
			echo "<strong>今後の予定</strong>：　<br>";
			$workdetail = str_replace('<br>', '<br>　　　　　　', $weekly[$weeklyid]['今後の予定']);
			echo "　　　　　　{$workdetail}<br><br>";
			
			
			echo "</div>";
		}
		
		
		
	}
	
	
	echo "</div>";
	echo "<div class='card-footer'>{$todo[$todoid]['開始予定日']}　～　{$todo[$todoid]['納期']} {$todo[$todoid]['納期時間']}</div>";
	echo "</div>";
				
//			}
//		}
//	}
	return $count;
}







?>
