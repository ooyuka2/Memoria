
<?php
	//$todo = readCsvFile2('../data/todo.csv');
	$todo_theme = readCsvFile2('../data/todo_theme.csv');
	$working = readCsvFile2('../data/working.csv');
	$periodically = readCsvFile2('../data/periodically.csv');
	$weekly = readCsvFile2('../data/weekly.csv');
	
	date_default_timezone_set('Asia/Tokyo');
	//$week_str_list = array( '��', '��', '��', '��', '��', '��', '�y');//$week_str = $week_str_list[ $datetime->format('w') ];
	
	if(isset($_GET['day'])) $TodayS = $_GET['day'];
	else $TodayS = date('Ymd');
	$today = new DateTime($TodayS);
	
	include('../data/weekly.php');
	
	if(!isset($_GET['change'])) {
?>
	<div class="col-xs-12">
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
						
						$weeklyid = check2array($weekly, $i, "todoid");
						
						if($todo[$i]['���ԊǗ��e�[�}'] != 0 && ($todo[$i]['���ԊǗ��e�[�}'] < 30) && $todo[$i]['level']==1 && $weeklyid != -1 && $weekly[$weeklyid]['�\��'] == 0) {
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
							echo "{$todo[$i]['�^�C�g��']}�F";
							if($weeklyid != -1) echo "{$weekly[$weeklyid]['�S��']}";
							else echo $myname;
							if($todo[$i]['����']==1) echo "�y�F�����z<br>";
							else echo "<br>";
							//for($j=1; $j<count($todo); $j++) {
							//	if($todo[$j]['parent'] == $todo[$i]['id']) {
							//		echo "�@�@�@���E{$todo[$j]['�^�C�g��']}";
							//		if($todo[$j]['����']==1) echo "�F����<br>";
							//		else if($todo[$j]['�p�[�Z���e�[�W']==0) echo "<br>";
							//		else echo "<br>";
									
							//	}
							//}
							//$todo[$i]['id']
							if($weeklyid != -1) $workdetail = str_replace('<br>', '<br>�@�@�@', $weekly[$weeklyid]['�e�[�}�T�v']);
							else $workdetail = str_replace('<br>', '<br>�@�@�@', $todo[$i]['��Ɠ��e']);
							echo "�@���e�[�}�T�v��<br>�@�@�@{$workdetail}<br>";
							if($weeklyid != -1 && $weekly[$weeklyid]['�ς�'] != "") {
								echo "�@���ς݁�<br>";
								$workdetail = str_replace('<br>', '<br>�@�@�@', $weekly[$weeklyid]['�ς�']);
								echo "�@�@�@{$workdetail}<br>";
							}
							if($flug != 0) {
								echo "�@���i����<br>";
								if($weeklyid != -1) {
									$workdetail = str_replace('<br>', '<br>�@�@�@', $weekly[$weeklyid]['�i��']);
									echo "�@�@�@{$workdetail}<br>";
								} else {
									for($j=1; $j<count($working); $j++) {
										$workday = new DateTime($working[$j]['day']);
										if($working[$j]['id'] != "periodically" && $workday->diff($monday)->format('%R%a') <= 0 && $todo[$working[$j]['id']]['top'] == $i) {
											echo "�@�@�@{$workday->format('n/d')}�F{$todo[$working[$j]['id']]['�^�C�g��']}��<br>";
										}
									}
								}
							}
							if($todo[$i]['����'] == 0) {
								echo "�@������̗\�聄<br>";
								if($weeklyid != -1) {
									$workdetail = str_replace('<br>', '<br>�@�@�@', $weekly[$weeklyid]['����̗\��']);
									echo "�@�@�@{$workdetail}<br>";
								} else {
									for($j=1; $j<count($todo); $j++) {
										if($todo[$j]['top'] == $todo[$i]['id'] && $todo[$j]['����']==0) {
											$temp = new DateTime($todo[$j]['�[��']);
											echo "�@�@�@�`{$temp->format('n/d')}�@�F{$todo[$j]['�^�C�g��']}��<br>";
										}
									}
								}
							}
							echo "<br><br>";
							
							
						}

						
						
					}
					//
					echo "�R�D���̑�<br>";
					$ary = array();
					$c = 0;
					for($i=1; $i<count($working); $i++) {
						
						$workday = new DateTime($working[$i]['day']);
						if($working[$i]['id'] != "periodically" && ($todo[$todo[$working[$i]['id']]['top']]['���ԊǗ��e�[�}'] <= 0 || $todo[$todo[$working[$i]['id']]['top']]['���ԊǗ��e�[�}'] >= 30) && ($workday->diff($monday)->format('%R%a')) <= 0 && serch_word($todo[$working[$i]['id']]['top'], $ary)==0) {
							$ary[$c] = $todo[$working[$i]['id']]['top'];
							$weeklyid = check2array($weekly, $ary[$c], "todoid");
							echo "��{$todo[$ary[$c]]['�^�C�g��']}�F";
							if($weeklyid != -1) echo "{$weekly[$weeklyid]['�S��']}";
							else echo $myname;
							if($todo[$ary[$c]]['����']==1) echo "�y�F�����z<br>";
							else echo "<br>";
							
							
							for($j=1; $j<count($todo); $j++) {
								if($todo[$j]['parent'] == $ary[$c]) {
									echo "�@�@�@���E{$todo[$j]['�^�C�g��']}";
									if($todo[$j]['����']==1) echo "�F����<br>";
									else if($todo[$j]['�p�[�Z���e�[�W']==0) echo "<br>";
									else echo "<br>";
									
								}
							}
							if($weeklyid != -1) $workdetail = str_replace('<br>', '<br>�@�@�@', $weekly[$weeklyid]['�e�[�}�T�v']);
							else $workdetail = str_replace('<br>', '<br>�@�@�@', $todo[$ary[$c]]['��Ɠ��e']);
							echo "�@���e�[�}�T�v��<br>�@�@�@{$workdetail}<br>";
							if($weeklyid != -1 && $weekly[$weeklyid]['�ς�'] != "") {
								echo "�@���ς݁�<br>";
								$workdetail = str_replace('<br>', '<br>�@�@�@', $weekly[$weeklyid]['�ς�']);
								echo "�@�@�@{$workdetail}<br>";
							}
							echo "�@���i����<br>";
							if($weeklyid != -1) {
								$workdetail = str_replace('<br>', '<br>�@�@�@', $weekly[$weeklyid]['�i��']);
								echo "�@�@�@{$workdetail}<br>";
							} else {
								for($j=$i; $j<count($working); $j++) {
									if($working[$j]['id'] != "periodically" && $todo[$working[$j]['id']]['top'] == $todo[$working[$i]['id']]['top']) {
										echo "�@�@�@{$workday->format('n/d')}�F{$todo[$working[$j]['id']]['�^�C�g��']}��<br>";
									}
								}
							}
							if($todo[$i]['����'] == 0) {
								echo "�@������̗\�聄<br>";
								if($weeklyid != -1) {
									$workdetail = str_replace('<br>', '<br>�@�@�@', $weekly[$weeklyid]['����̗\��']);
									echo "�@�@�@{$workdetail}<br>";
								} else {
									for($j=1; $j<count($todo); $j++) {
										if($todo[$j]['top'] == $todo[$working[$i]['id']]['id'] && $todo[$j]['����']==0) {
											$temp = new DateTime($todo[$j]['�[��']);
											echo "�@�@�@�`{$temp->format('n/d')}�@�F{$todo[$j]['�^�C�g��']}��<br>";
										}
									}
								}
							}
							echo "<br><br>";
							$c++;
						}
						
					}
					//echo "�S�D���T�̎���<br>";
					//week_do("monday", 1, $todo, $working, $TodayS);
					//week_do("tuesday", 2, $todo, $working, $TodayS);
					//week_do("wednesday", 3, $todo, $working, $TodayS);
					//week_do("thursday", 4, $todo, $working, $TodayS);
					//week_do("friday", 5, $todo, $working, $TodayS);
					//echo "<br>";
					//echo "�T�D���T�̎�ȗ\��<br>";
					//next_week_do("monday", 1, $todo, $working, $periodically, $TodayS);
					//next_week_do("tuesday", 2, $todo, $working, $periodically, $TodayS);
					//next_week_do("wednesday", 3, $todo, $working, $periodically, $TodayS);
					//next_week_do("thursday", 4, $todo, $working, $periodically, $TodayS);
					//next_week_do("friday", 5, $todo, $working, $periodically, $TodayS);
					//echo "<br><br>";
					//echo "���T�ȍ~<br>";
					//$sat = $today->modify('sat next week')->setTime(0,0,0);
					//$c = 0;
					//$ary = array();
					//for($i=1; $i<count($todo); $i++) {
					//	$workday = new DateTime($todo[$i]['�J�n�\���']);
					//	if(($workday->diff($sat)->format('%R%a')) <= 0 && serch_word($todo[$i]['top'], $ary)==0) {
					//		$ary[$c] = $todo[$i]['top'];
					//		echo "�@�@�@�E{$todo[$ary[$c]]['�^�C�g��']}<br>";
					//		$c++;
					//	}
					//}
					if(count($ary)==0) echo "�@�@�@�Ȃ�<br>";
					echo "<br>�ȏ�A��낵�����肢�v���܂��B</p>";
				?>
			</div>
		</fieldset>
		<div style="height: 100px"></div>
	</div>
	<div class="form-group" style="margin-bottom:0; position: fixed; top: 100px;right:0;width:300px;">
		<button type="button" class="btn btn-primary btn-block" onclick="location.href = '/Memoria/pages/todo.php?d=weekly&change=change';">�ҏW</button>
	</div>

