<div class="col-xs-12">
      <?php
      	//$todo = readCsvFile2('../data/todo.csv');
		$todo_theme = readCsvFile2('../data/todo_theme.csv');
		$working = readCsvFile2('../data/working.csv');
		
		date_default_timezone_set('Asia/Tokyo');
		//$week_str_list = array( '日', '月', '火', '水', '木', '金', '土');//$week_str = $week_str_list[ $datetime->format('w') ];
		$today = new DateTime();
		
		
		include('../data/weekly.php');
		
		?>
		<fieldset>
			<div class="well bs-component">
				
				<?php
					echo "<h3>?週報：{$today->modify('friday')->format('m/d')}：{$myname}</h3><hr><p>";
					$today = new DateTime();
					echo $weeklyTo."<br><br>";
					echo "お世話になっております。{$myname}です。<br>週報を提出致します。<br><br><br>１）テーマ進捗<br>{$thema1}<br><br>";
					echo "２）今週の業務のトピックス<br>";
					
					$monday = $today->modify('monday this week')->setTime(0,0,0);
					
					$c = 0;
					$ary = array();
					for($i=1; $i<count($working); $i++) {
						$workday = new DateTime($working[$i]['day']);
						//$date2->diff($date1)->format('%R%a');
						//echo $workday->format('m/d').":::";
						//echo $workday->diff($monday)->format('%R%a')."<br>";
						if($working[$i]['id'] != "deskwork" && ($workday->diff($monday)->format('%R%a')) <= 0 && serch_word($todo[$working[$i]['id']]['top'], $ary)==0) {
							$ary[$c] = $todo[$working[$i]['id']]['top'];
							//echo $ary[$c];
							echo "　◆{$todo[$ary[$c]]['タイトル']}<br>";
							$workdetail = str_replace('<br>', '<br>　　　', $todo[$ary[$c]]['作業内容']);
							echo "　　　{$workdetail}<br>";
							for($j=1; $j<count($todo); $j++) {
								if($todo[$j]['parent'] == $ary[$c]) {
									echo "　　　・{$todo[$j]['タイトル']}";
									if($todo[$j]['完了']==1) echo "　（完了）<br>";
									else echo "　（未完了or未着手）<br>";
									
								}
							}
							echo "<br>";
							$c++;
						}
						
					}
					
					echo "３）今週の実績<br>";
					week_do("monday", 1, $todo, $working);
					week_do("tuesday", 2, $todo, $working);
					week_do("wednesday", 3, $todo, $working);
					week_do("thursday", 4, $todo, $working);
					week_do("friday", 5, $todo, $working);
					echo "<br>";
					echo "４）次週の主な予定<br>";
					next_week_do("monday", 1, $todo, $working);
					next_week_do("tuesday", 2, $todo, $working);
					next_week_do("wednesday", 3, $todo, $working);
					next_week_do("thursday", 4, $todo, $working);
					next_week_do("friday", 5, $todo, $working);
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
					echo "<br>以上、宜しくお願い致します。</p>";
				?>
			</div>
	    </fieldset>

        <div style="height: 100px"></div>
</div>

<?php
function week_do($week, $week2, $todo, $working) {
	$today = new DateTime();
	/*if($week2<$today->format('w')) $weekday = "last ".$week;
	else if($week2==$today->format('w')) $weekday = $week;
	else return;//$weekday = "next ".$week;*/
	
	$weekday = $week." this week";
	$day = $today->modify($weekday)->setTime(0,0,0);
	//echo $day->format('m/d');
	$c = 0;
	$ary = array();
	$week_str_list = array( '日', '月', '火', '水', '木', '金', '土');
	echo "{$day->format('n/d')}（{$week_str_list[$day->format('w')]}）<br>";
	for($i=1; $i<count($working); $i++) {
		$workday = new DateTime($working[$i]['day']);
		$workday = $workday->setTime(0,0,0);
		//echo $workday->format('m/d');
		if($working[$i]['id'] != "deskwork" && $workday->diff($day)->format('%R%a') == 0 && serch_word($todo[$working[$i]['id']]['top'], $ary)==0) {
			$ary[$c] = $todo[$working[$i]['id']]['top'];
			//echo $ary[$c];
			echo "　　　・{$todo[$ary[$c]]['タイトル']}<br>";
			//echo "<br>";
			$c++;
		}
	}
	if(count($ary)==0) echo "　　　なし<br>";
}

function next_week_do($week, $week2, $todo, $working) {
	$today = new DateTime();
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
	if(count($ary)==0) echo "　　　なし<br>";
}
?>
