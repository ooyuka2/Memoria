<?php
		//session_start();
		header("Content-type: text/html; charset=SJIS-win");
		include_once('../function.php');
		
		$todofile = '../../data/todo.csv';
		
		$todo = readCsvFile2($todofile);
		if(!isset($todo[0]['����'])) {
			$copyfile = "../../data/bk/todo_".date('YmdHis').".csv";
			copy( $todofile , $copyfile );
			$todo[0]['����'] = "����";
			
			for($i=1; $i<count($todo); $i++) {
				if($todo[$i]['level']==1 && $todo[$i]['�폜']==0) {
					//$todo[$i]['�p�[�Z���e�[�W'] = 0;
					//$todo[$i]['����'] = 0;
					$todo[$i]['����'] = 0;
					$todo = PlusOrder($todo, $todo[$i]['id'], 1);
				} else if($todo[$i]['�폜']!=0) {
					$todo[$i]['����'] = 0;
				}
			}
			
			
			echo "<pre>";
			for($i=1; $i<count($todo); $i++) {
				echo "id={$todo[$i]['id']}	:	".$todo[$i]['����']."<br>";
			}
			echo "</pre>";
			
			writeCsvFile2($todofile, $todo);
			/*header( "Location: /Memoria/pages/todo.php" );
			exit();
			*/
			
			
			
		} else {
			//echo "����";
			echo "<script>alert('�X�V�ς�');location.href = '/Memoria/pages/todo.php';</script>";
		}

	function PlusOrder($todo, $top, $count) {
		for($j=1; $j<count($todo);$j++) {
			if($todo[$j]['top']==$top && $todo[$j]['level']!=1 && $todo[$j]['�폜']==0) {
				$todo[$j]['����'] = $count;
				$count++;
				//echo "<script>alert('����');</script>";
			}
			//echo "<script>alert('����');</script>";
		}
		return $todo;
	}
		
		
		
		//echo "</pre><br><br>finish!";
?>
