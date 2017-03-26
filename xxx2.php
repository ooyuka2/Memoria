<?php
		session_start();
		include_once('pages/function.php');
	$dictionary = readCsvFile('data/dictionary.csv');
	for($i=0;$i<count($dictionary);$i++) {
		
		$dictionary[$i][5] =  date('Y/m/d H:i:s');
	}
		writeCsvFile("data/dictionary.csv", $dictionary);
		header( "Location: ./" );
		exit();
?>