<?php
	header("Content-type: text/plain; charset=SJIS-win");
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\..\data\config.ini');
	include($ini['dirWin'].'/pages/function.php');
	if(isset($_POST['txtA'])) {
		$txtA = $_POST['txtA'];
		$txtB = $_POST['txtB'];
	} else {
		$txtA = "";
		$txtB = "";
	}
	echo $txtA."<br>";
	echo $txtB."<br>";
?>