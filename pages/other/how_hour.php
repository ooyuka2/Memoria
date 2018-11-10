<?php
	
	$graphdata = array();
	
	date_default_timezone_set('Asia/Tokyo');
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	$pagetype = "MDBpages";
	include_once($ini['dirWin'].'/pages/function.php');
	
	$working = readCsvFile2($ini['dirWin'].'/data/working.csv');
	$todo_keeper_theme = readCsvFile2($ini['dirWin'].'/data/todo_keeper_theme.csv');
	$todo = readCsvFile2($ini['dirWin'].'/data/todo.csv');
	//echo date("Y-m-d", strtotime("now"));
	
	if(strtotime(date("Y-m-d"), strtotime("now")) > strtotime(date("Y-m-11", time()))) $lastday = date("Y-m-11", time());
	else $lastday = date("Y-m-11",strtotime("-1 month"));
	
	//echo "<br>".$lastday;
	
	$countday = day_diff($lastday, date('Y-m-d'));
	
	$when = new DateTime($working[(count($working)-1)]['day']);
	$when = $when->format('Y/m/d');
	$last = count($working)-1;
	$day = 1;
	$lastTime = $working[(count($working)-1)]['day'];
	
	
	
	for($i=count($working)-1; $i>0; $i--) {
		$comDay = new DateTime($working[$i]['day']);
		$comDay = $comDay->format('Y/m/d');
		
		if($comDay != $when || $i==1) {
			$first = $i+1;
			if($day <= $countday) {
				for($j=$first; $j<=$last; $j++) {
					if($working[$j]['keeper'] == 1) continue;
					//仕事の時間
					$tmp = explode(":",$working[$j]['startTime']);
					$startTime = new DateTime($working[$j]['day']);
					$startTime = $startTime->setTime($tmp[0], $tmp[1]);
					$tmp = explode(":",$working[$j]['finishTime']);
					$finishTime = new DateTime($working[$j]['day']);
					$finishTime = $finishTime->setTime($tmp[0], $tmp[1]);
					$interval = $startTime->diff($finishTime);
					if($working[$j]['id'] == "periodically") {
						$graphdata[$day][$working[$j]['keeper']] = intval($interval->format('%h')) + intval($interval->format('%i'))/60;
					} else {
						$graphdata[$day][$todo[$todo[$working[$j]['id']]['top']]['時間管理テーマ']] = intval($interval->format('%h')) + intval($interval->format('%i'))/60;
					}
					//doubleval($graphdata[$day]['time']) + 
				}
			}
			if($i!=1 && $day <= $countday) {
				
				
				$day1 = new DateTime($lastTime);
				$tmp = explode(":",$working[($i+1)]['startTime']);
				$day2 = new DateTime($working[($i+1)]['day']);
				$day2 = $day2->setTime($tmp[0], $tmp[1])->modify('+1 hours');
				$interval = $day2->diff($day1);
				
				$graphdata[$day]['day'] = $when;
				$graphdata[$day]['time'] = intval($interval->format('%h')) + intval($interval->format('%i'))/60;
				
				for($k=1; $k<count($todo_keeper_theme); $k++) {
					if(!isset($graphdata[$day][$todo_keeper_theme[$k]['id']]))
					$graphdata[$day][$todo_keeper_theme[$k]['id']] = 0;
				}
				
				if(day_diff(date("Y-m-d", strtotime($working[($i+1)]['day'])), date("Y-m-d", strtotime($working[$i]['day']))) != 1)
					$countday -= day_diff(date("Y-m-d", strtotime($working[($i+1)]['day'])), date("Y-m-d", strtotime($working[$i]['day']))) -1;

				$when = new DateTime($working[$i]['day']);
				$when = $when->format('Y/m/d');
				$lastTime = $working[$i]['day'];
				$last = $i;
				//if(day_diff($lastday, $when) == 1) break;
			} else if($day > $countday) {
				break;
			}
		$day ++;
		}
	}
	/*
	if($day > $countday) $day--;
	$day1 = new DateTime($lastTime);
	$day2 = new DateTime($working[($i+1)]['day']);
	$tmp = explode(":",$working[($i+1)]['startTime']);
	$day2 = $day2->setTime($tmp[0], $tmp[1])->modify('+1 hours');
	$interval = $day2->diff($day1);

	$graphdata[$day]['day'] = $when;
	$graphdata[$day]['time'] = intval($interval->format('%h')) + intval($interval->format('%i'))/60;
	*/
	//print_r_pre($graphdata);
	if($graphdata[1]['time'] <= 8 && day_diff($graphdata[1]['day'], date('Y-m-d')) == 0) $graphday = 1;
	else $graphday = 0;
	$overtime = 0;
	for($i=count($graphdata); $i>$graphday; $i--) {
		$overtime = doubleval($overtime) + doubleval($graphdata[$i]['time']) -8;
	}
	$keeperorder = array();
	for($k=1; $k<count($todo_keeper_theme); $k++) {
		$keeperorder[$k]['id'] = $todo_keeper_theme[$k]['id'];
		$keeperorder[$k]['時間合計'] = 0;
		for($i=count($graphdata); $i>$graphday; $i--) {
			$keeperorder[$k]['時間合計'] += $graphdata[$i][$todo_keeper_theme[$k]['id']];
		}
	}
	$sort = array(); 
	foreach ((array) $keeperorder as $key => $value) {
		$sort[$key] = $value['時間合計'];
	}
	array_multisort($sort, SORT_DESC, $keeperorder);
	
	//print_r_pre($keeperorder);
