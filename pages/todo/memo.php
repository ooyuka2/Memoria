

<?php
	//$ini = parse_ini_file('C:/xampp/htdocs/Memoria/data/config.ini');
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	if(!isset($todo)) {
		include_once($ini['dirWin'].'/pages/function.php');
		header("Content-type: text/html; charset=SJIS-win");
	}
	$dir = $ini['dirWin']."/data/memo/";
	$memocsv = $ini['dirWin'].'/data/memo.csv';
	echo "<div class='row'>";
	$memolist = readCsvFile2($memocsv);
	
	if( is_dir( $dir ) && $handle = opendir( $dir ) ) {
		while( ($file = readdir($handle)) !== false ) {
			// ファイルのみ取得
			if( filetype( $path = $dir . $file ) == "file" ) {
				// ファイル名$file ファイルパス$path
				$num = check2array($memolist, $file, "filename");
				if($num == -1) {
					$num = count($memolist);
					//filename,big,type,lock
					$memolist[$num]['filename'] = $file;
					$memolist[$num]['big'] = 'y';
					$memolist[$num]['type'] = 'txt';
					$memolist[$num]['lock'] = 'n';
					writeCsvFile2($memocsv, $memolist);
				}
			}
		}
	}
	$i=1;
	while($i<count($memolist)) {
		if(file_exists ($dir.$memolist[$i]['filename'])) {
			$memo = file_get_contents($dir.$memolist[$i]['filename']);
			makeDialogs($path, $memo, $memolist[$i]);
			$i++;
		} else {
			unset($memolist[$i]);
	$memolist = array_values($memolist);
	writeCsvFile2($memocsv, $memolist);
		}
	}

	echo "</div>";
?>

