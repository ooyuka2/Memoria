<?php
	echo "<div class='row'>";
	$memolist = readCsvFile2('../data/memo.csv');
	$dir = "../data/memo/";
	if( is_dir( $dir ) && $handle = opendir( $dir ) ) {
		while( ($file = readdir($handle)) !== false ) {
			// �t�@�C���̂ݎ擾
			if( filetype( $path = $dir . $file ) == "file" ) {
			// �t�@�C����$file �t�@�C���p�X$path
			$num = check2array($memolist, $file, "filename");
			if($num == -1) {
				$num = count($memolist);
				//filename,big,type,lock
				$memolist[$num]['filename'] = $file;
				$memolist[$num]['big'] = 'y';
				$memolist[$num]['type'] = 'txt';
				$memolist[$num]['lock'] = 'n';
				writeCsvFile2('../data/memo.csv', $memolist);
			}
			$memo = file_get_contents($path);
			makeDialogs($path, $memo, $memolist[$num]);
			}
		}
	}
	echo "</div>";
?>
