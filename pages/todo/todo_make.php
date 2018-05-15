
<?php
	//$todo = readCsvFile2('../data/todo.csv');
	$todo_theme = readCsvFile2('../data/todo_theme.csv');
	$todo_keeper_theme = readCsvFile2('../data/todo_keeper_theme.csv');
	if((!isset($_GET['p']) || $todo[$_GET['p']]['level']!=1) && $_GET['d']!="new") {
		echo "<button>���ǂ�</button>";
	}
	if (isset($_GET['file']) && $_GET['file'] == "old201804" && $_GET['d']=="change") echo '<meta http-equiv="refresh" content="1;URL=./todo.php">';
?>

<div class="col-xs-1"></div>
<div class="col-xs-10">
<?php
	if($_GET['d'] != "change") {
		echo "<form class='form-horizontal' method='post' action='todo/toroku.php'>";
		$id = count($todo);
		if($_GET['d'] == "new") todo_fieldset($todo, $todo_theme, $todo_keeper_theme, 1, $_GET['d'], $id, 0, 0);
		else todo_fieldset($todo, $todo_theme, $todo_keeper_theme, 1, $_GET['d'], $id, $_GET['p'], 0);
	} else {
		echo "<form class='form-horizontal' method='post' action='todo/toroku2.php' name='changetodo'>";
		$id = $_GET['p'];
		todo_fieldset($todo, $todo_theme, $todo_keeper_theme, 1, $_GET['d'], $id, $id, 0);
	}
?>


		<div class="new" >
<?php
	if($_GET['d'] != "new") {
		$count = todo_make_child($todo, $todo_theme, $todo_keeper_theme, 1, $_GET['p']);
	}
	

?>
		</div>
	    <div class="form-group">
	    	<button class="btn btn-success center-block" type="button" onClick='plus();'><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>�@�ǉ�</button>
	    </div>
	    
        <div class="form-group" style="margin-bottom:0; position: fixed; bottom: 20px;right:0;width:500px;">
            <div class="col-xs-offset-3 col-xs-3">
                <button type="reset" class="btn btn-default btn-block">Reset</button>
            </div>
			<div class="col-xs-3">
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </div>
			<div class="col-xs-offset-3 col-xs-6" style="margin-top:10px">
                <button type="button" class="btn btn-info btn-block btn-xs" onClick="setDateTime()">Set DateTime</button>
            </div>
        </div>
        <div style="height: 100px"></div>
    </form>
</div>

<?php
/*
function todo_make_child($todo, $todo_theme, $todo_keeper_theme, $count, $parent) {
	for($i=1; $i<count($todo);$i++) {
		if($todo[$i]['parent']==$parent && $todo[$i]['level']!=1 && $todo[$i]['�폜']==0) {
			if($_GET['d'] == "renew") {
				$id = count($todo) + $count;
				todo_fieldset($todo, $todo_theme, $todo_keeper_theme, $todo[$i]['level'], $_GET['d'], $id, $todo[$i]['id'], $count);
			} else {
				todo_fieldset($todo, $todo_theme, $todo_keeper_theme, $todo[$i]['level'], $_GET['d'], $todo[$i]['id'], $todo[$i]['id'], $count);
			}
			$count++;
			$count = todo_make_child($todo, $todo_theme, $todo_keeper_theme, 1, $i);
		}
	}
	return $count;
}*/

function todo_make_child($todo, $todo_theme, $todo_keeper_theme, $count, $top) {
	$next_id = todo_next($todo, $top, $count);
	while($next_id != 0) {
		if($_GET['d'] == "renew") {
			$id = count($todo) + $count;
			todo_fieldset($todo, $todo_theme, $todo_keeper_theme, $todo[$next_id]['level'], $_GET['d'], $id, $todo[$next_id]['id'], $count);
		} else {
			todo_fieldset($todo, $todo_theme, $todo_keeper_theme, $todo[$next_id]['level'], $_GET['d'], $todo[$next_id]['id'], $todo[$next_id]['id'], $count);
		}
		//echo "count={$count}	<br>";
		$count++;
		$next_id = todo_next($todo, $top, $count);
	}
}




