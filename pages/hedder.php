<!DOCTYPE html>
<html lang="ja">
<head>
	<?php
		session_start();
		include_once('setting.php');
		include_once('function.php');
		header("Content-type: text/html; charset=SJIS-win");
	?>
  <meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="../favicon.ico">

  <title>Memoria</title>
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/cupertino/jquery-ui.css" >
	<link rel="stylesheet" type="text/css" href="http://felicegattuso.com/projects/timedropper/js/timedropper/timedropper.css">
	<link rel="stylesheet" type="text/css" href="../DataTables/datatables.min.css"/>
	<?php
		include('../data/update.php');
		echo '<link id="sampleLink" rel="stylesheet" type="text/css" href="../'.$color.'/css/bootstrap.css?'.$updatefiletime.'">';
		echo '<link id="sampleLink2" rel="stylesheet" type="text/css" href="../'.$color.'/css/example.css?'.$updatefiletime.'">';
	?>
	<link rel="stylesheet" type="text/css" href="../style.css?<?php echo $updatefiletime; ?>"/>
</head>