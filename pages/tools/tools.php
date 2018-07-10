<?php
	if(!isset($ini)) $ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	$dir = $ini['dirWin']."/data/tools/";
	$dirhtml = $ini['dirhtml']."/data/tools/";
	
	if( is_dir( $dir ) && $handle = opendir( $dir ) ) {
		// [ul]タグ
		echo "<ul>" ;

		// ループ処理
		while( ($file = readdir($handle)) !== false ) {
			// ファイルのみ取得
			if( filetype( $path = $dir . $file ) == "file" ) {
				// [li]タグ
				echo "<li>" ;
				$ext = substr($file, strrpos($file, '.') + 1);
				
				if($ext == "php")  echo "<a onClick='read_tool_php(\"". $dirhtml.$file. "\", \"resulttab\")'>".$file."</a>" ;
				else echo "<a href='". $dirhtml.$file. "'>".$file."</a>" ;
				// [li]タグ
				echo "</li>" ;
			}
		}

		// [ul]タグ
		echo "</ul>" ;
	}

?>