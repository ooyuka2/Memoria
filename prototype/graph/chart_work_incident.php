<?php
	date_default_timezone_set('Asia/Tokyo');
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	$pagetype = "MDBpages";
	include_once($ini['dirWin'].'/pages/function.php');
	include $ini['dirWin']. "/prototype/rooting.php";
	
	$work = readCsvFile2($ini['dirWin'].'/prototype/data/work.csv');
	$incident = readCsvFile2($ini['dirWin'].'/prototype/data/incident.csv');
	
	$day = strtotime("next Monday");
	$graphX = array();
	for($i = 70; $i>=0; $i--) {
		$graphX[$i]['day'] = $day;
		$graphX[$i]['work'] = 0;
		$graphX[$i]['incident'] = 0;
		$day = strtotime(date('m/d', $day) . "-1 day");
	}
	//print_r_pre($graphX);

	for($i = 1; $i<count($work); $i++) {
		for($j = 0; $j<(count($graphX)-1); $j++) {
			if($graphX[$j]['day'] < strtotime($work[$i]['作業予定終了日時']) && strtotime($work[$i]['作業予定終了日時']) <= $graphX[($j+1)]['day'])
				$graphX[$j]['work']++;
		}
	}
	
	for($i = 1; $i<count($incident); $i++) {
		for($j = 0; $j<(count($graphX)-1); $j++) {
			if($graphX[$j]['day'] < strtotime($incident[$i]['インシデント発生日']) && strtotime($incident[$i]['インシデント発生日']) <= $graphX[($j+1)]['day'])
				$graphX[$j]['incident']++;
		}
	}
	$min = $graphX[0]['work'];
	$max = $graphX[0]['work'];
	
	for($i = 70; $i>=0; $i--) {
		if($min > $graphX[$i]['work']) $min = $graphX[$i]['work'];
		if($max < $graphX[$i]['work']) $max = $graphX[$i]['work'];
		if($min > $graphX[$i]['incident']) $min = $graphX[$i]['incident'];
		if($max < $graphX[$i]['incident']) $max = $graphX[$i]['incident'];
	}
?>
<canvas id="graph_work_incident" style="min-height:300px"></canvas>


<script>

var ctx = document.getElementById("graph_work_incident").getContext('2d');
var myLineChart = new Chart(ctx, {
	type: 'line',
	lineJoin: 'miter',
	data: {
		labels: [//"January", "February", "March", "April", "May", "June", "July"
		<?php
			for($i = 0; $i<(count($graphX)-1); $i = $i+7) {
				echo "\"" . date('m/d', $graphX[$i]['day']) . "\"";
				echo ",\"\",\"\",\"\",\"\",\"\",\"\",";
			}
			echo "\"" . date('m/d', $graphX[$i]['day']) . "\"";
		?>
		],
		datasets: [{
				label: "日別作業数",
				cubicInterpolationMode: "monotone",
				data: [
				<?php
					for($i = 0; $i<count($graphX); $i++) {
						echo $graphX[$i]['work'] . ",";
					}
				?>
				],
				<?php
					
					$day = strtotime("next Monday");
					$tmp = "";
					for($i = 0; $i<10; $i++) {
						$tmp = "\"" . date('m/d', $day) . "\"" . $tmp;
						$tmp = ",\"\",\"\",\"\",\"\",\"\",\"\"," . $tmp;
						$day = strtotime(date('m/d', $day) . "-1 week");
					}
					$tmp = "\"" . date('m/d', $day) . "\"" . $tmp;
					//echo $tmp;
				?>
				backgroundColor: [
					'rgba(0, 0, 0, 0)',
				],
				borderColor: [
					'rgba(200, 99, 132, .7)',
				],
				borderWidth: 2
			},
			{
				label: "日別インシデント数",
				data: [
				<?php
					for($i = 0; $i<count($graphX); $i++) {
						echo $graphX[$i]['incident'] . ",";
					}
				?>
				],
				backgroundColor: [
					'rgba(0, 0, 0, 0)',
				],
				borderColor: [
					'rgba(0, 10, 130, .7)',
				],
				borderWidth: 2
			}
		]
	},
	options: {
		responsive: true
	}
});
</script>
