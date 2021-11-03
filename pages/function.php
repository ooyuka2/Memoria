<?php
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\data\config.ini');
	include $ini['dirWin']. "/pages/rooting.php";
	
	include $link_function;
	require_once($ini['dirWin']."/md/md.php");
	//echo $link_function;


//##################################################################
//				csv読み込み/書き込み用関数
//##################################################################

function readCsvFile($filepath) {	//ファイル読み込んで配列に入れる
	mb_internal_encoding("SJIS-win");
	if (is_readable($filepath)) {
		$data = file_get_contents($filepath);
		$data = mb_convert_encoding($data, 'UTF-8', 'SJIS-win');
		$temp = tmpfile();
		$meta = stream_get_meta_data($temp);
		fwrite($temp, $data);
		rewind($temp);
		
		$file = new SplFileObject($meta['uri'], 'rb'); 
		$file->setFlags(SplFileObject::READ_CSV); 
		foreach ($file as $line) {
			if(!is_null($line[0])){
				$records[] = $line;
			}
		}
		for($i=0;$i<count($records);$i++) {
			for($j=0;$j<count($records[0]);$j++) {
				$records[$i][$j] = str_replace_magicquotes($records[$i][$j]);
			}
			mb_convert_variables('SJIS-win','UTF-8',$records[$i]);
		}
	}else {
		$records = null;
	}
	//mb_convert_variables('SJIS-win',"SJIS, SJIS-win, UTF-8, Unicode",$records);
	//mb_convert_variables('UTF-8',"auto",$records);
	//print_r($records);
	return $records;
}


function readCsvFile2($filepath) {	//ファイル読み込んで配列に入れる
	mb_internal_encoding("SJIS-win");
	if (is_readable($filepath)) {
		$data = file_get_contents($filepath);
		$data = mb_convert_encoding($data, 'UTF-8', 'SJIS-win');
		$temp = tmpfile();
		$meta = stream_get_meta_data($temp);
		fwrite($temp, $data);
		rewind($temp);
		
		$file = new SplFileObject($meta['uri'], 'rb'); 
		$file->setFlags(SplFileObject::READ_CSV); 
		foreach ($file as $line) {
			if(!is_null($line[0])){
				//mb_convert_variables('UTF-8','SJIS-win',$line);
				$records[] = $line;
			}
		}
		for($i=0;$i<count($records);$i++) {
			for($j=0;$j<count($records[0]);$j++) {
				$records[$i][$j] = str_replace_magicquotes($records[$i][$j]);
			}
			
			mb_convert_variables('SJIS-win','UTF-8',$records[$i]);
		}
		
		//mb_convert_variables('SJIS-win',"SJIS, SJIS-win, UTF-8, Unicode",$records);
		//mb_convert_variables('UTF-8',"auto",$records);
		for($i=0;$i<count($records);$i++) {
			for($j=0;$j<count($records[0]);$j++) {
				$ary[$i][$records[0][$j]] = str_replace_magicquotes($records[$i][$j]);
			}
		}
	}else {
		$ary = null;
	}
	/*
	for($i = 0; $i<count($records); $i++) {
		mb_convert_variables('SJIS-win','UTF-8',$ary[$i]);
	}*/
	//print_r_pre($ary);
	//mb_convert_variables('SJIS-win',"SJIS, SJIS-win, UTF-8, Unicode",$ary);
	return $ary;
}


function writeCsvFile($filepath, $records) {	//csvファイル書き込み
	//mb_convert_variables('SJIS-win','UTF-8',$records);
	$fp = fopen($filepath, 'w');
	foreach ($records as $fields) {
		fputcsv($fp, $fields);
	}
	fclose($fp);
}

function writeCsvFile2($filepath, $records) {	//csvファイル書き込み
	//print_r($records);
	//echo "<br><br>";
	//$line[] = array_keys($records[0]);
	//echo "line<br>";
	//print_r($line);
	for($i=0;$i<count($records);$i++) {
		//echo "line[{$i}]<br>";
		//print_r($records[$i]);
		$line[] = $records[$i];
	}
	//mb_convert_variables('SJIS-win','UTF-8',$line);
	$fp = fopen($filepath, 'w');
	foreach ($line as $fields) {
		fputcsv($fp, $fields);
	}
	fclose($fp);
}

