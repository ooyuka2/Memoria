<?php
	header("Content-type: text/html; charset=SJIS-win");
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	include_once($ini['dirWin'].'/pages/function.php');
	if($ini['datavarsion'] == "20180707") {
		$ini['datavarsion'] = "20180716";
		$ini['incidentID'] = "13";
		$ini['incidentKPI'] = "インシデント対策関連";
		$ini['servicesID'] = "15";
		$ini['servicesKPI'] = "サービス改善関連";
		
		write_ini_file($ini['dirWin'].'/data/config.ini', $ini);
		
		$txt = 'ファイル名,説明,種類,拡張子'."\r\n".'xxx.php,てすと,その他,php';
		file_put_contents($ini['dirWin'].'/data/tools.csv', $txt);
		
		header( "Location: ".$ini['dirhtml']."/pages/settings.php" );
		exit();
	} else if($ini['datavarsion'] == "20180716") {
		echo "<script>alert('更新済み'); location.href = '{$ini['dirhtml']}/pages/settings.php';</script>";
	} else {
		echo "<script>alert('別のバージョンを先に適応させてください');location.href = '{$ini['dirhtml']}/pages/settings.php';</script>";
	}
?>