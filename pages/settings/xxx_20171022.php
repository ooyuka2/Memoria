

<?php
		//session_start();
		include_once('../function.php');
		
		$working = readCsvFile2('../../data/working.csv');

		for($i=1; $i<count($working); $i++) {
			if($working[$i]['id']=="deskwork") {
				$working[$i]['keeper'] = 37;
				$working[$i]['id'] = "periodically";
			}
			if($working[$i]['id']=="morning") {
				$working[$i]['keeper'] = 60;
				$working[$i]['id'] = "periodically";
			}
		}
		/*
		for($i=1; $i<count($working); $i++) {
			if($working[$i]['child']==0) {
				$working = check_parent_finish($todo, $i, $todo[$i]['パーセンテージ']);
			}
		}*/

		writeCsvFile2("../../data/working.csv", $working);
		header( "Location: /Memoria/pages/todo.php?d=keeper" );
		exit();
		//echo "<pre>";
		//print_r($working);
		//echo "<hr>".$working[4]['name'];
		
		
		// target='_blank'>
		

		
		
		
		
		
		
		//echo "</pre><br><br>finish!";
?>
