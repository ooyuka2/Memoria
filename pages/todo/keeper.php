
<div id='keeper' class="table-responsive">
	<div class='clearfix'>
		<button style='margin:10px 0' class='btn btn-default pull-right btn-xs' onClick='location.href = "/Memoria/pages/todo.php?d=keeper&day=all"'>すべて</button>
		<button style='margin:10px 10px' class='btn btn-default pull-right btn-xs' onClick='location.href = "/Memoria/pages/todo.php?d=keeper&day=31"'>31日間</button>
		<button style='margin:10px 10px' class='btn btn-default pull-right btn-xs' onClick='location.href = "/Memoria/pages/todo.php?d=keeper&day=7"'>7日間</button>
		<button style='margin:10px 0' class='btn btn-default pull-right btn-xs' onClick='location.href = "/Memoria/pages/todo.php?d=keeper&day=old201804working"'>201804まで</button>
	</div>

<?php
	if(!isset($todo)) $todo = readCsvFile2('../data/todo.csv');
	//include('../data/weekly.php');
	$ini = parse_ini_file('../data/config.ini');
	date_default_timezone_set('Asia/Tokyo');
	
	if(isset($_GET['day']) && $_GET['day'] == 'old201804working') {
		$working = readCsvFile2('../data/old201804working.csv');
		$todo = readCsvFile2('../data/todo.csv');
		$old201804todo = readCsvFile2('../data/old201804todo.csv');
	}
	else $working = readCsvFile2('../data/working.csv');

	echo "<br><div class='clearfix'><a href='{$ini['keeperpage']}' class='pull-right'>時間管理</a></div>";
	$when = new DateTime($working[(count($working)-1)]['day']);
	$when = $when->format('Y/m/d');
	$keeper = "<table class='table table-condensed'><thead><tr><th class='col-md-2'>開始時間-終了時間</th><th class='col-md-8'>タイトル</th><th class='col-md-1'>ざっくり時間</th><th class='col-md-1'>時間管理テーマ</th></tr></thead><tbody>";
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
					$keeper .= "<td>{$working[$j]['keeper']}</td></tr>";
					if(strpos($working[$j]['note'], '<br>') !== false){
						$note = str_replace("<br>", "\\n", "&quot".$working[$j]['note']."&quot");//\\\'
					} else $note = $working[$j]['note'];
					$copytext .= $note . "	{$working[$j]['keeper']}\\n	";
				} else if($working[$j]['file'] == "todo") {
					$keeper .= "<td><span onClick='goto_detail({$todo[$working[$j]['id']]['top']})'>{$todo[$todo[$working[$j]['id']]['top']]['タイトル']}</span></td>";
					$keeper .= "<td>".$interval->format('%H時%i分')."</td>";
					$keeper .= "<td>{$todo[$todo[$working[$j]['id']]['top']]['時間管理テーマ']}</td></tr>";
					$copytext .= $todo[$todo[$working[$j]['id']]['top']]['タイトル'] . "	" . $todo[$todo[$working[$j]['id']]['top']]['時間管理テーマ']. "\\n	";
				} else if($working[$j]['file'] == "old201804") {
					$keeper .= "<td><span onClick='goto_detail({$old201804todo[$working[$j]['id']]['top']})'>{$old201804todo[$old201804todo[$working[$j]['id']]['top']]['タイトル']}</span></td>";
					$keeper .= "<td>".$interval->format('%H時%i分')."</td>";
					$keeper .= "<td>{$old201804todo[$old201804todo[$working[$j]['id']]['top']]['時間管理テーマ']}</td></tr>";
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
				$day2 = $day2->setTime($tmp[0], $tmp[1])->modify('+1 hours');
				$interval = $day2->diff($day1);
				
				//echo $working[($i+1)]['startTime']. ":::". $lastTime."<br>";

				echo $interval->format('%R%d日 %H時%i分');
				
				
				
				echo $keeper;
				
				$when = new DateTime($working[$i]['day']);
				$when = $when->format('Y/m/d');
				$lastTime = $working[$i]['day'];
				$keeper = "<table class='table table-condensed'><thead><tr><th class='col-md-2'>開始時間-終了時間</th><th class='col-md-8'>タイトル</th><th class='col-md-1'>ざっくり時間</th><th class='col-md-1'>時間管理テーマ</th></tr></thead></tr></thead><tbody>";
				$copytext = $when."	";
				$last = $i;
			} else if($day == $countday) {
				break;
			}
		$day ++;
		}
	}
	echo '<div class="clearfix"><h3>'.$when.'</h3><button onClick="execCopy(\''.$copytext.'\')" class="pull-right btn btn-sm btn-primary">copy</button></div>';
	
	
	$day1 = new DateTime($lastTime);
	$day2 = new DateTime($working[($i+1)]['day']);
	$tmp = explode(":",$working[($i+1)]['startTime']);
	$day2 = $day2->setTime($tmp[0], $tmp[1])->modify('+1 hours');
	$interval = $day2->diff($day1);
	
	//echo $working[($i+1)]['startTime']. ":::". $lastTime."<br>";

	echo $interval->format('%R%d日 %H時%i分');
	//echo time_diff(strtotime('2015-01-02 15:04:05'), strtotime('2015-01-02 16:04:05'));

	echo $keeper;
?>
	</tbody>
</table>
</div>


<?php
	//https://www.hotpepper.jp/strJ000758708/course/
	//https://r.gnavi.co.jp/a81kzjy90000/menu4/
?>