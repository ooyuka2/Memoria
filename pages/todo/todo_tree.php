<div class='panel panel-default'>
	<div class='panel-body'>
		<div class='clearfix'>
			<button class='btn btn-default pull-right btn-xs' onclick='tree_close()'>����</button>
			<button class='btn btn-default pull-right btn-xs' style='margin:0 10px' onclick='tree_open()'>�J��</button>
			<a href="/Memoria/pages/todo.php?page=whatdo&p=deskwork&f=0" class="btn btn-link active btn-xs">������</a>
			<a href="/Memoria/pages/todo.php?page=whatTodayDo" class="btn btn-link active btn-xs">������邱��</a>
		</div>
<?php
	if(isset($_GET['d']) && $_GET['d']=="detail" && isset($_GET['p'])) $sa[0] = $todo[$_GET['p']]['top'];
	else if((isset($_GET['list']) && $_GET['list']=="finishlist") || (isset($_GET['p']) && $todo[$todo[$_GET['p']]['top']]['����']==1))
		$sa = sort_by_noki_todo_priority($todo, false);
	else $sa = sort_by_noki_todo_priority($todo, true);
	for($i=0; $i<count($sa); $i++) {
		if($sa[$i]!=0) { 
			write_todo_tree($todo, $sa[$i], date('Y/m/d'));
		} else if($sa[$i]==0) {
			echo "<hr>";
		}
	}
?>
	</div>
</div>
