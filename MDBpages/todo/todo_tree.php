<?php
	$pagetype = "MDBpages";
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
?>
<div class="card">
	<div class="card-body">
		
<?php
	if(!isset($todo)) {
		include_once($ini['dirWin'].'/pages/function.php');
		header("Content-type: text/html; charset=SJIS-win");
		
		if(isset($_GET['file']) && $_GET['file'] == "old201804") {
			$todo = readCsvFile2($link_data . 'old201804todo.csv');
			$file = "old201804";
		} else {
			$todo = readCsvFile2($link_data . 'todo.csv');
			$file = "todo";
		}
	}
	if(isset($_GET['d']) && $_GET['d']=="detail" && isset($_GET['p'])) $sa[0] = $todo[$_GET['p']]['top'];
	else if((isset($_GET['list']) && $_GET['list']=="finishlist") || (isset($_GET['p']) && $_GET['p'] != 0 && $todo[$todo[$_GET['p']]['top']]['完了']==1))
		$sa = sort_by_noki_todo_priority($todo, false);
	else $sa = sort_by_noki_todo_priority($todo, true);
?>
		<div class='clearfix'>
			<button class='btn btn-default pull-right btn-sm' onclick='tree_close()'>閉じる</button>
			<button class='btn btn-default pull-right btn-sm' style='' onclick='tree_open()'>開く</button>
			<a class='pull-left' href="/Memoria/mdbpages/todo.php?page=whatdo&p=deskwork&f=0" style="margin:15px 5px">定期作業</a>
			<a class='pull-left' href="/Memoria/mdbpages/todo.php?page=whatTodayDo" style="margin:15px 5px">今日やること</a>
		</div>
		<div>

		</div>
		<div id="todo_tree">
<?php
	if($sa[0]==0) echo "<h3>今日の仕事終了！</h3>";
	for($i=0; $i<count($sa); $i++) {
		if($sa[$i]!=0) { 
			write_todo_tree($todo, $sa[$i], date('Y/m/d'));
		} else if($sa[$i]==0) {
			echo "<hr>";
		}
	}
?>
		</div>
	</div>
</div>
<div id="todo_tree_menu"></div>
<div class="modal fade" id="DoAfterDay" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-side modal-bottom-left modal-notify modal-primary " role="document">
		<!--Content-->
		<div class="modal-content">
			<!--Header-->
			<div class="modal-header text-center">
				<h4 class="modal-title white-text w-100 font-weight-bold py-2">いつ頑張る？</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" class="white-text">&times;</span>
				</button>
			</div>

			<!--Body-->
			<div class="modal-body">
				<div class="md-form mb-5 row">
					<i class="fa fa-calendar prefix grey-text col-1"></i>
					<input type="text" class="form-control validate kaisi col-12" style="padding-left:10px" id="DoAfterDay_day">
					<input type="hidden" value="" id="DoAfterDay_id">
					<a type="button" class="btn btn btn-primary waves-effect col-6" onclick="check_todo_tree_wait()" data-dismiss="modal" aria-label="Close">この日に頑張る <i class="fa fa-paper-plane-o ml-1"></i></a>
					<a type="button" class="btn btn btn-primary waves-effect col-5" onclick="todo_tree_wait(document.getElementById('DoAfterDay_id').value, 'turn', 0)" data-dismiss="modal" aria-label="Close">今度頑張る <i class="fa fa-paper-plane-o ml-1"></i></a>
					<!-- <label data-error="wrong" data-success="right" for="form3">Your name</label> -->
				</div>
			</div>

		</div>
		<!--/.Content-->
	</div>
</div>