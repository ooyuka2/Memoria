<?php
	$todo = readCsvFile2('../data/todo.csv');
?>

<div class="row">
	<div class="col-lg-12">
		<p id="nav-tabs"></p>
		<div class="bs-component">
        <p id="nav-tabs"></p>
        <div class="bs-component">
          <ul class="nav nav-tabs clearfix">
          	<?php
				if(!isset($_GET['d']) || $_GET['d']=="todo") echo "<li class='active'><a href='todo.php?d=todo2'>開発中</a></li>";
				else echo "<li><a href='todo.php?d=todo'>開発中</a></li>";
				
				if((isset($_GET['d']) && $_GET['d']=="detail") && (isset($_GET['p']) && $_GET['p']<count($todo))) echo "<li class='active'><a href='todo.php?d=detail'>詳細</a></li>";

				if(isset($_GET['d']) && $_GET['d']=="calendar") echo "<li class='active'><a href='todo.php?d=calendar'>カレンダー</a></li>";
				else echo "<li><a href='todo.php?d=calendar'>カレンダー</a></li>";
				if(isset($_GET['d']) && $_GET['d']=="new") echo "<li class='active'><a href='todo.php?d=new'>追加</a></li>";
				else if(isset($_GET['d']) && $_GET['d']=="renew" && isset($_GET['p'])) echo "<li class='active'><a href='todo.php?d=new'>追加</a></li>";
				else if(!(isset($_GET['d']) && $_GET['d']=="change")) echo "<li><a href='todo.php?d=new'>追加</a></li>";
				if(isset($_GET['d']) && $_GET['d']=="change") echo "<li class='active'><a href='todo.php?d=change'>編集</a></li>";
				if(isset($_GET['d']) && $_GET['d']=="weekly") echo "<li class='active'><a href='todo.php?d=weekly'>週報</a></li>";
				else echo "<li><a href='todo.php?d=weekly'>週報</a></li>";
				if(isset($_GET['d']) && $_GET['d']=="keeper") echo "<li class='active'><a href='todo.php?d=keeper'>時間管理</a></li>";
				else echo "<li><a href='todo.php?d=keeper'>時間管理</a></li>";
				
            ?>
	<li role="presentation" class="dropdown pull-right">
<?php
	if(!isset($_GET['list'])) echo "<a data-toggle='dropdown' role='button' aria-expanded='false'>今日やること<span class='caret'></span></a>";
	else if(isset($_GET['list']) && $_GET['list']=="tomorrow")
		echo "<a data-toggle='dropdown' role='button' aria-expanded='false'>明日やること<span class='caret'></span></a>";
	else if(isset($_GET['list']) && $_GET['list']=="week")
		echo "<a data-toggle='dropdown' role='button' aria-expanded='false'>1週間やること<span class='caret'></span></a>";
	else if(isset($_GET['list']) && $_GET['list']=="todo_all")
		echo "<a data-toggle='dropdown' role='button' aria-expanded='false'>未完了<span class='caret'></span></a>";
	else if(isset($_GET['list']) && $_GET['list']=="finishlist")
		echo "<a data-toggle='dropdown' role='button' aria-expanded='false'>完了済み<span class='caret'></span></a>";
