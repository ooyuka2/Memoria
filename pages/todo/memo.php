<?php
	
	$dir = "../data/memo/";
	if( is_dir( $dir ) && $handle = opendir( $dir ) ) {
		while( ($file = readdir($handle)) !== false ) {
			// �t�@�C���̂ݎ擾
			if( filetype( $path = $dir . $file ) == "file" ) {
			// �t�@�C����$file �t�@�C���p�X$path
			$memo = file_get_contents($path);
			makeDialogs($path, $file, $memo);
			}
		}
	}
	echo '<a href="C:\xampp\htdocs\Memoria\data\memo" class="btn btn-primary btn-block active">�ҏW����</a>';
?>

