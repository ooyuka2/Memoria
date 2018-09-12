<!DOCTYPE html>
<html lang="ja">
<head>
	<?php
		session_start();
		header("Content-type: text/html; charset=SJIS-win");
		date_default_timezone_set('Asia/Tokyo');
		$now = new DateTime();
		$updatefiletime = "?" . $now->format('Y-m-d-h-i-s');
		$pagetype = "pages";
		include_once($ini['dirWin'].'/pages/function.php');
	?>
	<!-- <meta http-equiv="Content-Type" content="text/html; charset=shift_jis">-->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="<?php echo $ini['dirhtml']."/favicon.ico";?>">

	<title>Memoria</title>
	<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/cupertino/jquery-ui.css" >
	<link rel="stylesheet" type="text/css" href="http://felicegattuso.com/projects/timedropper/js/timedropper/timedropper.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $ini['dirhtml']."/DataTables/datatables.min.css";?>"/>
	<?php
		echo '<link id="sampleLink" rel="stylesheet" type="text/css" href="'.$ini['dirhtml'].'/img/bootstrap3/'.$ini['csstype'].'/css/bootstrap.css'.$updatefiletime.'">';
		echo '<link id="sampleLink2" rel="stylesheet" type="text/css" href="'.$ini['dirhtml'].'/img/bootstrap3/'.$ini['csstype'].'/css/example.css'.$updatefiletime.'">';
	?>
	<?php echo '<link rel="stylesheet" type="text/css" href="'.$ini['dirhtml'].'/style.css'.$updatefiletime.';"/>';
	//echo '<link rel="stylesheet" href="'.$ini['dirhtml'].'/md/github-markdown.css">';
	 ?>
	
</head>
