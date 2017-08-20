<?php

$updatefiletime = "2017-08-15-1706";


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
	mb_convert_variables('SJIS-win',"SJIS, SJIS-win, UTF-8, Unicode",$records);
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
		mb_convert_variables('SJIS-win',"SJIS, SJIS-win, UTF-8, Unicode",$records);
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
	mb_convert_variables('SJIS-win',"SJIS, SJIS-win, UTF-8, Unicode",$ary);
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

function search_array($abc, $abc2, $abcl, $hiragana, $hiragana2, $word) {
	if(serch_word($_GET['search'], $abc2)) {
		$i = serch_word_r($_GET['search'], $abc2);
		if($word==$abc[$i] || $word==$abcl[$i]) return 1;
		
	}
	if(serch_word($_GET['search'], $hiragana2)) {
		$i = serch_word_r($_GET['search'], $hiragana2);
		if($word==$hiragana[$i]) return 1;
		if($i==5 && $word=="が") return 1;
		if($i==6 && $word=="ぎ") return 1;
		if($i==7 && $word=="ぐ") return 1;
		if($i==8 && $word=="げ") return 1;
		if($i==9 && $word=="ご") return 1;
		if($i==10 && $word=="ざ") return 1;
		if($i==11 && $word=="じ") return 1;
		if($i==12 && $word=="ず") return 1;
		if($i==13 && $word=="ぜ") return 1;
		if($i==14 && $word=="ぞ") return 1;
		if($i==15 && $word=="だ") return 1;
		if($i==16 && $word=="ぢ") return 1;
		if($i==17 && $word=="づ") return 1;
		if($i==17 && $word=="っ") return 1;
		if($i==18 && $word=="で") return 1;
		if($i==19 && $word=="ど") return 1;
		if($i==25 && $word=="ば") return 1;
		if($i==25 && $word=="ぱ") return 1;
		if($i==26 && $word=="び") return 1;
		if($i==26 && $word=="ぴ") return 1;
		if($i==27 && $word=="ぶ") return 1;
		if($i==27 && $word=="ぷ") return 1;
		if($i==28 && $word=="べ") return 1;
		if($i==28 && $word=="ぺ") return 1;
		if($i==29 && $word=="ぼ") return 1;
		if($i==29 && $word=="ぽ") return 1;
		if($i==35 && $word=="ゃ") return 1;
		if($i==36 && $word=="ゅ") return 1;
		if($i==37 && $word=="ょ") return 1;
		
	}
	return 0;
}


