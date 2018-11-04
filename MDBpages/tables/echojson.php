<?php
	if(!isset($ini)) $ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	include_once($ini['dirWin'].'/pages/function.php');
	
	$tablecsv = $ini['dirWin'].'/data/tables/' . $_GET['table'] . '.csv';

	$table = readCsvFile2($tablecsv);

	//print_r_pre($table);
	for($i = 0; $i<count($table); $i++) {
		mb_convert_variables('UTF-8','SJIS-win',$table[$i]);
	}
		for($i = 0; $i<count($table); $i++) {
			$json[$i] = $table[$i];
		}
		$value = "{\r\n	\"data\": [\r\n";
		//echo $value;
		for($i = 1; $i<count($json); $i++) {
			$value .= "		[\r\n";
			foreach ($json[$i] as $key => $val) {
				$value .= "			\"" . str_replace("\\","\\\\", str_replace("	","@@", $json[$i][$key] ) ) . "\",\r\n";
				//	htmlspecialchars($json[$i][$key], ENT_QUOTES)stripslashes( 
			}
			$value = substr_replace($value, '', -3, -2);
			$value .= "		],\r\n";
		}
		$value = substr_replace($value, '', -3, -2);
		$value .= "	]\r\n}";
	echo $value;
	//echo json_encode($table, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	
	//file_put_contents($tablejson , json_encode($table, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

?>