<?php
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\data\config.ini');
	include_once($ini['dirWin'].'/pages/function.php');
	include($ini['dirWin'].'/pages/hedder.php');
?>
<style type="text/css">
table {
		width: 100%;
}
table th {
		background: #87cefa;
}
table th,
table td {
		border: 1px solid #CCCCCC;
		text-align: center;
		padding: 5px;
}
.calendar {
	margin: 30px 10px;
}
</style>
<body>
<?php
	include($ini['dirWin'].'/pages/navigation.php');
	//$dictionary = readCsvFile('../data/dictionary.csv');
	if(!isset($_GET['page'])) $_GET['page'] = "top";
?>

<!-- jumbotron special -->
<section class="section section-inverse japanese-font">
	<div class='bkcolor'>
	<div class="container" style="padding:25px 0 50px 0">
<?php
	echo "<h2>MyTool</h2>";
	readTool($ini['dirWin']."/../data/tools/");
	echo "<h2>MemoriaTool</h2>";
	readTool($ini['dirWin']."/pages/tools/");
?>
	</div>
	</div>
</section>

<?php
	
	include($ini['dirWin'].'/pages/footer.php');
	select_script_page("tools", $_GET['page']);
?>
<script>
	window.onload = function(){
			document.getElementsByClassName('tools')[0].classList.add('active');
	}
</script>
</body>
</html>

<?php
	function readTool($dir) {
		// �f�B���N�g���̑��݂��m�F���A�n���h�����擾
		if( is_dir( $dir ) && $handle = opendir( $dir ) ) {
			// [ul]�^�O
			echo "<ul>" ;

			// ���[�v����
			while( ($file = readdir($handle)) !== false ) {
				// �t�@�C���̂ݎ擾
				if( filetype( $path = $dir . $file ) == "file" ) {
					// [li]�^�O
					echo "<li>" ;
					// �t�@�C�������o�͂���
					echo "<a href='". $path. "'>".$file."</a>" ;
					// [li]�^�O
					echo "</li>" ;
				}
			}

			// [ul]�^�O
			echo "</ul>" ;
		}
	}
?>