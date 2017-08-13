<div id='keeper' class="table-responsive">
	<div class='clearfix'>
		<button style='margin:10px 0' class='btn btn-default pull-right btn-xs' onClick='location.href = "/Memoria/pages/todo.php?d=keeper&day=all"'>すべて</button>
		<button style='margin:10px 10px' class='btn btn-default pull-right btn-xs' onClick='location.href = "/Memoria/pages/todo.php?d=keeper&day=31"'>31日間</button>
		<button style='margin:10px 0' class='btn btn-default pull-right btn-xs' onClick='location.href = "/Memoria/pages/todo.php?d=keeper&day=7"'>7日間</button>
	</div>

<?php
	//$todo = readCsvFile2('../data/todo.csv');
	$working = readCsvFile2('../data/working.csv');


	$when = new DateTime($working[(count($working)-1)]['day']);
	$when = $when->format('Y/m/d');
	echo "<h3>{$when}</h3>";
	echo "<table class='table table-condensed'><thead><tr><th class='col-md-2'>開始時間-終了時間</th><th class='col-md-8'>タイトル</th><th class='col-md-2'>時間管理テーマ</th></tr></thead><tbody>";
	$last = count($working)-1;
	$day = 1;
	
	$countday = 7;
	if(isset($_GET['day']) && $_GET['day'] == 'all') $countday = $last;
	else if(isset($_GET['day']) && ctype_digit($_GET['day'])) 	$countday = $_GET['day'];
	
	for($i=count($working)-1; $i>0; $i--) {
		$comDay = new DateTime($working[$i]['day']);
		$comDay = $comDay->format('Y/m/d');
		if($comDay != $when || $i==1) {
			$first = $i+1;
			for($j=$first; $j<=$last; $j++) {
				if($working[$j]['keeper'] == 1) continue;
				$processTime = str_replace(":", "", $working[$j]['startTime'] . "-" . $working[$j]['finishTime']);
				echo "<td>{$processTime}</td>";
				if($working[$j]['id'] == "deskwork") {
					echo "<td><span>{$working[$j]['note']}</span></td>";
					echo "<td>37</td></tr>";
				} else {
					echo "<td><span onClick='goto_detail({$todo[$working[$j]['id']]['top']})'>{$todo[$todo[$working[$j]['id']]['top']]['タイトル']}</span></td>";
					echo "<td>{$todo[$todo[$working[$j]['id']]['top']]['時間管理テーマ']}</td></tr>";
				}
			}
			if($i!=1 && $day != $countday) {
				echo "</tbody></table>";
				$when = new DateTime($working[$i]['day']);
				$when = $when->format('Y/m/d');
				echo "<h3>{$when}</h3>";
				echo "<table class='table table-condensed'><thead><tr><th class='col-md-2'>開始時間-終了時間</th><th class='col-md-8'>タイトル</th><th class='col-md-2'>時間管理テーマ</th></tr></thead><tbody>";
				$last = $i;
			} else if($day == $countday) {
				break;
			}
		$day ++;
		}
	}
?>
	</tbody>
</table>
</div>