<?php
	if (isset($_GET['path'])) {
	//�����ɉ�������̏����������iDB�o�^��t�@�C���ւ̏������݂Ȃǁj
		if ($_GET['do']=="new") {
			
		} else if($_GET['do']=="change") {
			
		} else {
			unlink ( $_GET['path'] );
		}
		
	} else {
		echo '�G���[�������������܂���';
	}
	header( "Location: /Memoria/pages/todo.php" );
?>