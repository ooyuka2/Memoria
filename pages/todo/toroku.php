<?php
//id,タイトル,作業内容,納期,納期時間,開始予定日,終了予定日,パーセンテージ,
//完了,所感,level,top,parent,child,成果物,テーマ,優先度,登録日

	if(!isset($ini)) $ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	include($ini['dirWin'].'/pages/function.php');
	$todo = readCsvFile2($ini['dirWin'].'/data/todo.csv');

	
	$id = $_POST['id'][0];
	$number = $id;
	date_default_timezone_set('Asia/Tokyo');
	for($j=0; $j<count($_POST['name']);$j++) {
		if($_POST['name'][$j]!="") {
			$todo[$id]['id'] = $id;
			$todo[$id]['タイトル'] = $_POST['name'][$j];
			$todo[$id]['作業内容'] = str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['detail'][$j]);
			$todo[$id]['納期'] = $_POST['noki'][$j];
			$todo[$id]['納期時間'] = $_POST['time'][$j];
			$todo[$id]['開始予定日'] = $_POST['kaisi'][$j];
			$todo[$id]['終了予定日'] = $_POST['syuryo'][$j];
			$todo[$id]['パーセンテージ'] = 0;
			$todo[$id]['完了'] = 0;
			$todo[$id]['所感'] = "no comment";
			$todo[$id]['level'] = $_POST['level'][$j];
			$todo[$id]['top'] = $number;
			$todo[$id]['parent'] = 0;
			$todo[$id]['child'] = 0;
			$todo[$id]['成果物'] = $_POST['mono'][$j];
			if($j==0) $todo[$id]['テーマ'] = $_POST['theme'][$j];
			else $todo[$id]['テーマ'] = 0;
			$todo[$id]['優先度'] = $_POST['priority'][$j];
			$todo[$id]['登録日'] = date('Y/m/d H:i:s');
			$todo[$id]['保留'] = 0;
			$todo[$id]['削除'] = 0;
			$todo[$id]['時間管理テーマ'] = $_POST['theme2'][0];
			$todo[$id]['順番'] = $j;
			$todo[$id]['今日やること'] = 0;
			$id++;
		}
	}
	
	$id = $_POST['id'][0];
	for($j=0; $j<count($_POST['name']);$j++) {
		if($_POST['name'][$j]!="") {
			if($todo[$id]['level']==1) $todo[$id]['parent'] = 0;
			else if(($todo[$id]['level']-$todo[($id-1)]['level'])==1) $todo[$id]['parent'] = $todo[($id-1)]['id'];
			else if($todo[$id]['level']==$todo[($id-1)]['level']) $todo[$id]['parent'] = $todo[($id-1)]['parent'];
			else {
				for($k=$id-1; $k>=0; $k--) {
					if($todo[$id]['level']==($todo[$k]['level'])+1) {
						$todo[$id]['parent'] = $todo[$k]['id'];
						break;
					}
				}
			}
			$child = 0;
			$i=$j+1;
			while($i<count($_POST['name']) && $_POST['level'][$j]<$_POST['level'][$i]) {
				if(($_POST['level'][$j]+1)==$_POST['level'][$i]) {
					$child++;
				}
				$i++;
			}
			$todo[$id]['child'] = $child;
			$id++;
		}
	}
	
	if($_POST['name'][0]!="" && isset($_POST['make_weekly']) && $_POST['make_weekly']==-1) {
		$weekly = readCsvFile2($ini['dirWin'].'/data/weekly.csv');
		$ini = parse_ini_file($ini['dirWin'].'/data/config.ini');
		
		$c = count($weekly);
		$weekly[$c]["todoid"] = $number;
		$weekly[$c]["テーマ概要"] = $todo[$number]['作業内容'];
		$weekly[$c]["KPI"] = "";
		$weekly[$c]["担当"] = $ini['myname'];
		$weekly[$c]["済み"] = "";
		$weekly[$c]["進捗"] = "";
		$weekly[$c]["今後の予定"] = "";
		if($_POST['theme2'][0] == $ini['incidentID'] || $_POST['theme2'][0] == $ini['servicesID']) $weekly[$c]["parentid"] = $_POST['theme2'][0];
		else $weekly[$c]["parentid"] = "0";
		$weekly[$c]["最終更新日時"] = date('Y/m/d H:i:s');
		$weekly[$c]["表示"] = "0";
		writeCsvFile2($ini['dirWin']."/data/weekly.csv", $weekly);
	} else if($_POST['name'][0]!="" && isset($_POST['make_weekly'])) {
		$weekly = readCsvFile2($ini['dirWin'].'/data/weekly.csv');
		include($ini['dirWin'].'/pages/todo/weekly.php');
		
		$weeklyid = check2array($weekly, $_POST['make_weekly'], "todoid");
		
		$c = count($weekly);
		$weekly[$c]["todoid"] = $number;
		$weekly[$c]["テーマ概要"] = $weekly[$weeklyid]["テーマ概要"];
		$weekly[$c]["KPI"] = $weekly[$weeklyid]["KPI"];
		$weekly[$c]["担当"] = $weekly[$weeklyid]["担当"] ;
		$weekly[$c]["済み"] = $weekly[$weeklyid]["済み"];
		$weekly[$c]["進捗"] = $weekly[$weeklyid]["進捗"];
		$weekly[$c]["今後の予定"] = $weekly[$weeklyid]["今後の予定"];
		$weekly[$c]["parentid"] = $weekly[$weeklyid]["parentid"];
		$weekly[$c]["最終更新日時"] = date('Y/m/d H:i:s');
		$weekly[$c]["表示"] = "0";
		writeCsvFile2($ini['dirWin']."/data/weekly.csv", $weekly);
	}
	
	/*echo "<pre>";
	print_r($todo);
	echo "</pre>";*/
	writeCsvFile2($ini['dirWin']."/data/todo.csv", $todo);
	if($_POST['name'][0] == "") header( "Location: " . $link_todo_html );
	else header( "Location: " . $link_todo_html . "?p={$_POST['id'][0]}" );
	exit();

?>