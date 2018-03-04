<?php
	if (isset($_GET['path'])) {
	//ここに何かしらの処理を書く（DB登録やファイルへの書き込みなど）
		if ($_GET['do']=="new") {
			
		} else if($_GET['do']=="change") {
			
		} else {
			unlink ( $_GET['path'] );
		}
		
	} else {
		echo 'エラーが発生いたしました';
	}
	header( "Location: /Memoria/pages/todo.php" );
?>