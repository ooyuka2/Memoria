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
				// �t�@�C����$file �t�@�C���p�X$path
				$num = check2array($toolslist, $file, "�t�@�C����");
				if($num == -1) {
					$num = count($toolslist);
					//�t�@�C����,����,���,�g���q
					$toolslist[$num]['�t�@�C����'] = $file;
					$toolslist[$num]['����'] = '';
					$toolslist[$num]['���'] = '';
					$toolslist[$num]['�g���q'] = substr($file, strrpos($file, '.') + 1);
					writeCsvFile2($toolscsv, $toolslist);
				}
			}
		}
	}
	
	$i = 1;
	while($i<count($toolslist)) {
		if(!file_exists ($dir.$toolslist[$i]['�t�@�C����'])) {
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
		if($toolslist[($i-1)]['���'] != $toolslist[($i)]['���'] && $i != 1) {
			echo_panel($toolslist[($i-1)]['���'], $txt, "info");
			$txt = "";
		}
		$txt .= "{$toolslist[$i]['����']}	�@�c�c�@	";
		if($toolslist[$i]['�g���q'] == "php")  $txt .= "<a onClick='read_tool_php2(\"". $dirhtml.$toolslist[$i]['�t�@�C����']. "\", \"resulttab\")'>".$toolslist[$i]['�t�@�C����']."</a>" ;
		else $txt .= "<a href='". $dirhtml.$toolslist[$i]['�t�@�C����']. "'>".$toolslist[$i]['�t�@�C����']."</a>" ;
		$txt .= "<br>";
		$i++;

	}
	if($i != 1) echo_panel($toolslist[($i-1)]['���'], $txt, "info");
	else echo "�w/prototype/maketestdata/testdata�x�t�H���_�ɂ̓t�@�C��������܂���B<br>";

?>