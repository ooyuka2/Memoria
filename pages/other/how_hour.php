<?php
	
	$graphdata = array();
	
	date_default_timezone_set('Asia/Tokyo');
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	$pagetype = "MDBpages";
	include_once($ini['dirWin'].'/pages/function.php');
	
	$working = readCsvFile2($ini['dirWin'].'/data/working.csv');
	
	if(strtotime(date("Y-m-d", strtotime("now"))) > strtotime(date("Y-m-11", time()))) $lastday = date("Y-m-11", time());
	else $lastday = date("Y-m-11",strtotime("-1 month"));
	
	$day = day_diff($lastday, date('Y-m-d'));
	 
	$countday = $day;
	//echo $day;
	
	$when = new DateTime($working[(count($working)-1)]['day']);
	$when = $when->format('Y/m/d');
	$last = count($working)-1;
	$day = 1;
	$lastTime = $working[(count($working)-1)]['day'];
	
	//$countday = 7;
	
	
	for($i=count($working)-1; $i>0; $i--) {
		$comDay = new DateTime($working[$i]['day']);
		$comDay = $comDay->format('Y/m/d');
		
		if($comDay != $when || $i==1) {
			$first = $i+1;
			for($j=$first; $j<=$last; $j++) {
				if($working[$j]['keeper'] == 1) continue;
				$processTime = str_replace(":", "", $working[$j]['startTime'] . "-" . $working[$j]['finishTime']);
				
				$tmp = explode(":",$working[$j]['startTime']);
				$startTime = new DateTime($working[$j]['day']);
				$startTime = $startTime->setTime($tmp[0], $tmp[1]);
				$tmp = explode(":",$working[$j]['finishTime']);
				$finishTime = new DateTime($working[$j]['day']);
				$finishTime = $finishTime->setTime($tmp[0], $tmp[1]);
				$interval = $startTime->diff($finishTime);
				
			}
			if($i!=1 && $day != $countday) {
				
				
				$day1 = new DateTime($lastTime);
				$tmp = explode(":",$working[($i+1)]['startTime']);
				$day2 = new DateTime($working[($i+1)]['day']);
				$day2 = $day2->setTime($tmp[0], $tmp[1])->modify('+1 hours');
				$interval = $day2->diff($day1);
				
				$graphdata[$day]['day'] = $when;
				if($interval->format('%i') == "30") $tmp = ".5";
				else $tmp = "";
				$graphdata[$day]['time'] = $interval->format('%h').$tmp;
				
				$when = new DateTime($working[$i]['day']);
				$when = $when->format('Y/m/d');
				$lastTime = $working[$i]['day'];
				$last = $i;
				if(day_diff($lastday, $when) == 0) break;
			} else if($day == $countday) {
				break;
			}
		$day ++;
		}
	}
	
	if($day != $countday) $day--;
	$day1 = new DateTime($lastTime);
	$day2 = new DateTime($working[($i+1)]['day']);
	$tmp = explode(":",$working[($i+1)]['startTime']);
	$day2 = $day2->setTime($tmp[0], $tmp[1])->modify('+1 hours');
	$interval = $day2->diff($day1);

	$graphdata[$day]['day'] = $when;
	$graphdata[$day]['time'] = $interval->format('%h');

	//print_r_pre($graphdata);
	$overtime = 0;
	for($i=count($graphdata); $i>0; $i--) {
		$overtime += intval($graphdata[$i]['time']) -8;
	}
?>
<canvas id="how_hour" style=""></canvas>
<script>

var ctx = document.getElementById("how_hour").getContext('2d');
var work_incidentChart = new Chart(ctx, {
	type: 'line',
	lineJoin: 'miter',
	data: {
		labels: [//"January", "February", "March", "April", "May", "June", "July"
<?php
	for($i=count($graphdata); $i>0; $i--) {
		echo "\"" . $graphdata[$i]['day'] . "\",";
	}
?>
		],
		datasets: [{
				label: <?php echo "'Žc‹ÆŽžŠÔF–ñ". $overtime . "ŽžŠÔ'"; ?>,
				cubicInterpolationMode: "monotone",
				data: [
<?php
	for($i=count($graphdata); $i>0; $i--) {
		echo $graphdata[$i]['time'] . ",";
	}
?>

				],
				backgroundColor: [
					'rgba(0, 0, 0, 0)',
				],
				borderColor: [
					'rgba(200, 99, 132, .7)',
				],
				borderWidth: 2
			},
		]
	},
	options: {
		responsive: true
	}
});
</script>

