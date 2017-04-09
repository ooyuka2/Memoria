<?php
	
	$todo = readCsvFile2('../data/todo.csv');
	
	if(isset($_GET['p'])) {//id,dictionary,author,year,commentary,floor,place,img
		$todo[$_GET['p']]['保留'] = 1;
		writeCsvFile2("../data/todo.csv", $todo);
	}
	header( "Location: ./todo.php" );
	exit();
?>
		
