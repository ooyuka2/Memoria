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
          		if(!isset($_GET['d']) || $_GET['d']=="today") echo "<li class='active'><a href='todo.php?d=today'>今日</a></li>";
          		else echo "<li><a href='todo.php?d=today'>今日</a></li>";
          		if((isset($_GET['d']) && $_GET['d']=="detail") && (isset($_GET['p']) && $_GET['p']<count($todo))) echo "<li class='active'><a href='todo.php?d=detail'>詳細</a></li>";
          		else if(isset($_GET['p']) && $_GET['p']<count($todo)) echo "<li><a href='todo.php?d=detail'>詳細</a></li>";
				if(isset($_GET['d']) && $_GET['d']=="tomorrow") echo "<li class='active'><a href='todo.php?d=tomorrow'>明日</a></li>";
				else echo "<li><a href='todo.php?d=tomorrow'>明日</a></li>";
				if(isset($_GET['d']) && $_GET['d']=="week") echo "<li class='active'><a href='todo.php?d=week'>1週間</a></li>";
				else echo "<li><a href='todo.php?d=week'>1週間</a></li>";
				if(isset($_GET['d']) && $_GET['d']=="calendar") echo "<li class='active'><a href='todo.php?d=calendar'>カレンダー</a></li>";
				else echo "<li><a href='todo.php?d=calendar'>カレンダー</a></li>";
				if(isset($_GET['d']) && $_GET['d']=="todo") echo "<li class='active'><a href='todo.php?d=todo'>リスト</a></li>";
				else echo "<li><a href='todo.php?d=todo'>リスト</a></li>";
				if(isset($_GET['d']) && $_GET['d']=="finish") echo "<li class='active'><a href='todo.php?d=finish'>終了</a></li>";
				else echo "<li><a href='todo.php?d=finish'>終了</a></li>";
				if(isset($_GET['d']) && $_GET['d']=="new") echo "<li class='active'><a href='todo.php?d=new'>追加</a></li>";
				else if(isset($_GET['d']) && $_GET['d']=="renew" && isset($_GET['p'])) echo "<li class='active'><a href='todo.php?d=new'>追加</a></li>";
				else if(!(isset($_GET['d']) && $_GET['d']=="change")) echo "<li><a href='todo.php?d=new'>追加</a></li>";
				if(isset($_GET['d']) && $_GET['d']=="change") echo "<li class='active'><a href='todo.php?d=change'>編集</a></li>";
				if(isset($_GET['d']) && $_GET['d']=="weekly") echo "<li class='active'><a href='todo.php?d=weekly'>週報</a></li>";
				else echo "<li><a href='todo.php?d=weekly'>週報</a></li>";
            ?>
		  </ul>
		<div style='width:90%; margin: auto'><!-- class='col-md-offset-1 col-md-10 col-sm-12' -->
          <div id="myTabContent" class="tab-content">
          	<?php
	            
				if(!isset($_GET['d']) || $_GET['d']=="today") echo "<div class='tab-pane fade active in' id='today'>";
				else echo "<div class='tab-pane fade' id='today'>";
				include('todo/today.php');
				echo "</div>";
				if((isset($_GET['d']) && $_GET['d']=="detail") && (isset($_GET['p']) && $_GET['p']<count($todo))) echo "<div class='tab-pane fade active in' id='detail'>";
				else if(isset($_GET['p']) && $_GET['p']<count($todo)) echo "<div class='tab-pane fade' id='detail'>";
				if(isset($_GET['p']) && $_GET['p']<count($todo)) {
					include('todo/detail.php');
					echo "</div>";
				}
				if(isset($_GET['d']) && $_GET['d']=="tomorrow") echo "<div class='tab-pane fade active in' id='tomorrow'>";
				else echo "<div class='tab-pane fade' id='tomorrow'>";
				include('todo/tomorrow.php');
				echo "</div>";
				if(isset($_GET['d']) && $_GET['d']=="week") echo "<div class='tab-pane fade active in' id='week'>";
				else echo "<div class='tab-pane fade' id='week'>";
				include('todo/week.php');
				//echo "<p class='text-info'>未実装</p>";
				echo "</div>";
				if(isset($_GET['d']) && $_GET['d']=="calendar") echo "<div class='tab-pane fade active in' id='calendar'>";
				else echo "<div class='tab-pane fade' id='calendar'>";
				include('todo/calendar.php');
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
				else if(isset($_GET['d']) && $_GET['d']=="renew" && isset($_GET['p'])) echo "<div class='tab-pane fade active in' id='new'>";
				else if(!(isset($_GET['d']) && $_GET['d']=="change")) echo "<div class='tab-pane fade' id='new'>";
				if(isset($_GET['d']) && $_GET['d']=="renew" && isset($_GET['p'])) include('todo/renew.php');
				else if(!(isset($_GET['d']) && $_GET['d']=="change"))include('todo/new.php');
				if(!(isset($_GET['d']) && $_GET['d']=="change")) echo "</div>";
				if(isset($_GET['d']) && $_GET['d']=="change") {
					echo "<div class='tab-pane fade active in' id='change'>";
					include('todo/change.php');
					echo "</div>";
				}
				if(isset($_GET['d']) && $_GET['d']=="weekly") echo "<div class='tab-pane fade active in' id='weekly'>";
				else echo "<div class='tab-pane fade' id='weekly'>";
				include('todo/weekly.php');
				echo "</div>";
			?>
				</div>
			</div>
		</div>
	</div>
</div>
