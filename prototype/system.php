<?php
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\data\config.ini');
		session_start();
		header("Content-type: text/html; charset=SJIS-win");
	if(!isset($_SESSION['staff']['id'])) {
		header( "Location: ".$ini['dirhtml']."/prototype/login.php" );
		exit();
	}
	include($ini['dirWin'].'/prototype/hedder.php');
?>
<body class="drawer drawer--left">
<?php
	include($ini['dirWin'].'/prototype/navigation.php');
?>



<!--Main Layout-->
<div class="main-contents">
<div class="pull-left drawer-hover"></div>
<main class="row">
	<?php
		$pass = $link_pages_Win . "system/".$_GET['page'].".php";
		include($pass);
	?>
</main>
</div>
<!--Main Layout-->
<?php
	include($ini['dirWin'].'/prototype/footer.php');
?>

<script>
	$(document).ready(function() {
		document.getElementsByClassName('systemnav')[0].classList.add('activenav');
		navOnload();
	});
</script>

</body>
</html>
