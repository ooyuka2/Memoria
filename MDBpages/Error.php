<meta http-equiv="refresh" content="5;URL=/Memoria/MDBpages/index.php">
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
	<main class="row">
		
		<div class="pull-left drawer-hover"></div>
		<div class="container-fluid">
			<h1>Memoria Error</h1>
			<h3>�G���[���������܂���</h3>
			�T�b��ɃW�����v���܂��B<br>
			�W�����v���Ȃ��ꍇ�́A���L�̃����N���N���b�N���Ă��������B<br>
			<br>
			<a href="./index.php">Memoria</a>
				<?php
					echo '<a href="'.$link_pages_html.'todo.php" class="btn btn-default btn-lg last-release-download-link"><i class="fa fa-github-alt"></i>��邱�ƃ��X�g</a>';
				?>
				<?php
					echo '<a href="'.$ini['dirhtml'].'/MDBpages/dictionary.php" class="btn btn-primary btn-lg"><i class="fa fa-play"></i> Watch Dictionary</a>';
				?>
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
