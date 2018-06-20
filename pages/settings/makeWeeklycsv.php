<?php
		//session_start();
		header("Content-type: text/html; charset=SJIS-win");
		include_once('../function.php');
		include_once('../../data/weekly.php');
		
		$todofile = '../../data/todo.csv';
		$oldtodofile = '../../data/old201804todo.csv';
		$weeklyfile = '../../data/weekly.csv';
		
		$todo0 = readCsvFile2($todofile);
		
		if(!file_exists ( $weeklyfile )) {
			$copyfile = "../../data/bk/todo_".date('YmdHis').".csv";
			copy( $todofile , $copyfile );
			$copyfile = "../../data/bk/old201804todo_".date('YmdHis').".csv";
			copy( $oldtodofile , $copyfile );
			
			
			
			$weekly[0]["todoid"] = "todoid";
			$weekly[0]["�e�[�}�T�v"] = "�e�[�}�T�v";
			$weekly[0]["KPI"] = "KPI";
			$weekly[0]["�S��"] = "�S��";
			$weekly[0]["�ς�"] = "�ς�";
			$weekly[0]["�i��"] = "�i��";
			$weekly[0]["����̗\��"] = "����̗\��";
			$weekly[0]["parentid"] = "parentid";
			$weekly[0]["�ŏI�X�V����"] = "�ŏI�X�V����";
			$weekly[0]["�\��"] = "�\��";

			$c = 0;
			for($i=0; $i<count($todo0); $i++) {
				$todo[$i]["id"] = $todo0[$i]["id"];
				$todo[$i]["�^�C�g��"] = $todo0[$i]["�^�C�g��"];
				$todo[$i]["��Ɠ��e"] = $todo0[$i]["��Ɠ��e"];
				$todo[$i]["�[��"] = $todo0[$i]["�[��"];
				$todo[$i]["�[������"] = $todo0[$i]["�[������"];
				$todo[$i]["�J�n�\���"] = $todo0[$i]["�J�n�\���"];
				$todo[$i]["�I���\���"] = $todo0[$i]["�I���\���"];
				$todo[$i]["�p�[�Z���e�[�W"] = $todo0[$i]["�p�[�Z���e�[�W"];
				$todo[$i]["����"] = $todo0[$i]["����"];
				$todo[$i]["����"] = $todo0[$i]["����"];
				$todo[$i]["level"] = $todo0[$i]["level"];
				$todo[$i]["top"] = $todo0[$i]["top"];
				$todo[$i]["parent"] = $todo0[$i]["parent"];
				$todo[$i]["child"] = $todo0[$i]["child"];
				$todo[$i]["���ʕ�"] = $todo0[$i]["���ʕ�"];
				$todo[$i]["�e�[�}"] = $todo0[$i]["�e�[�}"];
				$todo[$i]["�D��x"] = $todo0[$i]["�D��x"];
				$todo[$i]["�o�^��"] = $todo0[$i]["�o�^��"];
				$todo[$i]["�ۗ�"] = $todo0[$i]["�ۗ�"];
				$todo[$i]["�폜"] = $todo0[$i]["�폜"];
				$todo[$i]["���ԊǗ��e�[�}"] = $todo0[$i]["���ԊǗ��e�[�}"];
				$todo[$i]["����"] = $todo0[$i]["����"];
				$todo[$i]["������邱��"] = $todo0[$i]["������邱��"];
				
				if($todo[$i]['���ԊǗ��e�[�}'] != 0 && ($todo[$i]['���ԊǗ��e�[�}'] < 30) && $todo0[$i]["level"] == 1 ) {
					$c =$c +1;
					$weekly[$c]["todoid"] = $todo[$i]["id"];
					$weekly[$c]["�e�[�}�T�v"] = "";
					$weekly[$c]["KPI"] = "";
					$weekly[$c]["�S��"] = $todo0[$i]["�S��"];
					$weekly[$c]["�ς�"] = "";
					$weekly[$c]["�i��"] = "";
					$weekly[$c]["����̗\��"] = "";
					$weekly[$c]["parentid"] = "0";
					$weekly[$c]["�ŏI�X�V����"] = date('Y/m/d H:i:s');
					$weekly[$c]["�\��"] = "0";
				
				}
				
			}
			writeCsvFile2($weeklyfile, $weekly);
			writeCsvFile2($todofile, $todo);
			
			$todo0 = readCsvFile2($oldtodofile);
			
			$todo = array();
			
			for($i=0; $i<count($todo0); $i++) {
				$todo[$i]["id"] = $todo0[$i]["id"];
				$todo[$i]["�^�C�g��"] = $todo0[$i]["�^�C�g��"];
				$todo[$i]["��Ɠ��e"] = $todo0[$i]["��Ɠ��e"];
				$todo[$i]["�[��"] = $todo0[$i]["�[��"];
				$todo[$i]["�[������"] = $todo0[$i]["�[������"];
				$todo[$i]["�J�n�\���"] = $todo0[$i]["�J�n�\���"];
				$todo[$i]["�I���\���"] = $todo0[$i]["�I���\���"];
				$todo[$i]["�p�[�Z���e�[�W"] = $todo0[$i]["�p�[�Z���e�[�W"];
				$todo[$i]["����"] = $todo0[$i]["����"];
				$todo[$i]["����"] = $todo0[$i]["����"];
				$todo[$i]["level"] = $todo0[$i]["level"];
				$todo[$i]["top"] = $todo0[$i]["top"];
				$todo[$i]["parent"] = $todo0[$i]["parent"];
				$todo[$i]["child"] = $todo0[$i]["child"];
				$todo[$i]["���ʕ�"] = $todo0[$i]["���ʕ�"];
				$todo[$i]["�e�[�}"] = $todo0[$i]["�e�[�}"];
				$todo[$i]["�D��x"] = $todo0[$i]["�D��x"];
				$todo[$i]["�o�^��"] = $todo0[$i]["�o�^��"];
				$todo[$i]["�ۗ�"] = $todo0[$i]["�ۗ�"];
				$todo[$i]["�폜"] = $todo0[$i]["�폜"];
				$todo[$i]["���ԊǗ��e�[�}"] = $todo0[$i]["���ԊǗ��e�[�}"];
				$todo[$i]["����"] = $todo0[$i]["����"];
				$todo[$i]["������邱��"] = $todo0[$i]["������邱��"];
				
			}
			writeCsvFile2($oldtodofile, $todo);
			header( "Location: /Memoria/pages/todo.php" );
			exit();
		} else {
			//echo "����";
			echo "<script>alert('�X�V�ς�');location.href = '/Memoria/pages/todo.php';</script>";
		}
?>
