<?php
	//session_start();
	header("Content-type: text/html; charset=SJIS-win");
	if(!isset($ini)) $ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	include_once($ini['dirWin'].'/pages/function.php');
	
	$TodayS = date('Ymd');
	$today = new DateTime($TodayS);

	$todofile = $ini['dirWin'].'/data/todo.csv';
	$theme = readCsvFile2($ini['dirWin'].'/data/todo_keeper_theme.csv');
	
	$todo_old = readCsvFile2($todofile);
	$todo[0] = $todo_old[0];
	
	$id = 1;
	for($i=1; $i<count($theme); $i++) {
		
		$temp = rand(-20, 100);
		$temp2 = rand($temp, ($temp+25));
		$start = new DateTime($TodayS);
		$noki = new DateTime($TodayS);
		if($temp>=0) $start->modify('+ '.$temp.' days');
		else $start->modify('- '.abs($temp).' days');
		if($temp2 >= 0) $noki->modify('+ '.$temp2.' days');
		else $noki->modify('- '.abs($temp2).' days');
		

		$todo[$id]['id'] = $id;
		$todo[$id]['タイトル'] = $theme[$i]['テーマ'];
		$todo[$id]['作業内容'] = $theme[$i]['テーマ']."の作業内容";
		$todo[$id]['納期'] = $noki->format('Y/m/d');
		$todo[$id]['納期時間'] = "18:00";
		$todo[$id]['開始予定日'] = $start->format('Y/m/d');
		$todo[$id]['終了予定日'] = $noki->format('Y/m/d');
		$todo[$id]['パーセンテージ'] = 0;
		$todo[$id]['完了'] = 0;
		$todo[$id]['所感'] = "no comment";
		$todo[$id]['level'] = 1;
		$todo[$id]['top'] = $id;
		$todo[$id]['parent'] = 0;
		$todo[$id]['child'] = 5;
		$todo[$id]['成果物'] = "成果物";
		$todo[$id]['テーマ'] = 0;
		$todo[$id]['優先度'] = 1;
		$todo[$id]['登録日'] = date('Y/m/d H:i:s');
		$todo[$id]['保留'] = 0;
		$todo[$id]['削除'] = 0;
		$todo[$id]['時間管理テーマ'] = $theme[$i]['id'];
		$todo[$id]['順番'] = 0;
		$todo[$id]['今日やること'] = 0;
		$id++;
	}
	$temp = rand(5, 20);
	for($i=1; $i<$temp; $i++) {
		
		$temp = rand(-20, 100);
		$temp2 = rand($temp, ($temp+25));
		$start = new DateTime($TodayS);
		$noki = new DateTime($TodayS);
		if($temp>=0) $start->modify('+ '.$temp.' days');
		else $start->modify('- '.abs($temp).' days');
		if($temp2 >= 0) $noki->modify('+ '.$temp2.' days');
		else $noki->modify('- '.abs($temp2).' days');
		
		$todo[$id]['id'] = $id;
		$todo[$id]['タイトル'] = $id. "　　テーマ外の作業";
		$todo[$id]['作業内容'] = $theme[18]['テーマ']."の作業内容";
		$todo[$id]['納期'] = $noki->format('Y/m/d');
		$todo[$id]['納期時間'] = "18:00";
		$todo[$id]['開始予定日'] = $start->format('Y/m/d');
		$todo[$id]['終了予定日'] = $noki->format('Y/m/d');
		$todo[$id]['パーセンテージ'] = 0;
		$todo[$id]['完了'] = 0;
		$todo[$id]['所感'] = "no comment";
		$todo[$id]['level'] = 1;
		$todo[$id]['top'] = $id;
		$todo[$id]['parent'] = 0;
		$todo[$id]['child'] = 0;
		$todo[$id]['成果物'] = "成果物";
		$todo[$id]['テーマ'] = 0;
		$todo[$id]['優先度'] = 1;
		$todo[$id]['登録日'] = date('Y/m/d H:i:s');
		$todo[$id]['保留'] = 0;
		$todo[$id]['削除'] = 0;
		$todo[$id]['時間管理テーマ'] = 40;
		$todo[$id]['順番'] = 0;
		$todo[$id]['今日やること'] = 0;
		$id++;
	}
	for($j=0;$j<5;$j++) {
		for($i=1; $i<count($theme); $i++) {
			$todo[$id]['id'] = $id;
			$todo[$id]['タイトル'] = "1-".$j."　".$theme[$i]['テーマ'];
			$todo[$id]['作業内容'] = $theme[$i]['テーマ']."の作業内容";
			$todo[$id]['納期'] = $todo[$i]['納期'];
			$todo[$id]['納期時間'] = "18:00";
			$todo[$id]['開始予定日'] = $todo[$i]['開始予定日'];
			$todo[$id]['終了予定日'] = $todo[$i]['終了予定日'];
			$todo[$id]['パーセンテージ'] = 0;
			$todo[$id]['完了'] = 0;
			$todo[$id]['所感'] = "no comment";
			$todo[$id]['level'] = 2;
			$todo[$id]['top'] = $i;
			$todo[$id]['parent'] = $i;
			$todo[$id]['child'] = 0;
			$todo[$id]['成果物'] = "成果物";
			$todo[$id]['テーマ'] = 0;
			$todo[$id]['優先度'] = 1;
			$todo[$id]['登録日'] = date('Y/m/d H:i:s');
			$todo[$id]['保留'] = 0;
			$todo[$id]['削除'] = 0;
			$todo[$id]['時間管理テーマ'] = 0;
			$todo[$id]['順番'] = ($j+1);
			$todo[$id]['今日やること'] = 0;
			$id++;
		}
	}
	while($id<501) {
		$temp = rand(1, (count($todo) -1));
		//$temp = 98;
		if($todo[$temp]['level'] != 0) {
			$todo = plusnewtodo($todo, $id, $temp);
			$id++;
		}
		//echo count($todo)."<br><br>";
	}
	
	writeCsvFile2($todofile, $todo);
	
	$txt = 'file,id,day,per,startTime,finishTime,keeper,note'."\r\n".'todo,periodically,"2018/07/16 17:23:04",0,11:00,11:30,60,そのた';
	file_put_contents($ini['dirWin'].'/data/working.csv', $txt);
	$txt = 'todoid,テーマ概要,KPI,担当,済み,進捗,"今後の予定",parentid,最終更新日時,"表示"'."\r\n".'13,test1<br>インシデント関連テーマ概要,インシデント関連KPI,▲▲,インシデント<br>済み,インシデント関連<br>進捗,"インシデント関連<br>今後の予定",13,"2018/07/10 17:15:46",0'."\r\n".'15,サービス関連テーマ概要,サービス関連KPI,▲▲,サービス関連<br>済み,サービス<br>関連進捗,"サービス関連<br>今後の予定",15,"2018/07/10 17:15:46",0';
	file_put_contents($ini['dirWin'].'/data/weekly.csv', $txt);
	
	function plusnewtodo($todo, $id, $pre) {
		$todo[$id]['id'] = $id;
		$level = ($todo[$pre]['level'] + 1);
		$temp = ($todo[$pre]['child'] + 1);
		$todo[$id]['タイトル'] =  ($level-1)."-".$temp."　".$todo[$todo[$pre]['top']]['タイトル'];
		$todo[$id]['作業内容'] = $todo[$id]['タイトル']."の作業内容";
		$todo[$id]['納期'] = $todo[$pre]['納期'];
		$todo[$id]['納期時間'] = "18:00";
		$todo[$id]['開始予定日'] = $todo[$pre]['開始予定日'];
		$todo[$id]['終了予定日'] = $todo[$pre]['終了予定日'];
		$todo[$id]['パーセンテージ'] = 0;
		$todo[$id]['完了'] = 0;
		$todo[$id]['所感'] = "no comment";
		$todo[$id]['level'] = $level;
		$todo[$id]['top'] = $todo[$pre]['top'];
		$todo[$id]['parent'] = $todo[$pre]['id'];
		$todo[$id]['child'] = 0;
		$todo[$id]['成果物'] = "成果物";
		$todo[$id]['テーマ'] = 0;
		$todo[$id]['優先度'] = 1;
		$todo[$id]['登録日'] = date('Y/m/d H:i:s');
		$todo[$id]['保留'] = 0;
		$todo[$id]['削除'] = 0;
		$todo[$id]['時間管理テーマ'] = 0;
		$todo[$id]['順番'] = ($todo[$pre]['順番'] + 1);
		$todo[$id]['今日やること'] = 0;
		
		$todo[$todo[$pre]['id']]['child'] = $temp;

		$todo = renumberid($todo, $id);
		return $todo;
	}
	
	function renumberid($todo, $id) {
		for($i=1; $i<count($todo); $i++) {
			if($todo[$id]['top'] == $todo[$i]['top'] && $todo[$i]['順番'] >= $todo[$id]['順番'] && $id != $i) $todo[$i]['順番'] = ($todo[$i]['順番'] + 1);
		}
		
		return $todo;
	}
	//121
?>
