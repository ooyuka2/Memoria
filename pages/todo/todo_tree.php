
<div class='panel panel-default'>
	<div class='panel-body'>
		<div class='clearfix'>
			<button class='btn btn-default pull-right btn-xs' onclick='tree_close()'>•Â‚¶‚é</button>
			<button class='btn btn-default pull-right btn-xs' style='margin:0 10px' onclick='tree_open()'>ŠJ‚­</button>
			<a href="/Memoria/pages/todo.php?page=do&p=deskwork&f=0" class="btn btn-link active btn-xs">‚»‚Ì‘¼‚Ìì‹Æ</a>
		</div>
<?php
	if(isset($_GET['d']) && $_GET['d']=="detail" && isset($_GET['p'])) $sa[0] = $todo[$_GET['p']]['top'];
	else if((isset($_GET['list']) && $_GET['list']=="finishlist") || (isset($_GET['p']) && $todo[$todo[$_GET['p']]['top']]['Š®—¹']==1))
		$sa = sort_by_noki_todo_priority($todo, false);
	else $sa = sort_by_noki_todo_priority($todo, true);
	for($i=0; $i<count($sa); $i++) {
		
		if($i!=0 && $todo[$sa[$i]]['level'] == 1) {
			write_todo_tree($todo, $sa[$i], date('Y/m/d'));
		} else if($sa[$i]==0) {
			echo "<hr>";
		}
		
	}
?>
	</div>
</div>
