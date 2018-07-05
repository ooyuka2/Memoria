

<?php
	if(isset($todo)) {
		$dir = "../data/memo/";
		$memocsv = '../data/memo.csv';
	} else {
		$dir = "../../data/memo/";
		$memocsv = '../../data/memo.csv';
		include_once('../function.php');
		header("Content-type: text/html; charset=SJIS-win");
	}
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

