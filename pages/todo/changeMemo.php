<?php
	header("Content-type: text/plain; charset=SJIS-win");
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	include($ini['dirWin'].'/pages/function.php');
	require_once($ini['dirWin']."/md/md.php");

	if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])
		&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	// Ajaxリクエストの場合のみ処理する

		if (isset($_POST['do'])) {
			
			if($_POST['do']=="readtxt") {
				
				$markdown = mb_convert_encoding(file_get_contents("../../data/memo/".$_POST['file']), "UTF-8", "ASCII,JIS,UTF-8,EUC-JP,SJIS, SJIS-win, Unicode");
				$parser = new \cebe\markdown\GithubMarkdown();
				$memo = $parser->parse($markdown);
				$memo = mb_convert_encoding($memo, "SJIS-win", "UTF-8");
				$memo = str_replace("<table>","<table class='table table-striped table-bordered table-hover table-condensed'>",$memo);
				
				//echo str_replace("\n","<br>",$memo);
				echo $memo;
				
			}else if($_POST['do']=="readform") {
				
				$memo = file_get_contents("../../data/memo/".$_POST['file']);
				$memo = mb_convert_encoding($memo, "SJIS-win", "ASCII,JIS,UTF-8,EUC-JP,SJIS, SJIS-win, Unicode");
				echo $memo;
				
			} else if ($_POST['do']=="new") {
				
			} else if($_POST['do']=="change") {
				$memo = mb_convert_encoding($_POST['txt'], "SJIS-win", "ASCII,JIS,UTF-8,EUC-JP,SJIS, SJIS-win, Unicode");
				file_put_contents("../../data/memo/".$_POST['file'], str_replace("\n","\r\n",$memo ));
				
				$memolist = readCsvFile2('../../data/memo.csv');
				$num = check2array($memolist, $_POST['file'], "filename");
				$memolist[$num]['big'] = $_POST['min'];
				$memolist[$num]['lock'] = $_POST['lockmemo'];
				writeCsvFile2('../../data/memo.csv', $memolist);
				
				$markdown = mb_convert_encoding(file_get_contents("../../data/memo/".$_POST['file']), "UTF-8", "ASCII,JIS,UTF-8,EUC-JP,SJIS, SJIS-win, Unicode");
				$parser = new \cebe\markdown\GithubMarkdown();
				$memo = $parser->parse($markdown);
				$memo = mb_convert_encoding($memo, "SJIS-win", "UTF-8");
				$memo = str_replace("<table>","<table class='table table-striped table-bordered table-hover table-condensed'>",$memo);

				echo $memo;
			} else {
				echo 'errorエラーが発生いたしました';
			}
			
		} else {
			echo 'エラーが発生いたしました';
		}
	}
	else if (isset($_GET['path']) && $_GET['do']=="delete") {
		unlink ( "../../data/memo/".$_GET['path'] );
		$memolist = readCsvFile2('../../data/memo.csv');
		//$file = explode("/", $_GET['path']);
		$num = check2array($memolist, $_GET['path'], "filename");
		$templist = array_splice($memolist,$num,1);
		writeCsvFile2('../../data/memo.csv', $memolist);
		//header( "Location: /Memoria/pages/todo.php" );
		//exit();
	}
	
?>
