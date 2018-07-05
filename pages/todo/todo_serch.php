
<?php
	header("Content-type: text/html; charset=SJIS-win");
	include('../function.php');
	$todo = readCsvFile2('../../data/todo.csv');
	$working = readCsvFile2('../../data/working.csv');
	$file = "todo";
	if(isset($_GET['search'])) {
		$searchtext=mb_convert_encoding($_GET['search'], "SJIS-win", "ASCII,JIS,UTF-8,EUC-JP,SJIS, SJIS-win, Unicode");
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
					if(strpos($todo[$j]['タイトル'],$searchtext) !== false || strpos($todo[$j]['作業内容'],$searchtext) !== false || strpos($todo[$j]['タイトル'],$searchtext) !== false || strpos($todo[$j]['作業内容'],$searchtext) !== false) {
						$flug = 1;
						break;
					}
				}
			}
			
			
			if($flug ==1) {
				echo "<div class='panel panel-primary' id='todoid{$todo[$top]['id']}'>";
				echo "<div class='panel-heading'>";
				echo "<a href='./todo.php?d=detail&p={$top}&file={$file}' style='color:#ffffff;'>";
				echo "<h3 class='panel-title'>{$todo[$top]['タイトル']}</h3>";
				echo "</a></div>";
				echo "<div class='panel-body'>";
				echo "{$todo[$top]['作業内容']}<br>";
				echo "<div class='col-xs-12'><div class='progress'><div class='progress-bar progress-bar-success progress-bar-striped active' role='progressbar' style='width: {$todo[$top]['パーセンテージ']}%;'>";
				echo "{$todo[$top]['パーセンテージ']}%";
				echo "</div></div></div>";
				echo "</div>";
				echo "<div class='panel-footer'>{$todo[$top]['開始予定日']}　～　{$todo[$top]['納期']}</div>";
				echo "</div>";
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
					if(strpos($todo[$j]['タイトル'],$searchtext) !== false || strpos($todo[$j]['作業内容'],$searchtext) !== false || strpos($todo[$j]['タイトル'],$searchtext) !== false || strpos($todo[$j]['作業内容'],$searchtext) !== false) {
						$flug = 1;
						break;
					}
				}
			}
			
			if($flug ==1) {
				echo "<div class='panel panel-primary' id='todoid{$todo[$top]['id']}'>";
				echo "<div class='panel-heading'>";
				echo "<a href='./todo.php?d=detail&p={$top}&file={$file}' style='color:#ffffff;'>";
				echo "<h3 class='panel-title'>{$todo[$top]['タイトル']}</h3>";
				echo "</a></div>";
				echo "<div class='panel-body'>";
				echo "{$todo[$top]['作業内容']}<br>";
				echo "<div class='col-xs-12'><div class='progress'><div class='progress-bar progress-bar-success progress-bar-striped active' role='progressbar' style='width: {$todo[$top]['パーセンテージ']}%;'>";
				echo "{$todo[$top]['パーセンテージ']}%";
				echo "</div></div></div>";
				echo "</div>";
				echo "<div class='panel-footer'>{$todo[$top]['開始予定日']}　～　{$todo[$top]['納期']}</div>";
				echo "</div>";
			}
		}
	}

	if(isset($searchtext)) {
		$todo = readCsvFile2('../../data/old201804todo.csv');
		$working = readCsvFile2('../../data/old201804working.csv');
		$file = "old201804";
		if(isset($searchtext)) {
			$searchtext=$searchtext;
		} else {
			$searchtext="";
		}
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
						if(strpos($todo[$j]['タイトル'],$searchtext) !== false || strpos($todo[$j]['作業内容'],$searchtext) !== false || strpos($todo[$j]['タイトル'],$searchtext) !== false || strpos($todo[$j]['作業内容'],$searchtext) !== false) {
							$flug = 1;
							break;
						}
					}
				}
				
				if($flug ==1) {
					echo "<div class='panel panel-primary' id='todoid{$todo[$top]['id']}'>";
					echo "<div class='panel-heading'>";
					echo "<a href='./todo.php?d=detail&p={$top}&file={$file}' style='color:#ffffff;'>";
					echo "<h3 class='panel-title'>{$todo[$top]['タイトル']}</h3>";
					echo "</a></div>";
					echo "<div class='panel-body'>";
					echo "{$todo[$top]['作業内容']}<br>";
					echo "<div class='col-xs-12'><div class='progress'><div class='progress-bar progress-bar-success progress-bar-striped active' role='progressbar' style='width: {$todo[$top]['パーセンテージ']}%;'>";
					echo "{$todo[$top]['パーセンテージ']}%";
					echo "</div></div></div>";
					echo "</div>";
					echo "<div class='panel-footer'>{$todo[$top]['開始予定日']}　～　{$todo[$top]['納期']}</div>";
					echo "</div>";
				}
			}
		}
	}
?>