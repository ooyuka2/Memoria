<!DOCTYPE html>
<html lang="ja">
<head>
	<?php
		
		session_start();
		header("Content-type: text/html; charset=SJIS-win");
		date_default_timezone_set('Asia/Tokyo');
		$now = new DateTime();
		$updatefiletime = "?" . $now->format('Y-m-d-h-i-s');
		$ini = parse_ini_file(dirname ( __FILE__ ).'\..\data\config.ini');
		
		//if($_SERVER['SERVER_ADDR'] != $_SERVER['REMOTE_ADDR']) {
			
		//}
		
		$pagetype = "MDBpages";
		include_once($ini['dirWin'].'/pages/function.php');

	?>
	<!-- Required meta tags always come first -->
	<meta charset="shist-jis">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" href="<?php echo $ini['dirhtml']."/favicon.ico";?>">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Memoria</title>
	
	<link rel="stylesheet" type="text/css" href="/Memoria/js/jquery-ui-1.12.1.custom/jquery-ui.min.css">
	<link rel="stylesheet" type="text/css" href="/Memoria/img/timedropper/timedropper.css">
	<!-- drawer.css -->
	<?php 
		echo '<link rel="stylesheet" href="' . $link_drawer_css . '">';
	?>
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
	<!-- Material Design Bootstrap -->
	<!--<link href="../css/mdb.min.css" rel="stylesheet">-->
	<?php
		echo '<link href="' . $link_mdb_css . $updatefiletime . '" rel="stylesheet">';
	?>
	<!-- Bootstrap core CSS -->
	<?php
		echo '<link href="' . $link_bootstrap_css . $updatefiletime .'" rel="stylesheet">';
	?>

	<!-- ‘S‘Ì“I‚É”½‰f‚³‚¹‚½‚¢css -->
	<?php
		echo '<link href="' . $link_style_css . $updatefiletime .'" rel="stylesheet">';
	?>
	
	<?php
		echo '<link href="' . $link_css . 'fairly.css'. $updatefiletime . '" rel="stylesheet">';
	?>
	

</head>

