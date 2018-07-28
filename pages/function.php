<?php



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

function last_todo_panel($todo, $i, $pattern, $file) {
			echo "<div class='panel panel-{$pattern}' id='todoid{$todo[$i]['id']}'>";
			
			if($todo[$i]['保留'] == "") $todo[$i]['保留'] = 0;
			
			echo "<div class='panel-heading'>";
			if($todo[$i]['level'] == 1) {
				echo "<a href='./todo.php?d=detail&p={$i}&file={$file}' ";
				if($pattern=='primary') echo "style='color:#ffffff;'";
				if($pattern=='warning') echo "style='color:#fa8072;'";
				else if($pattern=='info') echo "style='color:#87ceeb;'";
				echo ">";
				echo "<h3 class='panel-title' oncontextmenu='tree_menu({$todo[$i]['id']}, {$todo[$i]['top']}, {$todo[$i]['パーセンテージ']}, {$todo[$i]['child']}, {$todo[$i]['保留']}, \"{$file}\");return false' >{$todo[$i]['タイトル']}</h3>";
			}
			else {
				//$b = $todo[$i]['top'];
				//echo "<a href='./todo.php?d=detail&p={$b}'";
				echo "<a href='./todo.php?d=detail&p={$i}&file={$file}'";
				if($pattern=='primary') echo "style='color:#ffffff;'";
				if($pattern=='warning') echo "style='color:#fa8072;'";
				else if($pattern=='info') echo "style='color:#87ceeb;'";
				echo ">";
				echo "<h3 class='panel-title' oncontextmenu='tree_menu({$todo[$i]['id']}, {$todo[$i]['top']}, {$todo[$i]['パーセンテージ']}, {$todo[$i]['child']}, {$todo[$i]['保留']}, \"{$file}\");return false'>{$todo[$i]['タイトル']}<span class='pull-right'>{$todo[$todo[$i]['top']]['タイトル']}</span></h3>";
			}
			echo "</a></div>";
			echo "<div class='panel-body'>";
			echo "";
			echo "<div class='col-md-9 col-xs-6'><strong>作業内容　: </strong>{$todo[$i]['作業内容']}<br><strong>成果物　　: </strong>{$todo[$i]['成果物']}<br><strong>期間　　　: </strong>{$todo[$i]['開始予定日']}　〜　{$todo[$i]['納期']}</div>";
			echo "<div class='col-md-1 col-xs-2 pull-right'><a href='todo.php?page=whatdo&f=100&p={$i}' class='btn btn-success btn-sm'>完了</a></div>";
			if($todo[$i]['完了'] != 1) {
				if($todo[$i]['保留'] == 0) echo "<div class='col-md-1 col-xs-2 pull-right'><a href='todo.php?page=wait&p={$i}' class='btn btn-info btn-sm'>保留</a></div>";
				else echo "<div class='col-md-1 col-xs-2 pull-right'><a href='todo.php?page=wait&p={$i}' class='btn btn-link btn-sm'>解除</a></div>";
				echo "<div class='col-md-1 col-xs-2 pull-right'><button type='button' class='btn btn-default dropdown-toggle btn-sm' data-toggle='dropdown' aria-expanded='false'>作業 <span class='caret'></span></button><ul class='dropdown-menu' role='menu'>";
				for($j=ceil($todo[$i]['パーセンテージ']/10)*10; $j<100; $j+=10) 
				echo "<li role='presentation'><a role='menuitem' tabindex='-1' href='todo.php?page=whatdo&p={$i}&f={$j}'>{$j}％まで完了</a></li>";
				echo "</ul></div>";
			} else if($file == "todo") {
				echo "<div class='col-md-1 col-xs-2 pull-right'><a href='./todo/nofinish.php?p={$i}' class='btn btn-warning btn-sm'>未完了</a></div>";
			}
			echo "</div>";
			echo "</div>";
	
}

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
	}/*
	echo "<pre>";
	print_r($array);
	echo "</pre>";*/
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
		if($todo[$i]['完了'] == 0 && $todo[$i]['保留'] == 0 && $todo[$i]['削除'] != 1 && $flag && $todo[$todo[$i]['top']]['今日やること'] == 0) {
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
	/*
	echo "<pre>";
	//print_r($todo[24]);
	//print_r($todo[25]);
	//print_r($sortlist);
	print_r($tmparray);
	echo "</pre>";
	*/
	return $sortlist;
}


