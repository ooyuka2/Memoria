<?php
	include('../function.php');
	$working = readCsvFile2('../../data/working.csv');
	$periodically = readCsvFile2('../../data/periodically.csv');
	if(isset($_POST['p']) && isset($_POST['startTime'])) {
		$www = count($working);
		if(ctype_digit($_POST['p'])) {
			$working[$www]['id'] = $_POST['p'];
		} else {
			$working[$www]['id'] = "periodically";
		}
		if(isset($_POST['date'])) $working[$www]['day'] = date($_POST['date']);
		else $working[$www]['day'] = date('Y/m/d H:i:s');
		$working[$www]['per'] = $_POST['f'];
		$working[$www]['startTime'] = $_POST['startTime'];
		$working[$www]['finishTime'] = $_POST['finishTime'];
		if(ctype_digit($_POST['p'])) {
			$working[$www]['keeper'] = $_POST['keeper'];
		} else {
			for($i=1; $i<count($periodically); $i++) {
				if($periodically[$i]['title']==$_POST['p']) $working[$www]['keeper'] = $periodically[$i]['id'];
			}
		}
		//if($_POST['p'] == "deskwork") {
		if(!ctype_digit($_POST['p'])) {
			if(isset($_POST['note'])) $working[$www]['note'] = str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['note']);
			else $working[$www]['note'] = "";//$_POST['note'];
		}else {
			$todo = readCsvFile2('../../data/todo.csv');
			$fdo = $_POST['f']-$todo[$_POST['p']]['パーセンテージ'];
			$todo[$_POST['p']]['パーセンテージ'] = $_POST['f'];
			if(isset($_POST['note'])) {
				$todo[$_POST['p']]['所感'] = str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['note']);
				$working[$www]['note'] = "";
			} else $working[$www]['note'] = "";
			if($_POST['f']<100) {
				$todo = check_child_do($todo, $_POST['p'], $fdo);
				$todo = check_parent_do($todo, $_POST['p'], $fdo);
			} else {
				$todo[$_POST['p']]['完了'] = 1;
				$todo = check_child_finish($todo, $todo[$_POST['p']]['id']);
				$todo = check_parent_finish($todo, $_POST['p'], $fdo);
			}
			
			writeCsvFile2("../../data/todo.csv", $todo);
		}
		
		mb_convert_variables('SJIS-win',"SJIS-win, UTF-8, Unicode",$working);
		writeWorking($working);
	} else {
		header( "Location: /Memoria/pages/todo.php" );
	}
	
	if(isset($_POST['goto']) && $_POST['goto']=="today") {
		header( "Location: /Memoria/pages/todo.php" );
	} else if(isset($_POST['goto']) && $_POST['goto']=="todo") {
		header( "Location: /Memoria/pages/todo.php?p=".$todo[$_POST['p']]['top'] );
	}else if(isset($_POST['goto']) && $_POST['goto']=="detail") {
		header( "Location: /Memoria/pages/todo.php?d=detail&p=".$todo[$_POST['p']]['top'] );
	} else {
		header( "Location: /Memoria/pages/todo.php?d=keeper" );
	}
	exit();

?>
		
