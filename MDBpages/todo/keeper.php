<?php
	$pagetype = "MDBpages";
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	if(!isset($todo)) {
		include_once($ini['dirWin'].'/pages/function.php');
		
		if(isset($_GET['file']) && $_GET['file'] == "old201804") {
			$todo = readCsvFile2($link_data . 'old201804todo.csv');
			$file = "old201804";
		} else {
			$todo = readCsvFile2($link_data . 'todo.csv');
			$file = "todo";
		}
	}
?>
<div class="card col-xl-12">
	<div class="card-body">
		<div id='keeper' class="table-responsive">
		<?php
			if(isset($_GET['day']) && !equal_word_str($_GET['day'], '1')) {
		?>
			<div class='clearfix'>
				<button style='margin:10px 0' class='btn btn-default pull-right btn-sm' onClick='location.href = "/Memoria/MDBpages/todo.php?d=keeper&day=all"'>すべて</button>
				<button style='margin:10px 10px' class='btn btn-default pull-right btn-sm' onClick='location.href = "/Memoria/MDBpages/todo.php?d=keeper&day=31"'>31日間</button>
				<button style='margin:10px 10px' class='btn btn-default pull-right btn-sm' onClick='location.href = "/Memoria/MDBpages/todo.php?d=keeper&day=7"'>7日間</button>
				<button style='margin:10px 0' class='btn btn-default pull-right btn-sm' onClick='location.href = "/Memoria/MDBpages/todo.php?d=keeper&day=old201804working"'>201804まで</button>
			</div>
			<br><div class='clearfix'><a href='{$ini['keeperpage']}' class='pull-right'>時間管理</a></div>
		<?php } ?>

