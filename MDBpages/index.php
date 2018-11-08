<?php
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\data\config.ini');
	include($ini['dirWin'].'/MDBpages/hedder.php');
?>
<body class="drawer drawer--left">
<?php
	include($ini['dirWin'].'/MDBpages/navigation.php');
?>



<!--Main Layout-->
<div class="main-contents">
<div class="pull-left drawer-hover"></div>
<main class="row justify-content-center">
	<div class="container-fluid col-12">
		<h1>Memoria for <?php echo $ini['myname']; ?>!</h1>
		<p>自分のタスクやフォルダーのリンク、分からない単語のメモなどを管理しよう</p>
		<div class="download row justify-content-around">
		<?php
			echo '<a href="'.$link_pages_html.'todo/whatTodayDo.php?auto=OK" class="btn btn-warning btn-lg last-release-download-link col-2"><i class="fa fa-github-alt"></i>一日の始まり</a>';
			echo '<a href="'.$link_pages_html.'todo.php" class="btn btn-default btn-lg last-release-download-link col-2"><i class="fa fa-tasks"></i>やることリスト</a>';
			echo '<a href="'.$ini['dirhtml'].'/MDBpages/file.php" class="btn btn-primary btn-lg col-2"><i class="fa fa-link"></i>リンク集</a>';
			echo '<a href="'.$link_tools_html.'" class="btn btn-default btn-lg last-release-download-link col-2"><i class="fa fa-wrench"></i>ツール集</a>';
			echo '<a href="'.$link_tables_html.'" class="btn btn-primary btn-lg col-2"><i class="fa fa-table"></i>いろんな表</a>';
		?>
		</div>
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
	<div class="col-8" id="how_hour_comp"></div>
	<div class="col-12" style="height: 2000px"></div>
</main>
</div>
<!--Main Layout-->
<?php
	include($ini['dirWin'].'/MDBpages/footer.php');
?>

<script>
	$(document).ready(function() {
		document.getElementsByClassName('todonav')[0].classList.add('activenav');
		navOnload();
	});
</script>

</body>
</html>
