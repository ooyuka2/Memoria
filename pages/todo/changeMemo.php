<?php
	include('../function.php');
	if (isset($_GET['path'])) {
	//�����ɉ�������̏����������iDB�o�^��t�@�C���ւ̏������݂Ȃǁj
		if ($_GET['do']=="new") {
			
		} else if($_GET['do']=="change") {
			
		} else {
			unlink ( $_GET['path'] );
			$memolist = readCsvFile2('../../data/memo.csv');
			$file = explode("/", $_GET['path']);
			$num = check2array($memolist, $file[(count($file)-1)], "filename");
			$templist = array_splice($memolist,$num,1);
			writeCsvFile2('../../data/memo.csv', $memolist);
		}
	//header( "Location: /Memoria/pages/todo.php" );		
	} else {
		echo '�G���[�������������܂���';
	}

?>