<?php
	
	if(isset($_GET['day']) && $_GET['day'] == 'old201804working') {
		$working = readCsvFile2($link_data . 'old201804working.csv');
		$todo = readCsvFile2($link_data . 'todo.csv');
		$old201804todo = readCsvFile2($link_data . 'old201804todo.csv');
	}
	else $working = readCsvFile2($link_data . 'working.csv');
		
	$when = new DateTime($working[(count($working)-1)]['day']);
	$when = $when->format('Y/m/d');
	if(isset($_GET['day']) && !equal_word_str($_GET['day'], '1')) {
		$tableHeadder = "<table class='table table-condensed table-striped table-hover table-sm'><thead class='thead-dark'><tr><th class='col-md-2'>開始時間-終了時間</th><th class='col-md-8'>タイトル</th><th class='col-md-2'>ざっくり時間</th></tr></thead><tbody>";
	} else {
		$tableHeadder = "<table class='table table-condensed table-striped table-hover table-sm'><thead class='thead-dark'><tr><th class='col-md-3'>作業時間</th><th class='col-md-6'>タイトル</th><th class='col-md-3'>時間</th></tr></thead><tbody>";
	}
	$keeper = "";
	$copytext = $when."	";
	$last = count($working)-1;
	$day = 1;
	$lastTime = $working[(count($working)-1)]['day'];
	
	$countday = 7;
	if(isset($_GET['day']) && $_GET['day'] == 'old201804working') $countday = $last;
	else if(isset($_GET['day']) && $_GET['day'] == 'all') $countday = $last;
	else if(isset($_GET['day']) && ctype_digit($_GET['day'])) 	$countday = $_GET['day'];
	
	
	for($i=count($working)-1; $i>0; $i--) {
		$comDay = new DateTime($working[$i]['day']);
		$comDay = $comDay->format('Y/m/d');
		
		if($comDay != $when || $i==1) {
			$first = $i+1;
			for($j=$first; $j<=$last; $j++) {
				if($working[$j]['keeper'] == 1) continue;
				$processTime = str_replace(":", "", $working[$j]['startTime'] . "-" . $working[$j]['finishTime']);
				$keeper .= "<td>{$processTime}</td>";
				$copytext .= $processTime . "	";
				
				$tmp = explode(":",$working[$j]['startTime']);
				$startTime = new DateTime($working[$j]['day']);
				$startTime = $startTime->setTime($tmp[0], $tmp[1]);
				$tmp = explode(":",$working[$j]['finishTime']);
				$finishTime = new DateTime($working[$j]['day']);
				$finishTime = $finishTime->setTime($tmp[0], $tmp[1]);
				$interval = $startTime->diff($finishTime);
				
				if($working[$j]['id'] == "periodically") {
					$keeper .= "<td><span>{$working[$j]['note']}</span></td>";
					$keeper .= "<td>".$interval->format('%H時%i分')."</td>";
					$keeper .= "</tr>";
					if(strpos($working[$j]['note'], '<br>') !== false){
						$note = str_replace("<br>", "\\n", "&quot".$working[$j]['note']."&quot");//\\\'
					} else $note = $working[$j]['note'];
					$copytext .= $note . "	{$working[$j]['keeper']}\\n	";
				} else if($working[$j]['file'] == "todo") {
					$keeper .= "<td><span onClick='goto_detail({$todo[$working[$j]['id']]['top']})'>{$todo[$todo[$working[$j]['id']]['top']]['タイトル']}</span></td>";
					$keeper .= "<td>".$interval->format('%H時%i分')."</td>";
					$keeper .= "</tr>";
					$copytext .= $todo[$todo[$working[$j]['id']]['top']]['タイトル'] . "	" . $todo[$todo[$working[$j]['id']]['top']]['時間管理テーマ']. "\\n	";
				} else if($working[$j]['file'] == "old201804") {
					$keeper .= "<td><span onClick='goto_detail({$old201804todo[$working[$j]['id']]['top']})'>{$old201804todo[$old201804todo[$working[$j]['id']]['top']]['タイトル']}</span></td>";
					$keeper .= "<td>".$interval->format('%H時%i分')."</td>";
					$keeper .= "</tr>";
					$copytext .= $old201804todo[$old201804todo[$working[$j]['id']]['top']]['タイトル'] . "	" . $old201804todo[$old201804todo[$working[$j]['id']]['top']]['時間管理テーマ']. "\\n	";
					//$old201804todo
				}
			}
			if($i!=1 && $day != $countday) {
				$keeper .= "</tbody></table>";
				echo '<div class="clearfix"><h3>'.$when.'<button onClick="execCopy(\''.$copytext.'\')" class="pull-right btn btn-sm btn-primary">copy</button></h3></div>';
				
				
				$day1 = new DateTime($lastTime);
				$tmp = explode(":",$working[($i+1)]['startTime']);
				$day2 = new DateTime($working[($i+1)]['day']);
				$day2 = $day2->setTime($tmp[0], $tmp[1]);
				$interval = $day2->diff($day1);
				
				//echo $working[($i+1)]['startTime']. ":::". $lastTime."<br>";
				
				
				
				echo $tableHeadder. "<caption>".$interval->format('%H時%i分')."</caption>" .$keeper;
				
				$when = new DateTime($working[$i]['day']);
				$when = $when->format('Y/m/d');
				$lastTime = $working[$i]['day'];
				$keeper = "";
				$copytext = $when."	";
				$last = $i;
			} else if($day == $countday) {
				break;
			}
		$day ++;
		}
	}
	if(isset($_GET['day']) && !equal_word_str($_GET['day'], '1')) 
	echo '<div class="clearfix"><h3>'.$when.'</h3><button onClick="execCopy(\''.$copytext.'\')" class="pull-right btn btn-sm btn-primary">copy</button></div>';
	
	
	$day1 = new DateTime($lastTime);
	$day2 = new DateTime($working[($i+1)]['day']);
	$tmp = explode(":",$working[($i+1)]['startTime']);
	$day2 = $day2->setTime($tmp[0], $tmp[1]);
	$interval = $day2->diff($day1);
	
	//echo $working[($i+1)]['startTime']. ":::". $lastTime."<br>";

	echo $tableHeadder. "<caption>".$interval->format('%H時%i分')."</caption>" .$keeper;
?>
	</tbody>
</table>
</div>
</div>
</div>