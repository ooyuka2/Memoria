<?php
		session_start();
		include_once('pages/function.php');
	$dictionary = readCsvFile2('data/dictionary.csv');
	/*for($i=0;$i<count($dictionary);$i++) {
		if($dictionary[$i][4]==0) $dictionary[$i][4] = 1;
	}*/
		//writeCsvFile("data/dictionary.csv", $dictionary);
		//header( "Location: ./" );
		//exit();
		print_r($dictionary);
		echo "<hr>".$dictionary[4]['name'];
?>
<input type="date" name="datetime">