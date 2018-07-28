<?php
	header("Content-type: text/html; charset=SJIS-win");
	if(!isset($ini)) $ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\..\data\config.ini');
	include_once($ini['dirWin'].'/pages/function.php');
	
	if(isset($_POST['program']) && isset($_POST['CSV'])) {
		$program = mb_convert_encoding($_POST['program'], "SJIS-win", "UTF-8");
		$CSV = mb_convert_encoding($_POST['CSV'], "SJIS-win", "UTF-8");

		
		//file_put_contents($ini['dirWin'].'/data/tools/temp.php', str_replace("\n","\r\n", $program));
		file_put_contents($ini['dirWin'].'/data/tools/temp.php', $program);
		
		$temp = explode ( "\r\n" , $CSV );
		if($temp[0] != "") {
			for($i=0; $i<count($temp); $i++) if($temp[$i] != "") $arrayCSV[$i] = explode ( "," , $temp[$i] );
		
		} else $arrayCSV[0][0] = "";
		writeCsvFile($ini['dirWin'].'/data/tools/tool_data/tempcsv.csv', $arrayCSV);
		echo "<br><div class='alert alert-dismissible alert-success'><button type='button' class='close' data-dismiss='alert'>&times;</button><p>•Û‘¶‚É¬Œ÷‚µ‚Ü‚µ‚½</p></div>";
		
	} else {
		echo "<div class='alert alert-dismissible alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button><p>•Û‘¶‚É¸”s‚µ‚Ü‚µ‚½</p></div>";
	}
	
?>