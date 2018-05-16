<?php
		//session_start();
		header("Content-type: text/html; charset=SJIS-win");
		include_once('../function.php');
		include_once('../../data/weekly.php');
		
		$todofile = '../../data/todo.csv';
		$oldtodofile = '../../data/old201804todo.csv';
		
		$todo = readCsvFile2($todofile);
		$oldtodo = readCsvFile2($oldtodofile);
		if(!isset($todo[0]['’S“–'])) {
			$copyfile = "../../data/bk/todo_".date('YmdHis').".csv";
			copy( $todofile , $copyfile );
			$copyfile = "../../data/bk/old201804todo_".date('YmdHis').".csv";
			copy( $oldtodofile , $copyfile );
				$todo[0]['’S“–'] = "’S“–";

			for($i=1; $i<count($todo); $i++) {
				$todo[$i]['’S“–'] = $myname;
			}
			
			for($i=1; $i<count($oldtodo); $i++) {
				$oldtodo[$i]['’S“–'] = $myname;
			}
			
			writeCsvFile2($todofile, $todo);
			writeCsvFile2($oldtodofile, $oldtodo);
			header( "Location: /Memoria/pages/todo.php" );
			exit();
			
			
			
			
		} else {
			//echo "‚ ‚é";
			echo "<script>alert('XVÏ‚İ');location.href = '/Memoria/pages/todo.php';</script>";
		}
?>
