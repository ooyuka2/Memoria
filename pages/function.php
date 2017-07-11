<?php
//ファイル読み込んで配列に入れる
function readCsvFile($filepath) {
mb_internal_encoding("UTF-8");
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
	mb_convert_variables('UTF-8',"SJIS-win, UTF-8, Unicode",$records);
	//mb_convert_variables('UTF-8',"auto",$records);
	//print_r($records);
	return $records;
}

//ファイル読み込んで配列に入れる
function readCsvFile2($filepath) {
mb_internal_encoding("UTF-8");
if (is_readable($filepath)) {
		$file = new SplFileObject($filepath); 
		$file->setFlags(SplFileObject::READ_CSV); 
		foreach ($file as $line) {
			if(!is_null($line[0])){
				$records[] = $line;
			}
		}
		mb_convert_variables('UTF-8',"SJIS-win, UTF-8, Unicode",$records);
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
	mb_convert_variables('UTF-8',"SJIS-win, UTF-8, Unicode",$ary);
	return $ary;
}

//csvファイル書き込み
function writeCsvFile($filepath, $records) {
	mb_convert_variables('SJIS-win','UTF-8',$records);
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
	mb_convert_variables('SJIS-win','UTF-8',$line);
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

function panel_child($todo, $parent) {
	//echo $todo[12]['child'];
	if($todo[$parent]['child'] != 0) {
		for($i=1; $i<count($todo); $i++) {
			if($todo[$i]['parent']==$parent && $todo[$i]['削除']==0) {
				if($todo[$i]['完了']==1) { echo "<div class='panel panel-success'>"; }
				else echo "<div class='panel panel-danger'>";
				echo "<div class='panel-heading'>";
				echo "<div class='clearfix'><span class='pull-right close' onClick='todo_delete_check(&quot;{$todo[$i]['タイトル']}&quot;, &quot;{$i}&quot;)'>&times;</span><h3 class='panel-title'>{$todo[$i]['タイトル']}</h3></div>";
				echo "</div>";
				echo "<div class='panel-body'>";
				echo "<div class='alert alert-dismissible alert-warning' style='margin-bottom:0'>{$todo[$i]['作業内容']}</div>";
				if($todo[$i]['成果物']!="") {
					echo "<div class='alert alert-dismissible alert-info'><!--<strong style='font-size:150%'>成果物</strong>-->{$todo[$i]['成果物']}</div>";
				} else echo "<div style='height:20px;'></div>";
				echo "<div class='col-xs-11'><div class='progress'><div class='progress-bar progress-bar-info progress-bar-striped active' role='progressbar' style='width: {$todo[$i]['パーセンテージ']}%;'>";
				echo "{$todo[$i]['パーセンテージ']}%";
				echo "</div></div></div>";
				if($todo[$i]['パーセンテージ']!=100) {
					echo "<div class='col-xs-1'><a href='todo.php?page=finish&p={$i}' class='btn btn-success'>完了</a></div>";
				}//todo.php?page=finish
				echo "<div style='height:50px;'></div>";
				panel_child($todo, $todo[$i]['id']);
				echo "</div>";
				echo "<div class='panel-footer'>{$todo[$i]['開始予定日']}　～　{$todo[$i]['納期']} {$todo[$i]['納期時間']}</div>";
				echo "</div>";
				
			}
		}
	}
	return $todo;
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
				$b = $todo[$i]['top'];
				echo "<a href='./todo.php?d=detail&p={$b}'";
				if($pattern=='primary') echo "style='color:#ffffff;'";
				if($pattern=='warning') echo "style='color:#fa8072;'";
				else if($pattern=='info') echo "style='color:#87ceeb;'";
				echo ">";
				echo "<h3 class='panel-title'>{$todo[$i]['タイトル']}<span class='pull-right'>{$todo[$todo[$i]['top']]['タイトル']}</span></h3>";
			}
			echo "</a></div>";
			echo "<div class='panel-body'>";
			if($pattern=='warning') echo "style='color:#fa8072;'";
			echo "";
			echo "<div class='col-md-9 col-xs-6'><strong>作業内容　: </strong>{$todo[$i]['作業内容']}<br><strong>成果物　　: </strong>{$todo[$i]['成果物']}<br><strong>期間　　　: </strong>{$todo[$i]['開始予定日']}　～　{$todo[$i]['納期']}</div>";
			//echo "<div class='col-md-1 col-xs-2'><a href='todo.php?page=do&p={$i}' class='btn btn-default'>作業</a></div>";
			echo "<div class='col-md-1 col-xs-2'><button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>作業 <span class='caret'></span></button><ul class='dropdown-menu' role='menu'>";
			for($j=ceil($todo[$i]['パーセンテージ']/10)*10; $j<100; $j+=10) 
			echo "<li role='presentation'><a role='menuitem' tabindex='-1' href='todo.php?page=do&p={$i}&f={$j}'>{$j}％まで完了</a></li>";
			echo "</ul></div>";
			echo "<div class='col-md-1 col-xs-2'><a href='todo.php?page=wait&p={$i}' class='btn btn-warning'>保留</a></div>";
			echo "<div class='col-md-1 col-xs-2'><a href='todo.php?page=finish&p={$i}' class='btn btn-success'>完了</a></div>";
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
