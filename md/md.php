<?php
	require_once(dirname ( __FILE__ )."/inline/CodeTrait.php");
	require_once(dirname ( __FILE__ )."/inline/EmphStrongTrait.php");
	require_once(dirname ( __FILE__ )."/inline/LinkTrait.php");
	require_once(dirname ( __FILE__ )."/inline/StrikeoutTrait.php");
	require_once(dirname ( __FILE__ )."/inline/UrlLinkTrait.php");

	require_once(dirname ( __FILE__ )."/block/CodeTrait.php");
	require_once(dirname ( __FILE__ )."/block/FencedCodeTrait.php");
	require_once(dirname ( __FILE__ )."/block/HeadlineTrait.php");
	require_once(dirname ( __FILE__ )."/block/HtmlTrait.php");
	require_once(dirname ( __FILE__ )."/block/ListTrait.php");
	require_once(dirname ( __FILE__ )."/block/QuoteTrait.php");
	require_once(dirname ( __FILE__ )."/block/RuleTrait.php");
	require_once(dirname ( __FILE__ )."/block/TableTrait.php");

	require_once(dirname ( __FILE__ )."/Parser.php");
	require_once(dirname ( __FILE__ )."/Markdown.php");
	require_once(dirname ( __FILE__ )."/GithubMarkdown.php");
	require_once(dirname ( __FILE__ )."/MarkdownExtra.php");

	function read_md($markdown) {
		if(!isset($ini)) $ini = parse_ini_file(dirname ( __FILE__ ).'\..\data\config.ini');
		
		
		$markdown =  str_replace(">>","> >",$markdown);
		$markdown =  str_replace(">>","> >",$markdown);
		
		$markdown = mb_convert_encoding($markdown, "UTF-8", "ASCII,JIS,UTF-8,EUC-JP,SJIS, SJIS-win, Unicode");
		$parser = new \cebe\markdown\GithubMarkdown();
		
		$memo = $parser->parse($markdown);
		$memo = mb_convert_encoding($memo, "SJIS-win", "UTF-8");
		
		$hyouzi = str_replace("<table>","<table class='table table-striped table-bordered table-hover table-condensed'>",$memo);
		$hyouzi = str_replace("<a href=\"http","<a target='_blank' href=\"http",$hyouzi);
		$hyouzi = str_replace("<blockquote>","<blockquote class='blockquote'>",$hyouzi);
		
		return $hyouzi;
	}

?>