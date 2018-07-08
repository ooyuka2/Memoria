<?php
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\data\config.ini');
	include_once($ini['dirWin'].'/pages/function.php');
	include($ini['dirWin'].'/pages/hedder.php');
?>
<body>
<?php
	include($ini['dirWin'].'/pages/navigation.php');
	if(!isset($_GET['page'])) $_GET['page'] = "top";
?>

<!-- jumbotron special -->
<section class="section section-inverse japanese-font">
	<div class='bkcolor'>
	<div class="container" style="padding:0 0 50px 0">
		<?php
			$file = readCsvFile2($ini['dirWin'].'/../data/file.csv');
			//name,furi,summary,detail,count,syurui,date,delete
			$group = readCsvFile2($ini['dirWin'].'/../data/file_group.csv');
			//group,abc,detail
			select_page("file", $_GET['page']);
		?>
	</div>
</section>

<?php
	
	include($ini['dirWin'].'/pages/footer.php');
	select_script_page("file", $_GET['page']);
?>
<script>
	window.onload = function(){
		document.getElementsByClassName('file')[0].classList.add('active');
	}
	//document.body.style.fontSize = '60%';
</script>
</body>
</html>
