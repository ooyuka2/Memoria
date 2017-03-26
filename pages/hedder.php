<!DOCTYPE html>
<html lang="ja">
<head>
	<?php
		session_start();
		include_once('setting.php');
		include_once('function.php');
	?>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="../favicon.ico">

  <title>Memoria</title>
	<link rel="stylesheet" type="text/css" href="../DataTables/datatables.min.css"/>
	<?php
	echo '<link id="sampleLink" rel="stylesheet" type="text/css" href="../'.$color.'/css/bootstrap.css">';
	echo '<link id="sampleLink2" rel="stylesheet" type="text/css" href="../'.$color.'/css/example.css">';
	?>


  <style type="text/css">
  @font-face {
	font-family: 'MyFont';
	src: url(../niko/font/Apples Script-TTF.ttf);
}
  @media ( min-width: 768px ) {
    #banner {
      min-height: 300px;
      border-bottom: none;
    }
    .bs-docs-section {
      margin-top: 8em;
    }
    .bs-component {
      position: relative;
    }
    .bs-component .modal {
      position: relative;
      top: auto;
      right: auto;
      left: auto;
      bottom: auto;
      z-index: 1;
      display: block;
    }
    .bs-component .modal-dialog {
      width: 90%;
    }
    .bs-component .popover {
      position: relative;
      display: inline-block;
      width: 220px;
      margin: 20px;
    }
    .nav-tabs {
      margin-bottom: 15px;
    }
    .progress {
      margin-bottom: 10px;
    }
  }
  </style>
</head>