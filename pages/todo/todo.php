<div class="row">
	<div class="col-xs-6 col-sm-4">
		<?php
			include('todo/todo_tree.php');
		?>
	</div>
	<div class="col-xs-6  col-sm-8">
<?php
	if(isset($_GET['p']) && $_GET['p']<count($todo)) {
		include('todo/detail.php');
	} else {
		if(!isset($_GET['list'])) include('todo/today.php');
		else if(isset($_GET['list']) && $_GET['list']=="tomorrow") include('todo/tomorrow.php');
		else if(isset($_GET['list']) && $_GET['list']=="week") include('todo/week.php');
		else if(isset($_GET['list']) && $_GET['list']=="todo_all") include('todo/todo_all.php');
		else if(isset($_GET['list']) && $_GET['list']=="finishlist") include('todo/finishlist.php');
	}
?>
	</div>
</div>