function last_todo_panel($todo, $i, $pattern) {
			echo "<div class='panel panel-{$pattern}'>";
			
			echo "<div class='panel-heading'>";
			if($todo[$i]['level'] == 1) {
				echo "<a href='./todo.php?d=detail&p={$i}' ";
				if($pattern=='primary') echo "style='color:#ffffff;'";
				if($pattern=='warning') echo "style='color:#fa8072;'";
				else if($pattern=='info') echo "style='color:#87ceeb;'";
				echo ">";
				echo "<h3 class='panel-title'>{$todo[$i]['タイトル']}</h3>";
			}
			else {
				//$b = $todo[$i]['top'];
				//echo "<a href='./todo.php?d=detail&p={$b}'";
				echo "<a href='./todo.php?d=detail&p={$i}'";
				if($pattern=='primary') echo "style='color:#ffffff;'";
				if($pattern=='warning') echo "style='color:#fa8072;'";
				else if($pattern=='info') echo "style='color:#87ceeb;'";
				echo ">";
				echo "<h3 class='panel-title'>{$todo[$i]['タイトル']}<span class='pull-right'>{$todo[$todo[$i]['top']]['タイトル']}</span></h3>";
			}
			echo "</a></div>";
			echo "<div class='panel-body'>";
			echo "";
			echo "<div class='col-md-9 col-xs-6'><strong>作業内容　: </strong>{$todo[$i]['作業内容']}<br><strong>成果物　　: </strong>{$todo[$i]['成果物']}<br><strong>期間　　　: </strong>{$todo[$i]['開始予定日']}　～　{$todo[$i]['納期']}</div>";
			//echo "<div class='col-md-1 col-xs-2'><a href='todo.php?page=whatdo&p={$i}' class='btn btn-default'>作業</a></div>";
			echo "<div class='col-md-1 col-xs-2'><button type='button' class='btn btn-default dropdown-toggle btn-sm' data-toggle='dropdown' aria-expanded='false'>作業 <span class='caret'></span></button><ul class='dropdown-menu' role='menu'>";
			for($j=ceil($todo[$i]['パーセンテージ']/10)*10; $j<100; $j+=10) 
			echo "<li role='presentation'><a role='menuitem' tabindex='-1' href='todo.php?page=whatdo&p={$i}&f={$j}'>{$j}％まで完了</a></li>";
			echo "</ul></div>";
			if($todo[$i]['保留'] == 0) echo "<div class='col-md-1 col-xs-2'><a href='todo.php?page=wait&p={$i}' class='btn btn-info btn-sm'>保留</a></div>";
			else echo "<div class='col-md-1 col-xs-2'><a href='todo.php?page=wait&p={$i}' class='btn btn-link btn-sm'>解除</a></div>";
			echo "<div class='col-md-1 col-xs-2'><a href='todo.php?page=whatdo&f=100&p={$i}' class='btn btn-success btn-sm'>完了</a></div>";
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
	for($i=1; $i<count($todo); $i++) {
		if($todo[$i]['完了'] == 0 && $todo[$i]['保留'] == 0 && $todo[$i]['削除'] != 1 && $flag) {
			$tmparray[count($tmparray)] = $todo[$i]['id'];
		} else if($todo[$todo[$i]['top']]['完了'] == 1 && $todo[$i]['削除'] != 1 && !$flag) {
			$tmparray[count($tmparray)] = $todo[$i]['id'];
		}
	}
	if($flag) $tmparray[count($tmparray)] = 0;
	for($i=0; $i<count($tmparray); $i++) {
		for($j=$i+1; $j<count($tmparray); $j++) {
			if($tmparray[$i] == 0) {
				$today =  new DateTime();
				$date1 = $today->modify('+1 day')->setTime(0,0,0);
			} else {
				$date1 = $todo[$tmparray[$i]]['納期']. " ".$todo[$tmparray[$i]]['納期時間'];
				$date1 = new DateTime($date1);
			}
			if($tmparray[$j] == 0) {
				$today =  new DateTime();
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
	echo "</pre>";*/
	return $sortlist;
}

//一次元配列の中に一致するものがあるか否か
function check1array($array, $text) {
	$flug = false;
	for($i=0; $i<count($array); $i++) {
		if($array[$i] == $text) $flug = true;
	}
	return $flug;
}

function write_todo_tree($todo, $id, $date) {
	$color = check_todo_tree($todo, $id, $date);
	if($color != "") {
		write_todo_tree_title($todo, $id, $color);
		if($todo[$id]['child'] != 0) {
			for($i=0; $i<count($todo); $i++) {
				if($todo[$i]['parent'] == $todo[$id]['id'] && $todo[$i]['削除'] == 0) write_todo_tree($todo, $i, $date);
			}
		}
		echo "</div>";
	}
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
		}else if($finishday->diff($today->modify('+3 day'))->format('%r%a 日') >= 0) {
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
	
	
	
	if($todo[$id]['level'] != 1) {
		echo "&thinsp;";
		for($j=1; $j<$todo[$id]['level']; $j++) echo " <span class='tree-child-space'>　</span>";
	}
	
	if($todo[$id]['child'] != 0) echo "<span class='glyphicon glyphicon-chevron-down tree-mark' aria-hidden='true' onClick='tree_operate(this)'></span>";
	else if($todo[$id]['完了'] == 0) echo "<span class='glyphicon glyphicon-edit tree-mark' aria-hidden='true'></span>";
	else echo "<span class='glyphicon glyphicon-check tree-mark' aria-hidden='true'></span>";
	if(!isset($_GET['d'])) $_GET['d'] = "todo";
	echo "<span class='text-{$color}' onDblClick='location.href = \"/Memoria/pages/todo.php?d={$_GET['d']}&p={$todo[$id]['id']}\"'  onMouseOver='this.classList.add(\"bg-info\")' onMouseOut='this.classList.remove(\"bg-info\")'>{$todo[$id]['タイトル']}</span>";
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

?>

<?php
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
	        		echo "style='display:block; width:100%; height:100%'>".$value['day']."</a>";
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
?>
