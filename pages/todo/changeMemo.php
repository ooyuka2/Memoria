<?php
	//header("Content-type: text/plain; charset=SJIS-win");
	//include('../function.php');

	if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])
	   && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	  // Ajaxリクエストの場合のみ処理する

		if (isset($_GET['do'])) {
			if($_GET['do']=="readtxt") {
				
				$memo = file_get_contents("../../data/memo/".$_GET['file']);
				echo str_replace("\n","<br>",$memo);
				
			}else if($_GET['do']=="readform") {
				
				$memo = file_get_contents("../../data/memo/".$_GET['file']);
				echo $memo;
				//header('Content-type: application/json');
				//echo json_encode("hellow");
				//echo "successあああ";
			} else if ($_GET['do']=="new") {
				
			} else if($_GET['do']=="change") {
				
			} else {
				echo 'errorエラーが発生いたしました';
			}
			
		} else {
			echo 'エラーが発生いたしました';
		}
	}
	/* else if (isset($_GET['path']) && $_GET['do']=="delete") {
		unlink ( $_GET['path'] );
		$memolist = readCsvFile2('../../data/memo.csv');
		$file = explode("/", $_GET['path']);
		$num = check2array($memolist, $file[(count($file)-1)], "filename");
		$templist = array_splice($memolist,$num,1);
		writeCsvFile2('../../data/memo.csv', $memolist);
		header( "Location: /Memoria/pages/todo.php" );
	}
	*/
?>
