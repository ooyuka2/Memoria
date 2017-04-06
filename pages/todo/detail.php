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
          		echo "<li><a href='#today' data-toggle='tab'>今日</a></li>";
          		echo "<li class='active'><a href='#detail' data-toggle='tab'>詳細</a></li>";
				echo "<li><a href='#tomorrow' data-toggle='tab'>明日</a></li>";
				echo "<li><a href='#week' data-toggle='tab'>1週間</a></li>";
				echo "<li><a href='#todo' data-toggle='tab'>リスト</a></li>";
				echo "<li><a href='#finish' data-toggle='tab'>終了</a></li>";
				echo "<li><a href='#new' data-toggle='tab'>追加</a></li>";
            ?>
		  </ul>
			
          <div id="myTabContent" class="tab-content">
          	<?php
				echo "<div class='tab-pane fade' id='today'>";
				include('todo/today.php');
				echo "</div><div class='tab-pane fade' id='tomorrow'>";
				//include('todo/tomorrow.php');
				echo "<p class='text-success'>未実装</p>";
				echo "</div><div class='tab-pane fade' id='week'>";
				//include('todo/week.php');
				echo "<p class='text-info'>未実装</p>";
				echo "</div><div class='tab-pane fade' id='todo'>";
				include('todo/todo.php');
				echo "</div><div class='tab-pane fade' id='finish'>";
				include('todo/finishlist.php');
				echo "</div><div class='tab-pane fade' id='new'>";
				include('todo/new.php');
				echo "</div><div class='tab-pane fade active in' id='new'>";
				?>
				<?php
					echo "<div class='clearfix'><a href='todo.php?page=change&p={$_GET['p']}' class='btn btn-info pull-right'>編集</a><a href='todo.php?d=renew&p={$_GET['p']}' class='btn btn-warning pull-right'>流用</a></div>";
					echo "<div class='panel panel-primary'>";
					
					echo "<div class='panel-heading'>";
					echo "<h3 class='panel-title'>{$todo[$_GET['p']]['タイトル']}</h3>";
					echo "</div>";
					echo "<div class='panel-body'>";
					echo "<div class='alert alert-dismissible alert-success' style='margin-bottom:0'>{$todo[$_GET['p']]['作業内容']}</div>";
					if($todo[$_GET['p']]['成果物']!="") {
						echo "<div class='alert alert-dismissible alert-info'><!--<strong style='font-size:150%'>成果物</strong>-->{$todo[$_GET['p']]['成果物']}</div>";
					} else echo "<div style='height:20px;'></div>";
					echo "<div class='col-xs-11'><div class='progress'><div class='progress-bar progress-bar-info progress-bar-striped active' role='progressbar' style='width: {$todo[$_GET['p']]['パーセンテージ']}%;'>";
					echo "{$todo[$_GET['p']]['パーセンテージ']}%";
					echo "</div></div></div>";
					echo "<div class='col-xs-1'><a href='todo.php?page=finish&p={$_GET['p']}' class='btn btn-success'>完了</a></div>";//todo.php?page=finish
					echo "<div style='height:50px;'></div>";
					panel_child($todo, $todo[$_GET['p']]['id']);
					//echo "panel_child(\$todo, {$todo[$_GET['p']]['id']});";
					echo "</div>";
					echo "<div class='panel-footer'>{$todo[$_GET['p']]['開始予定日']}　～　{$todo[$_GET['p']]['納期']} {$todo[$_GET['p']]['納期時間']}</div>";
					/*
					$day1 = new DateTime($todo[$_GET['p']]['開始予定日']);
					$day2 = new DateTime(date('Y/m/d'));
					$interval = $day1->diff($day2);
					echo $interval->format('%r%a 日');
					$week_str_list = array( '日', '月', '火', '水', '木', '金', '土');
					$week_str = $week_str_list[ $day1->format('w') ];
					print_r($week_str);*/
					echo "</div>";
				?>
				</div>
			</div>
		</div>
	</div>
</div>
