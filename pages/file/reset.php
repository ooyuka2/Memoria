<?php
	$file = readCsvFile2('../data/file.csv');
	
	writeCsvFile("../data/file.csv", $file);
	header( "Location: ./file.php" );
	exit();
?>