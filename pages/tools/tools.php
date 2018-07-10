<?php
	if(!isset($ini)) $ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	$dir = $ini['dirWin']."/data/tools/";
	$dirhtml = $ini['dirhtml']."/data/tools/";
	
	if( is_dir( $dir ) && $handle = opendir( $dir ) ) {
		// [ul]�^�O
		echo "<ul>" ;

		// ���[�v����
		while( ($file = readdir($handle)) !== false ) {
			// �t�@�C���̂ݎ擾
			if( filetype( $path = $dir . $file ) == "file" ) {
				// [li]�^�O
				echo "<li>" ;
				$ext = substr($file, strrpos($file, '.') + 1);
				
				if($ext == "php")  echo "<a onClick='read_tool_php(\"". $dirhtml.$file. "\", \"resulttab\")'>".$file."</a>" ;
				else echo "<a href='". $dirhtml.$file. "'>".$file."</a>" ;
				// [li]�^�O
				echo "</li>" ;
			}
		}

		// [ul]�^�O
		echo "</ul>" ;
	}

?>