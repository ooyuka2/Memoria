<?php
	
	$dir = $ini['dirWin']."/data/tables/";
	$tablescsv = $ini['dirWin'].'/data/tables.csv';
	echo "<div class='col-12'>";
	$tableslist = readCsvFile2($tablescsv);
	
	if( is_dir( $dir ) && $handle = opendir( $dir ) ) {
		while( ($file = readdir($handle)) !== false ) {
			// ファイルのみ取得
			if( filetype( $path = $dir . $file ) == "file" ) {
				// ファイル名$file ファイルパス$path
				$num = check2array($tableslist, $file, "filename");
				if($num == -1) {
					$num = count($tableslist);
					//filename,big,type,lock
					$tableslist[$num]['filename'] = $file;
					$tableslist[$num]['tablename'] = '名称未設定';
					$tableslist[$num]['detail'] = '詳細未設定';
					$tableslist[$num]['memo'] = '';
					writeCsvFile2($tablescsv, $tableslist);
				}
			}
		}
	}
	$i=1;
	while($i<count($tableslist)) {
		if(file_exists ($dir.$tableslist[$i]['filename'])) {
			$title = "<a href='./tables.php?page=tables&table=" . str_replace(".csv","",$tableslist[$num]['filename'] ) . "'>" . $tableslist[$i]['tablename'] . "</a>";
			echo_panel($title, $tableslist[$i]['detail'], "primary");
			$i++;
		} else {
			unset($tableslist[$i]);
			$tableslist = array_values($tableslist);
			writeCsvFile2($tablescsv, $tableslist);
		}
	}

	echo "</div>";
?>