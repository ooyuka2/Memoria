<div class="col-xs-12">
      <?php
      	//$todo = readCsvFile2('../data/todo.csv');
		$todo_theme = readCsvFile2('../data/todo_theme.csv');
		$working = readCsvFile2('../data/working.csv');
		
		date_default_timezone_set('Asia/Tokyo');
		//$week_str_list = array( '��', '��', '��', '��', '��', '��', '�y');//$week_str = $week_str_list[ $datetime->format('w') ];
		$today = new DateTime();
		
		
		include('../data/weekly.php');
		
		?>
		<fieldset>
			<div class="well bs-component">
				
				<?php
					echo "<h3>?�T��F{$today->modify('friday')->format('m/d')}�F{$myname}</h3><hr><p>";
					$today = new DateTime();
					echo $weeklyTo."<br><br>";
					echo "�����b�ɂȂ��Ă���܂��B{$myname}�ł��B<br>�T����o�v���܂��B<br><br><br>�P�j�e�[�}�i��<br>{$thema1}<br><br>";
					echo "�Q�j���T�̋Ɩ��̃g�s�b�N�X<br>";
					
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
							echo "�@��{$todo[$ary[$c]]['�^�C�g��']}<br>";
							$workdetail = str_replace('<br>', '<br>�@�@�@', $todo[$ary[$c]]['��Ɠ��e']);
							echo "�@�@�@{$workdetail}<br>";
							for($j=1; $j<count($todo); $j++) {
								if($todo[$j]['parent'] == $ary[$c]) {
									echo "�@�@�@�E{$todo[$j]['�^�C�g��']}";
									if($todo[$j]['����']==1) echo "�@�i�����j<br>";
									else echo "�@�i������or������j<br>";
									
								}
							}
							echo "<br>";
							$c++;
						}
						
					}
					
					echo "�R�j���T�̎���<br>";
					week_do("monday", 1, $todo, $working);
					week_do("tuesday", 2, $todo, $working);
					week_do("wednesday", 3, $todo, $working);
					week_do("thursday", 4, $todo, $working);
					week_do("friday", 5, $todo, $working);
					echo "<br>";
					echo "�S�j���T�̎�ȗ\��<br>";
					next_week_do("monday", 1, $todo, $working);
					next_week_do("tuesday", 2, $todo, $working);
					next_week_do("wednesday", 3, $todo, $working);
					next_week_do("thursday", 4, $todo, $working);
					next_week_do("friday", 5, $todo, $working);
					echo "<br><br>";
					echo "���T�ȍ~<br>";
					$sat = $today->modify('sat next week')->setTime(0,0,0);
					$c = 0;
					$ary = array();
					for($i=1; $i<count($todo); $i++) {
						$workday = new DateTime($todo[$i]['�J�n�\���']);
						if(($workday->diff($sat)->format('%R%a')) <= 0 && serch_word($todo[$i]['top'], $ary)==0) {
							$ary[$c] = $todo[$i]['top'];
							echo "�@�@�@�E{$todo[$ary[$c]]['�^�C�g��']}<br>";
							$c++;
						}
					}
					if(count($ary)==0) echo "�@�@�@�Ȃ�<br>";
					echo "<br>�ȏ�A�X�������肢�v���܂��B</p>";
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
	$week_str_list = array( '��', '��', '��', '��', '��', '��', '�y');
	echo "{$day->format('n/d')}�i{$week_str_list[$day->format('w')]}�j<br>";
	for($i=1; $i<count($working); $i++) {
		$workday = new DateTime($working[$i]['day']);
		$workday = $workday->setTime(0,0,0);
		//echo $workday->format('m/d');
		if($working[$i]['id'] != "deskwork" && $workday->diff($day)->format('%R%a') == 0 && serch_word($todo[$working[$i]['id']]['top'], $ary)==0) {
			$ary[$c] = $todo[$working[$i]['id']]['top'];
			//echo $ary[$c];
			echo "�@�@�@�E{$todo[$ary[$c]]['�^�C�g��']}<br>";
			//echo "<br>";
			$c++;
		}
	}
	if(count($ary)==0) echo "�@�@�@�Ȃ�<br>";
}

function next_week_do($week, $week2, $todo, $working) {
	$today = new DateTime();
	$weekday = $week." next week";
	$day = $today->modify($weekday)->setTime(0,0,0);
	$c = 0;
	$ary = array();
	$week_str_list = array( '��', '��', '��', '��', '��', '��', '�y');
	echo "{$day->format('n/d')}�i{$week_str_list[$day->format('w')]}�j<br>";
	for($i=1; $i<count($todo); $i++) {
		$workday = new DateTime($todo[$i]['�J�n�\���']);
		$workday = $workday->setTime(0,0,0);
		//echo $workday->format('m/d');
		if($workday->diff($day)->format('%R%a') == 0 && serch_word($todo[$i]['top'], $ary)==0) {
			$ary[$c] = $todo[$i]['top'];
			//echo $ary[$c];
			echo "�@�@�@�E{$todo[$ary[$c]]['�^�C�g��']}<br>";
			//echo "<br>";
			$c++;
		}
	}
	if(count($ary)==0) echo "�@�@�@�Ȃ�<br>";
}
?>
