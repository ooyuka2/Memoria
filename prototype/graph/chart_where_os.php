<?php
	date_default_timezone_set('Asia/Tokyo');
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	$pagetype = "MDBpages";
	include_once($ini['dirWin'].'/pages/function.php');
	include $ini['dirWin']. "/prototype/rooting.php";
	
	$mashine = readCsvFile2($ini['dirWin'].'/prototype/data/equipment.csv');
	
	$os = readCsvFile2($ini['dirWin'].'/prototype/data/os.csv');
	$kiban = readCsvFile2($ini['dirWin'].'/prototype/data/kiban.csv');
	$equipmentStatus = readCsvFile2($ini['dirWin'].'/prototype/data/equipmentStatus.csv');
	//$equipmentStatus2 = readCsvFile2($ini['dirWin'].'/prototype/data/equipmentStatus2.csv');
	//$domain  = readCsvFile2($ini['dirWin'].'/prototype/data/domain.csv');
	//$equipmentType = readCsvFile2($ini['dirWin'].'/prototype/data/equipmentType.csv');
	$where = readCsvFile2($ini['dirWin'].'/prototype/data/where.csv');
	//$connext = readCsvFile2($ini['dirWin'].'/prototype/data/connext.csv');
	//$Department = readCsvFile2($ini['dirWin'].'/prototype/data/Department.csv');
?>
<div class="card h-100">
	<div class='card-body row justify-content-center' style='padding-bottom:0'>
		<h2 class="col-12">OS別マシン数</h2>
		<?php
			/*
			for($i = 0; $i<count($where); $i++) {
				if($i==0) {
					echo "<div class='col-8'>";
				} else {
					//echo "<div class='col-5'>";
					//echo "<h4>" . $where[$i]['名前'] . "拠点</h4>";
				}
				//echo "<canvas id='graph_where_os" . $where[$i]['拠点ID'] . "'></canvas></div>";
			}
			*/
			echo "<div class='col-8'><canvas id='graph_where_os" . $where[0]['拠点ID'] . "'></canvas></div>";
		?>
		<!--
		<table class='table table-striped table-hover table-sm col-8'>
			<thead>
				<tr>
					<th></th>
					<?php
						for($i = 1; $i<count($where); $i++) {
							echo "<th>" . $where[$i]['名前'] . "拠点</th>";
						}
					?>
				</tr>
			</thead>
			<tbody>
				<?php
					$array = array();
					for($i = 1; $i<count($os); $i++) {
						for($j = 1; $j<count($where); $j++) {
							$array[$i][$j] = 0;
						}
					}
					for($i = 1; $i<count($mashine); $i++) {
						if($mashine[$i]['OSID'] != "" && $mashine[$i]['設備ステータスID'] > 2 && $mashine[$i]['設備ステータスID'] < 7)
							$array[$mashine[$i]['OSID']][$mashine[$i]['拠点ID']]++;
					}
					
					
					for($i = 1; $i<count($os); $i++) {
						echo "<tr><th>" . $os[$j]['OS名'] . "</th>";
							for($j = 1; $j<count($where); $j++) {
								echo "<td>" . $array[$i][$j] . "台</td>";
							}
						echo "</tr>";
					}
					echo "<tr><th>合計</th>";
						for($i = 1; $i<count($where); $i++) {
							$tmp = 0;
							for($j = 1; $j<count($os); $j++) {
								$tmp += $array[$j][$i];
							}
							echo "<td>" . $tmp . "台</td>";
						}
					echo "</tr>";
				?>
			</tbody>
		</table>-->
	</div>
</div>

<script>


<?php
	$array = array();
	for($i = 1; $i<count($os); $i++) {
		for($j = 1; $j<count($where); $j++) {
			$array[$i][$j] = 0;
		}
	}
	for($i = 1; $i<count($mashine); $i++) {
		if($mashine[$i]['OSID'] != "" && $mashine[$i]['設備ステータスID'] > 2 && $mashine[$i]['設備ステータスID'] < 7)
			$array[$mashine[$i]['OSID']][$mashine[$i]['拠点ID']]++;
	}
	for($i = 0; $i<count($where); $i++) {
		echo "var ctx" . $where[$i]['拠点ID'] . " = document.getElementById('graph_where_os" . $where[$i]['拠点ID'] . "').getContext('2d');\r\n";
		echo "var where_os" . $where[$i]['拠点ID'] . "Chart = new Chart(ctx" . $where[$i]['拠点ID'] . ", {";
?>

	type: 'doughnut',
	data: {
		<?php
			echo "labels: [";
				for($j = 1; $j<count($os); $j++) {
					echo "'" . $os[$j]['OS名'] . "',";
				}
			echo "],";
		?>
		datasets: [
			{
				data: [
				<?php
					if($i==0) {
						for($j = 1; $j<count($os); $j++) {
							$tmp = 0;
							for($h = 1; $h<count($where); $h++) {
								$tmp += $array[$j][$h];
							}
							echo "'" . $tmp . "',";
						}
					} else {
						for($j = 1; $j<count($os); $j++) {
							echo "'" . $array[$j][$i] . "',";
						}
					}
				?>
				],
				backgroundColor: ['rgba(234,85,80,0.4)', 'rgba(238,120,0,0.4)', 'rgba(255,220,0,0.4)', 'rgba(156,187,28,0.4)', 'rgba(0,148,122,0.4)',
					'rgba(0,175,204,0.4)', 'rgba(0,104,183,0.4)', 'rgba(90,68,152,0.4)', ],
				hoverBackgroundColor: ['rgba(234,85,80,0.8)', 'rgba(238,120,0,0.8)', 'rgba(255,220,0,0.8)', 'rgba(156,187,28,0.8)', 'rgba(0,148,122,0.8)',
					'rgba(0,175,204,0.8)', 'rgba(0,104,183,0.8)', 'rgba(90,68,152,0.8)', ],
			}
		]
	},
	options: {
		responsive: true
	}
});


<?php
	}
?>

</script>