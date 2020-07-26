<?php
	header("Content-type: text/html; charset=SJIS-win");
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	include_once($ini['dirWin'].'/pages/function.php');
	if($ini['datavarsion'] == "20181015") {
		$ini['datavarsion'] = "20200727";
		$ini['keeper place'] = "";
		$ini['keeper people'] = "";
		$ini['keeper people commonly'] = "";
		
		write_ini_file($ini['dirWin'].'/data/config.ini', $ini);
		
		
		
		$workingfile = $ini['dirWin'].'/data/working.csv';
		$oldworkingfile = $ini['dirWin'].'/data/old201804working.csv';
		
		$working0 = readCsvFile2($workingfile);
		$oldworking0 = readCsvFile2($oldworkingfile);
		if(file_exists ( $workingfile )) {
			$copyfile = "../../data/bk/working".date('YmdHis').".csv";
			copy( $workingfile , $copyfile );
			$copyfile = "../../data/bk/old201804working_".date('YmdHis').".csv";
			copy( $oldworkingfile , $copyfile );
			
			//file,id,day,per,startTime,finishTime,keeper,note,place,people
			
			$working[0]["file"] = "file";
			$working[0]["id"] = "id";
			$working[0]["day"] = "day";
			$working[0]["per"] = "per";
			$working[0]["startTime"] = "startTime";
			$working[0]["finishTime"] = "finishTime";
			$working[0]["keeper"] = "keeper";
			$working[0]["note"] = "note";
			$working[0]["place"] = "place";
			$working[0]["people"] = "people";

			for($i=1; $i<count($working0); $i++) {
				$working[$i]["file"] = $working0[$i]["file"];
				$working[$i]["id"] = $working0[$i]["id"];
				$working[$i]["day"] = $working0[$i]["day"];
				$working[$i]["per"] = $working0[$i]["per"];
				$working[$i]["startTime"] = $working0[$i]["startTime"];
				$working[$i]["finishTime"] = $working0[$i]["finishTime"];
				$working[$i]["keeper"] = $working0[$i]["keeper"];
				$working[$i]["note"] = $working0[$i]["note"];
				$working[$i]["place"] = "";
				$working[$i]["people"] = "";
			}
			writeCsvFile2($workingfile, $working);
		
		
			$oldworking[0]["file"] = "file";
			$oldworking[0]["id"] = "id";
			$oldworking[0]["day"] = "day";
			$oldworking[0]["per"] = "per";
			$oldworking[0]["startTime"] = "startTime";
			$oldworking[0]["finishTime"] = "finishTime";
			$oldworking[0]["keeper"] = "keeper";
			$oldworking[0]["note"] = "note";
			$oldworking[0]["place"] = "place";
			$oldworking[0]["people"] = "people";

			for($i=1; $i<count($oldworking0); $i++) {
				$oldworking[$i]["file"] = $oldworking0[$i]["file"];
				$oldworking[$i]["id"] = $oldworking0[$i]["id"];
				$oldworking[$i]["day"] = $oldworking0[$i]["day"];
				$oldworking[$i]["per"] = $oldworking0[$i]["per"];
				$oldworking[$i]["startTime"] = $oldworking0[$i]["startTime"];
				$oldworking[$i]["finishTime"] = $oldworking0[$i]["finishTime"];
				$oldworking[$i]["keeper"] = $oldworking0[$i]["keeper"];
				$oldworking[$i]["note"] = $oldworking0[$i]["note"];
				$oldworking[$i]["place"] = "";
				$oldworking[$i]["people"] = "";
			}
			writeCsvFile2($oldworkingfile, $oldworking);
		}
		
		header( "Location: ".$_SERVER['HTTP_REFERER'] );
		exit();
	} else if($ini['datavarsion'] == "20200727") {
		echo "<script>alert('更新済み'); location.href = '{$_SERVER['HTTP_REFERER']}';</script>";
	} else {
		echo "<script>alert('別のバージョンを先に適応させてください');location.href = '{$_SERVER['HTTP_REFERER']}';</script>";
	}
?>
