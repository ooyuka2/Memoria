<?php
	date_default_timezone_set('Asia/Tokyo');
	if(!isset($ini)) {
		$ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
		include_once($ini['dirWin'].'/pages/function.php');
	}
	whatTodayDo_Registration($ini);
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

								if($today->diff($workday)->format('%r%a') == 0) {
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
<form method='get' action='todo/whatTodayDo.php'>
	<div class="form-group" style="margin-bottom:0; position: fixed; top: 100px;right:0;width:300px;">
		<?php echo "<input type='hidden' name='pid' value='{$pid}' id='pid'>"; ?>
		<input type='hidden' name='page' value='whatTodayDo'>
		<button type="submit" class="btn btn-primary btn-block">Submit</button>
	</div>
</form>
<script>

</script>