function todo_fieldset($todo, $todo_theme, $todo_keeper_theme, $level, $type, $id, $p, $count) {
	if(isset($_GET['theme'])) $theme = $_GET['theme'];
	else if(isset($_GET['p'])) $theme = $todo[$_GET['p']]['�e�[�}'];
	else $theme = 0;
	if(isset($_GET['p']) && $_GET['p']) $time_theme = $todo[$_GET['p']]['���ԊǗ��e�[�}'];
	else $time_theme = 0;
	
	date_default_timezone_set('Asia/Tokyo');
	if($_GET['d'] == "new") {
		$title = "";
		$detail = "";
		$mono = "";
		$priority = 1;
		$today = date('Y/m/d');
		$noki = $today;
		$noki_time = '18:00';
		$kaisi = $today;
		$syuryo = $today;
		$count = 0;
		$todotheme = 0;
	} else {
		$title = $todo[$p]['�^�C�g��'];
		$detail = str_replace('<br>', '&#13;',$todo[$p]['��Ɠ��e']); 
		$mono = $todo[$p]['���ʕ�'];
		$priority = $todo[$p]['�D��x'];
		$count = $todo[$p]['����'];
		$todotheme = $todo[$p]['�e�[�}�Ή�'];
		if($_GET['d'] == "renew") {
			$today = date('Y/m/d');
			$noki = $today;
			$noki_time = '18:00';
			$kaisi = $today;
			$syuryo = $today;
		} else {
			$noki = date('Y/m/d',  strtotime($todo[$p]['�[��']));
			$noki_time = $todo[$p]['�[������'];
			$kaisi = date('Y/m/d',  strtotime($todo[$p]['�J�n�\���']));
			$syuryo = date('Y/m/d',  strtotime($todo[$p]['�I���\���']));
		}
	}
	
	echo "<fieldset style='position: relative'>";
	echo "<div class='well bs-component'>";
	echo "<div class='form-group'>";
	
	if($level != 1) echo "<div class='clearfix'><span class='pull-right close' onClick='minus({$count});'>&times;</span><span class='pull-right close'>�@</span><span class='pull-right close' onClick='plus2({$count});'>+</span></div>";
	
	echo "<div class='col-xs-8'>";
	
	if($level == 1) {
		echo "<div class='col-xs-12' style='margin-bottom:5px'>";
		if($_GET['d'] != "change")
		echo '<select class="form-control input-normal input-sm theme" name="theme[]" onChange="select_theme(this.options[this.options.selectedIndex].value)">';
		else echo '<select class="form-control input-normal input-sm theme" name="theme[]">';
		echo "<option value='0'>�e�[�}�̑I��</option>";
		for($i=1;$i<count($todo_theme);$i++) {
			if($theme == $i) {
				echo "<option value='{$i}' selected>{$todo_theme[$i]['�e�[�}']}</option>";
			} else {
				echo "<option value='{$i}'>{$todo_theme[$i]['�e�[�}']}</option>";//col-sm-2
			}
		}
		echo "</select></div>";
		echo "<div class='col-xs-12' style='margin-bottom:5px'>";
		echo "<select class='form-control input-normal input-sm theme' name='theme2[]'>";
		echo "<option value='0'>���ԊǗ��e�[�}�̑I��</option>";
		for($i=1;$i<count($todo_keeper_theme);$i++) {
			if($time_theme == $todo_keeper_theme[$i]['id']) {
				echo "<option value='{$todo_keeper_theme[$i]['id']}' selected>{$todo_keeper_theme[$i]['�e�[�}']}</option>";
			} else {
				echo "<option value='{$todo_keeper_theme[$i]['id']}'>{$todo_keeper_theme[$i]['�e�[�}']}</option>";//col-sm-2
			}
		}
		echo "</select></div>";
	}

	echo "<div class='col-xs-12' style='margin-bottom:5px'>";
	echo "<input type='text' class='form-control input-normal input-sm name' name='name[]' placeholder='�^�C�g��' value='{$title}'>";
	echo "<input type='hidden' name='id[]' value='{$id}' class='id'>";
	echo "</div>";
	
	echo "<div class='col-xs-12' style='margin-bottom:5px'>";
	echo "<textarea class='form-control input-normal input-sm detail' rows='3' name='detail[]'>{$detail}</textarea>";
	echo "</div>";
	
	echo "<div class='col-xs-12' style='margin-bottom:5px'>";
	echo "<input type='text' class='form-control input-normal input-sm mono' name='mono[]' placeholder='���ʕ�' value='{$mono}'>";
	echo "</div>";
	
					
					
	
	echo "<div class='col-xs-2 center-block' style='margin-bottom:5px'><button type='button' class='btn btn-warning btn-xs' onClick='level_up(this)'>��</button><button type='button' class='btn btn-warning btn-xs eee' onClick='level_down(this)'>��</button></div>";
	echo "<label class='col-sm-2 control-label' style='margin-bottom:5px'>���x��</label>";
	echo "<div class='col-xs-3' style='margin-bottom:5px'>";
	echo "<input type='number' class='form-control input-normal input-sm level' name='level[]' min='1' max='10' value='{$level}' readonly>";
	echo "</div>";
	
	echo "<label class='col-sm-2 control-label' style='margin-bottom:5px'>�D��x</label>";
	echo "<div class='col-xs-3' style='margin-bottom:5px'>";
	echo "<input type='number' class='form-control input-normal input-sm priority' name='priority[]' value='{$priority}' min='1' max='10'>";
	echo "</div></div>";
	
	echo "<div class='col-xs-4 date_and_time'>";
	echo "<div class='col-xs-12' style='margin-bottom:5px'>";
	echo "<label class='control-label'>�[��</label>";
	echo "<input type='text' class='form-control input-normal input-sm noki' name='noki[]' value='{$noki}'>";
	echo "</div>";
	
	echo "<div class='col-xs-12 ' style='margin-bottom:5px'>";
	echo "<label class='control-label'>�[���̎���</label>";
	echo "<input type='time' class='form-control input-normal input-sm time' name='time[]' value='{$noki_time}' step='900'>";
	echo "</div>";
	
	echo "<div class='col-xs-12' style='margin-bottom:5px'>";
	echo "<label class='control-label'>�J�n�\�莞��</label>";
	echo "<input type='text' class='form-control input-normal input-sm kaisi' name='kaisi[]' value='{$kaisi}'>";
	echo "</div>";
	
	echo "<div class='col-xs-12' style='margin-bottom:5px'>";
	echo "<label class='control-label'>�I���\�����</label>";
	echo "<input type='text' class='form-control input-normal input-sm syuryo' name='syuryo[]' value='{$syuryo}'>";
	echo "</div>";
	
	echo "</div></div></div>";
	echo "</fieldset>";
}

?>
