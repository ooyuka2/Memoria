<?php
	header("Content-type: text/html; charset=SJIS-win");
	if(isset($_GET['pagetype'])) $pagetype = $_GET['pagetype'];
	if(!isset($ini)) $ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	include_once($ini['dirWin'].'/pages/function.php');
	
	$dir = $ini['dirWin']."/prototype/maketestdata/testdata/";
	$dirhtml = $ini['dirhtml']."/prototype/maketestdata/testdata/";
	
	
	$toolscsv = $ini['dirWin'].'/prototype/maketestdata/tools.csv';
	$toolslist = readCsvFile2($toolscsv);
	if( is_dir( $dir ) && $handle = opendir( $dir ) ) {
		while( ($file = readdir($handle)) !== false ) {
			if( filetype( $path = $dir . $file ) == "file" ) {
				// ファイル名$file ファイルパス$path
				$num = check2array($toolslist, $file, "ファイル名");
				if($num == -1) {
					$num = count($toolslist);
					//ファイル名,説明,種類,拡張子
					$toolslist[$num]['ファイル名'] = $file;
					$toolslist[$num]['説明'] = '';
					$toolslist[$num]['種類'] = '';
					$toolslist[$num]['拡張子'] = substr($file, strrpos($file, '.') + 1);
					writeCsvFile2($toolscsv, $toolslist);
				}
			}
		}
	}
	
	$i = 1;
	while($i<count($toolslist)) {
		if(!file_exists ($dir.$toolslist[$i]['ファイル名'])) {
			unset($toolslist[$i]);
			$toolslist = array_values($toolslist);
			writeCsvFile2($toolscsv, $toolslist);
		} else {
			$i++;
		}
	}
	$i = 1;
	$txt = "";
	while($i<count($toolslist)) {
		if($toolslist[($i-1)]['種類'] != $toolslist[($i)]['種類'] && $i != 1) {
			echo_panel($toolslist[($i-1)]['種類'], $txt, "info");
			$txt = "";
		}
		$txt .= "{$toolslist[$i]['説明']}	　……　	";
		if($toolslist[$i]['拡張子'] == "php")  $txt .= "<a onClick='read_tool_php2(\"". $dirhtml.$toolslist[$i]['ファイル名']. "\", \"resulttab\")'>".$toolslist[$i]['ファイル名']."</a>" ;
		else $txt .= "<a href='". $dirhtml.$toolslist[$i]['ファイル名']. "'>".$toolslist[$i]['ファイル名']."</a>" ;
		$txt .= "<br>";
		$i++;

	}
	if($i != 1) echo_panel($toolslist[($i-1)]['種類'], $txt, "info");
	else echo "『/prototype/maketestdata/testdata』フォルダにはファイルがありません。<br>";

?>