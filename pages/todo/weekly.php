
<?php
	//$todo = readCsvFile2('../data/todo.csv');
	date_default_timezone_set('Asia/Tokyo');
	if(!isset($ini)) $ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	
	//$week_str_list = array( '��', '��', '��', '��', '��', '��', '�y');//$week_str = $week_str_list[ $datetime->format('w') ];
	
	if(isset($_GET['day'])) $TodayS = $_GET['day'];
	else $TodayS = date('Ymd');
	$today = new DateTime($TodayS);
	
	
	
	if(!isset($_GET['change'])) {
		if(!isset($todo)) $todo = readCsvFile2($ini['dirWin'].'/data/todo.csv');
		$todo_theme = readCsvFile2($ini['dirWin'].'/data/todo_theme.csv');
		$working = readCsvFile2($ini['dirWin'].'/data/working.csv');
		$periodically = readCsvFile2($ini['dirWin'].'/data/periodically.csv');
		$weekly = readCsvFile2($ini['dirWin'].'/data/weekly.csv');
		if(!isset($link_todo_weekly_html)) $link_todo_weekly_html = "/Memoria/pages/todo.php?d=weekly";
?>
	<div class="col-xs-12  container-fluid">
		<fieldset>
			<div class="well bs-component">
				
				<?php
					echo "<h3>?�T��F{$today->modify('friday')->format('m/d')}�F{$ini['myname']}</h3><hr><p>";
					echo $ini['weeklyTo']."<br><br>";
					echo "���������b�ɂȂ��Ă���܂��B<br>{$ini['myname']}�ł��B<br>���T�̏T����o�v���܂��B<br><br><br>�P�D�g�s�b�N�X�i�]����*�R�s�y�ł���T�����сj<br><br>�@�@�@�Ȃ�<br><br><br>";
					echo "�Q�D�e�[�}�i��<br>";
					
					//�e�[�}�ɂ��Ă܂Ƃ߂Ă���\��\���B
					//�\��settings����ݒ�B
					//�������A�T���ƂɃt�@�C�����ς�邽�ߒ���
					echo "<br>�@�@�@".str_replace("<br>", "<br>�@�@�@", $ini['thema1'])."<br><br>";
					//
					echo "�R�D���̑�<br>";
					
					$monday = $today->modify('monday this week')->setTime(0,0,0);
					
					$flug = 0;
					for($i=1; $i<count($todo); $i++) {
						$weeklyid = check2array($weekly, $i, "todoid");
						if($todo[$i]['���ԊǗ��e�[�}'] == $ini['servicesID'] && $weeklyid != -1 && $weekly[$weeklyid]['�\��'] == 0) {
							for($j=1; $j<count($working); $j++) {
								if($working[$j]['id'] != "periodically" && $todo[$working[$j]['id']]['top'] == $i) {
									$workday = new DateTime($working[$j]['day']);
									if($workday->diff($monday)->format('%R%a') <= 0) {
										$flug = 1;
										break;
									}
								}
							}
						}
					}
					
					echo "KPI�F{$ini['incidentKPI']}<br>";
					if($flug == 1) echo "��".$ini['servicesTheme']."<br>";
					else echo "�Z".$ini['servicesTheme']."<br>";
					for($i=1; $i<count($todo); $i++) {
						$weeklyid = check2array($weekly, $i, "todoid");
						if($todo[$i]['���ԊǗ��e�[�}'] == $ini['servicesID'] && $weeklyid != -1 && $weekly[$weeklyid]['�\��'] == 0) {
							write_weekly($todo, $working, $weekly, $i, $weeklyid, 0);
						}
						
					}
					echo "<br><br>";
					
					$flug = 0;
					for($i=1; $i<count($todo); $i++) {
						$weeklyid = check2array($weekly, $i, "todoid");
						if($todo[$i]['���ԊǗ��e�[�}'] == $ini['incidentID'] && $weeklyid != -1 && $weekly[$weeklyid]['�\��'] == 0) {
							for($j=1; $j<count($working); $j++) {
								if($working[$j]['id'] != "periodically" && $todo[$working[$j]['id']]['top'] == $i) {
									$workday = new DateTime($working[$j]['day']);
									if($workday->diff($monday)->format('%R%a') <= 0) {
										$flug = 1;
										break;
									}
								}
							}
						}
					}
					
					echo "KPI�F{$ini['incidentKPI']}<br>";
					if($flug == 1) echo "��".$ini['incidentTheme']."<br>";
					else echo "�Z".$ini['incidentTheme']."<br>";
					for($i=1; $i<count($todo); $i++) {
						$weeklyid = check2array($weekly, $i, "todoid");
						if($todo[$i]['���ԊǗ��e�[�}'] == $ini['incidentID'] && $weeklyid != -1 && $weekly[$weeklyid]['�\��'] == 0) {
							write_weekly($todo, $working, $weekly, $i, $weeklyid, 0);
						}
						
					}
					echo "<br><br>";
					
					$ary = array();
					$c = 0;
					for($i=1; $i<count($working); $i++) {
						
						$workday = new DateTime($working[$i]['day']);
						if($working[$i]['id'] != "periodically" && ($todo[$todo[$working[$i]['id']]['top']]['���ԊǗ��e�[�}'] <= 0 || $todo[$todo[$working[$i]['id']]['top']]['���ԊǗ��e�[�}'] >= 30) && ($workday->diff($monday)->format('%R%a')) <= 0 && serch_word($todo[$working[$i]['id']]['top'], $ary)==0) {
							$ary[$c] = $todo[$working[$i]['id']]['top'];
							$weeklyid = check2array($weekly, $ary[$c], "todoid");
							write_weekly($todo, $working, $weekly, $ary[$c], $weeklyid, 1);
							//echo "<span class='text-info'>��{$todo[$ary[$c]]['�^�C�g��']}�F";
							//if($weeklyid != -1) echo "{$weekly[$weeklyid]['�S��']}";
							//else echo $ini['myname'];
							//if($todo[$ary[$c]]['����']==1) echo "�y�F�����z";
							//echo "</span><br>";
							
							//if($weeklyid == -1) {
							//	for($j=1; $j<count($todo); $j++) {
							//		if($todo[$j]['parent'] == $ary[$c]) {
							//			echo "�@�@�@���E{$todo[$j]['�^�C�g��']}";
							//			if($todo[$j]['����']==1) echo "�F����<br>";
							//			else if($todo[$j]['�p�[�Z���e�[�W']==0) echo "<br>";
							//			else echo "<br>";
										
							//		}
							//	}
							//}
							//if($weeklyid != -1) $workdetail = str_replace('<br>', '<br>�@�@�@', $weekly[$weeklyid]['�e�[�}�T�v']);
							//else $workdetail = str_replace('<br>', '<br>�@�@�@', $todo[$ary[$c]]['��Ɠ��e']);
							//echo "�@���e�[�}�T�v��<br>�@�@�@{$workdetail}<br>";
							//if($weeklyid != -1 && $weekly[$weeklyid]['�ς�'] != "") {
							//	echo "�@���ς݁�<br>";
							//	$workdetail = str_replace('<br>', '<br>�@�@�@', $weekly[$weeklyid]['�ς�']);
							//	echo "�@�@�@{$workdetail}<br>";
							//}
							//echo "�@���i����<br>";
							//if($weeklyid != -1) {
							//	$workdetail = str_replace('<br>', '<br>�@�@�@', $weekly[$weeklyid]['�i��']);
							//	echo "�@�@�@{$workdetail}<br>";
							//} else {
							//	for($j=$i; $j<count($working); $j++) {
							//		if($working[$j]['id'] != "periodically" && $todo[$working[$j]['id']]['top'] == $todo[$working[$i]['id']]['top']) {
							//			echo "�@�@�@{$workday->format('n/d')}�F{$todo[$working[$j]['id']]['�^�C�g��']}��<br>";
							//		}
							//	}
							//}
							//if($todo[$ary[$c]]['����'] == 0) {
							//	echo "�@������̗\�聄<br>";
							//	if($weeklyid != -1) {
							//		$workdetail = str_replace('<br>', '<br>�@�@�@', $weekly[$weeklyid]['����̗\��']);
							//		echo "�@�@�@{$workdetail}<br>";
							//	} else {
							//		for($j=1; $j<count($todo); $j++) {
							//			if($todo[$j]['top'] == $todo[$working[$i]['id']]['id'] && $todo[$j]['����']==0) {
							//				$temp = new DateTime($todo[$j]['�[��']);
							//				echo "�@�@�@�`{$temp->format('n/d')}�@�F{$todo[$j]['�^�C�g��']}��<br>";
							//			}
							//		}
							//	}
							//}
							echo "<br><br>";
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
	<div class="form-group" style="margin-bottom:0; position: fixed; top: 100px;right:0;width:300px;">
		<button type="button" class="btn btn-primary btn-block" onclick="location.href = '<?php echo $link_todo_weekly_html; ?>&change=change';">�ҏW</button>
	</div>

<?php
	} else if($_GET['change'] == "change") {
		if(!isset($todo)) $todo = readCsvFile2($ini['dirWin'].'/data/todo.csv');
		$todo_theme = readCsvFile2($ini['dirWin'].'/data/todo_theme.csv');
		$working = readCsvFile2($ini['dirWin'].'/data/working.csv');
		$periodically = readCsvFile2($ini['dirWin'].'/data/periodically.csv');
		$weekly = readCsvFile2($ini['dirWin'].'/data/weekly.csv');
		$ini = parse_ini_file($ini['dirWin'].'/data/config.ini');
		$monday = $today->modify('monday this week')->setTime(0,0,0);
?>
<form class='form-horizontal container-fluid' method='post' action='todo/weekly.php?change=go' >
<div class="form-group">
<div class="bs-component table-responsive">
	<table class='table table-striped table-condensed'>
		<thead>
			<tr>
				<th class="col-md-3">�e�[�}</th>
				<th class="col-md-1"></th>
				<th class="col-md-4">�T��</th>
				<th class="col-md-4">�T��q���g</th>
			</tr>
		</thead>
		<tbody>
<?php
	
	$count = 0;
	$monday = $today->modify('monday this week')->setTime(0,0,0);
	
	for($i=1; $i<count($weekly); $i++) {
		$flug = 0;
		for($j=1; $j<count($working); $j++) {
			if($working[$j]['id'] != "periodically" && $todo[$working[$j]['id']]['top'] == $weekly[$i]['todoid']) {
				$workday = new DateTime($working[$j]['day']);
				if($workday->diff($monday)->format('%R%a') <= 0) {
					
					$flug = 1;
					break;
				}
			}
		}
		if($weekly[$i]['�\��'] == 0 && $todo[$weekly[$i]['todoid']]['���ԊǗ��e�[�}'] != 0 && ($todo[$weekly[$i]['todoid']]['���ԊǗ��e�[�}'] == $ini['servicesID'] || $todo[$weekly[$i]['todoid']]['���ԊǗ��e�[�}'] == $ini['incidentID'] || ($todo[$weekly[$i]['todoid']]['���ԊǗ��e�[�}'] >= 30) && $flug != 0)) {
			
			echo "<tr><td rowspan='9'>";
			
			$lastday = new DateTime($weekly[$i]['�ŏI�X�V����']);
			if(($lastday->diff($monday)->format('%R%a')) <= 0) echo "<span class='text-info'>";
			else echo "<span class='text-danger'>";
			
			if($flug == 0) echo "�Z";
			else echo "��";
			
			echo "{$todo[$weekly[$i]['todoid']]['�^�C�g��']}</span></td><td>";
			//echo "�i���L�薳��";
			echo "</td><td>";

			echo "</td><td>";
			echo "</td></tr><tr><input type='hidden' name='id[]' value='{$i}' class='id'><input type='hidden' name='write[]' value='0' class='write'><td>";
			
			echo "�ŏI�X�V����";
			echo "</td><td>";
			echo $weekly[$i]['�ŏI�X�V����'];
			echo "</td><td>";

			echo "<label class='label-checkbox pull-right'>";
			echo "<input type='checkbox' name='make_weekly[]' value='{$i}'  onChange='writeweekly({$count})' checked/>";
			echo "<span class='lever'>�T��̕\��</span>";
			echo "</label>";

			echo "</td></tr><tr><td>";
			
			echo "KPI";
			echo "</td><td>";
			echo "<input type='text' class='form-control input-normal input-sm kpi' name='kpi[]' value='{$weekly[$i]['KPI']}' onChange='writeweekly({$count})'>";
			echo "</td><td>";
			echo $weekly[$i]['KPI'];
			echo "</td></tr><tr><td>";


			echo "�e�[�}�T�v";
			echo "</td><td>";
			$temp = str_replace('<br>', '&#10;',$weekly[$i]['�e�[�}�T�v']);
			echo "<textarea class='form-control input-normal input-sm detail' name='detail[]' onChange='writeweekly({$count})'>{$temp}</textarea>";
			echo "</td><td>";
			echo $todo[$weekly[$i]['todoid']]['��Ɠ��e'];
			echo "</td></tr><tr><td>";
			
			echo "�S��";
			echo "</td><td>";
			echo "<input type='text' class='form-control input-normal input-sm name' name='name[]' value='{$weekly[$i]['�S��']}' onChange='writeweekly({$count})'>";
			echo "</td><td>";
			echo $weekly[$i]['�S��'];
			echo "</td></tr><tr><td>";
			
			echo "�ς�";
			echo "</td><td>";
			$temp = str_replace('<br>', '&#10;',$weekly[$i]['�ς�']);
			echo "<textarea class='form-control input-normal input-sm finish' name='finish[]' onChange='writeweekly({$count})'>{$temp}</textarea>";
			echo "</td><td>";
			echo $weekly[$i]['�ς�'];
			echo "</td></tr><tr><td>";
			
			echo "�i��";
			echo "</td><td>";
			$temp = str_replace('<br>', '&#10;',$weekly[$i]['�i��']);
			echo "<textarea class='form-control input-normal input-sm step' name='step[]' onChange='writeweekly({$count})'>{$temp}</textarea>";
			echo "</td><td>";
			if($flug != 0) {
				for($j=1; $j<count($working); $j++) {
					$workday = new DateTime($working[$j]['day']);
					if($working[$j]['id'] != "periodically" && $workday->diff($monday)->format('%R%a') <= 0 && $todo[$working[$j]['id']]['top'] == $weekly[$i]['todoid']) {
						echo "{$workday->format('n/d')}�F{$todo[$working[$j]['id']]['�^�C�g��']}��<br>";
					}
				}
			}
			echo "</td></tr><tr><td>";
			
			echo "����̗\��";
			echo "</td><td>";
			$temp = str_replace('<br>', '&#10;',$weekly[$i]['����̗\��']);
			echo "<textarea class='form-control input-normal input-sm plan' name='plan[]' onChange='writeweekly({$count})'>{$temp}</textarea>";
			echo "</td><td>";
			if($todo[$weekly[$i]['todoid']]['����']==0) {
				for($j=1; $j<count($todo); $j++) {
					if($todo[$j]['top'] == $todo[$weekly[$i]['todoid']]['id'] && $todo[$j]['����']==0) {
						$temp = new DateTime($todo[$j]['�[��']);
						echo "�`{$temp->format('n/d')}�@�F{$todo[$j]['�^�C�g��']}��<br>";
					}
				}
			}
			echo "</td></tr><tr><td></td><td></td><td></td></tr>";
			$count ++;
		}
	}
?>
		</tbody>
	</table>
</div>
</div>

	<div class="form-group row" style="margin-bottom:0; position: fixed; bottom: 20px;right:0;width:500px;">
	    <div class="col-xs-offset-3 col-xs-3 offset-3 col-3">
	        <button type="reset" class="btn btn-default btn-block">Reset</button>
	    </div>
		<div class="col-xs-offset-1 col-xs-3 offset-1 col-3">
	        <button type="submit" class="btn btn-primary btn-block">Submit</button>
	    </div>
	</div>
	<div style="height: 100px"></div>
<form>
<?php
	} else if($_GET['change'] == "go") {
		header("Content-type: text/html; charset=SJIS-win");
		echo $_POST['id'][0];
		if(isset($_POST['id'][0])) {
			include_once($ini['dirWin'].'/pages/function.php');
			$weekly = readCsvFile2($ini['dirWin'].'/data/weekly.csv');
			for($i=0; $i<count($_POST['id']); $i++) {
				if($_POST['write'][$i] == 1) {
					$weekly[$_POST['id'][$i]]["�e�[�}�T�v"] = str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['detail'][$i]);
					$weekly[$_POST['id'][$i]]["KPI"] = $_POST['kpi'][$i];
					$weekly[$_POST['id'][$i]]["�S��"] = $_POST['name'][$i];
					$weekly[$_POST['id'][$i]]["�ς�"] = str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['finish'][$i]);
					$weekly[$_POST['id'][$i]]["�i��"] = str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['step'][$i]);
					$weekly[$_POST['id'][$i]]["����̗\��"] = str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['plan'][$i]);
					$weekly[$_POST['id'][$i]]["�ŏI�X�V����"] = date('Y/m/d H:i:s');
					$weekly[$_POST['id'][$i]]["�\��"] = "1";
					for($j=0; $j<count($_POST['make_weekly']); $j++) {
						if($_POST['make_weekly'][$j] == $_POST['id'][$i]) $weekly[$_POST['id'][$i]]["�\��"] = "0";
					}
					
				}
				
			}
			
			writeCsvFile2($ini['dirWin'].'/data/weekly.csv', $weekly);
			//print_r_pre($weekly);
			header( "Location: " . $link_todo_weekly_html );
			exit();
			
			//print_r_pre($_POST['make_weekly']);
			//print_r_pre($weekly);
			
		} else {
			echo "<script>alert('�Ȃ񂩂��������H');location.href = '<?php echo $link_todo_weekly_html; ?>';</script>";
		}
	
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
