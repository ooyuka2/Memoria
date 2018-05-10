<div class="col-xs-12">
      <?php
      	//$todo = readCsvFile2('../data/todo.csv');
		$todo_theme = readCsvFile2('../data/todo_theme.csv');
		$working = readCsvFile2('../data/working.csv');
		$periodically = readCsvFile2('../data/periodically.csv');
		date_default_timezone_set('Asia/Tokyo');
		//$week_str_list = array( '日', '月', '火', '水', '木', '金', '土');//$week_str = $week_str_list[ $datetime->format('w') ];
		
		if(isset($_GET['day'])) $TodayS = $_GET['day'];
		else $TodayS = date('Ymd');
		$today = new DateTime($TodayS);
		
		echo $TodayS;
		include('../data/weekly.php');
		
		?>
		<fieldset>
			<div class="well bs-component">
				
				<?php
					echo "<h3>?週報：{$today->modify('friday')->format('m/d')}：{$myname}</h3><hr><p>";
					echo $weeklyTo."<br><br>";
					echo "いつもお世話になっております。<br>{$myname}です。<br>今週の週報を提出致します。<br><br><br>１．トピックス（従来の*コピペできる週次実績）<br>テーマ名：担当名<br><br><br><br>";
					echo "２．テーマ進捗<br>";
					
					$monday = $today->modify('monday this week')->setTime(0,0,0);
					
					$c = 0;
					$ary = array();
					
					for($i=1; $i<count($todo); $i++) {
						if($todo[$i]['テーマ対応'] == 1) {
							$flug = 0;
							for($j=1; $j<count($working); $j++) {
								if($working[$j]['id'] != "periodically" && $todo[$working[$j]['id']]['top'] == $i) {
									$workday = new DateTime($working[$j]['day']);
									if($workday->diff($monday)->format('%R%a') <= 0) {
										echo "●";
										$flug = 1;
										break;
									}
								}
							}
							if($flug == 0) echo "〇";
							echo "{$todo[$i]['タイトル']}<br>";
							for($j=1; $j<count($todo); $j++) {
								if($todo[$j]['parent'] == $todo[$i]['id']) {
									echo "　　　□・{$todo[$j]['タイトル']}";
									if($todo[$j]['完了']==1) echo "：完了<br>";
									else if($todo[$j]['パーセンテージ']==0) echo "<br>";
									else echo "<br>";
									
								}
							}
							//$todo[$i]['id']
							$workdetail = str_replace('<br>', '<br>　　　', $todo[$i]['テーマ概要']);
							echo "　＜テーマ概要＞<br>　　　{$workdetail}<br>";
							echo "　＜進捗＞<br>";
							for($j=1; $j<count($working); $j++) {
								$workday = new DateTime($working[$j]['day']);
								if($working[$j]['id'] != "periodically" && $workday->diff($monday)->format('%R%a') <= 0 && $todo[$working[$j]['id']]['top'] == $i) {
									echo "　　　{$workday->format('n/d')}：{$todo[$working[$j]['id']]['タイトル']}→<br>";
								}
							}
							if($todo[$i]['完了'] == 0) echo "　＜今後の予定＞<br>";
							echo "<br>";
							
							
						}

						
						
					}
					//
					echo "３．その他<br>";
					$ary = array();
					$c = 0;
					for($i=1; $i<count($working); $i++) {
						$workday = new DateTime($working[$i]['day']);
						if($working[$i]['id'] != "periodically" && $todo[$working[$i]['id']]['テーマ対応'] == 0 && ($workday->diff($monday)->format('%R%a')) <= 0 && serch_word($todo[$working[$i]['id']]['top'], $ary)==0) {
							$ary[$c] = $todo[$working[$i]['id']]['top'];
							echo "●{$todo[$ary[$c]]['タイトル']}<br>";
							for($j=1; $j<count($todo); $j++) {
								if($todo[$j]['parent'] == $ary[$c]) {
									echo "　　　□・{$todo[$j]['タイトル']}";
									if($todo[$j]['完了']==1) echo "：完了<br>";
									else if($todo[$j]['パーセンテージ']==0) echo "<br>";
									else echo "<br>";
									
								}
							}
							$workdetail = str_replace('<br>', '<br>　　　', $todo[$ary[$c]]['作業内容']);
							echo "　＜テーマ概要＞<br>　　　{$workdetail}<br>";
							echo "　＜進捗＞<br>";
							
							for($j=$i; $j<count($working); $j++) {
								if($working[$j]['id'] != "periodically" && $todo[$working[$j]['id']]['top'] == $todo[$working[$i]['id']]['top']) {
									echo "　　　{$workday->format('n/d')}：{$todo[$working[$j]['id']]['タイトル']}→<br>";
								}
							}
							echo "　＜今後の予定＞<br>";
							echo "<br>";
							$c++;
						}
						
					}
					echo "４．今週の実績<br>";
					week_do("monday", 1, $todo, $working, $TodayS);
					week_do("tuesday", 2, $todo, $working, $TodayS);
					week_do("wednesday", 3, $todo, $working, $TodayS);
					week_do("thursday", 4, $todo, $working, $TodayS);
					week_do("friday", 5, $todo, $working, $TodayS);
					echo "<br>";
					echo "５．次週の主な予定<br>";
					next_week_do("monday", 1, $todo, $working, $periodically, $TodayS);
					next_week_do("tuesday", 2, $todo, $working, $periodically, $TodayS);
					next_week_do("wednesday", 3, $todo, $working, $periodically, $TodayS);
					next_week_do("thursday", 4, $todo, $working, $periodically, $TodayS);
					next_week_do("friday", 5, $todo, $working, $periodically, $TodayS);
					echo "<br><br>";
					echo "翌週以降<br>";
					$sat = $today->modify('sat next week')->setTime(0,0,0);
					$c = 0;
					$ary = array();
					for($i=1; $i<count($todo); $i++) {
						$workday = new DateTime($todo[$i]['開始予定日']);
						if(($workday->diff($sat)->format('%R%a')) <= 0 && serch_word($todo[$i]['top'], $ary)==0) {
							$ary[$c] = $todo[$i]['top'];
							echo "　　　・{$todo[$ary[$c]]['タイトル']}<br>";
							$c++;
						}
					}
					if(count($ary)==0) echo "　　　なし<br>";
					echo "<br>以上、よろしくお願い致します。</p>";
				?>
			</div>
	    </fieldset>

        <div style="height: 100px"></div>
