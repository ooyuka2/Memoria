<?php
	
	$dir = "../data/memo/";
	if( is_dir( $dir ) && $handle = opendir( $dir ) ) {
		while( ($file = readdir($handle)) !== false ) {
			// ファイルのみ取得
			if( filetype( $path = $dir . $file ) == "file" ) {
			// ファイル名$file ファイルパス$path
			$memo = file_get_contents($path);
			makeDialogs($path, $file, $memo);
			}
		}
	}
	echo '<a href="C:\xampp\htdocs\Memoria\data\memo" class="btn btn-primary btn-block active">編集する</a>';
?>

