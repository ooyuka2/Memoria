<?php
	include('../function.php');
	$working = readCsvFile2('../../data/working.csv');
	$periodically = readCsvFile2('../../data/periodically.csv');
	if(isset($_GET['p']) && isset($_GET['startTime'])) {
		$www = count($working);
		if(ctype_digit($_GET['p'])) {
			$working[$www]['id'] = $_GET['p'];
		} else {
			$working[$www]['id'] = "periodically";
		}
		if(isset($_GET['date'])) $working[$www]['day'] = date($_GET['date']);
		else $working[$www]['day'] = date('Y/m/d H:i:s');
		$working[$www]['per'] = $_GET['f'];
		$working[$www]['startTime'] = $_GET['startTime'];
		$working[$www]['finishTime'] = $_GET['finishTime'];
		if(ctype_digit($_GET['p'])) {
			$working[$www]['keeper'] = $_GET['keeper'];
		} else {
			for($i=1; $i<count($periodically); $i++) {
				if($periodically[$i]['title']==$_GET['p']) $working[$www]['keeper'] = $periodically[$i]['id'];
			}
		}
		//if($_GET['p'] == "deskwork") {
		if(!ctype_digit($_GET['p'])) {
			if(isset($_GET['note'])) $working[$www]['note'] = str_replace(array("\r\n", "\r", "\n"), '<br>', $_GET['note']);
			else $working[$www]['note'] = "";//$_GET['note'];
		}else {
			$todo = readCsvFile2('../../data/todo.csv');
			$fdo = $_GET['f']-$todo[$_GET['p']]['パーセンテージ'];
			$todo[$_GET['p']]['パーセンテージ'] = $_GET['f'];
			if(isset($_GET['note'])) {
				$todo[$_GET['p']]['所感'] = str_replace(array("\r\n", "\r", "\n"), '<br>', $_GET['note']);
				$working[$www]['note'] = "";
			} else $working[$www]['note'] = "";
			if($_GET['f']<100) {
				$todo = check_child_do($todo, $_GET['p'], $fdo);
				$todo = check_parent_do($todo, $_GET['p'], $fdo);
			} else {
				$todo[$_GET['p']]['完了'] = 1;
				$todo = check_child_finish($todo, $todo[$_GET['p']]['id']);
				$todo = check_parent_finish($todo, $_GET['p'], $fdo);
			}
			
			writeCsvFile2("../../data/todo.csv", $todo);
		}
		
		mb_convert_variables('SJIS-win',"SJIS-win, UTF-8, Unicode",$working);
		writeWorking($working);
	} else {
		header( "Location: /Memoria/pages/todo.php" );
	}
	
	if(isset($_GET['goto']) && $_GET['goto']=="today") {
		header( "Location: /Memoria/pages/todo.php" );
	} else if(isset($_GET['goto']) && $_GET['goto']=="todo") {
		header( "Location: /Memoria/pages/todo.php?p=".$todo[$_GET['p']]['top'] );
	}else if(isset($_GET['goto']) && $_GET['goto']=="detail") {
		header( "Location: /Memoria/pages/todo.php?d=detail&p=".$todo[$_GET['p']]['top'] );
	} else {
		header( "Location: /Memoria/pages/todo.php?d=keeper" );
	}
	exit();

?>
		
