<?php
	header("Content-type: text/html; charset=SJIS-win");
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	include_once($ini['dirWin'].'/pages/function.php');
	if($ini['datavarsion'] == "20180717") {
		$ini['datavarsion'] = "20181015";
		$ini['user_Registration'] = "0";
		$ini['user_Delete'] = "0";
		
		write_ini_file($ini['dirWin'].'/data/config.ini', $ini);
		
		
		header( "Location: ".$_SERVER['HTTP_REFERER'] );
		exit();
	} else if($ini['datavarsion'] == "20181015") {
		echo "<script>alert('�X�V�ς�'); location.href = '{$_SERVER['HTTP_REFERER']}';</script>";
	} else {
		echo "<script>alert('�ʂ̃o�[�W�������ɓK�������Ă�������');location.href = '{$_SERVER['HTTP_REFERER']}';</script>";
	}
?>
