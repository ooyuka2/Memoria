<?php
	header("Content-type: text/html; charset=SJIS-win");
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	include_once($ini['dirWin'].'/pages/function.php');
	if($ini['datavarsion'] == "20180716") {
		$ini['datavarsion'] = "20180717";
		$ini['incidentTheme'] = "�C���V�f���g�΍�֘A";
		$ini['servicesTheme'] = "�T�[�r�X���P�֘A";
		
		unset($ini['servicesKPI']);
		var_dump($ini);
		
		write_ini_file($ini['dirWin'].'/data/config.ini', $ini);
		
		
		header( "Location: ".$ini['dirhtml']."/pages/settings.php" );
		exit();
	} else if($ini['datavarsion'] == "20180717") {
		echo "<script>alert('�X�V�ς�'); location.href = '{$ini['dirhtml']}/pages/settings.php';</script>";
	} else {
		echo "<script>alert('�ʂ̃o�[�W�������ɓK�������Ă�������');location.href = '{$ini['dirhtml']}/pages/settings.php';</script>";
	}
?>