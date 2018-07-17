<?php
	header("Content-type: text/plain; charset=SJIS-win");
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\..\data\config.ini');
	include($ini['dirWin'].'/pages/function.php');
	require_once($ini['dirWin']."/md/md.php");
	$memo = readCsvFile2($ini['dirWin']."/data/memo.csv");
	
	if(isset($_POST['file'])) $file = $_POST['file'];
	else $file = $memo[1]['filename'];
	
	echo "<div class='col-xs-offset-8 col-xs-4'><select class='form-control no_print' onChange='read_md_php(this.value)'>";
	for($i=1;$i<count($memo);$i++) {
		if($file == $memo[$i]['filename']) {
			echo "<option value='{$memo[$i]['filename']}' selected>{$memo[$i]['filename']}</option>";
		} else {
			echo "<option value='{$memo[$i]['filename']}'>{$memo[$i]['filename']}</option>";
		}
	}
	echo "</select></div>";
	
	
	$markdown = mb_convert_encoding(file_get_contents($ini['dirWin']."/data/memo/".$file), "UTF-8", "ASCII,JIS,UTF-8,EUC-JP,SJIS, SJIS-win, Unicode");
	$parser = new \cebe\markdown\GithubMarkdown();
	$mdtxt = $parser->parse($markdown);
	$mdtxt = mb_convert_encoding($mdtxt, "SJIS-win", "UTF-8");
	$mdtxt = str_replace("<table>","<table class='table table-striped table-bordered table-hover table-condensed'>",$mdtxt);
	
	//echo str_replace("\n","<br>",$memo);
	echo $mdtxt;
	
?>

