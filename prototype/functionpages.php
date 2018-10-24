<?php


//##################################################################
//				todo�p�֐�
//##################################################################

function last_todo_panel($todo, $i, $pattern, $file) {
			echo "<div class='card border-{$pattern}' id='todoid{$todo[$i]['id']}'>";
			
			if($todo[$i]['�ۗ�'] == "") $todo[$i]['�ۗ�'] = 0;
			
			echo "<div class='card-header'>";
			if($todo[$i]['level'] == 1) {
				echo "<a href='./todo.php?d=detail&p={$i}&file={$file}' ";
				if($pattern=='primary') echo "style='color:#afafaf;'";
				if($pattern=='warning') echo "style='color:#fa8072;'";
				else if($pattern=='info') echo "style='color:#87ceeb;'";
				echo ">";
				echo "<h3 class='card-title' oncontextmenu='tree_menu({$todo[$i]['id']}, {$todo[$i]['top']}, {$todo[$i]['�p�[�Z���e�[�W']}, {$todo[$i]['child']}, {$todo[$i]['�ۗ�']}, \"{$file}\");return false' >{$todo[$i]['�^�C�g��']}</h3>";
			}
			else {
				//$b = $todo[$i]['top'];
				//echo "<a href='./todo.php?d=detail&p={$b}'";
				echo "<a href='./todo.php?d=detail&p={$i}&file={$file}'";
				if($pattern=='primary') echo "style='color:#ffffff;'";
				if($pattern=='warning') echo "style='color:#fa8072;'";
				else if($pattern=='info') echo "style='color:#87ceeb;'";
				echo ">";
				echo "<h3 class='card-title' oncontextmenu='tree_menu({$todo[$i]['id']}, {$todo[$i]['top']}, {$todo[$i]['�p�[�Z���e�[�W']}, {$todo[$i]['child']}, {$todo[$i]['�ۗ�']}, \"{$file}\");return false'>{$todo[$i]['�^�C�g��']}<span class='pull-right'>{$todo[$todo[$i]['top']]['�^�C�g��']}</span></h3>";
			}
			echo "</a></div>";
			echo "<div class='card-body'>";
			echo "";
			echo "<div class='col-md-9 col-6'><strong>��Ɠ��e�@: </strong>{$todo[$i]['��Ɠ��e']}<br><strong>���ʕ��@�@: </strong>{$todo[$i]['���ʕ�']}<br><strong>���ԁ@�@�@: </strong>{$todo[$i]['�J�n�\���']}�@�`�@{$todo[$i]['�[��']}</div>";
			echo "<div class='col-md-1 col-2 pull-right'><a href='todo.php?page=whatdo&f=100&p={$i}' class='btn btn-success btn-sm'>����</a></div>";
			if($todo[$i]['����'] != 1) {
				if($todo[$i]['�ۗ�'] == 0) echo "<div class='col-md-1 col-2 pull-right'><a href='todo.php?page=wait&p={$i}' class='btn btn-info btn-sm'>�ۗ�</a></div>";
				else echo "<div class='col-md-1 col-2 pull-right'><a href='todo.php?page=wait&p={$i}' class='btn btn-link btn-sm'>����</a></div>";
				echo "<div class='col-md-1 col-2 pull-right'><button type='button' class='btn btn-default dropdown-toggle btn-sm' data-toggle='dropdown' aria-expanded='false'>��� <span class='caret'></span></button><ul class='dropdown-menu' role='menu'>";
				for($j=ceil($todo[$i]['�p�[�Z���e�[�W']/10)*10; $j<100; $j+=10) 
				echo "<li role='presentation'><a role='menuitem' tabindex='-1' href='todo.php?page=whatdo&p={$i}&f={$j}'>{$j}���܂Ŋ���</a></li>";
				echo "</ul></div>";
			} else if($file == "todo") {
				echo "<div class='col-md-1 col-2 pull-right'><a href='./todo/nofinish.php?p={$i}' class='btn btn-warning btn-sm'>������</a></div>";
			}
			echo "</div>";
			echo "</div>";
	
}
// ##############################################################################################################################
//            todo_tree�̊֐�
// ##############################################################################################################################
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
	
	if($todo[$id]['child'] != 0 && $todo[$id]['level'] == 1 && $todo[$todo[$id]['top']]['������邱��'] != 1) echo "<span class='fa fa-chevron-right tree-mark' aria-hidden='true' onClick='tree_operate(this)'></span>";
	else if($todo[$id]['child'] != 0) echo "<span class='fa fa-chevron-down tree-mark' aria-hidden='true' onClick='tree_operate(this)'></span>";
	else if($todo[$id]['����'] == 0) echo "<span class='fa fa-pencil-square-o tree-mark' aria-hidden='true'></span>";
	else echo "<span class='fa fa-check-square-o tree-mark' aria-hidden='true'></span>";
	if(!isset($_GET['d'])) $_GET['d'] = "todo";
	if($color == "primary") $textcolor_class = "light-blue-text";
	else if($color == "muted") $textcolor_class = "text-wait";
	else $textcolor_class = "text-{$color}";
	
	echo "<span class='{$textcolor_class} bg-line' onDblClick='location.href = \"/Memoria/mdbpages/todo.php?d={$_GET['d']}&p={$todo[$id]['id']}\"' ";
	if($todo[$id]['child'] != 0) echo "onClick='tree_operate(this.previousElementSibling)'";
	else  echo "onClick='gotoid(todoid{$todo[$id]['id']})'";
	echo "oncontextmenu='tree_menu({$todo[$id]['id']}, {$todo[$id]['top']}, {$todo[$id]['�p�[�Z���e�[�W']}, {$todo[$id]['child']}, {$todo[$id]['�ۗ�']}, {$todo[$todo[$id]['top']]['������邱��']},\"{$file}\");return false' style='cursor: pointer;'>{$todo[$id]['�^�C�g��']}</span>";
}

