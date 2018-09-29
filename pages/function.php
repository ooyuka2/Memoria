<?php
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\data\config.ini');
	include $ini['dirWin']. "/pages/rooting.php";
	
	include $link_function;
	//echo $link_function;


//##################################################################
//				csv読み込み/書き込み用関数
//##################################################################
//ファイル読み込んで配列に入れる
function readCsvFile($filepath) {
	mb_internal_encoding("SJIS-win");
	if (is_readable($filepath)) {
		$file = new SplFileObject($filepath); 
		$file->setFlags(SplFileObject::READ_CSV); 
		foreach ($file as $line) {
			if(!is_null($line[0])){
				$records[] = $line;
			}
		}
	}else {
		$records = null;
	}
	//mb_convert_variables('SJIS-win',"SJIS, SJIS-win, UTF-8, Unicode",$records);
	//mb_convert_variables('UTF-8',"auto",$records);
	//print_r($records);
	return $records;
}

//ファイル読み込んで配列に入れる
function readCsvFile2($filepath) {
	mb_internal_encoding("SJIS-win");
	if (is_readable($filepath)) {
		$file = new SplFileObject($filepath); 
		$file->setFlags(SplFileObject::READ_CSV); 
		foreach ($file as $line) {
			if(!is_null($line[0])){
				$records[] = $line;
			}
		}
		//mb_convert_variables('SJIS-win',"SJIS, SJIS-win, UTF-8, Unicode",$records);
		//mb_convert_variables('UTF-8',"auto",$records);
		for($i=0;$i<count($records);$i++) {
			/*echo "<pre>";
			print_r($records[$i]);
			echo "</pre>";*/
			for($j=0;$j<count($records[0]);$j++) {
				$ary[$i][$records[0][$j]] = $records[$i][$j];
			}
		}
	}else {
		$ary = null;
	}
	//print_r($ary);
	//mb_convert_variables('SJIS-win',"SJIS, SJIS-win, UTF-8, Unicode",$ary);
	return $ary;
}

//csvファイル書き込み
function writeCsvFile($filepath, $records) {
	//mb_convert_variables('SJIS-win','UTF-8',$records);
	$fp = fopen($filepath, 'w');
	foreach ($records as $fields) {
		fputcsv($fp, $fields);
	}
	fclose($fp);
}
//csvファイル書き込み
function writeCsvFile2($filepath, $records) {
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

function json_safe_encode($data){
		return json_encode($data, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
}


//##################################################################
//				iniファイル書き込み用関数
//##################################################################


function write_ini_file($filename, $ini){
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
			if($todo[$i]['今日やること'] == 1 && $todo[$i]['完了'] == 0 && !check1array($tmparray, $todo[$i]['top'])) {
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


function check_todo_tree($todo, $id , $date) {
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
				if($todo[$sa[$i]]['今日やること'] != 0 || $flug == 1) {
					$pid = $pid . "@". $sa[$i];
				}
			}
		}
	//echo $pid;
		header( "Location: ./whatTodayDo.php?pid=".$pid );
		exit();
	}
	
	
	
	if(isset($_GET['pid'])) {
		$ids = explode("@", $_GET['pid']);
		//echo $_GET['pid'];
		$todo = readCsvFile2($ini['dirWin'].'/data/todo.csv');
		for($i=1; $i<count($todo); $i++) {
			if($todo[$i]['level'] == 1 && $todo[$i]['今日やること'] != 2) $todo[$i]['今日やること'] = 0;
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
			writeCsvFile2($ini['dirWin']."/data/working.csv", $working);
		}
		
		header( "Location: ../todo.php" );
		exit();
	}
	
	if(isset($_GET['turn'])) {
		$todo = readCsvFile2($ini['dirWin'].'/data/todo.csv');
		
		if(isset($_GET['p'])) {
			$todo[$_GET['p']]['今日やること'] = $_GET['turn'];
			writeCsvFile2($ini['dirWin']."/data/todo.csv", $todo);
		}
		header( "Location: ../todo.php" );
		exit();
	}

}

//##################################################################
//				todo/do.php用関数
//##################################################################
function dophp ($pagetype) {

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

?>

