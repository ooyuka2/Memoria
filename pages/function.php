<?php
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\data\config.ini');
	include $ini['dirWin']. "/pages/rooting.php";
	
	include $link_function;
	//echo $link_function;


//##################################################################
//				csv�ǂݍ���/�������ݗp�֐�
//##################################################################
//�t�@�C���ǂݍ���Ŕz��ɓ����
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

//�t�@�C���ǂݍ���Ŕz��ɓ����
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

//csv�t�@�C����������
function writeCsvFile($filepath, $records) {
	//mb_convert_variables('SJIS-win','UTF-8',$records);
	$fp = fopen($filepath, 'w');
	foreach ($records as $fields) {
		fputcsv($fp, $fields);
	}
	fclose($fp);
}
//csv�t�@�C����������
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
//				ini�t�@�C���������ݗp�֐�
//##################################################################


function write_ini_file($filename, $ini){
	$fp = fopen($filename, 'w');
	foreach ($ini as $k => $i) fputs($fp, "$k=\"".str_replace("\\", "\\\\", rtrim($i, '\\'))."\"\n");
	fclose($fp);
}

//##################################################################
//				�y�[�W�̃C���N���[�h�I�Ȋ֐�
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
//				todo�p�֐�
//##################################################################



function sort_by_noki_priority($todo) {
	$array = array();
	for($i=1; $i<count($todo); $i++) {
		$array[$i-1] = $todo[$i]['id'];
	}
	for($i=0; $i<count($array); $i++) {
		for($j=$i+1; $j<count($array); $j++) {
			$date1 = $todo[$array[$i]]['�[��']. " ".$todo[$array[$i]]['�[������'];
			$date1 = new DateTime($date1);
			$date2 = $todo[$array[$j]]['�[��']. " ".$todo[$array[$j]]['�[������'];
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
		if($todo[$i]['level'] == 1 && $todo[$i]['����'] == 0 && $todo[$i]['�ۗ�'] == 0) {
			$tmparray[count($tmparray)] = $todo[$i]['id'];
		}
	}
	for($i=0; $i<count($tmparray); $i++) {
		for($j=$i+1; $j<count($tmparray); $j++) {
			$date1 = $todo[$tmparray[$i]]['�[��']. " ".$todo[$tmparray[$i]]['�[������'];
			$date1 = new DateTime($date1);
			$date2 = $todo[$tmparray[$j]]['�[��']. " ".$todo[$tmparray[$j]]['�[������'];
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
			if($todo[$i]['������邱��'] == 1 && $todo[$i]['����'] == 0 && !check1array($tmparray, $todo[$i]['top'])) {
				$tmparray[count($tmparray)] = $todo[$i]['top'];
			}
		}
		$tmparray[count($tmparray)] = 0;
		$tmpcount = count($tmparray);
	}
	for($i=1; $i<count($todo); $i++) {
		if($todo[$i]['����'] == 0 && $todo[$i]['�ۗ�'] == 0 && $todo[$i]['�폜'] != 1 && $flag && $todo[$todo[$i]['top']]['������邱��'] != 1) {
			$tmparray[count($tmparray)] = $todo[$i]['id'];
		} else if($todo[$todo[$i]['top']]['����'] == 1 && $todo[$i]['�폜'] != 1 && !$flag) {
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
				$date1 = $todo[$tmparray[$i]]['�[��']. " ".$todo[$tmparray[$i]]['�[������'];
				$date1 = new DateTime($date1);
			}
			if($tmparray[$j] == 0) {
				$today =	new DateTime();
				$date2 = $today->modify('+1 day')->setTime(0,0,0);
			} else {
				$date2 = $todo[$tmparray[$j]]['�[��']. " ".$todo[$tmparray[$j]]['�[������'];
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
		if($todo[$i]['����'] == 0 && $todo[$i]['�ۗ�'] == 1 && $todo[$i]['�폜'] != 1 && $flag) {
			$tmparray[count($tmparray)] = $todo[$i]['id'];
		}
	}

	$todayflug = false;
	for($i=$tmpcount; $i<count($tmparray); $i++) {
		for($j=$i+1; $j<count($tmparray); $j++) {
			$date1 = $todo[$tmparray[$i]]['�[��']. " ".$todo[$tmparray[$i]]['�[������'];
			$date1 = new DateTime($date1);
			$date2 = $todo[$tmparray[$j]]['�[��']. " ".$todo[$tmparray[$j]]['�[������'];
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
			if($todo[$i]['level'] != 1 && $todo[$i]['top'] == $tmparray[$j] && $todo[$i]['�폜'] != 1) {
				$sortlist[count($sortlist)] = $todo[$i]['id'];
			}
		}*/
	}
	return $sortlist;
}


function check_todo_tree($todo, $id , $date) {
	date_default_timezone_set('Asia/Tokyo');
	$day1 = new DateTime($todo[$id]['�J�n�\���']);
	$day2 = new DateTime($date);
	$interval = $day1->diff($day2);
	$color = "";
	if($todo[$id]['�폜']==0) {
		$finishday = new DateTime($todo[$id]['�[��']);
		$today = new DateTime(date('Y/m/d'));
		if($todo[$id]['����'] == 1) {
			$color = 'success';
		} else if($todo[$id]['�ۗ�'] == 1) {
			$color = 'muted';
		} else if($interval->format('%r%a ��')<0) { //����
			$color = 'future';
		} else if($finishday->diff($day2->modify('+1 day'))->format('%r%a ��') >= 0) {
			$color = 'danger';
		}else if($finishday->diff($today->modify('+7 day'))->format('%r%a ��') >= 0) {
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
			if($todo[$i]['parent']==$parent && $todo[$i]['����']==0) {
				$todo[$i]['����'] = 1;
				$todo[$i]['�p�[�Z���e�[�W'] = 100;
				$todo = check_child_finish($todo, $todo[$i]['id']);
			}
		}
	}
	return $todo;
}

function check_parent_finish($todo, $child, $fdo) {
	if($todo[$child]['level'] != 1) {
		$parent = $todo[$child]['parent'];
		$pfdo = $todo[$parent]['�p�[�Z���e�[�W'];
		$todo[$parent]['�p�[�Z���e�[�W'] += $fdo/$todo[$parent]['child'];
		$pfdo = $todo[$parent]['�p�[�Z���e�[�W'] - $pfdo;
		//echo $todo[$parent]['id'];
		if($todo[$parent]['�p�[�Z���e�[�W']>90) {
			$chk = 0;
			for($i=1; $i<count($todo); $i++) {
				if($todo[$i]['parent']==$parent && $todo[$i]['����'] == 0 && $todo[$i]['�폜'] == 0) {
					$chk++;
				}
			}
			if($chk==0) {
				$todo[$parent]['�p�[�Z���e�[�W']=100;
				$todo[$parent]['����'] = 1;
			}
		}
		if($todo[$parent]['level']!=1) $todo = check_parent_finish($todo, $parent, $pfdo);
	}
	return $todo;
}

function check_parent_do($todo, $child, $fdo) {
	if($todo[$child]['level'] != 1) {
		$parent = $todo[$child]['parent'];
		$pfdo = $todo[$parent]['�p�[�Z���e�[�W'];
		$todo[$parent]['�p�[�Z���e�[�W'] += $fdo/$todo[$parent]['child'];
		$pfdo = $todo[$parent]['�p�[�Z���e�[�W'] - $pfdo;
		//writeCsvFile2("../../data/todo.csv", $todo);
		if($todo[$parent]['level']!=1) $todo = check_parent_do($todo, $parent, $pfdo);
	}
	return $todo;
}

function check_child_do($todo, $parent, $fdo) {
	if($todo[$parent]['child'] != 0) {
		//echo "\$todo[\$parent]['child'] != 0<br>";
		for($i=0; $i<count($todo); $i++) {
			if($todo[$i]['parent']==$parent && $todo[$i]['����']==0) {
				$todo[$i]['�p�[�Z���e�[�W'] += $fdo/$todo[$parent]['child'];
				$todo = check_child_finish($todo, $todo[$i]['id'], $fdo/$todo[$parent]['child']);
			}
		}
	}
/*
	if($todo[$child]['level'] != 1) {
		$parent = $todo[$child]['parent'];
		$pfdo = $todo[$parent]['�p�[�Z���e�[�W'];
		$todo[$parent]['�p�[�Z���e�[�W'] += $fdo/$todo[$parent]['child'];
		$pfdo = $todo[$parent]['�p�[�Z���e�[�W'] - $pfdo;
		//writeCsvFile2("../../data/todo.csv", $todo);
		if($todo[$parent]['level']!=1) $todo = check_parent_do($todo, $parent, $pfdo);
	}*/
	return $todo;
}

function check_parent_nofinish($todo, $child, $fdo) {
	if($todo[$child]['level'] != 1) {
		$parent = $todo[$child]['parent'];
		$pfdo = $todo[$parent]['�p�[�Z���e�[�W'];
		$todo[$parent]['�p�[�Z���e�[�W'] += $fdo/$todo[$parent]['child'];
		$pfdo = $pfdo - $todo[$parent]['�p�[�Z���e�[�W'];
		$todo[$parent]['����'] = 0;
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
		if($todo[$i]['top']==$top && $todo[$i]['level']!=1 && $todo[$i]['�폜']==0 && $todo[$i]['����']==$next) {
			$id = $todo[$i]['id'];
		}
	}
	return $id;
}

function todo_next_child($todo, $parent, $next) {
	$id = 0;
	for($i=1; $i<count($todo);$i++) {
		if($todo[$i]['parent']==$parent && $todo[$i]['level']!=1 && $todo[$i]['�폜']==0 && $todo[$i]['����']==$next) {
			$id = $todo[$i]['id'];
		}
	}
	return $id;
}

//##################################################################
//				������邱�Ɛ����̃y�[�W�p�̊֐�
//##################################################################

function whatTodayDo_Registration($ini) {
	if(isset($_GET['auto'])) {
	
		$todo = readCsvFile2($ini['dirWin'].'/data/todo.csv');
		$sa = sort_by_noki_todo_priority($todo, true);
		$pid = "";
		$today = new DateTime(date('Ymd'));
		
		
		for($i=0; $i<count($sa); $i++) {
			
			if($sa[$i]!=0 && $todo[$sa[$i]]['�폜'] != 1 && $todo[$sa[$i]]['�ۗ�'] != 1 && $todo[$sa[$i]]['����'] != 1) { 
				$flug = 0;
				
				for($j=1; $j<count($todo); $j++) {
					if($todo[$j]['top'] == $sa[$i]) {
						$workday = new DateTime($todo[$j]['�J�n�\���']);

						if($today->diff($workday)->format('%r%a ��') == 0) {
							$flug = 1;
							break;
						}
					}
				}
				if($todo[$sa[$i]]['������邱��'] != 0 || $flug == 1) {
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
			if($todo[$i]['level'] == 1 && $todo[$i]['������邱��'] != 2) $todo[$i]['������邱��'] = 0;
		}
		for($i=1; $i<count($ids); $i++) {
			$todo[$ids[$i]]['������邱��'] = 1;
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
			$todo[$_GET['p']]['������邱��'] = $_GET['turn'];
			writeCsvFile2($ini['dirWin']."/data/todo.csv", $todo);
		}
		header( "Location: ../todo.php" );
		exit();
	}

}

//##################################################################
//				todo/do.php�p�֐�
//##################################################################
function dophp ($pagetype) {

}



//##################################################################
//				�f�o�b�O�p�֐�
//##################################################################
function print_r_pre($array) {
	echo "<pre>";
	print_r($array);
	echo "</pre>";
}

//##################################################################
//				�z��p�֐�
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

//�ꎟ���z��̒��Ɉ�v������̂����邩�ۂ�
function check1array($array, $text) {
	$flug = false;
	for($i=0; $i<count($array); $i++) {
		if($array[$i] == $text) $flug = true;
	}
	return $flug;
}

//2�����z��̒��Ɉ�v������̂����邩�ۂ�
function check2array($array, $text, $num) {
	$flug = -1;
	for($i=0; $i<count($array); $i++) {
		if($array[$i][$num] == $text) $flug = $i;
	}
	return $flug;
}

//##################################################################
//				�����p�֐�
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
//				�����̍����v�Z�p�֐�
//##################################################################

function time_diff($time_from, $time_to) {
	//date_default_timezone_set('Asia/Tokyo');
	// ��������b���Ŏ擾
	$dif = $time_to - $time_from;
	// ���ԒP�ʂ̍�
	$dif_time = date("H:i:s", $dif);
	// ���t�P�ʂ̍�
	$dif_days = (strtotime(date("Y-m-d", $dif)) - strtotime("1970-01-01")) / 86400;
	return "{$dif_days}days {$dif_time}";
}

?>

