<?php
	header("Content-type: text/html; charset=SJIS-win");
	date_default_timezone_set('Asia/Tokyo');
	if(!isset($ini)) $ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\..\data\config.ini');
	include_once($ini['dirWin'].'/pages/function.php');
	
	
	$work = readCsvFile2($ini['dirWin'].'/prototype/data/work.csv');
	$tmp = $work[0];
	$work = array();
	$work[0] = $tmp;
	
	
	//writeCsvFile2($ini['dirWin'].'/prototype/data/work.csv', $work);
	
	echo "<h4>finish!</h4>";
	print_r_pre($work);
	
?>