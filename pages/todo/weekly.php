<div class="col-xs-12">
      <?php
      	//$todo = readCsvFile2('../data/todo.csv');
		$todo_theme = readCsvFile2('../data/todo_theme.csv');
		$working = readCsvFile2('../data/working.csv');
		$periodically = readCsvFile2('../data/periodically.csv');
		date_default_timezone_set('Asia/Tokyo');
		//$week_str_list = array( '��', '��', '��', '��', '��', '��', '�y');//$week_str = $week_str_list[ $datetime->format('w') ];
		
		if(isset($_GET['day'])) $TodayS = $_GET['day'];
		else $TodayS = date('Ymd');
		$today = new DateTime($TodayS);
		
		echo $TodayS;
		include('../data/weekly.php');
		
		?>
		<fieldset>
			<div class="well bs-component">
				
				<?php
					echo "<h3>?�T��F{$today->modify('friday')->format('m/d')}�F{$myname}</h3><hr><p>";
					echo $weeklyTo."<br><br>";
					echo "���������b�ɂȂ��Ă���܂��B<br>{$myname}�ł��B<br>���T�̏T����o�v���܂��B<br><br><br>�P�D�g�s�b�N�X�i�]����*�R�s�y�ł���T�����сj<br>�e�[�}���F�S����<br><br><br><br>";
					echo "�Q�D�e�[�}�i��<br>";
					
					$monday = $today->modify('monday this week')->setTime(0,0,0);
					
					$c = 0;
					$ary = array();
					
					for($i=1; $i<count($todo); $i++) {
						if($todo[$i]['�e�[�}�Ή�'] == 1) {
							$flug = 0;
							for($j=1; $j<count($working); $j++) {
								if($working[$j]['id'] != "periodically" && $todo[$working[$j]['id']]['top'] == $i) {
									$workday = new DateTime($working[$j]['day']);
									if($workday->diff($monday)->format('%R%a') <= 0) {
										echo "��";
										$flug = 1;
										break;
									}
								}
							}
							if($flug == 0) echo "�Z";
							echo "{$todo[$i]['�^�C�g��']}<br>";
							for($j=1; $j<count($todo); $j++) {
								if($todo[$j]['parent'] == $todo[$i]['id']) {
									echo "�@�@�@���E{$todo[$j]['�^�C�g��']}";
									if($todo[$j]['����']==1) echo "�F����<br>";
									else if($todo[$j]['�p�[�Z���e�[�W']==0) echo "<br>";
									else echo "<br>";
									
								}
							}
							//$todo[$i]['id']
							$workdetail = str_replace('<br>', '<br>�@�@�@', $todo[$i]['�e�[�}�T�v']);
							echo "�@���e�[�}�T�v��<br>�@�@�@{$workdetail}<br>";
							echo "�@���i����<br>";
							for($j=1; $j<count($working); $j++) {
								$workday = new DateTime($working[$j]['day']);
								if($working[$j]['id'] != "periodically" && $workday->diff($monday)->format('%R%a') <= 0 && $todo[$working[$j]['id']]['top'] == $i) {
									echo "�@�@�@{$workday->format('n/d')}�F{$todo[$working[$j]['id']]['�^�C�g��']}��<br>";
								}
							}
							if($todo[$i]['����'] == 0) echo "�@������̗\�聄<br>";
							echo "<br>";
							
							
						}

						
						
					}
					//
					echo "�R�D���̑�<br>";
					$ary = array();
					$c = 0;
					for($i=1; $i<count($working); $i++) {
						$workday = new DateTime($working[$i]['day']);
						if($working[$i]['id'] != "periodically" && $todo[$working[$i]['id']]['�e�[�}�Ή�'] == 0 && ($workday->diff($monday)->format('%R%a')) <= 0 && serch_word($todo[$working[$i]['id']]['top'], $ary)==0) {
							$ary[$c] = $todo[$working[$i]['id']]['top'];
							echo "��{$todo[$ary[$c]]['�^�C�g��']}<br>";
							for($j=1; $j<count($todo); $j++) {
								if($todo[$j]['parent'] == $ary[$c]) {
									echo "�@�@�@���E{$todo[$j]['�^�C�g��']}";
									if($todo[$j]['����']==1) echo "�F����<br>";
									else if($todo[$j]['�p�[�Z���e�[�W']==0) echo "<br>";
									else echo "<br>";
									
								}
							}
							$workdetail = str_replace('<br>', '<br>�@�@�@', $todo[$ary[$c]]['��Ɠ��e']);
							echo "�@���e�[�}�T�v��<br>�@�@�@{$workdetail}<br>";
							echo "�@���i����<br>";
							
							for($j=$i; $j<count($working); $j++) {
								if($working[$j]['id'] != "periodically" && $todo[$working[$j]['id']]['top'] == $todo[$working[$i]['id']]['top']) {
									echo "�@�@�@{$workday->format('n/d')}�F{$todo[$working[$j]['id']]['�^�C�g��']}��<br>";
								}
							}
							echo "�@������̗\�聄<br>";
							echo "<br>";
							$c++;
						}
						
					}
					echo "�S�D���T�̎���<br>";
					week_do("monday", 1, $todo, $working, $TodayS);
					week_do("tuesday", 2, $todo, $working, $TodayS);
					week_do("wednesday", 3, $todo, $working, $TodayS);
					week_do("thursday", 4, $todo, $working, $TodayS);
					week_do("friday", 5, $todo, $working, $TodayS);
					echo "<br>";
					echo "�T�D���T�̎�ȗ\��<br>";
					next_week_do("monday", 1, $todo, $working, $periodically, $TodayS);
					next_week_do("tuesday", 2, $todo, $working, $periodically, $TodayS);
					next_week_do("wednesday", 3, $todo, $working, $periodically, $TodayS);
					next_week_do("thursday", 4, $todo, $working, $periodically, $TodayS);
					next_week_do("friday", 5, $todo, $working, $periodically, $TodayS);
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
					echo "<br>�ȏ�A��낵�����肢�v���܂��B</p>";
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
//	$week_str_list = array( '��', '��', '��', '��', '��', '��', '�y');
//	echo "{$day->format('n/d')}�i{$week_str_list[$day->format('w')]}�j<br>";
//	//echo $day->format('w');
//	for($i=1; $i<count($working); $i++) {
//		$workday = new DateTime($working[$i]['day']);
//		$workday = $workday->setTime(0,0,0);
//		//echo $workday->format('m/d');
//		if($working[$i]['id'] != "periodically" && $workday->diff($day)->format('%R%a') == 0 && serch_word($todo[$working[$i]['id']]['top'], $ary)==0) {
//			$ary[$c] = $todo[$working[$i]['id']]['top'];
//			//echo $ary[$c];
//			echo "�@�@�@�E{$todo[$ary[$c]]['�^�C�g��']}<br>";
//			//echo "<br>";
//			$c++;
//		}
//	}
//	if(count($ary)==0) echo "�@�@�@�Ȃ�<br>";
//}

