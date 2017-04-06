<div class="col-xs-12">
      <?php
      	$todo = readCsvFile2('../data/todo.csv');
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
					
					echo "<h3>〠週報：{$today->modify('friday')->format('m/d')}：{$myname}</h3><hr><p>";
					echo $weeklyTo."<br><br>";
					echo "お世話になっております。{$myname}です。<br>週報を提出致します。<br><br><br>１）テーマ進捗<br>なし<br><br>";
					echo "２）今週の業務のトピックス<br>";
					$monday = $today->modify('last monday');
					$c = 0;
					$ary = array();
					for($i=1; $i<count($working); $i++) {
						$workday = new DateTime($working[$i]['日付']);
						//$date2->diff($date1)->format('%R%a');
						if(($workday->diff($today)) <= $workday->diff($today->modify('last friday')) && serch_word($todo[$working[$i]['id']]['top'], $ary)==0) {
							$ary[$c] = $todo[$working[$i]['id']]['top'];
							//echo $ary[$c];
							echo "　◆{$todo[$ary[$c]]['タイトル']}<br>";
							for($j=1; $j<count($todo); $j++) {
								if($todo[$j]['parent'] == $ary[$c]) {
									echo "　               ・{$todo[$j]['タイトル']}";
									if($todo[$j]['完了']==1) echo "　（完了）<br>";
									else echo "　（作業中）<br>";
									
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
					echo "翌週以降<br>　　　なし<br><br>";
					echo "以上、宜しくお願い致します。</p>";
				?>
			</div>
	    </fieldset>

        <div style="height: 100px"></div>
</div>

<?php
/*

４）次週の主な予定
（月）
　　　なし
　　　・○○○○
（水）
　　　なし
（木）
　　　・○○○○
（金）
　　　なし



*/
function week_do($week, $week2, $todo, $working) {
	$today = new DateTime();
	/*if($week2<$today->format('w')) $weekday = "last ".$week;
	else if($week2==$today->format('w')) $weekday = $week;
	else return;//$weekday = "next ".$week;*/
	
	$weekday = $week." this week";
	
	$day = $today->modify($weekday);
	//echo $day->format('m/d');
	$c = 0;
	$ary = array();
	$week_str_list = array( '日', '月', '火', '水', '木', '金', '土');
	echo "（{$week_str_list[$day->format('w')]}）<br>";
	for($i=1; $i<count($working); $i++) {
		$workday = new DateTime($working[$i]['日付']);
		//echo $workday->format('m/d');
		if($workday->diff($day)->format('%R%a') == 0 && serch_word($todo[$working[$i]['id']]['top'], $ary)==0) {
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
	
	$day = $today->modify($weekday);
	$c = 0;
	$ary = array();
	$week_str_list = array( '日', '月', '火', '水', '木', '金', '土');
	echo "（{$week_str_list[$day->format('w')]}）<br>";
	for($i=1; $i<count($todo); $i++) {
		$workday = new DateTime($todo[$i]['開始予定日']);
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