/*
		<i class='fa fa-check-square-o' aria-hidden='true'></i>
		<i class='fa fa-pencil-square-o' aria-hidden='true'></i>
		<i class='fa fa-chevron-down' aria-hidden='true'></i>
		<i class='fa fa-chevron-right' aria-hidden='true'></i>
*/


//##################################################################
//				�����p�l���쐬�p�֐�
//##################################################################



function makeMemoCard($path, $memo, $memolist) {
	if($memolist['big'] == "y") echo "<div class='col-sm-12' id='{$memolist['filename']}'>";
	else echo "<div class='col-sm-6' id='{$memolist['filename']}'>";
	echo "<div class='card'>";
	echo "<div class='card-header'>";
	echo "<a name='{$memolist['filename']}'></a>";
	
	$title = str_replace("<", "!", $memo);
	$title = str_replace(">", "!", $title);
	$title = mb_substr($title, 0, 20);
	if($memolist['lock'] == "n") echo "<span style='display:none;'>".$title."�c�c</span><button type='button' class='close' data-dismiss='modal' aria-hidden='true' onClick='switchingMemoPanel(this)'><span class='fa fa-compress' aria-hidden='true'></span></button>";
	else echo "<span>".$title."�c�c</span><button type='button' class='close' data-dismiss='modal' aria-hidden='true' onClick='switchingMemoPanel(this)'><span class='fa fa-expand' aria-hidden='true'></span></button>";
	echo "</div>";
	if($memolist['lock'] == "n") echo "<div class='card-body'>";
	else echo "<div class='card-body' style='display:none;'>";

	echo "<p>{$memo}</p>";
	echo "</div>";
	
	
	if($memolist['lock'] == "n") echo "<div class='card-footer'>";
	else echo "<div class='card-footer' style='display:none;'>";
	echo '<span class="pull-right">�@</span><button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="deleteMemoPanel(\''.$path.'\', \''.$memolist['filename'].'\')"><span class="fa fa-trash" aria-hidden="true"></span></button>';
	echo '<span class="pull-right">�@</span><button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="changeMempPanel(\''.$memolist['filename'].'\', this, \''.$memolist['big'].'\', \''.$memolist['lock'].'\')"><span class="fa fa-pencil" aria-hidden="true"></span></button>';

	echo "</div>";
	echo "</div>";
	echo "</div>";
}


//##################################################################
//				�p�l���\���p�֐�
//##################################################################

function echo_panel($title, $txt, $pattern) {
			echo "<div class='card  border-{$pattern}' style='text-align:start;'>";
			
			echo "<div class='card-header'>";
			echo "<h3 class='card-title'>{$title}</h3>";
			echo "</div>";
			echo "<div class='card-body'>";
			echo $txt;
			echo "</div>";
			echo "</div>";
	
}

?>