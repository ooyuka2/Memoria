<?php
	
	$todo = readCsvFile2('../data/todo.csv');
	
	if(isset($_GET['p'])) {//id,dictionary,author,year,commentary,floor,place,img
		if($todo[$_GET['p']]['•Û—¯'] == 1) $todo[$_GET['p']]['•Û—¯'] = 0;
		else $todo[$_GET['p']]['•Û—¯'] = 1;
		writeCsvFile2("../data/todo.csv", $todo);
	}
	header( "Location: ./todo.php" );
	exit();
?>
		
