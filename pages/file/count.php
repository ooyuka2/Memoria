<?php
	$file = readCsvFile2('../data/file.csv');
	
	
	if(isset($_GET['p'])) {
		$file[$_GET['p']]['count'] += 1;
	}
	
	
	writeCsvFile("../data/file.csv", $file);
	header( "Location: " . $_SERVER['HTTP_REFERER'] );
	exit();
?>