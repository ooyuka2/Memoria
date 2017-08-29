<?php
	
	$todo = readCsvFile2('../data/todo.csv');
	
	if(isset($_GET['p'])) {//id,dictionary,author,year,commentary,floor,place,img
		if($todo[$_GET['p']]['•Û—¯'] == 1) $todo = todo_wait_child($todo, $_GET['p'], 0);
		else $todo = todo_wait_child($todo, $_GET['p'], 1);
		writeCsvFile2("../data/todo.csv", $todo);
	}
	header( "Location: ".$_SERVER['HTTP_REFERER'] );
	exit();
	
	function todo_wait_child($todo, $id, $wait) {
		$todo[$id]['•Û—¯'] = $wait;
		if($todo[$id]['child'] != 0) {
			for($i=1; $i<count($todo); $i++) {
				if($todo[$i]['parent']==$id && $todo[$i]['Š®—¹']==0 && $todo[$i]['íœ']==0) {
					$todo = todo_wait_child($todo, $i, $wait);
				}
			}
		}
		return $todo;
	}
?>
		