function write_todo_tree($todo, $id, $date) {
	$color = check_todo_tree($todo, $id, $date);
	$count = $todo[$id]['順番']+1;
	if($color != "") {
		write_todo_tree_title($todo, $id, $color);
		if($todo[$id]['child'] != 0) {
			/*
			for($i=0; $i<count($todo); $i++) {
				if($todo[$i]['parent'] == $todo[$id]['id'] && $todo[$i]['削除'] == 0) write_todo_tree($todo, $i, $date);
			}
			*/
			$next_id = todo_next_child($todo, $id, $count);
			while($next_id != 0) {
				$count = write_todo_tree($todo, $next_id, $date);
				//$count++;
				$next_id = todo_next_child($todo, $id, $count);
			}

		}
		echo "</div>";
	}
	return $count;
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
			//write_todo_tree($todo, $id, 'success');
			$color = 'success';
		} else if($todo[$id]['保留'] == 1) {
			//write_todo_tree($todo, $id, 'muted');
			$color = 'muted';
		} else if($interval->format('%r%a 日')<0) { //未来
			$color = 'future';
		} else if($finishday->diff($day2->modify('+1 day'))->format('%r%a 日') >= 0) {
			//write_todo_tree($todo, $id, 'danger');
			$color = 'danger';
		}else if($finishday->diff($today->modify('+7 day'))->format('%r%a 日') >= 0) {
			//write_todo_tree($todo, $id, 'warning');
			$color = 'warning';
		} else {
			//write_todo_tree($todo, $id, 'primary');
			$color = 'primary';
		}
	}
	return $color;
}

function write_todo_tree_title($todo, $id, $color) {
	if(isset($_GET['p']) && $_GET['p'] == $todo[$id]['id']) echo "<div class='panel-tree-child bg-warning'>";
	else echo "<div class='panel-tree-child'>";
	
	if(isset($_GET['file']) && $_GET['file'] == "old201804") {
		$file = "old201804";
	} else {
		$file = "todo";
	}
	
	if($todo[$id]['level'] != 1) {
		echo "&thinsp;";
		for($j=1; $j<$todo[$id]['level']; $j++) echo " <span class='tree-child-space'>　</span>";
	}
	
	if($todo[$id]['保留'] == "") $todo[$id]['保留'] = 0;
	
	if($todo[$id]['child'] != 0) echo "<span class='glyphicon glyphicon-chevron-down tree-mark' aria-hidden='true' onClick='tree_operate(this)'></span>";
	else if($todo[$id]['完了'] == 0) echo "<span class='glyphicon glyphicon-edit tree-mark' aria-hidden='true'></span>";
	else echo "<span class='glyphicon glyphicon-check tree-mark' aria-hidden='true'></span>";
	if(!isset($_GET['d'])) $_GET['d'] = "todo";
	echo "<span class='text-{$color}' onDblClick='location.href = \"/Memoria/pages/todo.php?d={$_GET['d']}&p={$todo[$id]['id']}\"'	onMouseOver='this.classList.add(\"bg-info\")' onMouseOut='this.classList.remove(\"bg-info\")' onClick='gotoid(todoid{$todo[$id]['id']})' oncontextmenu='tree_menu({$todo[$id]['id']}, {$todo[$id]['top']}, {$todo[$id]['パーセンテージ']}, {$todo[$id]['child']}, {$todo[$id]['保留']}, \"{$file}\");return false' style='cursor: pointer;'>{$todo[$id]['タイトル']}</span>";
}