?>
		
		<ul class="dropdown-menu" role="menu">
			<li role="presentation"><a href="/Memoria/pages/todo.php">今日やること</a></li>
			<li role="presentation"><a href="/Memoria/pages/todo.php?list=tomorrow">明日やること</a></li>
			<li role="presentation"><a href="/Memoria/pages/todo.php?list=week">1週間やること</a></li>
			<li role="presentation"><a href="/Memoria/pages/todo.php?list=todo_all">未完了</a></li>
			<li role="presentation"><a href="/Memoria/pages/todo.php?list=finishlist">完了済み</a></li>
		</ul>
	</li>
		  </ul>
		<div style='width:90%; margin: auto'><!-- class='col-md-offset-1 col-md-10 col-sm-12' -->
          <div id="myTabContent" class="tab-content">
          	<?php
				if((isset($_GET['d']) && $_GET['d']=="detail") && (isset($_GET['p']) && $_GET['p']<count($todo))) {
					echo "<div class='tab-pane fade active in' id='detail'>";
					include('todo/todo.php');
					echo "</div>";
				}
				if(isset($_GET['d']) && $_GET['d']=="calendar") {
					echo "<div class='tab-pane fade active in' id='calendar'>";
					include('todo/calendar.php');
				}
				else echo "<div class='tab-pane fade' id='calendar'>";
				
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
				if(isset($_GET['d']) && $_GET['d']=="weekly") {
					echo "<div class='tab-pane fade active in' id='weekly'>";
					include('todo/weekly.php');
				}
				else echo "<div class='tab-pane fade' id='weekly'>";
				echo "</div>";
				if(isset($_GET['d']) && $_GET['d']=="delete") {
					echo "<div>";
					include('todo/delete.php');
				}
				if(isset($_GET['d']) && $_GET['d']=="keeper") {
					echo "<div class='tab-pane fade active in' id='keeper'>";
					include('todo/keeper.php');
				}
				else echo "<div class='tab-pane fade' id='keeper'>";
				echo "</div>";
				if(!isset($_GET['d']) || $_GET['d']=="todo") {
					echo "<div class='tab-pane fade active in' id='todo2'>";
					include('todo/todo.php');
				}
				else echo "<div class='tab-pane fade' id='todo'>";
				echo "</div>";
			?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
/*
//if(!isset($_GET['d']) || $_GET['d']=="today") echo "<li class='active'><a href='todo.php?d=today'>今日</a></li>";
if(isset($_GET['p']) && $_GET['d']=="today") echo "<li class='active'><a href='todo.php?d=today'>今日</a></li>";
else echo "<li><a href='todo.php?d=today'>今日</a></li>";
if(isset($_GET['d']) && $_GET['d']=="tomorrow") echo "<li class='active'><a href='todo.php?d=tomorrow'>明日</a></li>";
else echo "<li><a href='todo.php?d=tomorrow'>明日</a></li>";
if(isset($_GET['d']) && $_GET['d']=="week") echo "<li class='active'><a href='todo.php?d=week'>1週間</a></li>";
else echo "<li><a href='todo.php?d=week'>1週間</a></li>";
if(isset($_GET['d']) && $_GET['d']=="todo") echo "<li class='active'><a href='todo.php?d=todo'>リスト</a></li>";
else echo "<li><a href='todo.php?d=todo'>リスト</a></li>";
if(isset($_GET['d']) && $_GET['d']=="finish") echo "<li class='active'><a href='todo.php?d=finish'>終了</a></li>";
else echo "<li><a href='todo.php?d=finish'>終了</a></li>";
//if(!isset($_GET['d']) || $_GET['d']=="today") {
if(isset($_GET['d']) && $_GET['d']=="today") { 
	echo "<div class='tab-pane fade active in' id='today'>";
	include('todo/today.php');
}
else echo "<div class='tab-pane fade' id='today'>";

echo "</div>";
if(isset($_GET['d']) && $_GET['d']=="tomorrow") { 
	echo "<div class='tab-pane fade active in' id='tomorrow'>";
	include('todo/tomorrow.php');
}
else echo "<div class='tab-pane fade' id='tomorrow'>";

echo "</div>";
if(isset($_GET['d']) && $_GET['d']=="week") {
	echo "<div class='tab-pane fade active in' id='week'>";
	include('todo/week.php');
}
else echo "<div class='tab-pane fade' id='week'>";

//echo "<p class='text-info'>未実装</p>";
echo "</div>";
if(isset($_GET['d']) && $_GET['d']=="todo_all") {
	echo "<div class='tab-pane fade active in' id='todo'>";
	include('todo/todo.php');
}
else echo "<div class='tab-pane fade' id='todo_all'>";

echo "</div>";
if(isset($_GET['d']) && $_GET['d']=="finish") {
	echo "<div class='tab-pane fade active in' id='finish'>";
	include('todo/finishlist.php');
	}
else echo "<div class='tab-pane fade' id='finish'>";

echo "</div>";






*/
?>