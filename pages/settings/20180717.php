<?php
	header("Content-type: text/html; charset=SJIS-win");
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	include_once($ini['dirWin'].'/pages/function.php');
	if($ini['datavarsion'] == "20180716") {
		$ini['datavarsion'] = "20180717";
		$ini['incidentTheme'] = "インシデント対策関連";
		$ini['servicesTheme'] = "サービス改善関連";
		
		unset($ini['servicesKPI']);
		var_dump($ini);
		
		write_ini_file($ini['dirWin'].'/data/config.ini', $ini);
		
		
		header( "Location: ".$ini['dirhtml']."/pages/settings.php" );
		exit();
	} else if($ini['datavarsion'] == "20180717") {
		echo "<script>alert('更新済み'); location.href = '{$ini['dirhtml']}/pages/settings.php';</script>";
	} else {
		echo "<script>alert('別のバージョンを先に適応させてください');location.href = '{$ini['dirhtml']}/pages/settings.php';</script>";
	}
?>