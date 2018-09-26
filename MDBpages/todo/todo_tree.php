<?php
	$pagetype = "MDBpages";
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
?>
<div class="card">
	<div class="card-body">

		
<?php
	if(!isset($todo)) {
		include_once($ini['dirWin'].'/pages/function.php');
		header("Content-type: text/html; charset=SJIS-win");
		
		if(isset($_GET['file']) && $_GET['file'] == "old201804") {
			$todo = readCsvFile2($link_data . 'old201804todo.csv');
			$file = "old201804";
		} else {
			$todo = readCsvFile2($link_data . 'todo.csv');
			$file = "todo";
		}
	}
	if(isset($_GET['d']) && $_GET['d']=="detail" && isset($_GET['p'])) $sa[0] = $todo[$_GET['p']]['top'];
	else if((isset($_GET['list']) && $_GET['list']=="finishlist") || (isset($_GET['p']) && $_GET['p'] != 0 && $todo[$todo[$_GET['p']]['top']]['Š®—¹']==1))
		$sa = sort_by_noki_todo_priority($todo, false);
	else $sa = sort_by_noki_todo_priority($todo, true);
?>
		<div class='clearfix'>
			<button class='btn btn-default pull-right btn-sm' onclick='tree_close()'>•Â‚¶‚é</button>
			<button class='btn btn-default pull-right btn-sm' style='' onclick='tree_open()'>ŠJ‚­</button>
			<a class='pull-left' href="/Memoria/mdbpages/todo.php?page=whatdo&p=deskwork&f=0" style="margin:15px 5px">’èŠúì‹Æ</a>
			<a class='pull-left' href="/Memoria/mdbpages/todo.php?page=whatTodayDo" style="margin:15px 5px">¡“ú‚â‚é‚±‚Æ</a>
		</div>
		<div>

		</div>
		<div id="todo_tree">
<?php
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
</div>
<div id="todo_tree_menu"></div>