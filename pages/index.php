<?php
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\data\config.ini');
	include_once($ini['dirWin'].'/pages/function.php');
	include($ini['dirWin'].'/pages/hedder.php');
?>
<body>
<?php
	include($ini['dirWin'].'/pages/navigation.php');
?>


<div class="jumbotron special">
	<div class="honoka"></div>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 outline">
				<h1>Memoria for <?php echo $ini['myname']; ?>!</h1>
				<p>自分のタスクやフォルダーのリンク、分からない単語のメモなどを管理しよう</p>
				<div class="download">
				<?php
					//echo '<a href="'.$ini['dirhtml'].'/pages/todo.php" class="btn btn-warning btn-lg last-release-download-link"><i class="fa fa-github-alt"></i> Go to ToDo List</a>';
					//echo '<a href="'.$ini['dirhtml'].'/pages/dictionary.php" class="btn btn-primary btn-lg"><i class="fa fa-play"></i> Watch Dictionary</a>';
				?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	include($ini['dirWin'].'/pages/footer.php');
?>
<script>
	window.onload = function(){
		document.getElementsByClassName('top')[0].classList.add('active');
	}
</script>
</body>
</html>
