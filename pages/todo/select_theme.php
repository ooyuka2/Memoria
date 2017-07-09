<?php
	$todo = readCsvFile2('../data/todo.csv');
	$id = 0;
	for($i=count($todo)-1; $i>0; $i--) {
		if($todo[$i]['テーマ'] == $_GET['theme']) {
			$id = $i;
		}
	}
	if($id == 0 || $_GET['theme']==0) {
		header( "Location: /Memoria/pages/todo.php?d=new&theme=".$_GET['theme'] );
		exit();
	}
	header( "Location: /Memoria/pages/todo.php?d=renew&p=".$id );
	exit();
?>