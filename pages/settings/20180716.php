<?php
	header("Content-type: text/html; charset=SJIS-win");
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	include_once($ini['dirWin'].'/pages/function.php');
	if($ini['datavarsion'] == "20180707") {
		$ini['datavarsion'] = "20180716";
		$ini['incidentID'] = "13";
		$ini['incidentKPI'] = "�C���V�f���g�΍�֘A";
		$ini['servicesID'] = "15";
		$ini['servicesKPI'] = "�T�[�r�X���P�֘A";
		
		write_ini_file($ini['dirWin'].'/data/config.ini', $ini);
		
		$txt = '�t�@�C����,����,���,�g���q'."\r\n".'xxx.php,�Ă���,���̑�,php';
		file_put_contents($ini['dirWin'].'/data/tools.csv', $txt);
		
		header( "Location: ".$ini['dirhtml']."/pages/settings.php" );
		exit();
	} else if($ini['datavarsion'] == "20180716") {
		echo "<script>alert('�X�V�ς�'); location.href = '{$ini['dirhtml']}/pages/settings.php';</script>";
	} else {
		echo "<script>alert('�ʂ̃o�[�W�������ɓK�������Ă�������');location.href = '{$ini['dirhtml']}/pages/settings.php';</script>";
	}
?>