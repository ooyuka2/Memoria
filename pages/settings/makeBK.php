<?php
	//session_start();
	header("Content-type: text/html; charset=SJIS-win");
	include_once('../function.php');
	
	$todofile = '../../data/todo.csv';
	$oldtodofile = '../../data/old201804todo.csv';
	$workingfile = "../../data/working.csv";
	$oldworkingfile = "../../data/old201804working.csv";
	
	$oldtodo = readCsvFile2($todofile);
	$oldworking = readCsvFile2($workingfile);
	
	
	if(!isset($oldworking[0]['file'])) {
		$copyfile = "../../data/bk/todo_".date('YmdHis').".csv";
		copy( $todofile , $copyfile );
		
		$copyfile = "../../data/bk/working_".date('YmdHis').".csv";
		copy( $workingfile , $copyfile );
		
		$working[0]['file'] = "file";
		$working[0]['id'] = "id";
		$working[0]['day'] = "day";
		$working[0]['per'] = "per";
		$working[0]['startTime'] = "startTime";
		$working[0]['finishTime'] = "finishTime";
		$working[0]['keeper'] = "keeper";
		$working[0]['note'] = "note";
		
		writeCsvFile2($workingfile, $working);
		
		
		for($i=1; $i<count($oldworking); $i++) {
			$working[$i]['file'] = "old201804";
			$working[$i]['id'] = $oldworking[$i]['id'];
			$working[$i]['day'] = $oldworking[$i]['day'];
			$working[$i]['per'] = $oldworking[$i]['per'];
			$working[$i]['startTime'] = $oldworking[$i]['startTime'];
			$working[$i]['finishTime'] = $oldworking[$i]['finishTime'];
			$working[$i]['keeper'] = $oldworking[$i]['keeper'];
			$working[$i]['note'] = $oldworking[$i]['note'];
		}
		
		$arraynewtodo[0]['id'] = "id";
		$arraynewtodo[0]['時間管理テーマ'] = "時間管理テーマ";
		
		for($i=1; $i<count($oldtodo); $i++) {
			if ($oldtodo[$i]['level'] == 1 && $oldtodo[$i]['完了'] == 0 && $oldtodo[$i]['削除'] != 1) {
				$arraynewtodo[count($arraynewtodo)]['id'] = $oldtodo[$i]['id'];
				$arraynewtodo[count($arraynewtodo)-1]['時間管理テーマ'] = $oldtodo[$i]['時間管理テーマ'];
			}
		}
		
		//for($i=1; $i<count($arraynewtodo)-1; $i++) {
		//	for($j=2; $j<count($arraynewtodo); $j++) {
		//		if($arraynewtodo[$i]['時間管理テーマ'] > $arraynewtodo[$j]['時間管理テーマ']) {
		//			$temp = $arraynewtodo[$i];
		//			$arraynewtodo[$i] = $arraynewtodo[$j];
		//			$arraynewtodo[$j] = $temp;
		//		}
		//	}
		//}
		
		foreach ((array) $arraynewtodo as $key => $value) {
			$temp[$key] = $value['時間管理テーマ'];
		}

		array_multisort($temp, SORT_ASC, $arraynewtodo);
		
		$temp = $arraynewtodo[(count($arraynewtodo)-1)];
		
		for($i=(count($arraynewtodo)-1); $i>0; $i--) {
			$arraynewtodo[$i] = $arraynewtodo[($i-1)];
		}
		$arraynewtodo[0] = $temp;
		
		$todo[0] = $oldtodo[0];
		
		print_r_pre($arraynewtodo);
		
		
		//新しいtodoファイルへの配列
		for($i=1; $i<count($arraynewtodo); $i++) {
			$temp = array();
			$temp[0]['old'] = $arraynewtodo[$i]['id'];
			$temp[0]['new'] = count($todo);
			$todo[$temp[0]['new']] = $oldtodo[$temp[0]['old']];
			$todo[$temp[0]['new']]['id'] = $temp[0]['new'];
			$todo[$temp[0]['new']]['top'] = $temp[0]['new'];
			$next = 1;
			if(todo_next($oldtodo, $temp[0]['old'], $next) != 0) {
				$temp = write_todo_next($todo, $oldtodo, $temp[0]['old'], $next, $temp, $working);
			} else {
				writeCsvFile2($oldtodofile, $oldtodo);
				writeCsvFile2($todofile, $todo);
				writeCsvFile2($oldworkingfile, $working);
			}
			
			if(file_exists($oldtodofile)) {
				$oldtodo = readCsvFile2($oldtodofile);
				$working = readCsvFile2($oldworkingfile);
				$todo = readCsvFile2($todofile);
			}
			
			for($j=1; $j<count($working); $j++) {
				if($working[$j]['id'] == $temp[0]['old']) {
					$working[$j]['file'] = "todo";
					$working[$j]['id'] = $temp[0]['new'];
				}
			}
			
			$oldtodo[$temp[0]['old']]['削除'] = 1;
			
			writeCsvFile2($oldtodofile, $oldtodo);
			writeCsvFile2($todofile, $todo);
			writeCsvFile2($oldworkingfile, $working);
			
		}

		
		writeCsvFile2($oldtodofile, $oldtodo);
		writeCsvFile2($todofile, $todo);
		writeCsvFile2($oldworkingfile, $working);
		
		
		header( "Location: /Memoria/pages/todo.php" );
		exit();
		
		
		
		
	} else {
		//echo "ある";
		echo "<script>alert('更新済み');location.href = '/Memoria/pages/todo.php';</script>";
	}
	
	
