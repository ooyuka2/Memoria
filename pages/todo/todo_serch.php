
<?php
	$flag = 0;
	if(isset($_GET['pagetype']) && $_GET['pagetype'] == "MDBpages") $pagetype = "MDBpages";
	header("Content-type: text/html; charset=SJIS-win");
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	include_once($ini['dirWin'].'/pages/function.php');
	$todo = readCsvFile2($ini['dirWin'].'/data/todo.csv');
	$working = readCsvFile2($ini['dirWin'].'/data/working.csv');
	$file = "todo";
	if(isset($_GET['search'])) {
		$searchtext=mb_convert_encoding($_GET['search'], "SJIS-win", "ASCII,JIS,UTF-8,EUC-JP,SJIS, SJIS-win, Unicode");
		$searchtext = mb_convert_kana($searchtext, "asHc", "SJIS-win");
		$searchtext = mb_strtolower($searchtext);
	} else {
		$searchtext=" ";
	}
	
	
	$c = 0;
	$ary = array();
	for($i=1; $i<count($todo); $i++) {
		if($todo[$i]['完了'] == 0 && $todo[$i]['level'] == 1 && $todo[$i]['削除'] == 0) {
			$ary[$c] = $todo[$i]['top'];
			$c++;
			$top = $todo[$i]['top'];
			$flug = 0;
			for($j=1; $j<count($todo); $j++) {
				if($todo[$j]['top'] == $i) {
					if(serch_word_str($todo[$j]['タイトル'], $searchtext) || serch_word_str($todo[$j]['作業内容'], $searchtext) || serch_word_str($todo[$j]['所感'], $searchtext) || serch_word_str($todo[$j]['成果物'], $searchtext)) {
						$flug = 1;
						break;
					}
				}
			}
			
			
			if($flug ==1) {
				if ($todo[$todo[$top]['id']]['保留']==1) last_todo_panel($todo, $todo[$top]['id'], 'info', $file);
				else {
					date_default_timezone_set('Asia/Tokyo');
					$day1 = new DateTime($todo[$todo[$top]['id']]['開始予定日']);
					$day2 = new DateTime(date('Y/m/d'));
					$finishday = new DateTime($todo[$todo[$top]['id']]['納期']);
					$today = new DateTime(date('Y/m/d'));
					if($finishday->diff($day2->modify('+1 day'))->format('%r%a 日') >= 0) {
						last_todo_panel($todo, $todo[$top]['id'],'primary', $file);
					}else if($finishday->diff($today->modify('+3 day'))->format('%r%a 日') >= 0) {
						last_todo_panel($todo, $todo[$top]['id'],'warning', $file);
					} else {
						last_todo_panel($todo, $todo[$top]['id'],'danger', $file);
					}
				}
				$flag = 1;
			}
		}
	}

	for($i=count($working)-1; $i>0; $i--) {
		if($working[$i]['id'] != "deskwork" && $working[$i]['id'] != "periodically" && $todo[$todo[$working[$i]['id']]['top']]['完了'] == 1 && serch_word($todo[$working[$i]['id']]['top'], $ary)==0) {
			$ary[$c] = $todo[$working[$i]['id']]['top'];
			$c++;
			$top = $todo[$working[$i]['id']]['top'];
			
			$flug = 0;
			for($j=1; $j<count($todo); $j++) {
				if($todo[$j]['top'] == $top) {
					if(serch_word_str($todo[$j]['タイトル'], $searchtext) || serch_word_str($todo[$j]['作業内容'], $searchtext) || serch_word_str($todo[$j]['所感'], $searchtext) || serch_word_str($todo[$j]['成果物'], $searchtext)) {
						$flug = 1;
						break;
					}
				}
			}
			
			if($flug ==1) {
				last_todo_panel($todo, $todo[$top]['id'],'success', $file);
				$flag = 1;
			}
		}
	}

	$todo = readCsvFile2($ini['dirWin'].'/data/old201804todo.csv');
	$working = readCsvFile2($ini['dirWin'].'/data/old201804working.csv');
	$file = "old201804";
	$c = 0;
	$ary = array();
	for($i=count($working)-1; $i>0; $i--) {
		if($working[$i]['id'] != "deskwork" && $working[$i]['id'] != "periodically" && $todo[$todo[$working[$i]['id']]['top']]['完了'] == 1 && serch_word($todo[$working[$i]['id']]['top'], $ary)==0) {
			$ary[$c] = $todo[$working[$i]['id']]['top'];
			$c++;
			$top = $todo[$working[$i]['id']]['top'];
			
			$flug = 0;
			for($j=1; $j<count($todo); $j++) {
				if($todo[$j]['top'] == $top) {
					if(serch_word_str($todo[$j]['タイトル'], $searchtext) || serch_word_str($todo[$j]['作業内容'], $searchtext) || serch_word_str($todo[$j]['所感'], $searchtext) || serch_word_str($todo[$j]['成果物'], $searchtext)) {
						$flug = 1;
						break;
					}
				}
			}
			
			if($flug ==1) {
				last_todo_panel($todo, $todo[$top]['id'],'success', $file);
				$flag = 1;
			}
		}
	}
	if($flag == 0 && $pagetype == "MDBpages") echo "<div class=\"alert alert-danger alert-dismissible fade show col-12\" role=\"alert\" id=\"noserachalert\"><h4>データがありません。</h4><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button></div>";
	else if($flag == 0) echo "<div class='alert alert-dismissible alert-warning'><button type='button' class='close' data-dismiss='alert'>&times;</button><p class='text-danger'>データがありません。</p></div>";
?>