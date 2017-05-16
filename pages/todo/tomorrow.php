<?php //$day2 = $day2->modify('+1 day'); ?>
<?php
	for($i=0; $i<count($sa); $i++) {
		date_default_timezone_set('Asia/Tokyo');
		$day1 = new DateTime($todo[$sa[$i]]['開始予定日']);
		$day2 = new DateTime(date('Y/m/d'));
		$day2 = $day2->modify('+1 day');
		$interval = $day1->diff($day2);
		if($todo[$sa[$i]]['完了']==0 && $interval->format('%r%a 日')>=0 && $todo[$sa[$i]]['保留']==0 && $todo[$sa[$i]]['child']==0 && $todo[$sa[$i]]['削除']==0) { //$todo[$i]['level'] == 1 && 
			last_todo_panel($todo, $sa[$i],'primary');
		}
	}
	for($i=0; $i<count($sa); $i++) {
		$day1 = new DateTime($todo[$sa[$i]]['開始予定日']);
		$day2 = new DateTime(date('Y/m/d'));
		$interval = $day1->diff($day2);
		if ($todo[$sa[$i]]['完了']==0 && $interval->format('%r%a 日')>=0 && $todo[$sa[$i]]['保留']==1 && $todo[$sa[$i]]['child']==0 && $todo[$sa[$i]]['削除']==0) {
			last_todo_panel($todo, $sa[$i], 'info');
		}
	}
?>

