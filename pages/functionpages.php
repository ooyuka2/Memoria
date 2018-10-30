<?php
//##################################################################
//				todo�p�֐�
//##################################################################

function last_todo_panel($todo, $i, $pattern, $file) {
			echo "<div class='panel panel-{$pattern}' id='todoid{$todo[$i]['id']}'>";
			
			if($todo[$i]['�ۗ�'] == "") $todo[$i]['�ۗ�'] = 0;
			
			echo "<div class='panel-heading'>";
			if($todo[$i]['level'] == 1) {
				echo "<a href='./todo.php?d=detail&p={$i}&file={$file}' ";
				if($pattern=='primary') echo "style='color:#ffffff;'";
				if($pattern=='warning') echo "style='color:#fa8072;'";
				else if($pattern=='info') echo "style='color:#87ceeb;'";
				echo ">";
				echo "<h3 class='panel-title' oncontextmenu='tree_menu({$todo[$i]['id']}, {$todo[$i]['top']}, {$todo[$i]['�p�[�Z���e�[�W']}, {$todo[$i]['child']}, {$todo[$i]['�ۗ�']}, {$todo[$i]['������邱��']}, \"{$file}\");return false' >{$todo[$i]['�^�C�g��']}</h3>";
			}
			else {
				//$b = $todo[$i]['top'];
				//echo "<a href='./todo.php?d=detail&p={$b}'";
				echo "<a href='./todo.php?d=detail&p={$i}&file={$file}'";
				if($pattern=='primary') echo "style='color:#ffffff;'";
				if($pattern=='warning') echo "style='color:#fa8072;'";
				else if($pattern=='info') echo "style='color:#87ceeb;'";
				echo ">";
				echo "<h3 class='panel-title' oncontextmenu='tree_menu({$todo[$i]['id']}, {$todo[$i]['top']}, {$todo[$i]['�p�[�Z���e�[�W']}, {$todo[$i]['child']}, {$todo[$i]['�ۗ�']}, {$todo[$i]['������邱��']}, \"{$file}\");return false'>{$todo[$i]['�^�C�g��']}<span class='pull-right'>{$todo[$todo[$i]['top']]['�^�C�g��']}</span></h3>";
			}
			echo "</a></div>";
			echo "<div class='panel-body'>";
			echo "";
			echo "<div class='col-md-9 col-xs-6'><strong>��Ɠ��e�@: </strong>{$todo[$i]['��Ɠ��e']}<br><strong>���ʕ��@�@: </strong>{$todo[$i]['���ʕ�']}<br><strong>���ԁ@�@�@: </strong>{$todo[$i]['�J�n�\���']}�@�`�@{$todo[$i]['�[��']}</div>";
			echo "<div class='col-md-1 col-xs-2 pull-right'><a href='todo.php?page=whatdo&f=100&p={$i}' class='btn btn-success btn-sm'>����</a></div>";
			if($todo[$i]['����'] != 1) {
				if($todo[$i]['�ۗ�'] == 0) echo "<div class='col-md-1 col-xs-2 pull-right'><a href='todo.php?page=wait&p={$i}' class='btn btn-info btn-sm'>�ۗ�</a></div>";
				else echo "<div class='col-md-1 col-xs-2 pull-right'><a href='todo.php?page=wait&p={$i}' class='btn btn-link btn-sm'>����</a></div>";
				echo "<div class='col-md-1 col-xs-2 pull-right'><button type='button' class='btn btn-default dropdown-toggle btn-sm' data-toggle='dropdown' aria-expanded='false'>��� <span class='caret'></span></button><ul class='dropdown-menu' role='menu'>";
				for($j=ceil($todo[$i]['�p�[�Z���e�[�W']/10)*10; $j<100; $j+=10) 
				echo "<li role='presentation'><a role='menuitem' tabindex='-1' href='todo.php?page=whatdo&p={$i}&f={$j}'>{$j}���܂Ŋ���</a></li>";
				echo "</ul></div>";
			} else if($file == "todo") {
				echo "<div class='col-md-1 col-xs-2 pull-right'><a href='./todo/nofinish.php?p={$i}' class='btn btn-warning btn-sm'>������</a></div>";
			}
			echo "</div>";
			echo "</div>";
	
}


function write_todo_tree($todo, $id, $date) {
	$color = check_todo_color($todo, $id, $date);
	$count = $todo[$id]['����']+1;
	if($color != "") {
		write_todo_tree_title($todo, $id, $color);
		if($todo[$id]['child'] != 0) {
			$next_id = todo_next_child($todo, $id, $count);
			while($next_id != 0) {
				$count = write_todo_tree($todo, $next_id, $date);
				$next_id = todo_next_child($todo, $id, $count);
			}

		}
		echo "</div>";
	}
	return $count;
}

