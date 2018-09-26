<?php

// ##############################################################################################################################
//            todo_treeの関数
// ##############################################################################################################################
function write_todo_tree($todo, $id, $date) {
	$color = check_todo_tree($todo, $id, $date);
	$count = $todo[$id]['順番']+1;
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
	else echo "<div class='panel-tree-child'>";
	
	if(isset($_GET['file']) && $_GET['file'] == "old201804") {
		$file = "old201804";
	} else {
		$file = "todo";
	}
	
	if($todo[$id]['level'] != 1) {
		echo "&thinsp;";
		for($j=1; $j<$todo[$id]['level']; $j++) echo " <span class='tree-child-space'>　</span>";
	}
	
	if($todo[$id]['保留'] == "") $todo[$id]['保留'] = 0;
	
	if($todo[$id]['child'] != 0) echo "<span class='fa fa-chevron-down tree-mark' aria-hidden='true' onClick='tree_operate(this)'></span>";
	else if($todo[$id]['完了'] == 0) echo "<span class='fa fa-pencil-square-o tree-mark' aria-hidden='true'></span>";
	else echo "<span class='fa fa-check-square-o tree-mark' aria-hidden='true'></span>";
	if(!isset($_GET['d'])) $_GET['d'] = "todo";
	if($color == "primary") $textcolor_class = "cyan-text";
	else $textcolor_class = "text-{$color}";
	
	echo "<span class='{$textcolor_class}' onDblClick='location.href = \"/Memoria/mdbpages/todo.php?d={$_GET['d']}&p={$todo[$id]['id']}\"'	onMouseOver='this.classList.add(\"bg-info\")' onMouseOut='this.classList.remove(\"bg-info\")' onClick='gotoid(todoid{$todo[$id]['id']})' oncontextmenu='tree_menu({$todo[$id]['id']}, {$todo[$id]['top']}, {$todo[$id]['パーセンテージ']}, {$todo[$id]['child']}, {$todo[$id]['保留']}, \"{$file}\");return false' style='cursor: pointer;'>{$todo[$id]['タイトル']}</span>";
}

/*
		<i class='fa fa-check-square-o' aria-hidden='true'></i>
		<i class='fa fa-pencil-square-o' aria-hidden='true'></i>
		<i class='fa fa-chevron-down' aria-hidden='true'></i>
		<i class='fa fa-chevron-right' aria-hidden='true'></i>
*/





?>