function json_safe_encode($data){	//jsonの文字コード変換
	return json_encode($data, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
}


//##################################################################
//				iniファイル書き込み用関数
//##################################################################


function write_ini_file($filename, $ini){	//iniファイル書き込み用関数
	$fp = fopen($filename, 'w');
	foreach ($ini as $k => $i) fputs($fp, "$k=\"".str_replace("\\", "\\\\", rtrim($i, '\\'))."\"\n");
	fclose($fp);
}

//##################################################################
//				ページのインクルード的な関数
//##################################################################

function select_page($folder, $page) {
	$pass = $folder."/".$page.".php";
	include($pass);
}

function select_script_page($folder, $page) {
	$script_file = $folder."/".$page."_script.php";
	if(file_exists($script_file)) {
		select_page($folder, $page."_script");
	}
}


//##################################################################
//				todo用関数
//##################################################################



function sort_by_noki_priority($todo) {
	$array = array();
	for($i=1; $i<count($todo); $i++) {
		$array[$i-1] = $todo[$i]['id'];
	}
	for($i=0; $i<count($array); $i++) {
		for($j=$i+1; $j<count($array); $j++) {
			$date1 = $todo[$array[$i]]['納期']. " ".$todo[$array[$i]]['納期時間'];
			$date1 = new DateTime($date1);
			$date2 = $todo[$array[$j]]['納期']. " ".$todo[$array[$j]]['納期時間'];
			$date2 = new DateTime($date2);
			if($date1 > $date2) {
				$x = $array[$i];
				$array[$i] = $array[$j];
				$array[$j] = $x;
			} else if($date1 == $date2) {
				if($array[$i]>$array[$j]) {
					$x = $array[$i];
					$array[$i] = $array[$j];
					$array[$j] = $x;
				}
			}
		}
	}
	return $array;
}

function sort_by_noki_todo_priority2($todo) {
	$tmparray = array();
	for($i=1; $i<count($todo); $i++) {
		if($todo[$i]['level'] == 1 && $todo[$i]['完了'] == 0 && $todo[$i]['保留'] == 0) {
			$tmparray[count($tmparray)] = $todo[$i]['id'];
		}
	}
	for($i=0; $i<count($tmparray); $i++) {
		for($j=$i+1; $j<count($tmparray); $j++) {
			$date1 = $todo[$tmparray[$i]]['納期']. " ".$todo[$tmparray[$i]]['納期時間'];
			$date1 = new DateTime($date1);
			$date2 = $todo[$tmparray[$j]]['納期']. " ".$todo[$tmparray[$j]]['納期時間'];
			$date2 = new DateTime($date2);
			if($date1 > $date2) {
				$x = $tmparray[$i];
				$tmparray[$i] = $tmparray[$j];
				$tmparray[$j] = $x;
			} else if($date1 == $date2) {
				if($tmparray[$i]<$tmparray[$j]) {
					$x = $tmparray[$i];
					$tmparray[$i] = $tmparray[$j];
					$tmparray[$j] = $x;
				}
			}
		}
	}
	$sortlist = array();
	for($j=0; $j<count($tmparray); $j++) {
		$sortlist[count($sortlist)] = $tmparray[$j];
		for($i=1; $i<count($todo); $i++) {
			if($todo[$i]['level'] != 1 && $todo[$i]['top'] == $tmparray[$j]) {
				$sortlist[count($sortlist)] = $todo[$i]['id'];
			}
		}
	}
	return $sortlist;
}

function sort_by_noki_todo_priority($todo, $flag) {
	$tmparray = array();
	$tmpcount = 0;
	if($flag) {
		for($i=1; $i<count($todo); $i++) {
			if($todo[$i]['今日やること'] == 1 && $todo[$i]['完了'] == 0 && $todo[$i]['保留'] == 0 && $todo[$i]['削除'] != 1 && !check1array($tmparray, $todo[$i]['top'])) {
				$tmparray[count($tmparray)] = $todo[$i]['top'];
			}
		}
		$tmparray[count($tmparray)] = 0;
		$tmpcount = count($tmparray);
	}
	for($i=1; $i<count($todo); $i++) {
		if($todo[$i]['完了'] == 0 && $todo[$i]['保留'] == 0 && $todo[$i]['削除'] != 1 && $flag && $todo[$todo[$i]['top']]['今日やること'] != 1) {
			$tmparray[count($tmparray)] = $todo[$i]['id'];
		} else if($todo[$todo[$i]['top']]['完了'] == 1 && $todo[$i]['削除'] != 1 && !$flag) {
			$tmparray[count($tmparray)] = $todo[$i]['id'];
		}
	}
	if($flag) $tmparray[count($tmparray)] = 0;
	for($i=$tmpcount; $i<count($tmparray); $i++) {
		for($j=$i+1; $j<count($tmparray); $j++) {
			if($tmparray[$i] == 0) {
				$today =	new DateTime();
				$date1 = $today->modify('+1 day')->setTime(0,0,0);
			} else {
				$date1 = $todo[$tmparray[$i]]['納期']. " ".$todo[$tmparray[$i]]['納期時間'];
				$date1 = new DateTime($date1);
			}
			if($tmparray[$j] == 0) {
				$today =	new DateTime();
				$date2 = $today->modify('+1 day')->setTime(0,0,0);
			} else {
				$date2 = $todo[$tmparray[$j]]['納期']. " ".$todo[$tmparray[$j]]['納期時間'];
				$date2 = new DateTime($date2);
			}
			if(($date1 > $date2 && $flag) || ($date1 < $date2 && !$flag)) {
				$x = $tmparray[$i];
				$tmparray[$i] = $tmparray[$j];
				$tmparray[$j] = $x;
			}else if($date1 == $date2) {
				if($tmparray[$i]>$tmparray[$j]) {
					$x = $tmparray[$i];
					$tmparray[$i] = $tmparray[$j];
					$tmparray[$j] = $x;
				}
			}
		}
	}
	$tmpcount = count($tmparray);
	for($i=1; $i<count($todo); $i++) {
		if($todo[$i]['完了'] == 0 && $todo[$i]['保留'] == 1 && $todo[$i]['削除'] != 1 && $flag) {
			$tmparray[count($tmparray)] = $todo[$i]['id'];
		}
	}

	$todayflug = false;
	for($i=$tmpcount; $i<count($tmparray); $i++) {
		for($j=$i+1; $j<count($tmparray); $j++) {
			$date1 = $todo[$tmparray[$i]]['納期']. " ".$todo[$tmparray[$i]]['納期時間'];
			$date1 = new DateTime($date1);
			$date2 = $todo[$tmparray[$j]]['納期']. " ".$todo[$tmparray[$j]]['納期時間'];
			$date2 = new DateTime($date2);

			if(($date1 > $date2 && $flag) || ($date1 < $date2 && !$flag)) {
				$x = $tmparray[$i];
				$tmparray[$i] = $tmparray[$j];
				$tmparray[$j] = $x;
			}else if($date1 == $date2) {
				if($tmparray[$i]>$tmparray[$j]) {
					$x = $tmparray[$i];
					$tmparray[$i] = $tmparray[$j];
					$tmparray[$j] = $x;
				}
			}
		}
	}
	$sortlist = array();
	$checktop = array();
	for($j=0; $j<count($tmparray); $j++) {
		if($tmparray[$j] == 0) $sortlist[count($sortlist)] = 0;
		else if(!check1array($checktop, $todo[$tmparray[$j]]['top'])) {
			$sortlist[count($sortlist)] = $todo[$tmparray[$j]]['top'];
			$checktop[count($checktop)] = $todo[$tmparray[$j]]['top'];
		}
		/*
		for($i=0; $i<count($todo); $i++) {
			if($todo[$i]['level'] != 1 && $todo[$i]['top'] == $tmparray[$j] && $todo[$i]['削除'] != 1) {
				$sortlist[count($sortlist)] = $todo[$i]['id'];
			}
		}*/
	}
	return $sortlist;
}


function check_todo_color($todo, $id , $date) {
	date_default_timezone_set('Asia/Tokyo');
	$day1 = new DateTime($todo[$id]['開始予定日']);
	$day2 = new DateTime($date);
	$interval = $day1->diff($day2);
	$color = "";
	if($todo[$id]['削除']==0) {
		$finishday = new DateTime($todo[$id]['納期']);
		$today = new DateTime(date('Y/m/d'));
		if($todo[$id]['完了'] == 1) {
			$color = 'success';
		} else if($todo[$id]['保留'] == 1) {
			$color = 'muted';
		} else if($interval->format('%r%a 日')<0) { //未来
			$color = 'future';
		} else if($finishday->diff($day2->modify('+1 day'))->format('%r%a 日') >= 0) {
			$color = 'danger';
		}else if($finishday->diff($today->modify('+7 day'))->format('%r%a 日') >= 0) {
			$color = 'warning';
		} else {
			$color = 'primary';
		}
	}
	return $color;
}



function check_child_finish($todo, $parent) {
	if($todo[$parent]['child'] != 0) {
		for($i=0; $i<count($todo); $i++) {
			if($todo[$i]['parent']==$parent && $todo[$i]['完了']==0) {
				$todo[$i]['完了'] = 1;
				$todo[$i]['パーセンテージ'] = 100;
				$todo = check_child_finish($todo, $todo[$i]['id']);
			}
		}
	}
	return $todo;
}

function check_parent_finish($todo, $child, $fdo) {
	if($todo[$child]['level'] != 1) {
		$parent = $todo[$child]['parent'];
		$pfdo = $todo[$parent]['パーセンテージ'];
		$todo[$parent]['パーセンテージ'] += $fdo/$todo[$parent]['child'];
		$pfdo = $todo[$parent]['パーセンテージ'] - $pfdo;
		//echo $todo[$parent]['id'];
		if($todo[$parent]['パーセンテージ']>90) {
			$chk = 0;
			for($i=1; $i<count($todo); $i++) {
				if($todo[$i]['parent']==$parent && $todo[$i]['完了'] == 0 && $todo[$i]['削除'] == 0) {
					$chk++;
				}
			}
			if($chk==0) {
				$todo[$parent]['パーセンテージ']=100;
				$todo[$parent]['完了'] = 1;
			}
		}
		if($todo[$parent]['level']!=1) $todo = check_parent_finish($todo, $parent, $pfdo);
	}
	return $todo;
}

function check_parent_do($todo, $child, $fdo) {
	if($todo[$child]['level'] != 1) {
		$parent = $todo[$child]['parent'];
		$pfdo = $todo[$parent]['パーセンテージ'];
		$todo[$parent]['パーセンテージ'] += $fdo/$todo[$parent]['child'];
		$pfdo = $todo[$parent]['パーセンテージ'] - $pfdo;
		//writeCsvFile2("../../data/todo.csv", $todo);
		if($todo[$parent]['level']!=1) $todo = check_parent_do($todo, $parent, $pfdo);
	}
	return $todo;
}

function check_child_do($todo, $parent, $fdo) {
	if($todo[$parent]['child'] != 0) {
		//echo "\$todo[\$parent]['child'] != 0<br>";
		for($i=0; $i<count($todo); $i++) {
			if($todo[$i]['parent']==$parent && $todo[$i]['完了']==0) {
				$todo[$i]['パーセンテージ'] += $fdo/$todo[$parent]['child'];
				$todo = check_child_finish($todo, $todo[$i]['id'], $fdo/$todo[$parent]['child']);
			}
		}
	}
/*
	if($todo[$child]['level'] != 1) {
		$parent = $todo[$child]['parent'];
		$pfdo = $todo[$parent]['パーセンテージ'];
		$todo[$parent]['パーセンテージ'] += $fdo/$todo[$parent]['child'];
		$pfdo = $todo[$parent]['パーセンテージ'] - $pfdo;
		//writeCsvFile2("../../data/todo.csv", $todo);
		if($todo[$parent]['level']!=1) $todo = check_parent_do($todo, $parent, $pfdo);
	}*/
	return $todo;
}

function check_parent_nofinish($todo, $child, $fdo) {
	if($todo[$child]['level'] != 1) {
		$parent = $todo[$child]['parent'];
		$pfdo = $todo[$parent]['パーセンテージ'];
		$todo[$parent]['パーセンテージ'] += $fdo/$todo[$parent]['child'];
		$pfdo = $pfdo - $todo[$parent]['パーセンテージ'];
		$todo[$parent]['完了'] = 0;
		if($todo[$parent]['level']!=1) $todo = check_parent_nofinish($todo, $parent, $pfdo);
	}
	return $todo;
}

function writeWorking($working) {
	$lastday = new DateTime($working[(count($working)-1)]['day']);
	$comday = new DateTime($working[(count($working)-2)]['day']);

	if($lastday < $comday) {
		$i = count($working)-2;
		while($lastday < $comday) {
			$i--;
			$comday = new DateTime($working[$i]['day']);
		}
		$xxx = $working[(count($working)-1)];
		for($j=count($working)-2; $j>$i; $j--) {
			$working[($j+1)] = $working[$j];
		}
		$working[$i] = $xxx;
	}

	writeCsvFile2("../../data/working.csv", $working);
}

function todo_next($todo, $top, $next) {
	$id = 0;
	for($i=1; $i<count($todo);$i++) {
		if($todo[$i]['top']==$top && $todo[$i]['level']!=1 && $todo[$i]['削除']==0 && $todo[$i]['順番']==$next) {
			$id = $todo[$i]['id'];
		}
	}
	return $id;
}

function todo_next_child($todo, $parent, $next) {
	$id = 0;
	for($i=1; $i<count($todo);$i++) {
		if($todo[$i]['parent']==$parent && $todo[$i]['level']!=1 && $todo[$i]['削除']==0 && $todo[$i]['順番']==$next) {
			$id = $todo[$i]['id'];
		}
	}
	return $id;
}

//##################################################################
//				今日やること整理のページ用の関数
//##################################################################

function whatTodayDo_Registration($ini) {
	if(isset($_GET['auto'])) {
	
		$todo = readCsvFile2($ini['dirWin'].'/data/todo.csv');
		$sa = sort_by_noki_todo_priority($todo, true);
		$pid = "";
		$today = new DateTime(date('Ymd'));
		
		
		for($i=0; $i<count($sa); $i++) {
			
			if($sa[$i]!=0 && $todo[$sa[$i]]['削除'] != 1 && $todo[$sa[$i]]['保留'] != 1 && $todo[$sa[$i]]['完了'] != 1) { 
				$flug = 0;
				
				for($j=1; $j<count($todo); $j++) {
					if($todo[$j]['top'] == $sa[$i]) {
						$workday = new DateTime($todo[$j]['開始予定日']);

						if($today->diff($workday)->format('%r%a 日') == 0) {
							$flug = 1;
							break;
						}

					}
				}
				
				if(validateDate($todo[$sa[$i]]['今日やること'], 'Y/m/d')) {
					$workday = new DateTime($todo[$sa[$i]]['今日やること']);
					if($today->diff($workday)->format('%r%a 日') <= 0) {
						$flug = 1;
					}
				}
				
				
				if($todo[$sa[$i]]['今日やること'] == 1 || $todo[$sa[$i]]['今日やること'] == 2 || $flug == 1) {
					$pid = $pid . "@". $sa[$i];
				}
			}
		}
		/*
		//table用にjsonファイルを新規作成
		$dir = $ini['dirWin']."/data/tables/";
		$tablescsv = $ini['dirWin'].'/data/tables.csv';
		$tableslist = readCsvFile2($tablescsv);
		
		$i=1;
		while($i<count($tableslist)) {
			if(file_exists ($dir.$tableslist[$i]['filename'])) {
				
				$tablecsv = $dir.$tableslist[$i]['filename'];
				$tablejson = str_replace(".csv",".json", $tablecsv);
				if(!file_exists ( $tablejson ) || filemtime ( $tablejson ) < filemtime ( $tablecsv )) {
					$table = readCsvFile2($tablecsv);
					make_jsonfile($table, $tablecsv, $tablejson);
					unset($table);
				}

				$i++;
			} else {
				unset($tableslist[$i]);
				$tableslist = array_values($tableslist);
				writeCsvFile2($tablescsv, $tableslist);
			}
		}*/
		
		header( "Location: ./whatTodayDo.php?pid=".$pid );
		exit();
	}
	
	
	
	if(isset($_GET['pid'])) {
		$ids = explode("@", $_GET['pid']);
		//echo $_GET['pid'];
		$todo = readCsvFile2($ini['dirWin'].'/data/todo.csv');
		for($i=1; $i<count($todo); $i++) {
			if($todo[$i]['level'] == 1 && $todo[$i]['今日やること'] == 1) $todo[$i]['今日やること'] = 0;
		}
		for($i=1; $i<count($ids); $i++) {
			$todo[$ids[$i]]['今日やること'] = 1;
		}
		writeCsvFile2($ini['dirWin']."/data/todo.csv", $todo);
		
		$TodayS = date('Ymd');
		$today = new DateTime($TodayS);
		
		$working = readCsvFile2($ini['dirWin'].'/data/working.csv');
		$workday = new DateTime($working[(count($working)-1)]['day']);
		$workday = $workday->setTime(0,0,0);
		
		if($workday->diff($today)->format('%R%a') != 0) {
			$www = count($working);
			$working[$www]['file'] = "todo";
			$working[$www]['id'] = "periodically";
			$working[$www]['day'] = date('Y/m/d H:i:s', strtotime('-5 minute'));
			$working[$www]['per'] = 0;
			$working[$www]['startTime'] = date('H:i', strtotime('-5 minute'));
			$working[$www]['finishTime'] = date('H:i', strtotime('-5 minute'));
			$working[$www]['keeper'] = 1;
			$working[$www]['note'] = "";
			$working[$www]['place'] = "";
			$working[$www]['people'] = "";
			writeCsvFile2($ini['dirWin']."/data/working.csv", $working);
		}
		
		header( "Location: ../todo.php" );
		exit();
	}
	

}

//##################################################################
//				週報用関数
//##################################################################

function write_weekly($todo, $working, $weekly, $i, $weeklyid, $workK) {
	
	if(!isset($ini)) $ini = parse_ini_file(dirname ( __FILE__ ).'\..\data\config.ini');
	if(isset($_GET['day'])) $TodayS = $_GET['day'];
	else $TodayS = date('Ymd');
	$today = new DateTime($TodayS);
	$monday = $today->modify('monday this week')->setTime(0,0,0);
	//if($weekly[$weeklyid]['parentid'] == 0) echo "KPI：{$weekly[$weeklyid]['KPI']}<br>";
	$flug = $workK;
	if($flug == 0) {
		for($j=1; $j<count($working); $j++) {
			if($working[$j]['id'] != "periodically" && $todo[$working[$j]['id']]['top'] == $i) {
				$workday = new DateTime($working[$j]['day']);
				if($workday->diff($monday)->format('%R%a') <= 0) {
					$flug = 1;
					break;
				}
			}
		}
	}
	if($weeklyid != -1) {
		$lastday = new DateTime($weekly[$weeklyid]['最終更新日時']);
		if(($lastday->diff($monday)->format('%R%a')) <= 0) echo "<span class='text-info'>";
		else echo "<span class='text-danger'>";
	} else echo "<span class='text-info'>";
	if((($weeklyid != -1) && $weekly[$weeklyid]['parentid'] == 0) || ($weeklyid == -1)) {
		if($flug == 0) echo "〇";
		else echo "●";
	} else {
		if($flug == 0) echo "　□";
		else echo "　■";
	}

	echo "{$todo[$i]['タイトル']}：";
	if($weeklyid != -1) echo "{$weekly[$weeklyid]['担当']}";
	else echo $ini['myname'];
	if($todo[$i]['完了']==1) echo "【：完了】</span><br>";
	else echo "</span><br>";
	if($weeklyid != -1) {
		$workdetail = last_br_delete($weekly[$weeklyid]['テーマ概要']);
		$workdetail = str_replace('<br>', '<br>　　　', $workdetail);
	} else {
		$workdetail = last_br_delete($todo[$i]['作業内容']);
		$workdetail = str_replace('<br>', '<br>　　　', $workdetail);
	}
	echo "　＜テーマ概要＞<br>　　　{$workdetail}<br>";
	if($weeklyid != -1 && $weekly[$weeklyid]['済み'] != "") {
		echo "　＜済み＞<br>";
		$workdetail = last_br_delete($weekly[$weeklyid]['済み']);
		$workdetail = str_replace('<br>', '<br>　　　', $workdetail);
		echo "　　　{$workdetail}<br>";
	}
	if($flug != 0) {
		echo "　＜進捗＞<br>";
		if($weeklyid != -1) {
			$workdetail = last_br_delete($weekly[$weeklyid]['進捗']);
			$workdetail = str_replace('<br>', '<br>　　　', $workdetail);
			echo "　　　{$workdetail}<br>";
		} else {
			for($j=1; $j<count($working); $j++) {
				$workday = new DateTime($working[$j]['day']);
				if($working[$j]['id'] != "periodically" && $workday->diff($monday)->format('%R%a') <= 0 && $todo[$working[$j]['id']]['top'] == $i) {
					echo "　　　{$workday->format('n/d')}：{$todo[$working[$j]['id']]['タイトル']}→<br>";
				}
			}
		}
	}
	if($todo[$i]['完了'] == 0 && $weekly[$weeklyid]['今後の予定'] != "") {
		echo "　＜今後の予定＞<br>";
		if($weeklyid != -1) {
			$workdetail = last_br_delete($weekly[$weeklyid]['今後の予定']);
			$workdetail = str_replace('<br>', '<br>　　　', $workdetail);
			echo "　　　{$workdetail}<br>";
		} else {
			for($j=1; $j<count($todo); $j++) {
				if($todo[$j]['top'] == $todo[$i]['id'] && $todo[$j]['完了']==0) {
					$temp = new DateTime($todo[$j]['納期']);
					echo "　　　～{$temp->format('n/d')}　：{$todo[$j]['タイトル']}→<br>";
				}
			}
		}
	}
}

//##################################################################
//				datatables表示のためのjson作成用の関数
//##################################################################

function make_jsonfile($table, $tablecsv, $tablejson) {
	if(!file_exists ( $tablejson ) || filemtime ( $tablejson ) < filemtime ( $tablecsv )) { //
	
		for($i = 0; $i<count($table); $i++) {
			$json[$i] = $table[$i];
		}
		for($i = 0; $i<count($json); $i++) {
			mb_convert_variables('UTF-8','SJIS-win',$json[$i]);
		}
		//print_r_pre($json);
		$value = "{\r\n	\"data\": [\r\n";
		//echo $value;
		for($i = 1; $i<count($json); $i++) {
			$value .= "		[\r\n";
			foreach ($json[$i] as $key => $val) {
				$value .= "			\"" . str_replace(array("\r\n", "\n"),"<br>", str_replace("\"","'", str_replace("\\","\\\\", str_replace("	","　　", $json[$i][$key] ) ) ) ) . "\",\r\n";
				//	htmlspecialchars($json[$i][$key], ENT_QUOTES)stripslashes( 
			}
			$value = substr_replace($value, '', -3, -2);
			$value .= "		],\r\n";
		}
		$value = substr_replace($value, '', -3, -2);
		$value .= "	]\r\n}";
		//echo $value;
		//$value = mb_convert_encoding($value, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
		//require( $ini['dirWin'].'/js/ssp.class.php' );
		//$value = json_encode($value, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		file_put_contents($tablejson , $value);
		//var_dump(mb_convert_encoding($value, "SJIS-win", "ASCII,JIS,UTF-8,EUC-JP,SJIS, SJIS-win, Unicode"));
	}
}

//##################################################################
//				デバッグ用関数
//##################################################################
function print_r_pre($array) {
	echo "<pre>";
	print_r($array);
	echo "</pre>";
}

//##################################################################
//				変数の末尾が文末が<br>の場合に削除
//##################################################################

function last_br_delete($tmpStr) {
	While(substr($tmpStr, -4) == "<br>") {
			$tmpStr = substr_replace($tmpStr, "", -4);
	}
	return $tmpStr;
}
//##################################################################
//				配列用関数
//##################################################################

function serch_word($word, $arr) {
	for($i=0; $i<count($arr); $i++) {
		if($arr[$i] == $word) {
			return 1;
		}
	}
	return 0;
}

function serch_word_r($word, $arr) {
	for($i=0; $i<count($arr); $i++) {
		if($arr[$i] == $word) {
			return $i;
		}
	}
	return false;
}

//一次元配列の中に一致するものがあるか否か
function check1array($array, $text) {
	$flug = false;
	for($i=0; $i<count($array); $i++) {
		if($array[$i] == $text) $flug = true;
	}
	return $flug;
}

//2次元配列の中に一致するものがあるか否か
function check2array($array, $text, $num) {
	$flug = -1;
	for($i=0; $i<count($array); $i++) {
		if($array[$i][$num] == $text) $flug = $i;
	}
	return $flug;
}

//##################################################################
//				検索用関数
//##################################################################

function serch_word_str($word, $searchtext) {
	$word = mb_convert_kana($word, "asHc", "SJIS-win");
	$word = mb_strtolower($word);
	
	$searchtext = mb_convert_kana($searchtext, "asHc", "SJIS-win");
	$searchtext = mb_strtolower($searchtext);
	
	if(strpos($word,$searchtext) !== false) return true;
	return false;
}

function equal_word_str($word, $searchtext) {
	$word = mb_convert_kana($word, "asHc", "SJIS-win");
	$word = mb_strtolower($word);
	
	$searchtext = mb_convert_kana($searchtext, "asHc", "SJIS-win");
	$searchtext = mb_strtolower($searchtext);
	
	if( strcmp($word, $searchtext) == 0 ) return true;
	else return false;
}

function allequal_word_str($word, $searchtext) {
	
	if( strcmp($word, $searchtext) == 0 ) return true;
	else return false;
}


//##################################################################
//				整数と少数を分ける関数
//##################################################################


function NumberSplit($chk_number, $returnUnsigned = false){
	$negative_num = 1;

	if ($chk_number < 0){
		$negative_num = -1;
		$chk_number *= -1;
	}

	if ($returnUnsigned){
		return array(floor($chk_number),($chk_number - floor($chk_number)));
	}

    return array(floor($chk_number) * $negative_num, ($chk_number - floor($chk_number)) * $negative_num);
}

//##################################################################
//				日時の差を計算用関数
//##################################################################

function time_diff($time_from, $time_to) {
	//date_default_timezone_set('Asia/Tokyo');
	// 日時差を秒数で取得
	$dif = $time_to - $time_from;
	// 時間単位の差
	$dif_time = date("H:i:s", $dif);
	// 日付単位の差
	$dif_days = (strtotime(date("Y-m-d", $dif)) - strtotime("1970-01-01")) / 86400;
	return "{$dif_days}days {$dif_time}";
}

function day_diff($date1, $date2) {

	// 日付をUNIXタイムスタンプに変換
	$timestamp1 = strtotime($date1);
	$timestamp2 = strtotime($date2);

	// 何秒離れているかを計算
	$seconddiff = abs($timestamp2 - $timestamp1);

	// 日数に変換
	$daydiff = $seconddiff / (60 * 60 * 24);

	// 戻り値
	return $daydiff;

}


//##################################################################
//				DateTimeクラスでcheckdate()より汎用性のある日付チェックを行う関数
//##################################################################
function validateDate($date, $format = 'Y-m-d H:i:s') {
	$d = DateTime::createFromFormat($format, $date);
	return $d && $d->format($format) == $date;
}

function str_replace_magicquotes($str) {
	
	$last = mb_substr($str, -1);
	if($last == "―\" || $last == "表\" || $last == "暴\" || $last == "予\" || $last == "禄\" || $last == "兔\" || $last == "喀\" || $last == "媾\" || $last == "彌\" || $last == "拿\" || $last == "杤\" || $last == "歃\" || $last == "濬\" || $last == "畚\" || $last == "秉\" || $last == "綵\" || $last == "臀\" || $last == "藹\" || $last == "觸\" || $last == "軆\" || $last == "鐔\" || $last == "饅\" || $last == "鷭\" || $last == "ソ\" || $last == "Ы\" || $last == "Ⅸ\" || $last == "噂\" || $last == "浬\" || $last == "欺\" || $last == "圭\" || $last == "構\" || $last == "蚕\" || $last == "十\" || $last == "申\" || $last == "曾\" || $last == "箪\" || $last == "貼\" || $last == "能\") $str .= " ";
	
	return $str;
}

// || $last == "偆\" || $last == "砡\"
?>

