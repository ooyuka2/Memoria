<?php
	if(!isset($ini)) $ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\..\data\config.ini');
	require_once($ini['dirWin']."/md/md.php");
	
	$markdown = file_get_contents($ini['dirWin']."/pages/tools/tools/phpfunction_memo.md");
	$markdown = mb_convert_encoding($markdown, "UTF-8", "ASCII,JIS,UTF-8,EUC-JP,SJIS, SJIS-win, Unicode");
	$parser = new \cebe\markdown\GithubMarkdown();
	
	$memo = $parser->parse($markdown);
	$memo = mb_convert_encoding($memo, "SJIS-win", "UTF-8");
	
	echo $memo;
?>