function write_todo_next($todo, $oldtodo, $top, $next, $temp, $working) {

	
	$todofile = '../../data/todo.csv';
	$oldtodofile = '../../data/old201804todo.csv';
	$workingfile = "../../data/working.csv";
	$oldworkingfile = "../../data/old201804working.csv";

	$id = todo_next($oldtodo, $top, $next);
	$temp[$next]['old'] = $id;
	$temp[$next]['new'] = count($todo);
	$todo[$temp[$next]['new']] = $oldtodo[$temp[$next]['old']];
	$todo[$temp[$next]['new']]['id'] = $temp[$next]['new'];
	$todo[$temp[$next]['new']]['top'] = $temp[0]['new'];
	echo check2array($temp, $oldtodo[$temp[$next]['old']]['parent'], 'old');
	$todo[$temp[$next]['new']]['parent'] = $temp[check2array($temp, $oldtodo[$temp[$next]['old']]['parent'], 'old')]['new'];

	//echo $temp[$next]['old']."<br>";

	echo $next;
	print_r_pre($temp);

	writeCsvFile2($oldtodofile, $oldtodo);
	writeCsvFile2($todofile, $todo);
	writeCsvFile2($oldworkingfile, $working);

	$nexts = $next +1;
	if(todo_next($oldtodo, $top, $nexts) != 0) {
		$temp = write_todo_next($todo, $oldtodo, $top, $nexts, $temp, $working);
	}
	
	if(file_exists($oldtodofile)) {
		$oldtodo = readCsvFile2($oldtodofile);
		$working = readCsvFile2($oldworkingfile);
		$todo = readCsvFile2($todofile);
	}
	
	for($j=1; $j<count($working); $j++) {
		if($working[$j]['id'] == $temp[$next]['old']) {
			$working[$j]['file'] = "todo";
			$working[$j]['id'] = $temp[$next]['new'];
		}
	}
	
	$oldtodo[$temp[$next]['old']]['削除'] = 1;
	
	
	writeCsvFile2($oldtodofile, $oldtodo);
	writeCsvFile2($todofile, $todo);
	writeCsvFile2($oldworkingfile, $working);
	
	return $temp;
}

?>
