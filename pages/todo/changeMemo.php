<?php
	header("Content-type: text/plain; charset=SJIS-win");
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	include($ini['dirWin'].'/pages/function.php');
	

	if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])
		&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
		// Ajaxリクエストの場合のみ処理する

		if (isset($_POST['doMemo'])) {
			
			if($_POST['doMemo']=="readtxt") {
				
				$markdown = mb_convert_encoding(file_get_contents("../../data/memo/".$_POST['file']), "UTF-8", "ASCII,JIS,UTF-8,EUC-JP,SJIS, SJIS-win, Unicode");
				echo read_md($markdown);
				
			}else if($_POST['doMemo']=="readform") {
				
				$memo = file_get_contents("../../data/memo/".$_POST['file']);
				$memo = mb_convert_encoding($memo, "SJIS-win", "ASCII,JIS,UTF-8,EUC-JP,SJIS, SJIS-win, Unicode");
				echo $memo;
				
			} else if ($_POST['doMemo']=="new") {
				
			} else if($_POST['doMemo']=="change") {
				$memo = mb_convert_encoding($_POST['txt'], "SJIS-win", "ASCII,JIS,UTF-8,EUC-JP,SJIS, SJIS-win, Unicode");
				file_put_contents("../../data/memo/".$_POST['file'], str_replace("\n","  \r\n", str_replace("  \n", "\n", $memo)));
				
				$memolist = readCsvFile2('../../data/memo.csv');
				$num = check2array($memolist, $_POST['file'], "filename");
				$memolist[$num]['big'] = $_POST['min'];
				$memolist[$num]['lock'] = $_POST['lockmemo'];
				writeCsvFile2('../../data/memo.csv', $memolist);
				
				$markdown = mb_convert_encoding(file_get_contents("../../data/memo/".$_POST['file']), "UTF-8", "ASCII,JIS,UTF-8,EUC-JP,SJIS, SJIS-win, Unicode");

				echo read_md($markdown);
			} else {
				echo 'errorエラーが発生いたしました';
			}
			
		} else if (isset($_POST['doTodo'])) {
			$todo = readCsvFile2($link_data . 'todo.csv');
			$_POST['what'] = mb_convert_encoding($_POST['what'], "SJIS-win", "ASCII,JIS,UTF-8,EUC-JP,SJIS, SJIS-win, Unicode");
			//$_POST['what']	$_POST['id']
			if($_POST['doTodo']=="readtxt") {
				
				if( $todo[$_POST['id']][$_POST['what']] == "no comment") echo "";
				else echo read_md(str_replace("<br>", "  \r\n", $todo[$_POST['id']][$_POST['what']]));
				
			}else if($_POST['doTodo']=="readform") {
				
				if( $todo[$_POST['id']][$_POST['what']] == "no comment") echo "";
				else echo str_replace('<br>', '&#10;', $todo[$_POST['id']][$_POST['what']]);
				
			} else if ($_POST['doTodo']=="new") {
				
			} else if($_POST['doTodo']=="change") {
				
				$_POST['txt'] = mb_convert_encoding($_POST['txt'], "SJIS-win", "ASCII,JIS,UTF-8,EUC-JP,SJIS, SJIS-win, Unicode");
				if( $_POST['txt'] != "" && $todo[$_POST['id']][$_POST['what']] != "no comment") $todo[$_POST['id']][$_POST['what']] = str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['txt']);
				writeCsvFile2($link_data . 'todo.csv', $todo);
				
				if( $todo[$_POST['id']][$_POST['what']] == "no comment") echo "";
				else echo read_md(str_replace("<br>", "  \r\n", $todo[$_POST['id']][$_POST['what']]));
				
			} else {
				echo 'errorエラーが発生いたしました';
			}
			
		} else {
			echo 'エラーが発生いたしました';
		}
	}
	else if (isset($_GET['path']) && $_GET['doMemo']=="delete") {
		unlink ( "../../data/memo/".$_GET['path'] );
		$memolist = readCsvFile2('../../data/memo.csv');
		//$file = explode("/", $_GET['path']);
		$num = check2array($memolist, $_GET['path'], "filename");
		$templist = array_splice($memolist,$num,1);
		writeCsvFile2('../../data/memo.csv', $memolist);
		header( "Location: " . $_SERVER['HTTP_REFERER'] );
		exit();
	}
	
?>