function write_todo_tree_title($todo, $id, $color) {
	if(isset($_GET['p']) && $_GET['p'] == $todo[$id]['id']) echo "<div class='panel-tree-child bg-warning'>";
	else if($todo[$id]['level'] == 2 && $todo[$todo[$id]['top']]['������邱��'] != 1) echo "<div class='panel-tree-child' style='display: none;'>";
	else echo "<div class='panel-tree-child'>";
	
	if(isset($_GET['file']) && $_GET['file'] == "old201804") {
		$file = "old201804";
	} else {
		$file = "todo";
	}
	
	if($todo[$id]['level'] != 1) {
		echo "&thinsp;";
		for($j=1; $j<$todo[$id]['level']; $j++) echo " <span class='tree-child-space'>�@</span>";
	}
	
	if($todo[$id]['�ۗ�'] == "") $todo[$id]['�ۗ�'] = 0;
	
	if($todo[$id]['child'] != 0 && $todo[$id]['level'] == 1 && $todo[$todo[$id]['top']]['������邱��'] != 1) echo "<span class='glyphicon glyphicon-chevron-right tree-mark' aria-hidden='true' onClick='tree_operate(this)'></span>";
	else if($todo[$id]['child'] != 0) echo "<span class='glyphicon glyphicon-chevron-down tree-mark' aria-hidden='true' onClick='tree_operate(this)'></span>";
	else if($todo[$id]['����'] == 0) echo "<span class='glyphicon glyphicon-edit tree-mark' aria-hidden='true'></span>";
	else echo "<span class='glyphicon glyphicon-check tree-mark' aria-hidden='true'></span>";
	if(!isset($_GET['d'])) $_GET['d'] = "todo";
	echo "<span class='text-{$color}' onDblClick='location.href = \"/Memoria/pages/todo.php?d={$_GET['d']}&p={$todo[$id]['id']}\"'	onMouseOver='this.classList.add(\"bg-info\")' onMouseOut='this.classList.remove(\"bg-info\")' onClick='gotoid(todoid{$todo[$id]['id']})' oncontextmenu='tree_menu({$todo[$id]['id']}, {$todo[$id]['top']}, {$todo[$id]['�p�[�Z���e�[�W']}, {$todo[$id]['child']}, {$todo[$id]['�ۗ�']}, {$todo[$todo[$id]['top']]['������邱��']}, \"{$file}\");return false' style='cursor: pointer;'>{$todo[$id]['�^�C�g��']}</span>";
}

//##################################################################
//				�����p�l���쐬�p�֐�
//##################################################################



function makeMemoPanel($path, $memo, $memolist) {
	if($memolist['big'] == "y") echo "<div class='bs-component col-sm-12' id='{$memolist['filename']}'>";
	else echo "<div class='bs-component col-sm-6' id='{$memolist['filename']}'>";
	echo "<div class='modal'>";
	echo "<div class='modal-dialog'>";
	echo "<div class='modal-content'>";
	echo "<div class='modal-header'>";
	echo "<a name='{$memolist['filename']}'></a>";
	//echo "<h4 class='modal-title'>{$title}</h4>";
	//
	//$title = htmlspecialchars($memo, ENT_IGNORE);
	
	$title = str_replace("<", "!", $memo);
	$title = str_replace(">", "!", $title);
	$title = mb_substr($title, 0, 20);
	if($memolist['lock'] == "n") echo "<span style='display:none;'>".$title."�c�c</span><button type='button' class='close' data-dismiss='modal' aria-hidden='true' onClick='switchingMemoPanel(this)'><span class='glyphicon glyphicon-resize-small' aria-hidden='true'></span></button>";
	else echo "<span>".$title."�c�c</span><button type='button' class='close' data-dismiss='modal' aria-hidden='true' onClick='switchingMemoPanel(this)'><span class='glyphicon glyphicon-resize-full' aria-hidden='true'></span></button>";
	echo "</div>";
	if($memolist['lock'] == "n") echo "<div class='modal-body'>";
	else echo "<div class='modal-body' style='display:none;'>";
//	$hyouzi = str_replace("<table>","<table class='table table-striped table-bordered table-hover table-condensed'>",$memo);
//	$hyouzi = str_replace("<a href=\"http","<a target='_blank' href=\"http",$hyouzi);

	echo "<p>{$memo}</p>";
	echo "</div>";
	
	if($memolist['lock'] == "n") echo "<div class='modal-footer'>";
	else echo "<div class='modal-footer' style='display:none;'>";
	echo '<span class="pull-right">�@</span><button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="deleteMemoPanel(\''.$path.'\', \''.$memolist['filename'].'\')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>';
	echo '<span class="pull-right">�@</span><button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="changeMempPanel(\''.$memolist['filename'].'\', this, \''.$memolist['big'].'\', \''.$memolist['lock'].'\')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>';
//	echo '�@<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></button>';

	//echo "<button type='button' class='btn btn-default' data-dismiss='modal'>����</button>";
	//echo "<button type='button' class='btn btn-primary'>�ۑ�</button>";
	echo "</div>";
	echo "</div>";
	echo "</div>";
	echo "</div>";
	echo "</div>";
}



