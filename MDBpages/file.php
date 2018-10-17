<?php
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\data\config.ini');
	include($ini['dirWin'].'/MDBpages/hedder.php');
?>
<body class="drawer drawer--left">
<?php
	include($ini['dirWin'].'/MDBpages/navigation.php');
	if(!isset($_GET['page'])) $_GET['page'] = "top";
?>

<!--Main Layout-->
<div class="main-contents">
<div class="pull-left drawer-hover"></div>
<main class="row">
	<?php
		$file = readCsvFile2($ini['dirWin'].'/data/file.csv');
		$group = readCsvFile2($ini['dirWin'].'/data/file_group.csv');
		
		$pass = $link_pages_Win . "file/".$_GET['page'].".php";
		include($pass);
	?>
</main>
</div>
<!--Main Layout-->
<?php
	include($ini['dirWin'].'/MDBpages/footer.php');
?>

<script>
	$(document).ready(function() {
		document.getElementsByClassName('filenav')[0].classList.add('activenav');
		navOnload();
	});
</script>

</body>
</html>