<div class="row">
	<div class="col-xs-6 col-sm-4">
		<div class='panel panel-default'>
			<div class='panel-body'>
				<div class='clearfix'>
					<button class='btn btn-default pull-right btn-xs' onclick='tree_close()'>•Â‚¶‚é</button>
					<button class='btn btn-default pull-right btn-xs' style='margin:0 10px' onclick='tree_open()'>ŠJ‚­</button>
					<a href="/Memoria/pages/todo.php?page=whatdo&p=deskwork&f=0" class="btn btn-link active btn-xs">’èŠúì‹Æ</a>
					<a href="/Memoria/pages/todo.php?page=whatTodayDo" class="btn btn-link active btn-xs">¡“ú‚â‚é‚±‚Æ</a>
				</div>
				<div id="todo_tree">
				<?php
					//include('todo/todo_tree.php');
				?>
				</div>
			</div>
		</div>


		<div id="todo_tree_menu"></div>
		
	</div>
	<div class="col-xs-6 col-sm-8" id='todo_space'>
<?php
	if(isset($_GET['p']) && $_GET['p']<count($todo)) {
		include('todo/detail.php');
	} else {
		//if(!isset($_GET['list'])) include('todo/memo.php');
		//else if(isset($_GET['list']) && $_GET['list']=="today") include('todo/today.php');
		//else if(isset($_GET['list']) && $_GET['list']=="tomorrow") include('todo/tomorrow.php');
		//else if(isset($_GET['list']) && $_GET['list']=="week") include('todo/week.php');
		//else if(isset($_GET['list']) && $_GET['list']=="todo_all") include('todo/todo_all.php');
		//else if(isset($_GET['list']) && $_GET['list']=="finishlist") include('todo/finishlist.php');
	}
?>
	</div>
</div>
