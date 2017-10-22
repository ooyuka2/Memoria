<?php
		//session_start();
		header("Content-type: text/html; charset=SJIS-win");
		include_once('../function.php');
		
		$todofile = '../../data/todo.csv';
		
		$todo = readCsvFile2($todofile);
		if(!isset($todo[0]['¡“ú‚â‚é‚±‚Æ'])) {
			$copyfile = "../../data/bk/todo_".date('YmdHis').".csv";
			copy( $todofile , $copyfile );
			$todo[0]['¡“ú‚â‚é‚±‚Æ'] = "¡“ú‚â‚é‚±‚Æ";
			
			for($i=1; $i<count($todo); $i++) {
				$todo[$i]['¡“ú‚â‚é‚±‚Æ'] = 0;
			}
			
			writeCsvFile2($todofile, $todo);
			header( "Location: /Memoria/pages/todo.php" );
			exit();
			
			
			
			
		} else {
			//echo "‚ ‚é";
			echo "<script>alert('XVÏ‚İ');location.href = '/Memoria/pages/todo.php';</script>";
		}
?>
