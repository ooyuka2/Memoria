<?php
		session_start();
		include_once('pages/function.php');
	$dictionary = readCsvFile('data/dictionary.csv');
	for($i=0;$i<count($dictionary);$i++) {
		$dictionary[$i][4] = 0;
		$dictionary[$i][5] = $dictionary[$i][3];
		
		$dictionary[$i][3] = $dictionary[$i][2];
		$dictionary[$i][2] = $dictionary[$i][1];
		$dictionary[$i][1] = $dictionary[$i][0];
	}
		writeCsvFile("data/dictionary.csv", $dictionary);
		header( "Location: ./" );
		exit();
?>