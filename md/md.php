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


?>