
<?php
	header("Content-type: text/html; charset=SJIS-win");
	if(!isset($ini)) $ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	include_once($ini['dirWin'].'/pages/function.php');
	echo "•\Ž¦";
	$startTime = "2018-07-23 07:50:00";
	$lastTime = "2018-07-23 08:50:00";
	date_default_timezone_set('Asia/Tokyo');
	$day1 = new DateTime($lastTime);
	$day2 = new DateTime($startTime);
	$interval = $day2->diff($day1);
	
	echo "<br><hr><br>";
	echo $interval->format('%R%d“ú %HŽž%i•ª');
	
	echo "<br><hr><br>";
	
	echo time_diff(strtotime('2015-01-02 15:04:05'), strtotime('2015-01-02 16:04:05'));
?>