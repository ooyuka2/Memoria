
<?php

	$dictionary = readCsvFile('../data/dictionary.csv');
	
	if(isset($_GET['p'])) {//id,dictionary,author,year,commentary,floor,place,img
		$name = $dictionary[$_GET['p']][0];
		unset($dictionary[$_GET['p']]);
		array_values($dictionary);
		writeCsvFile("../data/dictionary.csv", $dictionary);
		$_SESSION['delete'] = "{$name}を削除しました。";
	}
	header( "Location: ./dictionary.php" );
	exit();
?>
		
