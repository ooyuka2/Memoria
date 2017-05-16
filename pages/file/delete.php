
<?php

	$file = readCsvFile('../data/file.csv');
	
	if(isset($_GET['p'])) {//id,file,author,year,commentary,floor,place,img
		$name = $file[$_GET['p']][0];
		$file[$_GET['p']][6]=1;
		//unset($file[$_GET['p']]);
		//array_values($file);
		writeCsvFile("../data/file.csv", $file);
		$_SESSION['delete'] = "{$name}を削除しました。";
	}
	header( "Location: ./file.php" );
	exit();
?>
		
