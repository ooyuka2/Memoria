<?php
	if(!isset($_GET['day']) && !isset($_GET['mounth']) && !isset($_GET['year'])) {
?>
	<div class="row">
		<div class="col-lg-12">
			<?php
			$year = date('Y');
			$month = date('n');
			calendar($year, $month, $todo);
			?>
		</div>
		<!--
		<div class="col-lg-6">
			<?php
			calendar($year, $month+1);
			?>
		</div>
		-->
	</div>
<?php
	} else if(isset($_GET['mounth']) && isset($_GET['year'])) {
?>
	<div class="row">
		<div class="col-lg-12">
			<?php
				calendar($_GET['year'], $_GET['mounth'], $todo);
			?>
		</div>
	</div>
<?php
	}
	if(isset($_GET['day']) && isset($_GET['mounth']) && isset($_GET['year'])) {
?>
<?php
		$sa = sort_by_noki_priority($todo);
		$day = $_GET['year'] ."/". $_GET['mounth'] ."/". $_GET['day'];
		$whatday = new DateTime($day);
		$today = new DateTime(date('Y/m/d'));
		if($today->diff($whatday)->format('%R%a') >= 0) {
			for($i=0; $i<count($sa); $i++) {
				date_default_timezone_set('Asia/Tokyo');
				$day1 = new DateTime($todo[$sa[$i]]['開始予定日']);
				$day2 = new DateTime($day);
				$day3 = new DateTime($todo[$sa[$i]]['終了予定日']);
				$interval = $day1->diff($day2);
				$interval2 = $day3->diff($day2);
				if($todo[$sa[$i]]['完了']==0 && $interval->format('%r%a 日')>=0 && $interval2->format('%r%a 日')<=0 && $todo[$sa[$i]]['保留']==0 && $todo[$sa[$i]]['child']==0 && $todo[$sa[$i]]['削除']==0) { //$todo[$i]['level'] == 1 && 
					$finishday = new DateTime($todo[$sa[$i]]['納期']);
					$today = new DateTime(date('Y/m/d'));
					if($finishday->diff($day2->modify('+1 day'))->format('%r%a 日') >= 0) {
						last_todo_panel($todo, $sa[$i],'primary');
					}else if($finishday->diff($today->modify('+3 day'))->format('%r%a 日') >= 0) {
						last_todo_panel($todo, $sa[$i],'warning');
					} else {
						last_todo_panel($todo, $sa[$i],'danger');
					}
				}
			}
			
		} else {
			$todo_theme = readCsvFile2('../data/todo_theme.csv');
			$c = 0;
			$ary = array();
			$working = readCsvFile2('../data/working.csv');
			for($i=count($working)-1; $i>0; $i--) {
				$workday = new DateTime($working[$i]['day']);
				if( $working[$i]['id']!="deskwork" && ($workday->diff($whatday)->format('%R%a')) == 0 && serch_word($todo[$working[$i]['id']]['top'], $ary)==0) {
					$ary[$c] = $working[$i]['id'];
					//last_todo_panel($todo, $ary[$c],'primary');
					$top = $todo[$working[$i]['id']]['top'];
					echo "<div class='panel panel-primary'>";
					
					echo "<div class='panel-heading'>";
					echo "<a href='./todo.php?d=detail&p={$top}' style='color:#ffffff;'>";
					//echo "<h3 class='panel-title'>{$todo[$top]['タイトル']}</h3>";
					echo "<h3 class='panel-title'>{$todo[$ary[$c]]['タイトル']}<span class='pull-right'>{$todo[$todo[$ary[$c]]['top']]['タイトル']}</span></h3>";
					echo "</a></div>";
					echo "<div class='panel-body'>";
					echo "{$todo[$top]['作業内容']}<br>";
					echo "<div class='col-xs-12'><div class='progress'><div class='progress-bar progress-bar-success progress-bar-striped active' role='progressbar' style='width: {$working[$i]['per']}%;'>";
					echo "{$working[$i]['per']}%";
					echo "</div></div></div>";
					echo "</div>";
					echo "<div class='panel-footer'>{$todo[$top]['開始予定日']}　～　{$todo[$top]['納期']}</div>";
					echo "</div>";
					echo "<br>";
					$c++;
				}
				
			}
		}
?>



<?php
	}
?>