?>
<canvas id="how_hour" style=""></canvas>
<script>

var ctx = document.getElementById("how_hour").getContext('2d');
var work_incidentChart = new Chart(ctx, {
	
<?php
	if(count($graphdata)<7) echo "type: 'line',";
	else echo "type: 'bar',";
?>
	//lineJoin: 'miter',
	data: {
		labels: [//"January", "February", "March", "April", "May", "June", "July"
<?php
	for($i=count($graphdata); $i>$graphday; $i--) {
		echo "\"" . $graphdata[$i]['day'] . "\",";
	}
?>
		],
		datasets: [{
				label: <?php echo "'残業時間：約". doubleval($overtime) . "時間'"; ?>,
				cubicInterpolationMode: "monotone",
				data: [
<?php
	for($i=count($graphdata); $i>$graphday; $i--) {
		echo $graphdata[$i]['time'] . ",";
	}
?>

				],
				backgroundColor: [
<?php
	for($i=count($graphdata); $i>$graphday; $i--) {
		echo "'rgba(230, 175, 207, .7)',";
	}
?>
				],
				borderColor: [
<?php
	for($i=count($graphdata); $i>$graphday; $i--) {
		echo "'rgba(230, 175, 207, .7)',";
	}
?>
				],
				borderWidth: 2
			},
<?php
	if($_GET['line'] == "ok") {
		for($k=0; $k<5 && $k<count($todo_keeper_theme); $k++) {
			echo "{label: '";
			for($i=1; $i<count($todo_keeper_theme); $i++) {
				if($todo_keeper_theme[$i]['id'] == $keeperorder[$k]['id']) {
					$id = $i;
					echo $todo_keeper_theme[$id]['テーマ'];
				}
			}
			echo "',data: [";

			for($i=count($graphdata); $i>$graphday; $i--) {
				echo $graphdata[$i][$todo_keeper_theme[$id]['id']] . ",";
			}

			echo "],borderColor: [";
			if($k==0) echo "'rgba(255, 99, 132, 0.8)',";
			else if($k==1) echo "'rgba(54, 162, 235, 0.8)',";
			else if($k==2) echo "'rgba(255, 206, 86, 0.8)',";
			else if($k==3) echo "'rgba(75, 192, 192, 0.8)',";
			else if($k==4) echo "'rgba(153, 102, 255, 0.8)',";
			else echo "'rgba(255, 159, 64, 0.8)',";
			echo "],backgroundColor: [";//'rgba(255, 255, 255, 0)'
			if($k==0) echo "'rgba(255, 99, 132, 0.1)',";
			else if($k==1) echo "'rgba(54, 162, 235, 0.1)',";
			else if($k==2) echo "'rgba(255, 206, 86, 0.1)',";
			else if($k==3) echo "'rgba(75, 192, 192, 0.1)',";
			else if($k==4) echo "'rgba(153, 102, 255, 0.1)',";
			else echo "'rgba(255, 159, 64, 0.1)',";
			echo "],type: 'line'},";
		}
	}
?>
		]
	},
	options: {
		responsive: true
	}
});
</script>