<?php
	} else if($_GET['change'] == "change") {
		$monday = $today->modify('monday this week')->setTime(0,0,0);
?>
<div class="bs-component table-responsive">
	<table class='table table-striped table-hover table-condensed'>
		<thead>
			<tr>
				<th class="col-md-2">�e�[�}</th>
				<th class="col-md-1"></th>
				<th class="col-md-5">�T��</th>
				<th class="col-md-4">�T��q���g</th>
			</tr>
		</thead>
		<tbody>
			<?php
				
				for($i=1; $i<count($weekly); $i++) {
					echo "<tr><td rowspan='9'>{$todo[$weekly[$i]['todoid']]['�^�C�g��']}</td><td>";

					echo "�i���L�薳��";
					echo "</td><td>";
					$flug = 0;
					for($j=1; $j<count($working); $j++) {
						if($working[$j]['id'] != "periodically" && $todo[$working[$j]['id']]['top'] == $weekly[$i]['todoid']) {
							$workday = new DateTime($working[$j]['day']);
							if($workday->diff($monday)->format('%R%a') <= 0) {
								echo "��";
								$flug = 1;
								break;
							}
						}
					}
					if($flug == 0) echo "�Z";
					echo "</td><td>";
					echo "</td></tr><tr><td>";
					
					echo "�ŏI�X�V����";
					echo "</td><td>";
					echo "</td><td>";
					echo "</td></tr><tr><td>";
					
					echo "�e�[�}�T�v";
					echo "</td><td>";
					echo $weekly[$i]['�e�[�}�T�v'];
					echo "</td><td>";
					echo $todo[$weekly[$i]['todoid']]['��Ɠ��e'];
					echo "</td></tr><tr><td>";
					
					echo "�S��";
					echo "</td><td>";
					echo $weekly[$i]['�S��'];
					echo "</td><td>";
					echo $weekly[$i]['�S��'];
					echo "</td></tr><tr><td>";
					
					echo "�ς�";
					echo "</td><td>";
					echo $weekly[$i]['�ς�'];
					echo "</td><td>";
					echo $weekly[$i]['�ς�'];
					echo "</td></tr><tr><td>";
					
					echo "�i��";
					echo "</td><td>";
					echo $weekly[$i]['�i��'];
					echo "</td><td>";
					if($flug != 0) {
						for($j=1; $j<count($working); $j++) {
							$workday = new DateTime($working[$j]['day']);
							if($working[$j]['id'] != "periodically" && $workday->diff($monday)->format('%R%a') <= 0 && $todo[$working[$j]['id']]['top'] == $weekly[$i]['todoid']) {
								echo "�@�@�@{$workday->format('n/d')}�F{$todo[$working[$j]['id']]['�^�C�g��']}��<br>";
							}
						}
					}
					echo "</td></tr><tr><td>";
					
					echo "����̗\��";
					echo "</td><td>";
					echo $weekly[$i]['����̗\��'];
					echo "</td><td>";
					if($todo[$weekly[$i]['todoid']]['����']==0) {
						for($j=1; $j<count($todo); $j++) {
							if($todo[$j]['top'] == $todo[$weekly[$i]['todoid']]['id'] && $todo[$j]['����']==0) {
								$temp = new DateTime($todo[$j]['�[��']);
								echo "�@�@�@�`{$temp->format('n/d')}�@�F{$todo[$j]['�^�C�g��']}��<br>";
							}
						}
					}
					echo "</td></tr><tr><td>";
					
					echo "�\��";
					echo "</td><td>";
					echo "</td><td>";

					echo "</td></tr><tr><td></td><td></td><td></td></tr>";
				}
			?>
		</tbody>
	</table>
</div>









<?php
	} else if($_GET['change'] == "go") {
	
	}
?>



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
	$echoString = "";
	
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
			$echoString = $week_do_text . $echoString;
		}
		else if ($flug == 1) break;
	}
	echo $echoString;
	
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
