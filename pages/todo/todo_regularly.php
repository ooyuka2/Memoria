<?php
	
	date_default_timezone_set('Asia/Tokyo');
	$pagetype = $_GET['pagetype'];
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	include_once($ini['dirWin'].'/pages/function.php');
	header("Content-type: text/html; charset=SJIS-win");
	
	
	//$todo = readCsvFile2($ini['dirWin'].'/data/todo.csv');
	$working = readCsvFile2($ini['dirWin'].'/data/working.csv');
	$periodically = readCsvFile2($ini['dirWin'].'/data/periodically.csv');
	$today = new DateTime(date('Ymd'));
	$week_str_list = array( '日', '月', '火', '水', '木', '金', '土');
	
	
	$txt = "";
	for($i=1; $i<count($periodically); $i++ ) {
		
		if($periodically[$i]['曜日'] != "0") {
			$weekday = $periodically[$i]['曜日']." this week";
			$day = $today->modify($weekday)->setTime(0,0,0);
			$today = new DateTime(date('Ymd'));
			$today = $today->setTime(0,0,0);
			if($today->diff($day)->format('%R%a') == 0) $txt = $txt . "（" . $week_str_list[$today->format('w')] . "）" . $periodically[$i]['内容'] ."<br>";
			//else echo "{$day->format('n/d')}（{$week_str_list[$day->format('w')]}）：{$today->format('n/d')}（{$week_str_list[$today->format('w')]}）<br>";
		}
	}
	
	if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])
		&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
		if (isset($_GET['change']) && $_GET['change'] == "user_Registration") {
			$ini['user_Registration'] = $_GET['number'];
			if($ini['user_Registration'] == -1) $ini['user_Registration'] = 0;
			write_ini_file($ini['dirWin'].'/data/config.ini', $ini);
			exit();
		} else if(isset($_GET['change']) && $_GET['change'] == "user_Delete") {
			$ini['user_Delete'] = $_GET['number'];
			if($ini['user_Delete'] == -1) $ini['user_Delete'] = 0;
			write_ini_file($ini['dirWin'].'/data/config.ini', $ini);
			exit();
		}
	
	}
	if($txt != "") echo_panel("定期的なもの", $txt, "success");
	/*
	$txt = "";
	$txt = $txt . '<h4>登録：<form class="form-inline"><div class="form-group"><button type="button" class="btn btn-warning btn-sm" onclick=\'change_todo_regularly_privateuser("user_Registration", ' . ((int)$ini['user_Registration']-1) . ')\' style="padding: 10px">▼</button>';
	$txt = $txt . '<input type="number" class="form-control form-control-sm" min="0" value="' . $ini['user_Registration'] . '" size="2" style="width:50px" readonly>';
	$txt = $txt . '<button type="button" class="btn btn-warning btn-sm text-center" onclick=\'change_todo_regularly_privateuser("user_Registration", ' . ((int)$ini['user_Registration']+1) . ')\' style="padding: 10px">▲</button></div></form></h4>';
	$txt = $txt . '<h4>削除：<form class="form-inline"><div class="form-group"><button type="button" class="btn btn-danger btn-sm" onclick=\'change_todo_regularly_privateuser("user_Delete", ' . ((int)$ini['user_Delete']-1) . ')\' style="padding: 10px">▼</button>';
	$txt = $txt . '<input type="number" class="form-control form-control-sm"  min="0" value="' . $ini['user_Delete'] . '" size="2" style="width:50px" readonly>';
	$txt = $txt . '<button type="button" class="btn btn-danger btn-sm text-center" onclick=\'change_todo_regularly_privateuser("user_Delete", ' . ((int)$ini['user_Delete']+1) . ')\' style="padding: 10px">▲</button></div></form></h4>';
	/*
	$txt = "";
	$txt = $txt . "";
	$txt = $txt . "";
	$txt = $txt . "";
	$txt = $txt . "";
	$txt = $txt . "";
	*/
	
	//echo_panel("個人ユーザー登録", $txt, "primary");
	
?>
