
<?php

	$file = readCsvFile2('../data/file.csv');
	//name,furi,summary,detail,count,syurui,date,delete
	$group = readCsvFile2('../data/file_group.csv');
	//group,abc,detail
	
	if(isset($_GET['p'])) {//id,file,author,year,commentary,floor,place,img
		$name = $file[$_GET['p']]['name'];
		$file[$_GET['p']]['delete']=1;
		//unset($file[$_GET['p']]);
		//array_values($file);
		writeCsvFile("../data/file.csv", $file);
		$_SESSION['delete'] = "{$name}を削除しました。";
	}
	header( "Location: ./file.php" );
	exit();
?>
		
