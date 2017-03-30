
<?php

	$todo = readCsvFile2('../data/todo.csv');
	
	if(isset($_GET['p'])) {//id,dictionary,author,year,commentary,floor,place,img
		$todo[$_GET['p']]['完了'] = 1;
		$todo[$_GET['p']]['パーセンテージ'] = 100;
		//writeCsvFile("../data/todo.csv", $todo);
		//$_SESSION['delete'] = "{$name}を削除しました。";
	}
	header( "Location: ./todo.php" );
	exit();
?>
		
