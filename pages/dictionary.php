<?php
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\data\config.ini');
	include($ini['dirWin'].'/pages/hedder.php');
?>
<body>
<?php
	include($ini['dirWin'].'/pages/navigation.php');
	//$dictionary = readCsvFile('../data/dictionary.csv');
	if(!isset($_GET['page'])) $_GET['page'] = "top";
?>

<!-- jumbotron special -->
<section class="section section-inverse japanese-font">
	<div class='bkcolor'>
	<div class="container" style="padding:0 0 50px 0">
		<?php
			select_page($link_pages_Win . "dictionary", $_GET['page']);
		?>
	</div>
</section>

<?php
	
	include($ini['dirWin'].'/pages/footer.php');
	select_script_page($link_pages_Win . "dictionary", $_GET['page']);
?>
<script>
	window.onload = function(){
		document.getElementsByClassName('dictionary')[0].classList.add('active');
	}
	//document.body.style.fontSize = '60%';
</script>
</body>
</html>
