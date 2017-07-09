<?php
	$todo = readCsvFile2('../data/todo.csv');
?>

<?php
	echo "<div class='clearfix'><a href='todo.php?d=change&p={$_GET['p']}' class='btn btn-info pull-right'>編集</a><a href='todo.php?d=renew&p={$_GET['p']}' class='btn btn-warning pull-right' style='margin:0 10px'>流用</a></div>";
	echo "<div class='panel panel-primary'>";
	
	echo "<div class='panel-heading'>";
	echo "<div class='clearfix'><span class='pull-right close' onClick='todo_delete_check(&quot;{$todo[$_GET['p']]['タイトル']}&quot;, &quot;{$_GET['p']}&quot;)'>&times;</span><h3 class='panel-title'>{$todo[$_GET['p']]['タイトル']}</h3></div>";
	echo "</div>";
	echo "<div class='panel-body'>";
	echo "<div class='alert alert-dismissible alert-warning' style='margin-bottom:0'>{$todo[$_GET['p']]['作業内容']}</div>";
	if($todo[$_GET['p']]['成果物']!="") {
		echo "<div class='alert alert-dismissible alert-info'><!--<strong style='font-size:150%'>成果物</strong>-->{$todo[$_GET['p']]['成果物']}</div>";
	} else echo "<div style='height:20px;'></div>";
	echo "<div class='col-xs-11'><div class='progress'><div class='progress-bar progress-bar-info progress-bar-striped active' role='progressbar' style='width: {$todo[$_GET['p']]['パーセンテージ']}%;'>";
	echo "{$todo[$_GET['p']]['パーセンテージ']}%";
	echo "</div></div></div>";
	if($todo[$_GET['p']]['パーセンテージ']!=100) 
	echo "<div class='col-xs-1'><a href='todo.php?page=finish&p={$_GET['p']}' class='btn btn-success'>完了</a></div>";//todo.php?page=finish
	echo "<div style='height:50px;'></div>";
	panel_child($todo, $todo[$_GET['p']]['id']);
	//echo "panel_child(\$todo, {$todo[$_GET['p']]['id']});";
	echo "</div>";
	echo "<div class='panel-footer'>{$todo[$_GET['p']]['開始予定日']}　～　{$todo[$_GET['p']]['納期']} {$todo[$_GET['p']]['納期時間']}</div>";
	/*
	$day1 = new DateTime($todo[$_GET['p']]['開始予定日']);
	$day2 = new DateTime(date('Y/m/d'));
	$interval = $day1->diff($day2);
	echo $interval->format('%r%a 日');
	$week_str_list = array( '日', '月', '火', '水', '木', '金', '土');
	$week_str = $week_str_list[ $day1->format('w') ];
	print_r($week_str);*/
	echo "</div>";
?>

