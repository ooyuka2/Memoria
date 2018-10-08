
<?php
	//$todo = readCsvFile2('../data/todo.csv');
	date_default_timezone_set('Asia/Tokyo');
	if(!isset($ini)) $ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	$pagetype = "MDBpages";
?>
<div class="col-md-4 col-xl-3">

	<div id="todo_tree_comp"></div>

</div>
<div class="col-md-8 col-xl-9">

<?php
	include($ini['dirWin'].'/pages/todo/weekly.php');
?>
</div>
