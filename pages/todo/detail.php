<?php
	if(!isset($todo)) $todo = readCsvFile2('../data/todo.csv');
?>

<?php
	if($todo[$_GET['p']]['level'] == 1) {
		echo "<div class='clearfix'><a href='todo.php?d=change&p={$_GET['p']}' class='btn btn-info pull-right btn-sm'>�ҏW</a><a href='todo.php?d=renew&p={$_GET['p']}' class='btn btn-warning pull-right btn-sm' style='margin:0 10px'>���p</a>";
		if(!(isset($_GET['d']) && $_GET['d']=="detail")) echo "<a href='todo.php?d=detail&p={$_GET['p']}' class='btn btn-primary pull-right btn-sm'>�ڍ�</a>";
		echo "</div>";
	}
	echo "<div class='panel panel-primary'>";
	
	echo "<div class='panel-heading'>";
	echo "<div class='clearfix'><span class='pull-right close' onClick='todo_delete_check(&quot;{$todo[$_GET['p']]['�^�C�g��']}&quot;, &quot;{$_GET['p']}&quot;)'>&times;</span><h3 class='panel-title'>{$todo[$_GET['p']]['�^�C�g��']}</h3></div>";
	echo "</div>";
	echo "<div class='panel-body'>";
	echo "<div class='alert alert-dismissible alert-warning' style='margin-bottom:0'>{$todo[$_GET['p']]['��Ɠ��e']}</div>";
	if($todo[$_GET['p']]['���ʕ�']!="") {
		echo "<div class='alert alert-dismissible alert-info'><!--<strong style='font-size:150%'>���ʕ�</strong>-->{$todo[$_GET['p']]['���ʕ�']}</div>";
	} else echo "<div style='height:20px;'></div>";
	echo "<div class='col-xs-9'><div class='progress'><div class='progress-bar progress-bar-info progress-bar-striped active' role='progressbar' style='width: {$todo[$_GET['p']]['�p�[�Z���e�[�W']}%;'>";
	echo "{$todo[$_GET['p']]['�p�[�Z���e�[�W']}%";
	echo "</div></div></div>";
	if($todo[$_GET['p']]['�p�[�Z���e�[�W']!=100) {
		echo "<div class='col-xs-1'><button type='button' class='btn btn-default dropdown-toggle btn-sm' data-toggle='dropdown' aria-expanded='false'>���<span class='caret'></span></button><ul class='dropdown-menu' role='menu'>";
		for($j=ceil($todo[$_GET['p']]['�p�[�Z���e�[�W']/10)*10; $j<100; $j+=10) 
		echo "<li role='presentation'><a role='menuitem' tabindex='-1' href='todo.php?page=do&p={$_GET['p']}&f={$j}'>{$j}���܂Ŋ���</a></li>";
		echo "</ul></div>";
		if($todo[$_GET['p']]['�ۗ�'] == 0) echo "<div class='col-xs-1'><a href='todo.php?page=wait&p={$_GET['p']}' class='btn btn-info btn-sm'>�ۗ�</a></div>";
			else echo "<div class='col-xs-1'><a href='todo.php?page=wait&p={$_GET['p']}' class='btn btn-link btn-sm'>����</a></div>";
		echo "<div class='col-xs-1'><a href='todo.php?page=finish&p={$_GET['p']}' class='btn btn-success btn-sm'>����</a></div>";//todo.php?page=finish
	}
		echo "<div style='height:50px;'></div>";
	panel_child($todo, $todo[$_GET['p']]['id']);
	//echo "panel_child(\$todo, {$todo[$_GET['p']]['id']});";
	echo "</div>";
	echo "<div class='panel-footer'>{$todo[$_GET['p']]['�J�n�\���']}�@�`�@{$todo[$_GET['p']]['�[��']} {$todo[$_GET['p']]['�[������']}</div>";
	/*
	$day1 = new DateTime($todo[$_GET['p']]['�J�n�\���']);
	$day2 = new DateTime(date('Y/m/d'));
	$interval = $day1->diff($day2);
	echo $interval->format('%r%a ��');
	$week_str_list = array( '��', '��', '��', '��', '��', '��', '�y');
	$week_str = $week_str_list[ $day1->format('w') ];
	print_r($week_str);*/
	echo "</div>";
?>