function week_do($week, $week2, $todo, $working, $TodayS) {
	$today = new DateTime($TodayS);
	$weekday = $week." this week";
	$day = $today->modify($weekday)->setTime(0,0,0);
	$c = 0;
	$ary = array();
	$week_str_list = array( '��', '��', '��', '��', '��', '��', '�y');
	echo "{$day->format('n��d��')}�i{$week_str_list[$day->format('w')]}�j<br>";
	$flug =0;

	for($i=count($working)-1; $i>0; $i--) {
		$workday = new DateTime($working[$i]['day']);
		$workday = $workday->setTime(0,0,0);
		if($workday == $day) {
			$flug = 1;
			$week_do_text = "";
			if($working[$i]['keeper'] == 1) continue;
			$processTime = str_replace(":", "", $working[$i]['startTime'] . "-" . $working[$i]['finishTime']);
			$week_do_text .= "�@�@�@�@". $processTime . "�@�@�@";
			if($working[$i]['id'] == "periodically") {
				if(strpos($working[$i]['note'], '<br>') !== false){
					$note = str_replace("<br>", "\\n", "&quot".$working[$i]['note']."&quot");//\\\'
				} else $note = $working[$i]['note'];
				$week_do_text .= $note . "<br>";
			} else {
				$week_do_text .= $todo[$todo[$working[$i]['id']]['top']]['�^�C�g��'] . "<br>";
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
	for($i=1; $i<count($periodically); $i++) {
		if($periodically[$i]['�j��'] == $week) {
			echo "�@�@�@�E{$periodically[$i]['���e']}<br>";
			$c++;
		}
	}
	if(count($ary)==0) echo "�@�@�@�Ȃ�<br>";
}
?>
