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
	<div class="container-fluid col-12">
		<h1>プロトタイプ</h1>
		<p>設備の管理全般をまとめてできるとうれしいですよね！！！</p>
		<?php
			//echo '<a href="'.$link_pages_html.'todo/whatTodayDo.php?auto=OK" class="btn btn-warning btn-lg last-release-download-link"><i class="fa fa-github-alt"></i>一日の始まり</a>';
			//echo '<a href="'.$link_pages_html.'todo.php" class="btn btn-default btn-lg last-release-download-link"><i class="fa fa-github-alt"></i>やることリスト</a>';
			//echo '<a href="'.$ini['dirhtml'].'/MDBpages/file.php" class="btn btn-primary btn-lg"><i class="fa fa-play"></i> Watch Link</a>';
		?>
	</div>
	<!--Panel
	<div class="col-sm-6">
		<div class="card">
			<div class="card-body">
				<h3 class="card-title">Special title treatment</h3>
				<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
				<a href="#" class="btn btn-primary">Go somewhere</a>
			</div>
		</div>
	</div>
	<!--/.Panel-->
	<div class="col-12" style="height: 2000px"></div>
</main>
</div>
<!--Main Layout-->
<?php
	include($ini['dirWin'].'/prototype/footer.php');
?>

<script>
	$(document).ready(function() {
		//document.getElementsByClassName('todonav')[0].classList.add('activenav');
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
