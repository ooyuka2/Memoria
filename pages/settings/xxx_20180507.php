<?php
		//session_start();
		header("Content-type: text/html; charset=SJIS-win");
		include_once('../function.php');
		
		$todofile = '../../data/todo.csv';
		
		$todo = readCsvFile2($todofile);
		if(!isset($todo[0]['�e�[�}�Ή�'])) {
			$copyfile = "../../data/bk/todo_".date('YmdHis').".csv";
			copy( $todofile , $copyfile );

				$todo[0]['�e�[�}�Ή�'] = "�e�[�}�Ή�";
				$todo[0]['�e�[�}�T�v'] = "�e�[�}�T�v";

			for($i=1; $i<count($todo); $i++) {
				$todo[$i]['�e�[�}�Ή�'] = 0;
				$todo[$i]['�e�[�}�T�v'] = "";
			}
			
			writeCsvFile2($todofile, $todo);
			header( "Location: /Memoria/pages/todo.php" );
			exit();
			
			
			
			
		} else {
			//echo "����";
			echo "<script>alert('�X�V�ς�');location.href = '/Memoria/pages/todo.php';</script>";
		}
?>
