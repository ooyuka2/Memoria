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
				if(!isset($_GET['d']) || $_GET['d']=="todo") echo "<li class='active'><a href='todo.php?d=todo2'>�J����</a></li>";
				else echo "<li><a href='todo.php?d=todo'>�J����</a></li>";
				
				if((isset($_GET['d']) && $_GET['d']=="detail") && (isset($_GET['p']) && $_GET['p']<count($todo))) echo "<li class='active'><a href='todo.php?d=detail'>�ڍ�</a></li>";

				if(isset($_GET['d']) && $_GET['d']=="calendar") echo "<li class='active'><a href='todo.php?d=calendar'>�J�����_�[</a></li>";
				else echo "<li><a href='todo.php?d=calendar'>�J�����_�[</a></li>";
				if(isset($_GET['d']) && $_GET['d']=="new") echo "<li class='active'><a href='todo.php?d=new'>�ǉ�</a></li>";
				else if(isset($_GET['d']) && $_GET['d']=="renew" && isset($_GET['p'])) echo "<li class='active'><a href='todo.php?d=new'>�ǉ�</a></li>";
				else if(!(isset($_GET['d']) && $_GET['d']=="change")) echo "<li><a href='todo.php?d=new'>�ǉ�</a></li>";
				if(isset($_GET['d']) && $_GET['d']=="change") echo "<li class='active'><a href='todo.php?d=change'>�ҏW</a></li>";
				if(isset($_GET['d']) && $_GET['d']=="weekly") echo "<li class='active'><a href='todo.php?d=weekly'>�T��</a></li>";
				else echo "<li><a href='todo.php?d=weekly'>�T��</a></li>";
				if(isset($_GET['d']) && $_GET['d']=="keeper") echo "<li class='active'><a href='todo.php?d=keeper'>���ԊǗ�</a></li>";
				else echo "<li><a href='todo.php?d=keeper'>���ԊǗ�</a></li>";
				
            ?>
	<li role="presentation" class="dropdown pull-right">
<?php
	if(!isset($_GET['list'])) echo "<a data-toggle='dropdown' role='button' aria-expanded='false'>������邱��<span class='caret'></span></a>";
	else if(isset($_GET['list']) && $_GET['list']=="tomorrow")
		echo "<a data-toggle='dropdown' role='button' aria-expanded='false'>������邱��<span class='caret'></span></a>";
	else if(isset($_GET['list']) && $_GET['list']=="week")
		echo "<a data-toggle='dropdown' role='button' aria-expanded='false'>1�T�Ԃ�邱��<span class='caret'></span></a>";
	else if(isset($_GET['list']) && $_GET['list']=="todo_all")
		echo "<a data-toggle='dropdown' role='button' aria-expanded='false'>������<span class='caret'></span></a>";
	else if(isset($_GET['list']) && $_GET['list']=="finishlist")
		echo "<a data-toggle='dropdown' role='button' aria-expanded='false'>�����ς�<span class='caret'></span></a>";
?>
		
		<ul class="dropdown-menu" role="menu">
			<li role="presentation"><a href="/Memoria/pages/todo.php">������邱��</a></li>
			<li role="presentation"><a href="/Memoria/pages/todo.php?list=tomorrow">������邱��</a></li>
			<li role="presentation"><a href="/Memoria/pages/todo.php?list=week">1�T�Ԃ�邱��</a></li>
			<li role="presentation"><a href="/Memoria/pages/todo.php?list=todo_all">������</a></li>
			<li role="presentation"><a href="/Memoria/pages/todo.php?list=finishlist">�����ς�</a></li>
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
//if(!isset($_GET['d']) || $_GET['d']=="today") echo "<li class='active'><a href='todo.php?d=today'>����</a></li>";
if(isset($_GET['p']) && $_GET['d']=="today") echo "<li class='active'><a href='todo.php?d=today'>����</a></li>";
else echo "<li><a href='todo.php?d=today'>����</a></li>";
if(isset($_GET['d']) && $_GET['d']=="tomorrow") echo "<li class='active'><a href='todo.php?d=tomorrow'>����</a></li>";
else echo "<li><a href='todo.php?d=tomorrow'>����</a></li>";
if(isset($_GET['d']) && $_GET['d']=="week") echo "<li class='active'><a href='todo.php?d=week'>1�T��</a></li>";
else echo "<li><a href='todo.php?d=week'>1�T��</a></li>";
if(isset($_GET['d']) && $_GET['d']=="todo") echo "<li class='active'><a href='todo.php?d=todo'>���X�g</a></li>";
else echo "<li><a href='todo.php?d=todo'>���X�g</a></li>";
if(isset($_GET['d']) && $_GET['d']=="finish") echo "<li class='active'><a href='todo.php?d=finish'>�I��</a></li>";
else echo "<li><a href='todo.php?d=finish'>�I��</a></li>";
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

//echo "<p class='text-info'>������</p>";
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