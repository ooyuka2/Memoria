
<?php
	$todo = readCsvFile2('../data/todo.csv');
	$todo_theme = readCsvFile2('../data/todo_theme.csv');
	$todo_keeper_theme = readCsvFile2('../data/todo_keeper_theme.csv');
	$weekly = readCsvFile2('../data/weekly.csv');
	if((!isset($_GET['p']) || $todo[$_GET['p']]['level']!=1) && $_GET['d']!="new") {
		echo "<button>もどれ</button>";
	}
	if (isset($_GET['file']) && $_GET['file'] == "old201804" && $_GET['d']=="change") echo '<meta http-equiv="refresh" content="1;URL=./todo.php">';
?>

<div class="col-1"></div>
<div class="col-10">
<?php
	if($_GET['d'] != "change") {
		echo "<form class='form-horizontal' method='post' action='todo/toroku.php?toroku=toroku'>";
		$id = count($todo);
		if(isset($_GET['file']) && $_GET['file'] != "todo") {
			$temp = readCsvFile2('../data/todo.csv');
			$id = count($temp);
		}
		if($_GET['d'] == "new") todo_fieldset($todo, $todo_theme, $todo_keeper_theme, 1, $_GET['d'], $id, 0, 0, $weekly);
		else todo_fieldset($todo, $todo_theme, $todo_keeper_theme, 1, $_GET['d'], $id, $_GET['p'], 0, $weekly);
	} else {
		echo "<form class='form-horizontal' method='post' action='todo/toroku.php?toroku=toroku2' name='changetodo'>";
		$id = $_GET['p'];
		todo_fieldset($todo, $todo_theme, $todo_keeper_theme, 1, $_GET['d'], $id, $id, 0, $weekly);
	}
?>


		<div class="new" >
<?php
	if($_GET['d'] != "new") {
		$count = todo_make_child($todo, $todo_theme, $todo_keeper_theme, 1, $_GET['p'], $weekly);
	}
	

?>
		</div>
		<div class="form-group">
			<button class="btn btn-success center-block" type="button" onClick='plus();'><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>　追加</button>
		</div>
		
		<div class="d-none" id="new_field_set">
		
		<?php
			todo_fieldset($todo, $todo_theme, $todo_keeper_theme, 2, "new_field", $id, $id, 0, $weekly);
		?>
		
		</div>
		<div class="form-group row" style="margin-bottom:0; position: fixed; bottom: 20px;right:0;width:500px;">
			<div class="col offset-3 col-4">
				<button type="reset" class="btn btn-default btn-block">Reset</button>
			</div>
			<div class="col col-4" style="margin-left:20px">
				<button type="submit" class="btn btn-primary btn-block">Submit</button>
			</div>
			<div class="col offset-3 col-9" style="margin-top:10px">
				<button type="button" class="btn btn-info btn-block btn-sm" onClick="setDateTime()">Set DateTime</button>
			</div>
		</div>
		<div style="height: 100px"></div>
	</form>
</div>

<?php

function todo_make_child($todo, $todo_theme, $todo_keeper_theme, $count, $top, $weekly) {
	$next_id = todo_next($todo, $top, $count);
	while($next_id != 0) {
		if($_GET['d'] == "renew") {
			$id = count($todo) + $count;
			todo_fieldset($todo, $todo_theme, $todo_keeper_theme, $todo[$next_id]['level'], $_GET['d'], $id, $todo[$next_id]['id'], $count, $weekly);
		} else {
			todo_fieldset($todo, $todo_theme, $todo_keeper_theme, $todo[$next_id]['level'], $_GET['d'], $todo[$next_id]['id'], $todo[$next_id]['id'], $count, $weekly);
		}
		//echo "count={$count}	<br>";
		$count++;
		$next_id = todo_next($todo, $top, $count);
	}
}




