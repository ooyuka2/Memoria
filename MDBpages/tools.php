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
		$pass = $link_pages_Win . "tools/".$_GET['page'].".php";
		include($pass);
	?>
</main>
</div>
<!--Main Layout-->
<?php
	
	include($ini['dirWin'].'/MDBpages/footer.php');
	echo '<script type="text/javascript" src="' . $ini['dirhtml'].'/data/tools.js"></script>';
	
?>

<script>
	$(document).ready(function() {
		document.getElementsByClassName('toolsnav')[0].classList.add('activenav');
		navOnload();
	});
	document.title="tools:Memoria";
</script>

</body>
</html>
