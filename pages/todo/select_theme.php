<?php
	$todo = readCsvFile2('../data/todo.csv');
	$id = 0;
	for($i=count($todo)-1; $i>0; $i--) {
		if($todo[$i]['�e�[�}'] == $_GET['theme'] && $todo[$i]['�폜'] == 0) {
			$id = $i;
			header( "Location: /Memoria/pages/todo.php?d=renew&p=".$id );
			exit();
		}
	}
	header( "Location: /Memoria/pages/todo.php?d==new&theme=".$_GET['theme'] );
	exit();
?>