
<?php
	$todo = readCsvFile2('../data/todo.csv');
	$working = readCsvFile('../data/working.csv');
	function check_child_finish($todo, $parent) {
		/*
		echo "check_child_finish(\$todo, {$parent})<br>";
		echo $todo[($parent-1)]['child']."<br>";
		echo "<pre>";
		print_r($todo[($parent-1)]);
		echo "</pre>";*/
		if($todo[$parent]['child'] != 0) {
			//echo "\$todo[\$parent]['child'] != 0<br>";
			for($i=0; $i<count($todo); $i++) {
				if($todo[$i]['parent']==$parent && $todo[$i]['完了']==0) {
					//echo "ok{$todo[$i]['parent']} == \$parent<br>";
					$todo[$i]['完了'] = 1;
					$todo[$i]['パーセンテージ'] = 100;
					$working = readCsvFile2('../data/working.csv');
					$www = count($working);
					$working[$www]['id'] = $todo[$i]['id'];
					$working[$www]['day'] = date('Y/m/d H:i:s');
					$working[$www]['per'] = 100;
					/*
					echo "<pre>";
					print_r($working);
					echo "</pre>";
					*/
					writeCsvFile2("../data/working.csv", $working);
					$todo = check_child_finish($todo, $todo[$i]['id']);
				}
			}
		}
		return $todo;
	}
	
	function check_parent_finish($todo, $child, $fdo) {
		if($todo[$child]['level'] != 1) {
		$parent = $todo[$child]['parent'];
		$pfdo = $todo[$parent]['パーセンテージ'];
		$todo[$parent]['パーセンテージ'] += $fdo/$todo[$parent]['child'];
		$pfdo = $todo[$parent]['パーセンテージ'] - $pfdo;
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
		if($todo[$parent]['level']!=1) $todo = check_parent_finish($todo, $parent, $pfdo);
		}
		return $todo;
	}
	
	
	if(isset($_GET['p'])) {//id,dictionary,author,year,commentary,floor,place,img
		$todo[$_GET['p']]['完了'] = 1;
		$fdo = 100-$todo[$_GET['p']]['パーセンテージ'];
		$todo[$_GET['p']]['パーセンテージ'] = 100;
		$www = count($working);
		$working[$www]['id'] = $todo[$_GET['p']]['id'];
		$working[$www]['day'] = date('Y/m/d H:i:s');
		$working[$www]['per'] = 100;
		writeCsvFile2("../data/working.csv", $working);
		$todo = check_child_finish($todo, $todo[$_GET['p']]['id']);
		if($todo[$_GET['p']]['level']!=1) {
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
		}
		writeCsvFile2("../data/todo.csv", $todo);
	}
	header( "Location: ./todo.php" );
	exit();
?>
		
