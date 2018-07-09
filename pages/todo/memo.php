<?php

	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	require_once($ini['dirWin']."/md/md.php");

	
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
			$markdown = file_get_contents($dir.$memolist[$i]['filename']);
			$markdown = mb_convert_encoding($markdown, "UTF-8", "ASCII,JIS,UTF-8,EUC-JP,SJIS, SJIS-win, Unicode");
			$parser = new \cebe\markdown\GithubMarkdown();
			//$parser = new \cebe\markdown\MarkdownExtra();
			$memo = $parser->parse($markdown);
			//$memo = $parser->parseParagraph($markdown);
			$memo = mb_convert_encoding($memo, "SJIS-win", "UTF-8");
			
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

