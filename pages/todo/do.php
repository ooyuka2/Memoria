<?php

	if(isset($_GET['p']) && !isset($_GET['startTime']) && !isset($_GET['finishTime'])) {
		$working = readCsvFile2('../data/working.csv');
		echo "<form class='form-horizontal' method='get' action='todo/do.php' style='padding-top: 50px;'>";
		echo "<input type='hidden' name='p' value='{$_GET['p']}'>";
		echo "<input type='hidden' name='page' value='do'>";
		echo "<input type='hidden' name='f' value='{$_GET['f']}'>";
		echo "<div class='form-group'>";
		echo "<label class='' for='startTime'>開始時間</label>";
		echo "<div class='input-group'>";
		echo "<span class='input-group-addon'><span class='glyphicon glyphicon-time' aria-hidden='true'></span></span>";
		echo "<input type='text' class='form-control time' name='startTime' value='{$working[(count($working)-1)]['finishTime']}'>";
		echo "</div>";
		echo "</div>";
		echo "<div class='form-group'>";
		echo "<label class='' for='finishTime'>終了時間</label>";
		echo "<div class='input-group'>";
		echo "<span class='input-group-addon'><span class='glyphicon glyphicon-time' aria-hidden='true'></span></span>";
		echo "<input type='text' class='form-control time' name='finishTime'>";
		echo "</div>";
		echo "</div>";
		date_default_timezone_set('Asia/Tokyo');
		$today=date('Y/m/d H:i:s');
		echo "<div class='form-group'><input type='text' class='form-control input-normal input-sm noki' name='date' value='{$today}'></div>";
		if( $_GET['p'] == "deskwork") echo "<div class='form-group'><input type='text' class='form-control input-normal input-sm' name='note' value='事務作業（メール対応etc）'></div>";
		echo "<div class='form-group'><div class='keeper-btn'><input type='radio' name='keeper' id='on' value='0' checked=''><label for='on' class='switch-on'>はい</label><input type='radio' name='keeper' id='off' value='1'><label for='off' class='switch-off'>いいえ</label></div></div>";
		echo "<div class='form-group'><button type='submit' class='btn btn-default'>送信</button></div>";
		echo "</form>";
	} else if(isset($_GET['p']) && $_GET['p'] == "deskwork" && isset($_GET['startTime'])) {
		include('../function.php');
		$working = readCsvFile2('../../data/working.csv');
		//id,dictionary,author,year,commentary,floor,place,img
		$www = count($working);
		$working[$www]['id'] = $_GET['p'];
		if(isset($_GET['date'])) $working[$www]['day'] = date($_GET['date']);
		else $working[$www]['day'] = date('Y/m/d H:i:s');
		$working[$www]['per'] = $_GET['f'];
		$working[$www]['startTime'] = $_GET['startTime'];
		$working[$www]['finishTime'] = $_GET['finishTime'];
		$working[$www]['keeper'] = $_GET['keeper'];
		if(isset($_GET['note'])) $working[$www]['note'] = $_GET['note'];
		else $working[$www]['note'] = "";//$_GET['note'];
		
		mb_convert_variables('SJIS-win',"SJIS-win, UTF-8, Unicode",$working);
		writeCsvFile2("../../data/working.csv", $working);
		header( "Location: /Memoria/pages/todo.php?d=keeper" );
		exit();
	} else if(isset($_GET['p']) && isset($_GET['startTime']) && isset($_GET['finishTime'])) {
		include('../function.php');
		$todo = readCsvFile2('../../data/todo.csv');
		$working = readCsvFile2('../../data/working.csv');
		//id,dictionary,author,year,commentary,floor,place,img
		$fdo = $_GET['f']-$todo[$_GET['p']]['パーセンテージ'];
		$todo[$_GET['p']]['パーセンテージ'] = $_GET['f'];
		$www = count($working);
		$working[$www]['id'] = $todo[$_GET['p']]['id'];
		if(isset($_GET['date'])) $working[$www]['day'] = date($_GET['date']);
		else $working[$www]['day'] = date('Y/m/d H:i:s');
		$working[$www]['per'] = $_GET['f'];
		$working[$www]['startTime'] = $_GET['startTime'];
		$working[$www]['finishTime'] = $_GET['finishTime'];
		$working[$www]['keeper'] = $_GET['keeper'];
		$working[$www]['note'] = "";//$_GET['note'];keeper
		
		writeCsvFile2("../../data/working.csv", $working);
		if($todo[$_GET['p']]['level']!=1) {
			$parent = $todo[$_GET['p']]['parent'];
			$todo[$parent]['パーセンテージ'] += $fdo/$todo[$parent]['child'];
			//echo $todo[$parent]['id'];
			if($todo[$parent]['level']!=1) $todo = check_parent_do($todo, $parent);
		}
		writeCsvFile2("../../data/todo.csv", $todo);
		header( "Location: /Memoria/pages/todo.php?d=detail&p=".$todo[$_GET['p']]['top'] );
		exit();
	} else {
		header( "Location: /Memoria/pages/todo.php" );
		exit();
	}

?>
		
