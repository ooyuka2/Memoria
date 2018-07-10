<?php
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\data\config.ini');
	include_once($ini['dirWin'].'/pages/function.php');
	include($ini['dirWin'].'/pages/hedder.php');
?>
<style type="text/css">
table {
		width: 100%;
}
table th {
		background: #87cefa;
}
table th,
table td {
		border: 1px solid #CCCCCC;
		text-align: center;
		padding: 5px;
}
</style>
<body>
<?php
	include($ini['dirWin'].'/pages/navigation.php');
	//$dictionary = readCsvFile('../data/dictionary.csv');
	if(!isset($_GET['page'])) $_GET['page'] = "top";
?>

<!-- jumbotron special -->
<section class="section section-inverse japanese-font">
	<div class='bkcolor'>
	<div class="container" style="padding:25px 0 50px 0">
<?php
	/*
	echo "<h2>MyTool</h2>";
	readTool($ini['dirWin']."/data/tools/", $ini['dirhtml']."/data/tools/");
	echo "<h2>MemoriaTool</h2>";
	readTool($ini['dirWin']."/pages/tools/", $ini['dirhtml']."/pages/tools/");
	*/
	select_page("tools", $_GET['page']);
	
?>
	</div>
	</div>
</section>

<?php
	
	include($ini['dirWin'].'/pages/footer.php');
	select_script_page("tools", $_GET['page']);
?>
<script>
	window.onload = function(){
			document.getElementsByClassName('tools')[0].classList.add('active');
	}
</script>
</body>
</html>

