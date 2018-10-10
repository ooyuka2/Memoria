<?php
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	//include($ini['dirWin'].'/pages/rooting.php');
?>


<?php
	if(isset($_GET['d']) && (($_GET['d']=="renew" && isset($_GET['p'])) || ($_GET['d']=="new") || ($_GET['d']=="change" && isset($_GET['p'])))) {
		
		echo '<div class="col-md-3 col-xl-2"></div>';
		
		echo '<div class="col-md-8 col-xl-9 offset-md-1 offset-xl-1">';
		include('todo/todo_make.php');
		echo '</div>';
	} else {
	
?>
<div class="col-md-4 col-xl-3">

	<div id="todo_tree_comp"></div>

</div>
<div class="col-md-8 col-xl-7">

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#orangeModalSubscription">
  Launch demo modal
</button>

	<div id="todo_space_comp"></div>
</div>
<div class="col-md-12 col-xl-2">
	
	<div id="todo_keeper_comp"></div>
	<!-- <div id="weather_comp"></div> -->

</div>


<?php
	}
?>