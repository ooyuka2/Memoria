<!--
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#orangeModalSubscription">
  Launch demo modal
</button>
-->
<?php
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	include_once($ini['dirWin'].'/pages/function.php');
	//include($ini['dirWin'].'/pages/rooting.php');
	
	if(isset($_GET['file']) && $_GET['file'] == "old201804") {
		$todo = readCsvFile2($ini['dirWin'].'/data/old201804todo.csv');
		$working = readCsvFile2($ini['dirWin'].'/data/old201804working.csv');
		$file = "old201804";
	} else {
		$todo = readCsvFile2($ini['dirWin'].'/data/todo.csv');
		$working = readCsvFile2($ini['dirWin'].'/data/working.csv');
		$file = "todo";
	}

	if(isset($_GET['d']) && (($_GET['d']=="renew" && isset($_GET['p'])) || ($_GET['d']=="new") || ($_GET['d']=="change" && isset($_GET['p'])))) {
		
		echo '<div class="order-md-last order-lg-first col-lg-2 col-xl-3 "><div id="todo_memo_comp"></div><div id="todo_keeper_comp"></div></div>';
		
		echo '<div class="col-md-12 col-lg-9 col-xl-8 offset-xl-1 offset-lg-1"  id="todo_space_comp">';
		include('todo/todo_make.php');
		echo '</div>';
	} else {
	
		echo '<div class="col-md-4 col-xl-3">';
			echo '<div id="todo_tree_comp"></div>';
		echo '</div>';
		echo '<div class="col-md-8 col-xl-7">';
			if(isset($_GET['p']) && $_GET['p']<count($todo)) {
				echo '<div id="todo_space_comp">';
				include('todo/detail.php');
				echo '</div>';
			} else echo '<div id="todo_space_comp"></div>';
		
		
		echo '</div>';
		echo '<div class="col-md-12 col-xl-2">';
			echo '<div id="todo_regularly_comp"></div><div id="todo_keeper_comp"></div>';
		echo '</div>';
	}
	
?>

	