//##################################################################
//				�J�����_�[�p�֐�
//##################################################################
// ���݂̔N�����擾
function calendar($year, $month) {
	// ���������擾
	$last_day = date('j', mktime(0, 0, 0, $month + 1, 0, $year));
	$calendar = array();
	$j = 0;
	// �������܂Ń��[�v
	for ($i = 1; $i < $last_day + 1; $i++) {
		// �j�����擾
			$week = date('w', mktime(0, 0, 0, $month, $i, $year));
			// 1���̏ꍇ
			if ($i == 1) {
					// 1���ڂ̗j���܂ł����[�v
					for ($s = 1; $s <= $week; $s++) {
							// �O���ɋ󕶎����Z�b�g
							$calendar[$j]['day'] = '';
							$j++;
					}
			}
			// �z��ɓ��t���Z�b�g
			$calendar[$j]['day'] = $i;
			$j++;
			// �������̏ꍇ
			if ($i == $last_day) {
					// ����������c������[�v
					for ($e = 1; $e <= 6 - $week; $e++) {
							// �㔼�ɋ󕶎����Z�b�g
							$calendar[$j]['day'] = '';
							$j++;
					}
			}
	}
?>
	<div class='calendar'>
	<?php echo $year; ?>�N<?php echo $month; ?>��
	<?php
		$thisyear = date('Y');
		$thismonth = date('n');
		$thisday = date('d');
	?>
	<br>
	<br>
	<table>
			<tr>
					<th style='background: #e73562;'>��</th>
					<th>��</th>
					<th>��</th>
					<th>��</th>
					<th>��</th>
					<th>��</th>
					<th style='background: #009b9f;'>�y</th>
			</tr>
	 
			<tr>
			<?php $cnt = 0; ?>
			<?php foreach ($calendar as $key => $value): ?>
	 
			<?php
				//$sa = sort_by_noki_priority($todo);
				if($value['day']!="") {
					if($thisyear == $year && $thismonth == $month && $thisday == $value['day'])
						echo "<td style='background: #fff352;'>";
					else if($cnt == 0 && $value['day']!="") echo "<td style='background: #ffc0cb;'>";
					else if($cnt == 6 && $value['day']!="") echo "<td style='background: #afeeee;'>";
					else echo "<td>";
			?>
			 <?php 

					echo "<a href='todo.php?d=calendar";
					echo "&year={$year}&mounth={$month}&day={$value['day']}'";
			 		echo "style='display:block; width:100%; '>".$value['day']."</a>";//height:100%
			 		if($value['day']!="") {
			 			$day = $year ."/". $month ."/". $value['day'];
			 			$day2 = new DateTime($day);
			 		}
			 		/*
			 		for($i=0; $i<count($sa); $i++) {
						if($value['day']!="") {
							$day1 = new DateTime($todo[$sa[$i]]['�J�n�\���']);
							if($day1 == $day2 && $todo[$sa[$i]]['����']==0 && $todo[$sa[$i]]['�ۗ�']==0 && $todo[$sa[$i]]['child']==0 && $todo[$sa[$i]]['�폜']==0) echo "<br>".$todo[$sa[$i]]['�^�C�g��'];
						}
					}*/
				}
				else echo "<td>";
				$cnt++;
			?>
			</td>
	 
			<?php if ($cnt == 7): ?>
			</tr>
			<tr>
			<?php $cnt = 0; ?>
			<?php endif; ?>
	 
			<?php endforeach; ?>
			</tr>
	</table>
	</div>
<?php
}

//##################################################################
//				�p�l���\���p�֐�
//##################################################################

function echo_panel($title, $txt, $pattern) {
			echo "<div class='panel panel-{$pattern}' style='text-align:start;'>";
			
			echo "<div class='panel-heading'>";
			echo "<h3 class='panel-title'>{$title}</h3>";
			echo "</div>";
			echo "<div class='panel-body'>";
			echo $txt;
			echo "</div>";
			echo "</div>";
	
}







































?>