</div>

<?php
//function week_do($week, $week2, $todo, $working, $TodayS) {
//	$today = new DateTime($TodayS);
//	$weekday = $week." this week";
//	//echo $weekday;
//	$day = $today->modify($weekday)->setTime(0,0,0);
//	//echo $day->modify($weekday)->format('m/d');
//	$c = 0;
//	$ary = array();
//	$week_str_list = array( '日', '月', '火', '水', '木', '金', '土');
//	echo "{$day->format('n/d')}（{$week_str_list[$day->format('w')]}）<br>";
//	//echo $day->format('w');
//	for($i=1; $i<count($working); $i++) {
//		$workday = new DateTime($working[$i]['day']);
//		$workday = $workday->setTime(0,0,0);
//		//echo $workday->format('m/d');
//		if($working[$i]['id'] != "periodically" && $workday->diff($day)->format('%R%a') == 0 && serch_word($todo[$working[$i]['id']]['top'], $ary)==0) {
//			$ary[$c] = $todo[$working[$i]['id']]['top'];
//			//echo $ary[$c];
//			echo "　　　・{$todo[$ary[$c]]['タイトル']}<br>";
//			//echo "<br>";
//			$c++;
//		}
//	}
//	if(count($ary)==0) echo "　　　なし<br>";
//}

function week_do($week, $week2, $todo, $working, $TodayS) {
	$today = new DateTime($TodayS);
	$weekday = $week." this week";
	$day = $today->modify($weekday)->setTime(0,0,0);
	$c = 0;
	$ary = array();
	$week_str_list = array( '日', '月', '火', '水', '木', '金', '土');
	echo "{$day->format('n月d日')}（{$week_str_list[$day->format('w')]}）<br>";
	$flug =0;

	for($i=count($working)-1; $i>0; $i--) {
		$workday = new DateTime($working[$i]['day']);
		$workday = $workday->setTime(0,0,0);
		if($workday == $day) {
			$flug = 1;
			$week_do_text = "";
			if($working[$i]['keeper'] == 1) continue;
			$processTime = str_replace(":", "", $working[$i]['startTime'] . "-" . $working[$i]['finishTime']);
			$week_do_text .= "　　　　". $processTime . "　　　";
			if($working[$i]['id'] == "periodically") {
				if(strpos($working[$i]['note'], '<br>') !== false){
					$note = str_replace("<br>", "\\n", "&quot".$working[$i]['note']."&quot");//\\\'
				} else $note = $working[$i]['note'];
				$week_do_text .= $note . "<br>";
			} else {
				$week_do_text .= $todo[$todo[$working[$i]['id']]['top']]['タイトル'] . "<br>";
			}
			echo $week_do_text;
		}
		else if ($flug == 1) break;
	}
}


function next_week_do($week, $week2, $todo, $working, $periodically, $TodayS) {
	$today = new DateTime($TodayS);
	$weekday = $week." next week";
	$day = $today->modify($weekday)->setTime(0,0,0);
	$c = 0;
	$ary = array();
	$week_str_list = array( '日', '月', '火', '水', '木', '金', '土');
	echo "{$day->format('n/d')}（{$week_str_list[$day->format('w')]}）<br>";
	for($i=1; $i<count($todo); $i++) {
		$workday = new DateTime($todo[$i]['開始予定日']);
		$workday = $workday->setTime(0,0,0);
		//echo $workday->format('m/d');
		if($workday->diff($day)->format('%R%a') == 0 && serch_word($todo[$i]['top'], $ary)==0) {
			$ary[$c] = $todo[$i]['top'];
			//echo $ary[$c];
			echo "　　　・{$todo[$ary[$c]]['タイトル']}<br>";
			//echo "<br>";
			$c++;
		}
	}
	for($i=1; $i<count($periodically); $i++) {
		if($periodically[$i]['曜日'] == $week) {
			echo "　　　・{$periodically[$i]['内容']}<br>";
			$c++;
		}
	}
	if(count($ary)==0) echo "　　　なし<br>";
}
?>
