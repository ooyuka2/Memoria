
<?php

	
	if(isset($_GET['p']) && !isset($_GET['startTime']) && !isset($_GET['finishTime'])) {
		$working = readCsvFile2('../data/working.csv');
		echo "<form class='form-horizontal' method='get' action='todo/finish.php' style='padding-top: 50px;'>";
		echo "<input type='hidden' name='p' value='{$_GET['p']}'>";
		echo "<input type='hidden' name='page' value='finish'>";
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
		echo "<div class='form-group'><div class='keeper-btn'><input type='radio' name='keeper' id='on' value='0' checked=''><label for='on' class='switch-on'>はい</label><input type='radio' name='keeper' id='off' value='1'><label for='off' class='switch-off'>いいえ</label></div></div>";
		echo "<div class='form-group'><button type='submit' class='btn btn-default'>送信</button></div>";
		
		echo "</form>";
	} else if(isset($_GET['p']) && isset($_GET['startTime']) && isset($_GET['finishTime'])) {
		include('../function.php');
		$todo = readCsvFile2('../../data/todo.csv');
		$working = readCsvFile2('../../data/working.csv');
		//id,dictionary,author,year,commentary,floor,place,img
		$todo[$_GET['p']]['完了'] = 1;
		$fdo = 100-$todo[$_GET['p']]['パーセンテージ'];
		$todo[$_GET['p']]['パーセンテージ'] = 100;
		$www = count($working);
		$working[$www]['id'] = $todo[$_GET['p']]['id'];
		if(isset($_GET['date'])) $working[$www]['day'] = date($_GET['date']);
		else $working[$www]['day'] = date('Y/m/d H:i:s');
		$working[$www]['per'] = 100;
		$working[$www]['startTime'] = $_GET['startTime'];
		$working[$www]['finishTime'] = $_GET['finishTime'];
		$working[$www]['keeper'] = $_GET['keeper'];
		$working[$www]['note'] = "";//$_GET['note'];
		
		writeCsvFile2("../../data/working.csv", $working);
		$todo = check_child_finish($todo, $todo[$_GET['p']]['id']);
		if($todo[$_GET['p']]['level']!=1) {
			$todo = check_parent_finish($todo, $_GET['p'], $fdo);
			/*
			$parent = $todo[$_GET['p']]['parent'];
			$todo[$parent]['パーセンテージ'] += $fdo/$todo[$parent]['child'];
			//echo $todo[$parent]['id'];
			if($todo[$parent]['パーセンテージ']>90) {
				$chk = 0;
				for($i=1; $i<count($todo); $i++) {
					if($todo[$i]['parent']==$parent && $todo[$i]['完了'] == 0 && $todo[$i]['削除'] == 0) {
						$chk++;
					}
				}
				if($chk==0) {
					$todo[$parent]['パーセンテージ']=100;
					$todo[$parent]['完了'] = 1;
				}
			}
			if($todo[$parent]['level']!=1) $todo = check_parent_finish($todo, $parent, $fdo);
			*/
		}
		writeCsvFile2("../../data/todo.csv", $todo);
		header( "Location: /Memoria/pages/todo.php?d=detail&p=".$todo[$_GET['p']]['top'] );
		exit();
	} else {
		header( "Location: /Memoria/pages/todo.php" );
		exit();
	}
	

?>
		
