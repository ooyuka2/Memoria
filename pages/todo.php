<?php
	
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\data\config.ini');
	include_once($ini['dirWin'].'/pages/function.php');
	include($ini['dirWin'].'/pages/hedder.php');
?>
<style type="text/css">
.calendar table {
		width: 100%;
}
.calendar table th {
		background: #87cefa;
}
.calendar table th,
.calendar table td {
		border: 1px solid #CCCCCC;
		text-align: center;
		padding: 5px;
}
.calendar {
	margin: 30px 10px;
}

#keeper {
	background: #ffffff;
	padding: 0 20px;
}
</style>
<body>
<?php
	include($ini['dirWin'].'/pages/navigation.php');
	if(!isset($_GET['page'])) $_GET['page'] = "top";
?>

<!-- jumbotron special -->
<section class="section section-inverse japanese-font">
	<div class='bkcolor'>
	<div class="container" style="margin:0 auto; padding:0 0 0 0; width:95%; max-width:1500px">
		<?php
			select_page("todo", $_GET['page']);
		?>
	</div>
	</div>
</section>

<?php
	
	include($ini['dirWin'].'/pages/footer.php');
	select_script_page("todo", $_GET['page']);
?>
<script>
	window.onload = function(){
			document.getElementsByClassName('todo')[0].classList.add('active');
	}
</script>
</body>
</html>
