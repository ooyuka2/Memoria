<?php
		//session_start();
		header("Content-type: text/html; charset=SJIS-win");
		include_once('../function.php');
		
		$todofile = '../../data/todo.csv';
		
		$todo = readCsvFile2($todofile);
		if(!isset($todo[0]['今日やること'])) {
			$copyfile = "../../data/bk/todo_".date('YmdHis').".csv";
			copy( $todofile , $copyfile );
			$todo[0]['今日やること'] = "今日やること";
			
			for($i=1; $i<count($todo); $i++) {
				$todo[$i]['今日やること'] = 0;
			}
			
			writeCsvFile2($todofile, $todo);
			header( "Location: /Memoria/pages/todo.php" );
			exit();
			
			
			
			
		} else {
			//echo "ある";
			echo "<script>alert('更新済み');location.href = '/Memoria/pages/todo.php';</script>";
		}
?>