function check_child_finish($todo, $parent) {
	if($todo[$parent]['child'] != 0) {
		//echo "\$todo[\$parent]['child'] != 0<br>";
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
//				メモパネル作成用関数
//##################################################################



function makeMemoPanel($path, $memo, $memolist) {
	if($memolist['big'] == "y") echo "<div class='bs-component col-sm-12' id='{$memolist['filename']}'>";
	else echo "<div class='bs-component col-sm-6' id='{$memolist['filename']}'>";
	echo "<div class='modal'>";
	echo "<div class='modal-dialog'>";
	echo "<div class='modal-content'>";
	echo "<div class='modal-header'>";
	echo "<a name='{$memolist['filename']}'></a>";
	//echo "<h4 class='modal-title'>{$title}</h4>";
	//
	//$title = htmlspecialchars($memo, ENT_IGNORE);
	
	$title = str_replace("<", "!", $memo);
	$title = str_replace(">", "!", $title);
	$title = mb_substr($title, 0, 20);
	if($memolist['lock'] == "n") echo "<span style='display:none;'>".$title."……</span><button type='button' class='close' data-dismiss='modal' aria-hidden='true' onClick='switchingMemoPanel(this)'><span class='glyphicon glyphicon-resize-small' aria-hidden='true'></span></button>";
	else echo "<span>".$title."……</span><button type='button' class='close' data-dismiss='modal' aria-hidden='true' onClick='switchingMemoPanel(this)'><span class='glyphicon glyphicon-resize-full' aria-hidden='true'></span></button>";
	echo "</div>";
	if($memolist['lock'] == "n") echo "<div class='modal-body'>";
	else echo "<div class='modal-body' style='display:none;'>";
	$hyouzi = str_replace("<table>","<table class='table table-striped table-bordered table-hover table-condensed'>",$memo);
	$hyouzi = str_replace("<a href=\"http","<a target='_blank' href=\"http",$hyouzi);

	echo "<p>{$hyouzi}</p>";
	echo "</div>";
	
	if($memolist['lock'] == "n") echo "<div class='modal-footer'>";
	else echo "<div class='modal-footer' style='display:none;'>";
	echo '<span class="pull-right">　</span><button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="deleteMemoPanel(\''.$path.'\', \''.$memolist['filename'].'\')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>';
	echo '<span class="pull-right">　</span><button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="changeMempPanel(\''.$memolist['filename'].'\', this, \''.$memolist['big'].'\', \''.$memolist['lock'].'\')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>';
//	echo '　<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></button>';

	//echo "<button type='button' class='btn btn-default' data-dismiss='modal'>閉じる</button>";
	//echo "<button type='button' class='btn btn-primary'>保存</button>";
	echo "</div>";
	echo "</div>";
	echo "</div>";
	echo "</div>";
	echo "</div>";
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
	if($weeklyid != -1) $workdetail = str_replace('<br>', '<br>　　　', $weekly[$weeklyid]['テーマ概要']);
	else $workdetail = str_replace('<br>', '<br>　　　', $todo[$i]['作業内容']);
	echo "　＜テーマ概要＞<br>　　　{$workdetail}<br>";
	if($weeklyid != -1 && $weekly[$weeklyid]['済み'] != "") {
		echo "　＜済み＞<br>";
		$workdetail = str_replace('<br>', '<br>　　　', $weekly[$weeklyid]['済み']);
		echo "　　　{$workdetail}<br>";
	}
	if($flug != 0) {
		echo "　＜進捗＞<br>";
		if($weeklyid != -1) {
			$workdetail = str_replace('<br>', '<br>　　　', $weekly[$weeklyid]['進捗']);
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
	if($todo[$i]['完了'] == 0) {
		echo "　＜今後の予定＞<br>";
		if($weeklyid != -1) {
			$workdetail = str_replace('<br>', '<br>　　　', $weekly[$weeklyid]['今後の予定']);
			echo "　　　{$workdetail}<br>";
		} else {
			for($j=1; $j<count($todo); $j++) {
				if($todo[$j]['top'] == $todo[$i]['id'] && $todo[$j]['完了']==0) {
					$temp = new DateTime($todo[$j]['納期']);
					echo "　　　〜{$temp->format('n/d')}　：{$todo[$j]['タイトル']}→<br>";
				}
			}
		}
	}
	
}
//##################################################################
//				カレンダー用関数
//##################################################################
// 現在の年月を取得
function calendar($year, $month) {
	// 月末日を取得
	$last_day = date('j', mktime(0, 0, 0, $month + 1, 0, $year));
	$calendar = array();
	$j = 0;
	// 月末日までループ
	for ($i = 1; $i < $last_day + 1; $i++) {
		// 曜日を取得
			$week = date('w', mktime(0, 0, 0, $month, $i, $year));
			// 1日の場合
			if ($i == 1) {
					// 1日目の曜日までをループ
					for ($s = 1; $s <= $week; $s++) {
							// 前半に空文字をセット
							$calendar[$j]['day'] = '';
							$j++;
					}
			}
			// 配列に日付をセット
			$calendar[$j]['day'] = $i;
			$j++;
			// 月末日の場合
			if ($i == $last_day) {
					// 月末日から残りをループ
					for ($e = 1; $e <= 6 - $week; $e++) {
							// 後半に空文字をセット
							$calendar[$j]['day'] = '';
							$j++;
					}
			}
	}
?>
	<div class='calendar'>
	<?php echo $year; ?>年<?php echo $month; ?>月
	<?php
		$thisyear = date('Y');
		$thismonth = date('n');
		$thisday = date('d');
	?>
	<br>
	<br>
	<table>
			<tr>
					<th style='background: #e73562;'>日</th>
					<th>月</th>
					<th>火</th>
					<th>水</th>
					<th>木</th>
					<th>金</th>
					<th style='background: #009b9f;'>土</th>
			</tr>
	 
			<tr>
			<?php $cnt = 0; ?>
			<?php foreach ($calendar as $key => $value): ?>
	 
			<?php
				//$sa = sort_by_noki_priority($todo);
				if($value['day']!="") {
					if($thisyear == $year && $thismonth == $month && $thisday == $value['day'])
						echo "<td style='background: #fff352;'>";
					else if($cnt == 0 && $value['day']!="") echo "<td style='background: #ffc0cb;'>";
					else if($cnt == 6 && $value['day']!="") echo "<td style='background: #afeeee;'>";
					else echo "<td>";
			?>
			 <?php 

					echo "<a href='todo.php?d=calendar";
					echo "&year={$year}&mounth={$month}&day={$value['day']}'";
			 		echo "style='display:block; width:100%; '>".$value['day']."</a>";//height:100%
			 		if($value['day']!="") {
			 			$day = $year ."/". $month ."/". $value['day'];
			 			$day2 = new DateTime($day);
			 		}
			 		/*
			 		for($i=0; $i<count($sa); $i++) {
						if($value['day']!="") {
							$day1 = new DateTime($todo[$sa[$i]]['開始予定日']);
							if($day1 == $day2 && $todo[$sa[$i]]['完了']==0 && $todo[$sa[$i]]['保留']==0 && $todo[$sa[$i]]['child']==0 && $todo[$sa[$i]]['削除']==0) echo "<br>".$todo[$sa[$i]]['タイトル'];
						}
					}*/
				}
				else echo "<td>";
				$cnt++;
			?>
			</td>
	 
			<?php if ($cnt == 7): ?>
			</tr>
			<tr>
			<?php $cnt = 0; ?>
			<?php endif; ?>
	 
			<?php endforeach; ?>
			</tr>
	</table>
	</div>
<?php
}

//##################################################################
//				パネル表示用関数
//##################################################################

function echo_panel($title, $txt, $pattern) {
			echo "<div class='panel panel-{$pattern}' style='text-align:start;'>";
			
			echo "<div class='panel-heading'>";
			echo "<h3 class='panel-title'>{$title}</h3>";
			echo "</div>";
			echo "<div class='panel-body'>";
			echo $txt;
			echo "</div>";
			echo "</div>";
	
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

