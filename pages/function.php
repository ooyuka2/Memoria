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
	mb_convert_variables('UTF-8',"SJIS-win, UTF-8",$records);
	//print_r($records);
	return $records;
}

//ファイル読み込んで配列に入れる
function readCsvFile2($filepath) {
if (is_readable($filepath)) {
		$file = new SplFileObject($filepath); 
		$file->setFlags(SplFileObject::READ_CSV); 
		foreach ($file as $line) {
			if(!is_null($line[0])){
				$records[] = $line;
			}
		}
		mb_convert_variables('UTF-8',"SJIS-win, UTF-8",$records);
		for($i=0;$i<count($records);$i++) {
			for($j=0;$j<count($records[0]);$j++) {
				$ary[$i][$records[0][$j]] = $records[$i][$j];
			}
		}
	}else {
		$ary = null;
	}
	//print_r($ary);
	mb_convert_variables('UTF-8',"SJIS-win, UTF-8",$ary);
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
				echo "<h3 class='panel-title'>{$todo[$i]['タイトル']}</h3>";
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

?>