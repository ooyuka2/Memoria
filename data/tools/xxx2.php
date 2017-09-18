<?php
		session_start();
		include_once('pages/function.php');
		$file = readCsvFile('data/file_0.csv');
		for($i=0;$i<count($dictionary);$i++) {
			if($file[$i][3]=="") {
				echo "<pre>";
				print($file[$i]);
				echo "</pre><hr>";
			}
			$file[$i][2] = str_replace("a href='", "", $file[$i][2]);
		}
		writeCsvFile("data/file.csv", $file);
		//header( "Location: ./" );
		//exit();
		echo "<pre>";
		print_r($file);
		//echo "<hr>".$dictionary[4]['name'];
		
		echo "</pre><br><br>finish!";
?>
