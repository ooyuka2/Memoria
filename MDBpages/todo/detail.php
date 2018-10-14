<?php
	if(!isset($todo)) $todo = readCsvFile2('../data/todo.csv');
	date_default_timezone_set('Asia/Tokyo');
?>

<?php

	if($todo[$_GET['p']]['level'] == 1) {
		echo "<div class='clearfix'><a href='todo.php?d=change&p={$_GET['p']}&file={$file}' class='btn btn-info pull-right btn-sm'>�ҏW</a><a href='todo.php?d=renew&p={$_GET['p']}&file={$file}' class='btn btn-warning pull-right btn-sm' style='margin:6 12px'>���p</a>";
		if(!(isset($_GET['d']) && $_GET['d']=="detail")) echo "<a href='todo.php?d=detail&p={$_GET['p']}&file={$file}' class='btn btn-primary pull-right btn-sm'>�ڍ�</a>";
		echo "</div>";
	} else {
		echo "<div class='clearfix'><a href='/Memoria/MDBpages/todo.php?d=detail&p={$todo[$_GET['p']]['top']}&file={$file}'  class='btn btn-link pull-right btn-sm'>��ԏ�̊K�w��</a>";
		echo "<a href='/Memoria/MDBpages/todo.php?d=detail&p={$todo[$_GET['p']]['parent']}&file={$file}' class='btn btn-link pull-right btn-sm'>��̊K�w��</a></div>";
	}

	panel_child($todo, $todo[$_GET['p']]['id'], $working, $file);

?>



<?php

