<?php
		//session_start();
		include_once('./function.php');
		
		$todo = readCsvFile2('../data/todo.csv');

		for($i=1; $i<count($todo); $i++) {
			if($todo[$i]['child']!=0) {
				$todo[$i]['�p�[�Z���e�[�W'] = 0;
				$todo[$i]['����'] = 0;
			}
		}
		for($i=1; $i<count($todo); $i++) {
			if($todo[$i]['child']==0) {
				$todo = check_parent_finish($todo, $i, $todo[$i]['�p�[�Z���e�[�W']);
			}
		}

		writeCsvFile2("../data/todo.csv", $todo);
		header( "Location: /Memoria/pages/todo.php" );
		exit();
		//echo "<pre>";
		//print_r($working);
		//echo "<hr>".$working[4]['name'];
		
		
		// target='_blank'>
		

		
		
		
		
		
		
		//echo "</pre><br><br>finish!";
?>
