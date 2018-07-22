<?php
	header("Content-type: text/html; charset=SJIS-win");
	if(!isset($ini)) $ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	include_once($ini['dirWin'].'/pages/function.php');
	
	$programcsv = $ini['dirWin'].'/data/tools/tools_data/tempcsv.csv';
	
	$array = readCsvFile($programcsv);
	
	for($i=1; $i<count($array); $i++) {
		$array[$i][0] = $array[$i][0] . "sss" . $array[$i][0] . "aa";
	}
	
	print_r_pre($array);
	
	writeCsvFile($programcsv, $array);
	echo "КоЧ╣";
?>