function panel_child($todo, $todoid, $working, $file) {
	date_default_timezone_set('Asia/Tokyo');
	//echo $todo[12]['child'];
//	if($todo[$todoid]['child'] != 0) {
//		for($todoid=1; $todoid<count($todo); $todoid++) {
//			if($todo[$todoid]['parent']==$todoid && $todo[$todoid]['�폜']==0) {

	$color = check_todo_color($todo, $todoid, date('Y/m/d'));
	//if($color == "future") $color = "";
	
	echo "<div class='card border-{$color} row col-12' style='padding:0'>";
	/*
	if($todo[$todoid]['level']==1) echo "<div class='card border-primary row col-12' style='padding:0'>";
	else if($finishday->diff($today->modify('+1 day'))->format('%r%a ��') >= 0) { echo "<div class='card border-success row col-12' style='padding:0'>"; }
	else if($finishday->diff($today->modify('+3 day'))->format('%r%a ��') >= 0) { echo "<div class='card border-warning row col-12' style='padding:0'>"; }
	else echo "<div class='card border-danger row col-12' style='padding:0'>";
	*/
	echo "<div class='card-header' id='todoid{$todo[$todoid]['id']}'>";
	echo "<div class='clearfix'><span class='pull-right close' onClick='todo_delete_check(&quot;{$todo[$todoid]['�^�C�g��']}&quot;, &quot;{$todoid}&quot;)'>&times;</span><h3 class='card-title'>{$todo[$todoid]['�^�C�g��']}</h3></div>";
	echo "</div>";
	echo "<div class='card-body row'>";
	echo "<div class='alert alert-dismissible alert-warning col-12' style='margin-bottom:0'>{$todo[$todoid]['��Ɠ��e']}</div>";
	if($todo[$todoid]['���ʕ�']!="") {
		echo "<div class='alert alert-dismissible alert-info col-12' style='margin-bottom:0'><!--<strong style='font-size:150%'>���ʕ�</strong>-->{$todo[$todoid]['���ʕ�']}</div>";
	} 
	if($todo[$todoid]['����']!="" && $todo[$todoid]['����']!="no comment") {
		echo "<div class='alert alert-dismissible alert-danger col-12' style='margin-bottom:0'><!--<strong style='font-size:150%'>�R�����g</strong>-->{$todo[$todoid]['����']}</div>";
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
	echo "<div class='col-9'><div class='progress'><div class='progress-bar progress-bar-striped progress-bar-animated bg-{$color}' role='progressbar' style='width: {$todo[$todoid]['�p�[�Z���e�[�W']}%;'>";
	echo "{$todo[$todoid]['�p�[�Z���e�[�W']}%";
	echo "</div></div></div>";
	if($todo[$todoid]['�p�[�Z���e�[�W']!=100) {
		echo "<div class='col-1'>";
		if($todo[$todoid]['child'] == 0) {
			echo "<button type='button' class='btn btn-default dropdown-toggle btn-sm' data-toggle='dropdown' aria-expanded='false'>���<span class='caret'></span></button><ul class='dropdown-menu' role='menu'>";
			for($j=ceil($todo[$todoid]['�p�[�Z���e�[�W']/10)*10; $j<100; $j+=10) 
			echo "<li role='presentation'><a role='menuitem' tabindex='-1' href='todo.php?page=whatdo&p={$todoid}&f={$j}'>{$j}���܂Ŋ���</a></li>";
			echo "</ul>";
		}
		echo "</div>";

		if($todo[$todoid]['�ۗ�'] == 0) echo "<div class='col-1'><button class='btn btn-info btn-sm' onclick='todo_tree_wait({$todoid}, \"wait\", 0);setTimeout(\"location.reload()\",1000)'>�ۗ�</button></div>";
		else echo "<div class='col-1'><button class='btn btn-link btn-sm' onclick='todo_tree_wait({$todoid}, \"wait\", 0);setTimeout(\"location.reload()\",1000)'>����</button></div>";
		echo "<div class='col-1'><a href='todo.php?page=whatdo&f=100&p={$todoid}&file={$file}' class='btn btn-success btn-sm'>����</a></div>";
	} else {
		echo "<div class='col-1 pull-right'><a href='todo.php?page=whatdo&f=100&p={$todoid}&file={$file}' class='btn btn-success btn-sm'>����</a></div>";
		echo "<div class='col-md-1 pull-right'><button class='btn btn-warning btn-sm' onclick='todo_tree_wait({$todoid}, \"nofinish\", 0);setTimeout(\"location.reload()\",1000)'>������</button></div>";
		
	}
	echo "<div style='height:50px;'></div>";
	//card_child($todo, $todo[$todoid]['id']);
	
	/*
	if($todo[$todoid]['child'] != 0) {
		for($i=1; $i<count($todo); $i++) {
			if($todo[$i]['parent']==$todoid && $todo[$i]['�폜']==0) {
				card_child($todo, $todo[$i]['id'], $working);
			}
		}
	}*/
	
	$count = $todo[$todoid]['����']+1;
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
		if($weeklyid != -1 && $weekly[$weeklyid]['�\��'] == 0) {
			
			echo "<div class='alert alert-info  col-12' role='alert'><h5>�T��i{$weekly[$weeklyid]['�ŏI�X�V����']}�j</h5>";
			echo "<strong>KPI</strong>�F�@{$weekly[$weeklyid]['KPI']}<br>";
			echo "<strong>�e�[�}�T�v</strong>�F�@{$weekly[$weeklyid]['�e�[�}�T�v']}<br>";
			echo "<strong>�S��</strong>�F�@{$weekly[$weeklyid]['�S��']}<br>";
			echo "<strong>�ς�</strong>�F�@<br>";
			$workdetail = str_replace('<br>', '<br>�@�@�@�@', $weekly[$weeklyid]['�ς�']);
			echo "�@�@�@�@{$workdetail}<br><br>";
			echo "<strong>�i��</strong>�F�@<br>";
			$workdetail = str_replace('<br>', '<br>�@�@�@�@', $weekly[$weeklyid]['�i��']);
			echo "�@�@�@�@{$workdetail}<br><br>";
			echo "<strong>����̗\��</strong>�F�@<br>";
			$workdetail = str_replace('<br>', '<br>�@�@�@�@�@�@', $weekly[$weeklyid]['����̗\��']);
			echo "�@�@�@�@�@�@{$workdetail}<br><br>";
			
			
			echo "</div>";
		}
		
		
		
	}
	
	
	echo "</div>";
	echo "<div class='card-footer'>{$todo[$todoid]['�J�n�\���']}�@�`�@{$todo[$todoid]['�[��']} {$todo[$todoid]['�[������']}</div>";
	echo "</div>";
				
//			}
//		}
//	}
	return $count;
}







?>
