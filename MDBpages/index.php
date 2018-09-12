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
<main class="row">
	<div class="container-fluid">
		<h1>Memoria for <?php echo $ini['myname']; ?>!</h1>
		<p>自分のタスクやフォルダーのリンク、分からない単語のメモなどを管理しよう</p>
		<div class="download">
		<?php
			echo '<a href="'.$link_todo_html.'" class="btn btn-warning btn-lg last-release-download-link"><i class="fa fa-github-alt"></i> Go to ToDo List</a>';
			echo '<a href="'.$ini['dirhtml'].'/MDBpages/dictionary.php" class="btn btn-primary btn-lg"><i class="fa fa-play"></i> Watch Dictionary</a>';
		?>
		</div>
	</div>
	<!--Panel-->
	<div class="col-sm-6">
		<div class="card">
			<div class="card-body">
				<h3 class="card-title">Special title treatment</h3>
				<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
				<a href="#" class="btn btn-secondary">Go somewhere</a>
			</div>
		</div>
	</div>
	<!--/.Panel-->

	<!--Panel-->
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
	<div style="height: 2000px"></div>
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
