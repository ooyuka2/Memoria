<?php
		//session_start();
		header("Content-type: text/html; charset=SJIS-win");
		include_once('../function.php');
		
		$todofile = '../../data/todo.csv';
		
		$todo = readCsvFile2($todofile);
		if(!isset($todo[0]['順番'])) {
			$copyfile = "../../data/bk/todo_".date('YmdHis').".csv";
			copy( $todofile , $copyfile );
			$todo[0]['順番'] = "順番";
			
			for($i=1; $i<count($todo); $i++) {
				if($todo[$i]['level']==1 && $todo[$i]['削除']==0) {
					//$todo[$i]['パーセンテージ'] = 0;
					//$todo[$i]['完了'] = 0;
					$todo[$i]['順番'] = 0;
					$todo = PlusOrder($todo, $todo[$i]['id'], 1);
				} else if($todo[$i]['削除']!=0) {
					$todo[$i]['順番'] = 0;
				}
			}
			
			
			echo "<pre>";
			for($i=1; $i<count($todo); $i++) {
				echo "id={$todo[$i]['id']}	:	".$todo[$i]['順番']."<br>";
			}
			echo "</pre>";
			
			writeCsvFile2($todofile, $todo);
			/*header( "Location: /Memoria/pages/todo.php" );
			exit();
			*/
			
			
			
		} else {
			//echo "ある";
			echo "<script>alert('更新済み');location.href = '/Memoria/pages/todo.php';</script>";
		}

	function PlusOrder($todo, $top, $count) {
		for($j=1; $j<count($todo);$j++) {
			if($todo[$j]['top']==$top && $todo[$j]['level']!=1 && $todo[$j]['削除']==0) {
				$todo[$j]['順番'] = $count;
				$count++;
				//echo "<script>alert('ある');</script>";
			}
			//echo "<script>alert('ある');</script>";
		}
		return $todo;
	}
		
		
		
		//echo "</pre><br><br>finish!";
?>
