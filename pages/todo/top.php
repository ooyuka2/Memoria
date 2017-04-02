<?php
	$todo = readCsvFile2('../data/todo.csv');
?>

<div class="row">
	<div class="col-lg-12">
		<p id="nav-tabs"></p>
		<div class="bs-component">
        <p id="nav-tabs"></p>
        <div class="bs-component">
          <ul class="nav nav-tabs">
          	<?php
          		if(!isset($_GET['d']) || $_GET['d']=="today") echo "<li class='active'><a href='#today' data-toggle='tab'>今日</a></li>";
          		else echo "<li><a href='#today' data-toggle='tab'>今日</a></li>";
				if(isset($_GET['d']) && $_GET['d']=="tomorrow") echo "<li class='active'><a href='#tomorrow' data-toggle='tab'>明日</a></li>";
				else echo "<li><a href='#tomorrow' data-toggle='tab'>明日</a></li>";
				if(isset($_GET['d']) && $_GET['d']=="week") echo "<li class='active'><a href='#week' data-toggle='tab'>1週間</a></li>";
				else echo "<li><a href='#week' data-toggle='tab'>1週間</a></li>";
				if(isset($_GET['d']) && $_GET['d']=="todo") echo "<li class='active'><a href='#todo' data-toggle='tab'>やること</a></li>";
				else echo "<li><a href='#todo' data-toggle='tab'>リスト</a></li>";
				if(isset($_GET['d']) && $_GET['d']=="finish") echo "<li class='active'><a href='#finish' data-toggle='tab'>終了</a></li>";
				else echo "<li><a href='#finish' data-toggle='tab'>終了</a></li>";
				if(isset($_GET['d']) && $_GET['d']=="new") echo "<li class='active'><a href='#new' data-toggle='tab'>追加</a></li>";
				else echo "<li><a href='#new' data-toggle='tab'>追加</a></li>";
            ?>
		  </ul>
			
          <div id="myTabContent" class="tab-content">
          	<?php
	            
				if(!isset($_GET['d']) || $_GET['d']=="today") echo "<div class='tab-pane fade active in' id='today'>";
				else echo "<div class='tab-pane fade' id='today'>";
				include('todo/today.php');
				echo "</div>";
				if(isset($_GET['d']) && $_GET['d']=="tomorrow") echo "<div class='tab-pane fade active in' id='tomorrow'>";
				else echo "<div class='tab-pane fade' id='tomorrow'>";
				//include('todo/tomorrow.php');
				echo "<p class='text-success'>未実装</p>";
				echo "</div>";
				if(isset($_GET['d']) && $_GET['d']=="week") echo "<div class='tab-pane fade active in' id='week'>";
				else echo "<div class='tab-pane fade' id='week'>";
				//include('todo/week.php');
				echo "<p class='text-info'>未実装</p>";
				echo "</div>";
				if(isset($_GET['d']) && $_GET['d']=="todo") echo "<div class='tab-pane fade active in' id='todo'>";
				else echo "<div class='tab-pane fade' id='todo'>";
				include('todo/todo.php');
				echo "</div>";
				if(isset($_GET['d']) && $_GET['d']=="finish") echo "<div class='tab-pane fade active in' id='finish'>";
				else echo "<div class='tab-pane fade' id='finish'>";
				include('todo/finishlist.php');
				echo "</div>";
				if(isset($_GET['d']) && $_GET['d']=="new") echo "<div class='tab-pane fade active in' id='new'>";
				else echo "<div class='tab-pane fade' id='new'>";
				include('todo/new.php');
				echo "</div>";
				?>
			</div>
		</div>
	</div>
</div>
