<?php
		session_start();
		include_once('../pages/function.php');
		$dictionary = readCsvFile('../data/dictionary.csv');
		$file[] = $dictionary[0];
		for($i=0;$i<count($dictionary);$i++) {
			if($dictionary[$i][4]==4) {
				$links = explode("<br>", $dictionary[$i][2]);
				for($j=0;$j<count($links);$j++) {
					$file[] = array($dictionary[$i][0], $dictionary[$i][1], $links[$j], $dictionary[$i][3], $dictionary[$i][4], $dictionary[$i][5], $dictionary[$i][6]);
				}
				//unset($dictionary[$i]);
				
			}
		}
		$limit = count($dictionary);
		for($j=0;$j<$limit;$j++) {
			for($i=0;$i<count($dictionary);$i++) {
				if($dictionary[$i][4]==4) {
					unset($dictionary[$i]);
					$dictionary = array_values($dictionary);
				}
			}
		}
		$dictionary = array_values($dictionary);
		writeCsvFile("../data/file_0.csv", $file);
		writeCsvFile("data/dictionary.csv", $dictionary);
		
		$fileN[] = array("name","furi","summary","detail","count","syurui","date","delete");
		
		for($i=1;$i<count($file);$i++) {
			$links = explode(" target='_blank'>", $file[$i][2]);
			$links[1] = str_replace("</a>", "", "$links[1]");
			$fileN[] = array($file[$i][0], $file[$i][1], $links[1], $file[$i][3], 0, 1, $file[$i][5], $file[$i][6]);
		}
		writeCsvFile("../data/file.csv", $fileN);
		
		
		header( "Location: ./file.php" );
		exit();
		//echo "<pre>";
		//print_r($dictionary);
		//echo "<hr>".$dictionary[4]['name'];
		
		
		// target='_blank'>
		

		
		
		
		
		
		
		echo "</pre><br><br>finish!";
?>
