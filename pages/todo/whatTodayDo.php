<?php
	date_default_timezone_set('Asia/Tokyo');
	if(!isset($ini)) {
		$ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
		include_once($ini['dirWin'].'/pages/function.php');
	}
	
	if(isset($_GET['auto'])) {
	
		$todo = readCsvFile2($ini['dirWin'].'/data/todo.csv');
		$sa = sort_by_noki_todo_priority($todo, true);
		$pid = "";
		$today = new DateTime(date('Ymd'));
		
		
		for($i=0; $i<count($sa); $i++) {
			
			if($sa[$i]!=0 && $todo[$sa[$i]]['削除'] != 1 && $todo[$sa[$i]]['保留'] != 1 && $todo[$sa[$i]]['完了'] != 1) { 
				$flug = 0;
				
				for($j=1; $j<count($todo); $j++) {
					if($todo[$j]['top'] == $sa[$i]) {
						$workday = new DateTime($todo[$j]['開始予定日']);

						if($today->diff($workday)->format('%r%a 日') == 0) {
							$flug = 1;
							break;
						}
					}
				}
				if($todo[$sa[$i]]['今日やること'] != 0 || $flug == 1) {
					$pid = $pid . "@". $sa[$i];
				}
			}
		}
	
		header( "Location: /Memoria/pages/todo.php?page=whatTodayDo&pid=".$pid );
		exit();
	}
	
	
	
	if(isset($_GET['pid'])) {
		$ids = explode("@", $_GET['pid']);
		//echo $_GET['pid'];
		$todo = readCsvFile2($ini['dirWin'].'/data/todo.csv');
		for($i=1; $i<count($todo); $i++) {
			if($todo[$i]['level'] == 1 && $todo[$i]['今日やること'] != 2) $todo[$i]['今日やること'] = 0;
		}
		for($i=1; $i<count($ids); $i++) {
			$todo[$ids[$i]]['今日やること'] = 1;
		}
		writeCsvFile2($ini['dirWin']."/data/todo.csv", $todo);
		
		$TodayS = date('Ymd');
		$today = new DateTime($TodayS);
		
		$working = readCsvFile2($ini['dirWin'].'/data/working.csv');
		$workday = new DateTime($working[(count($working)-1)]['day']);
		$workday = $workday->setTime(0,0,0);
		
		if($workday->diff($today)->format('%R%a') != 0) {
			$www = count($working);
			$working[$www]['file'] = "todo";
			$working[$www]['id'] = "periodically";
			$working[$www]['day'] = date('Y/m/d H:i:s', strtotime('-5 minute'));
			$working[$www]['per'] = 0;
			$working[$www]['startTime'] = date('H:i', strtotime('-5 minute'));
			$working[$www]['finishTime'] = date('H:i', strtotime('-5 minute'));
			$working[$www]['keeper'] = 1;
			$working[$www]['note'] = "";
			writeCsvFile2($ini['dirWin']."/data/working.csv", $working);
		}
		
		header( "Location: /Memoria/pages/todo.php" );
		exit();
	}
	
	if(isset($_GET['turn'])) {
		$todo = readCsvFile2($ini['dirWin'].'/data/todo.csv');
		
		if(isset($_GET['p'])) {
			$todo[$_GET['p']]['今日やること'] = $_GET['turn'];
			writeCsvFile2($ini['dirWin']."/data/todo.csv", $todo);
		}
		header( "Location: /Memoria/pages/todo.php" );
		exit();
	}
?>

<div class="bs-component table-responsive">
	<table class='table table-striped table-hover table-condensed'>
		<thead>
			<tr>
				<th class="col-md-3">チェックボックス</th>
				<th class="col-md-9">やること</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$todo = readCsvFile2('../data/todo.csv');
				$sa = sort_by_noki_todo_priority($todo, true);
				$pid = "";
				$today = new DateTime(date('Ymd'));
				
				
				for($i=0; $i<count($sa); $i++) {
					
					if($sa[$i]!=0 && $todo[$sa[$i]]['削除'] != 1 && $todo[$sa[$i]]['保留'] != 1 && $todo[$sa[$i]]['完了'] != 1) { 
						$flug = 0;
						
						for($j=1; $j<count($todo); $j++) {
							if($todo[$j]['top'] == $sa[$i]) {
								$workday = new DateTime($todo[$j]['開始予定日']);

								if($today->diff($workday)->format('%r%a 日') == 0) {
									$flug = 1;
									break;
								}
							}
						}
						echo "<tr><td style='text-align: center; vertical-align: middle;'>";
						//echo $workday->diff($today)->format('%r%a 日');
						if($todo[$sa[$i]]['今日やること'] == 1 || $flug == 1) {
							echo "<button type='button' id='doButton{$sa[$i]}'  class='btn btn-success disabled' onClick='doBotton({$sa[$i]})'>やる!</button>　<button type='button' id='donotButton{$sa[$i]}'  class='btn btn-info' onClick='donotBotton({$sa[$i]})'>やらない</button></td><td>";
							$pid = $pid . "@". $sa[$i];
						} else {
							echo "<button type='button' id='doButton{$sa[$i]}' class='btn btn-success' onClick='doBotton({$sa[$i]})'>やる</button>　<button type='button' id='donotButton{$sa[$i]}'  class='btn btn-info disabled' onClick='donotBotton({$sa[$i]})'>やらない!</button></td><td>";
							
						}
						//write_todo_tree($todo, $sa[$i], date('Y/m/d'));
						echo "<span class='text-primary'> {$todo[$sa[$i]]['タイトル']}</span><br>";
						$temp = str_split( $todo[$sa[$i]]['作業内容'] , 250);
						echo "<span><strong>作業内容　: </strong>{$temp[0]}</span>";
						echo "</td></tr>";
					} else {
						echo "<tr><td></td><td></td></tr>";
					}
				}
			?>
		</tbody>
	</table>
</div>
<form method='get' action='todo.php?page=whatTodayDo'>
	<div class="form-group" style="margin-bottom:0; position: fixed; top: 100px;right:0;width:300px;">
		<?php echo "<input type='hidden' name='pid' value='{$pid}' id='pid'>"; ?>
		<input type='hidden' name='page' value='whatTodayDo'>
		<button type="submit" class="btn btn-primary btn-block">Submit</button>
	</div>
</form>
<script>
	function doBotton(id) {
		var pid = document.getElementById('pid').value;
		pid = pid + "@" + id;
		document.getElementById('pid').value = pid;
		dobuttonname = "doButton" + id;
		donotbuttonname = "donotButton" + id;
		document.getElementById(dobuttonname).classList.toggle("disabled");
		document.getElementById(donotbuttonname).classList.toggle("disabled");
		document.getElementById(dobuttonname).innerHTML = "やる!";
		document.getElementById(donotbuttonname).innerHTML = "やらない";
	}
	function donotBotton(id) {
		var pid = document.getElementById('pid').value;
		pid = pid.replace("@"+id, "");
		document.getElementById('pid').value = pid;
		dobuttonname = "doButton" + id;
		donotbuttonname = "donotButton" + id;
		document.getElementById(dobuttonname).classList.toggle("disabled");
		document.getElementById(donotbuttonname).classList.toggle("disabled");
		document.getElementById(dobuttonname).innerHTML = "やる";
		document.getElementById(donotbuttonname).innerHTML = "やらない!";
	}
</script>
