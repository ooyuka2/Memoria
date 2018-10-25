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
	<div class="form-group" style="margin-bottom:0; position: fixed; top: 80px;right:0;width:250px;">
		<button type="submit" class="btn btn-default btn-block waves-effect waves-light" style="margin-right:30px" data-toggle="modal" data-target="#centralModalInfo">このページの説明</button>
	</div>
<!-- Central Modal Medium Info -->
<div class="modal fade" id="centralModalInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-notify modal-info" role="document">
	<!--Content-->
	<div class="modal-content">
		<!--Header-->
		<div class="modal-header">
			<p class="heading lead">トップページのサンプルです。</p>

			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true" class="white-text">&times;</span>
			</button>
		</div>

		<!--Body-->
		<div class="modal-body">
			<div class="text-center">
				<i class="fa fa-check fa-4x mb-3 animated rotateIn"></i>
				<p></p>
				<p>トップページでは最近の作業や導入予定のPCについての説明などが読めると便利かなと思います</p>
			</div>
		</div>

		<!--Footer-->
		<div class="modal-footer justify-content-center">
		</div>
	</div>
	<!--/.Content-->
</div>
</div>
<!-- Central Modal Medium Info-->
</body>
</html>