function todo_fieldset($todo, $todo_theme, $todo_keeper_theme, $level, $type, $id, $p, $count, $weekly) {
	if(isset($_GET['theme'])) $theme = $_GET['theme'];
	else if(isset($_GET['p'])) $theme = $todo[$_GET['p']]['テーマ'];
	else $theme = 0;
	if(isset($_GET['p']) && $_GET['p']) $time_theme = $todo[$_GET['p']]['時間管理テーマ'];
	else $time_theme = 0;
	
	date_default_timezone_set('Asia/Tokyo');
	if($_GET['d'] == "new" || $type=="new_field") {
		$title = "";
		$detail = "";
		$mono = "";
		$priority = 1;
		$today = date('Y/m/d');
		$noki = $today;
		$noki_time = '18:00';
		$kaisi = $today;
		$syuryo = $today;
		$make_weekly = "-1";
		$make_weekly_select = "";
		$count = 0;
		$finish = 0;
	} else {
		$title = $todo[$p]['タイトル'];
		$detail = str_replace('<br>', '&#10;',$todo[$p]['作業内容']); 
		$mono = $todo[$p]['成果物'];
		$priority = $todo[$p]['優先度'];
		$count = $todo[$p]['順番'];
		$make_weekly = $_GET['p'];
		
		if ($_GET['d'] == "renew") $finish = 0;
		else $finish = $todo[$p]['完了'];
		
		$weeklyid = check2array($weekly, $make_weekly, "todoid");
		
		
		if($weeklyid != -1 &&$weekly[$weeklyid]["表示"] == 0) $make_weekly_select = " checked/";
		else $make_weekly_select = "";
		if($_GET['d'] == "renew") {
			$today = date('Y/m/d');
			$noki = $today;
			$noki_time = '18:00';
			$kaisi = $today;
			$syuryo = $today;
		} else {
			$noki = date('Y/m/d',  strtotime($todo[$p]['納期']));
			$noki_time = $todo[$p]['納期時間'];
			$kaisi = date('Y/m/d',  strtotime($todo[$p]['開始予定日']));
			$syuryo = date('Y/m/d',  strtotime($todo[$p]['終了予定日']));
		}
	}
	
	if ($finish == 0) echo "<div class='card' style='position: relative' >";
	else echo "<div class='card border-success' style='position: relative' >";
	
	
	echo "<div class='form-group card-body row'>";
	
	if($level != 1) echo "<div class='clearfix col-12'><span class='pull-right close' onClick='minus({$count});'>&times;</span><span class='pull-right close'>　</span><span class='pull-right close' onClick='plus2({$count});'>+</span></div>";
	
	echo "<div class='col-8 row'>";
	
	if($level == 1) {
		echo "<div class='col-12' style='margin-bottom:5px'>";
		if($_GET['d'] != "change")
		echo '<select class="form-control input-normal input-sm theme" name="theme[]" onChange="select_theme(this.options[this.options.selectedIndex].value)">';
		else echo '<select class="form-control input-normal input-sm theme" name="theme[]">';
		echo "<option value='0'>テーマの選択</option>";
		for($i=1;$i<count($todo_theme);$i++) {
			if($theme == $i) {
				echo "<option value='{$i}' selected>{$todo_theme[$i]['テーマ']}</option>";
			} else {
				echo "<option value='{$i}'>{$todo_theme[$i]['テーマ']}</option>";//col-sm-2
			}
		}
		echo "</select></div>";
		echo "<div class='col-12' style='margin-bottom:5px'>";
		echo "<select class='form-control input-normal input-sm theme' name='theme2[]'>";
		echo "<option value='0'>時間管理テーマの選択</option>";
		for($i=1;$i<count($todo_keeper_theme);$i++) {
			if($time_theme == $todo_keeper_theme[$i]['id']) {
				echo "<option value='{$todo_keeper_theme[$i]['id']}' selected>{$todo_keeper_theme[$i]['テーマ']}</option>";
			} else {
				echo "<option value='{$todo_keeper_theme[$i]['id']}'>{$todo_keeper_theme[$i]['テーマ']}</option>";//col-sm-2
			}
		}
		echo "</select></div>";
	}

	echo "<div class='col-12' style='margin-bottom:5px'>";
	echo "<input type='text' class='form-control input-normal input-sm name' name='name[]' placeholder='タイトル' value='{$title}' required>";
	echo "<input type='hidden' name='id[]' value='{$id}' class='id'>";
	echo "</div>";
	
	echo "<div class='col-12' style='margin-bottom:5px; whtie-space:nowrap;'>";
	echo "<textarea class='form-control input-normal input-sm detail' rows='3' name='detail[]'  style='white-space:pre-wrap;width: 100%'>{$detail}</textarea>";
	echo "</div>";
	
	echo "<div class='col-12' style='margin-bottom:5px'>";
	echo "<input type='text' class='form-control input-normal input-sm mono' name='mono[]' placeholder='成果物' value='{$mono}'>";
	echo "</div>";
	
					
					
	//<div class='col'>
	echo "<div class='col-1' style='margin-bottom:5px'><button type='button' class='btn btn-warning btn-xs' onClick='level_down(this)'>▲</button></div>";
	echo "<div class='col-1' style='margin-bottom:5px'><button type='button' class='btn btn-warning btn-xs eee' onClick='level_up(this)'>▼</button></div>";
	echo "<label class='col-2 control-label text-right' style='margin-bottom:5px'>レベル</label>";
	echo "<div class='col-3' style='margin-bottom:5px'>";
	echo "<input type='number' class='form-control input-normal input-sm level' name='level[]' min='1' max='10' value='{$level}' readonly>";
	echo "</div>";
	
	echo "<label class='col-sm-2 control-label text-right' style='margin-bottom:5px'>優先度</label>";
	echo "<div class='col-3' style='margin-bottom:5px'>";
	echo "<input type='number' class='form-control input-normal input-sm priority' name='priority[]' value='{$priority}' min='1' max='10'>";
	echo "</div></div>";
	
	echo "<div class='col-4 date_and_time'>";
	
	if($level == 1) {
		echo "<div class='col-12' style='margin-bottom:5px'>";
		echo "<label class='label-checkbox pull-right'>";
		echo "<input type='checkbox' name='make_weekly' value='{$make_weekly}' {$make_weekly_select}>";
		echo "<span class='lever'>週報の作成</span>";
		echo "</label></div>";
	}
	
	echo "<div class='col-12' style='margin-bottom:5px'>";
	echo "<label class='control-label'>納期</label>";
	echo "<input type='text' class='form-control input-normal input-sm noki' name='noki[]' value='{$noki}'>";
	echo "</div>";
	
	echo "<div class='col-12 ' style='margin-bottom:5px'>";
	echo "<label class='control-label'>納期の時間</label>";
	echo "<input type='time' class='form-control input-normal input-sm time' name='time[]' value='{$noki_time}' step='900'>";
	echo "</div>";
	
	echo "<div class='col-12' style='margin-bottom:5px'>";
	echo "<label class='control-label'>開始予定時刻</label>";
	echo "<input type='text' class='form-control input-normal input-sm kaisi' name='kaisi[]' value='{$kaisi}'>";
	echo "</div>";
	
	echo "<div class='col-12' style='margin-bottom:5px'>";
	echo "<label class='control-label'>終了予定日時</label>";
	echo "<input type='text' class='form-control input-normal input-sm syuryo' name='syuryo[]' value='{$syuryo}'>";
	echo "</div>";
	
	echo "</div></div></div>";
}

?>
