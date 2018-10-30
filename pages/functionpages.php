<?php
//##################################################################
//				todo用関数
//##################################################################

function last_todo_panel($todo, $i, $pattern, $file) {
			echo "<div class='panel panel-{$pattern}' id='todoid{$todo[$i]['id']}'>";
			
			if($todo[$i]['保留'] == "") $todo[$i]['保留'] = 0;
			
			echo "<div class='panel-heading'>";
			if($todo[$i]['level'] == 1) {
				echo "<a href='./todo.php?d=detail&p={$i}&file={$file}' ";
				if($pattern=='primary') echo "style='color:#ffffff;'";
				if($pattern=='warning') echo "style='color:#fa8072;'";
				else if($pattern=='info') echo "style='color:#87ceeb;'";
				echo ">";
				echo "<h3 class='panel-title' oncontextmenu='tree_menu({$todo[$i]['id']}, {$todo[$i]['top']}, {$todo[$i]['パーセンテージ']}, {$todo[$i]['child']}, {$todo[$i]['保留']}, {$todo[$i]['今日やること']}, \"{$file}\");return false' >{$todo[$i]['タイトル']}</h3>";
			}
			else {
				//$b = $todo[$i]['top'];
				//echo "<a href='./todo.php?d=detail&p={$b}'";
				echo "<a href='./todo.php?d=detail&p={$i}&file={$file}'";
				if($pattern=='primary') echo "style='color:#ffffff;'";
				if($pattern=='warning') echo "style='color:#fa8072;'";
				else if($pattern=='info') echo "style='color:#87ceeb;'";
				echo ">";
				echo "<h3 class='panel-title' oncontextmenu='tree_menu({$todo[$i]['id']}, {$todo[$i]['top']}, {$todo[$i]['パーセンテージ']}, {$todo[$i]['child']}, {$todo[$i]['保留']}, {$todo[$i]['今日やること']}, \"{$file}\");return false'>{$todo[$i]['タイトル']}<span class='pull-right'>{$todo[$todo[$i]['top']]['タイトル']}</span></h3>";
			}
			echo "</a></div>";
			echo "<div class='panel-body'>";
			echo "";
			echo "<div class='col-md-9 col-xs-6'><strong>作業内容　: </strong>{$todo[$i]['作業内容']}<br><strong>成果物　　: </strong>{$todo[$i]['成果物']}<br><strong>期間　　　: </strong>{$todo[$i]['開始予定日']}　～　{$todo[$i]['納期']}</div>";
			echo "<div class='col-md-1 col-xs-2 pull-right'><a href='todo.php?page=whatdo&f=100&p={$i}' class='btn btn-success btn-sm'>完了</a></div>";
			if($todo[$i]['完了'] != 1) {
				if($todo[$i]['保留'] == 0) echo "<div class='col-md-1 col-xs-2 pull-right'><a href='todo.php?page=wait&p={$i}' class='btn btn-info btn-sm'>保留</a></div>";
				else echo "<div class='col-md-1 col-xs-2 pull-right'><a href='todo.php?page=wait&p={$i}' class='btn btn-link btn-sm'>解除</a></div>";
				echo "<div class='col-md-1 col-xs-2 pull-right'><button type='button' class='btn btn-default dropdown-toggle btn-sm' data-toggle='dropdown' aria-expanded='false'>作業 <span class='caret'></span></button><ul class='dropdown-menu' role='menu'>";
				for($j=ceil($todo[$i]['パーセンテージ']/10)*10; $j<100; $j+=10) 
				echo "<li role='presentation'><a role='menuitem' tabindex='-1' href='todo.php?page=whatdo&p={$i}&f={$j}'>{$j}％まで完了</a></li>";
				echo "</ul></div>";
			} else if($file == "todo") {
				echo "<div class='col-md-1 col-xs-2 pull-right'><a href='./todo/nofinish.php?p={$i}' class='btn btn-warning btn-sm'>未完了</a></div>";
			}
			echo "</div>";
			echo "</div>";
	
}


function write_todo_tree($todo, $id, $date) {
	$color = check_todo_color($todo, $id, $date);
	$count = $todo[$id]['順番']+1;
	if($color != "") {
		write_todo_tree_title($todo, $id, $color);
		if($todo[$id]['child'] != 0) {
			$next_id = todo_next_child($todo, $id, $count);
			while($next_id != 0) {
				$count = write_todo_tree($todo, $next_id, $date);
				$next_id = todo_next_child($todo, $id, $count);
			}

		}
		echo "</div>";
	}
	return $count;
}

function write_todo_tree_title($todo, $id, $color) {
	if(isset($_GET['p']) && $_GET['p'] == $todo[$id]['id']) echo "<div class='panel-tree-child bg-warning'>";
	else if($todo[$id]['level'] == 2 && $todo[$todo[$id]['top']]['今日やること'] != 1) echo "<div class='panel-tree-child' style='display: none;'>";
	else echo "<div class='panel-tree-child'>";
	
	if(isset($_GET['file']) && $_GET['file'] == "old201804") {
		$file = "old201804";
	} else {
		$file = "todo";
	}
	
	if($todo[$id]['level'] != 1) {
		echo "&thinsp;";
		for($j=1; $j<$todo[$id]['level']; $j++) echo " <span class='tree-child-space'>　</span>";
	}
	
	if($todo[$id]['保留'] == "") $todo[$id]['保留'] = 0;
	
	if($todo[$id]['child'] != 0 && $todo[$id]['level'] == 1 && $todo[$todo[$id]['top']]['今日やること'] != 1) echo "<span class='glyphicon glyphicon-chevron-right tree-mark' aria-hidden='true' onClick='tree_operate(this)'></span>";
	else if($todo[$id]['child'] != 0) echo "<span class='glyphicon glyphicon-chevron-down tree-mark' aria-hidden='true' onClick='tree_operate(this)'></span>";
	else if($todo[$id]['完了'] == 0) echo "<span class='glyphicon glyphicon-edit tree-mark' aria-hidden='true'></span>";
	else echo "<span class='glyphicon glyphicon-check tree-mark' aria-hidden='true'></span>";
	if(!isset($_GET['d'])) $_GET['d'] = "todo";
	echo "<span class='text-{$color}' onDblClick='location.href = \"/Memoria/pages/todo.php?d={$_GET['d']}&p={$todo[$id]['id']}\"'	onMouseOver='this.classList.add(\"bg-info\")' onMouseOut='this.classList.remove(\"bg-info\")' onClick='gotoid(todoid{$todo[$id]['id']})' oncontextmenu='tree_menu({$todo[$id]['id']}, {$todo[$id]['top']}, {$todo[$id]['パーセンテージ']}, {$todo[$id]['child']}, {$todo[$id]['保留']}, {$todo[$todo[$id]['top']]['今日やること']}, \"{$file}\");return false' style='cursor: pointer;'>{$todo[$id]['タイトル']}</span>";
}

//##################################################################
//				メモパネル作成用関数
//##################################################################



function makeMemoPanel($path, $memo, $memolist) {
	if($memolist['big'] == "y") echo "<div class='bs-component col-sm-12' id='{$memolist['filename']}'>";
	else echo "<div class='bs-component col-sm-6' id='{$memolist['filename']}'>";
	echo "<div class='modal'>";
	echo "<div class='modal-dialog'>";
	echo "<div class='modal-content'>";
	echo "<div class='modal-header'>";
	echo "<a name='{$memolist['filename']}'></a>";
	//echo "<h4 class='modal-title'>{$title}</h4>";
	//
	//$title = htmlspecialchars($memo, ENT_IGNORE);
	
	$title = str_replace("<", "!", $memo);
	$title = str_replace(">", "!", $title);
	$title = mb_substr($title, 0, 20);
	if($memolist['lock'] == "n") echo "<span style='display:none;'>".$title."……</span><button type='button' class='close' data-dismiss='modal' aria-hidden='true' onClick='switchingMemoPanel(this)'><span class='glyphicon glyphicon-resize-small' aria-hidden='true'></span></button>";
	else echo "<span>".$title."……</span><button type='button' class='close' data-dismiss='modal' aria-hidden='true' onClick='switchingMemoPanel(this)'><span class='glyphicon glyphicon-resize-full' aria-hidden='true'></span></button>";
	echo "</div>";
	if($memolist['lock'] == "n") echo "<div class='modal-body'>";
	else echo "<div class='modal-body' style='display:none;'>";
//	$hyouzi = str_replace("<table>","<table class='table table-striped table-bordered table-hover table-condensed'>",$memo);
//	$hyouzi = str_replace("<a href=\"http","<a target='_blank' href=\"http",$hyouzi);

	echo "<p>{$memo}</p>";
	echo "</div>";
	
	if($memolist['lock'] == "n") echo "<div class='modal-footer'>";
	else echo "<div class='modal-footer' style='display:none;'>";
	echo '<span class="pull-right">　</span><button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="deleteMemoPanel(\''.$path.'\', \''.$memolist['filename'].'\')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>';
	echo '<span class="pull-right">　</span><button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="changeMempPanel(\''.$memolist['filename'].'\', this, \''.$memolist['big'].'\', \''.$memolist['lock'].'\')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>';
//	echo '　<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></button>';

	//echo "<button type='button' class='btn btn-default' data-dismiss='modal'>閉じる</button>";
	//echo "<button type='button' class='btn btn-primary'>保存</button>";
	echo "</div>";
	echo "</div>";
	echo "</div>";
	echo "</div>";
	echo "</div>";
}



//##################################################################
//				カレンダー用関数
//##################################################################
// 現在の年月を取得
function calendar($year, $month) {
	// 月末日を取得
	$last_day = date('j', mktime(0, 0, 0, $month + 1, 0, $year));
	$calendar = array();
	$j = 0;
	// 月末日までループ
	for ($i = 1; $i < $last_day + 1; $i++) {
		// 曜日を取得
			$week = date('w', mktime(0, 0, 0, $month, $i, $year));
			// 1日の場合
			if ($i == 1) {
					// 1日目の曜日までをループ
					for ($s = 1; $s <= $week; $s++) {
							// 前半に空文字をセット
							$calendar[$j]['day'] = '';
							$j++;
					}
			}
			// 配列に日付をセット
			$calendar[$j]['day'] = $i;
			$j++;
			// 月末日の場合
			if ($i == $last_day) {
					// 月末日から残りをループ
					for ($e = 1; $e <= 6 - $week; $e++) {
							// 後半に空文字をセット
							$calendar[$j]['day'] = '';
							$j++;
					}
			}
	}
?>
	<div class='calendar'>
	<?php echo $year; ?>年<?php echo $month; ?>月
	<?php
		$thisyear = date('Y');
		$thismonth = date('n');
		$thisday = date('d');
	?>
	<br>
	<br>
	<table>
			<tr>
					<th style='background: #e73562;'>日</th>
					<th>月</th>
					<th>火</th>
					<th>水</th>
					<th>木</th>
					<th>金</th>
					<th style='background: #009b9f;'>土</th>
			</tr>
	 
			<tr>
			<?php $cnt = 0; ?>
			<?php foreach ($calendar as $key => $value): ?>
	 
			<?php
				//$sa = sort_by_noki_priority($todo);
				if($value['day']!="") {
					if($thisyear == $year && $thismonth == $month && $thisday == $value['day'])
						echo "<td style='background: #fff352;'>";
					else if($cnt == 0 && $value['day']!="") echo "<td style='background: #ffc0cb;'>";
					else if($cnt == 6 && $value['day']!="") echo "<td style='background: #afeeee;'>";
					else echo "<td>";
			?>
			 <?php 

					echo "<a href='todo.php?d=calendar";
					echo "&year={$year}&mounth={$month}&day={$value['day']}'";
			 		echo "style='display:block; width:100%; '>".$value['day']."</a>";//height:100%
			 		if($value['day']!="") {
			 			$day = $year ."/". $month ."/". $value['day'];
			 			$day2 = new DateTime($day);
			 		}
			 		/*
			 		for($i=0; $i<count($sa); $i++) {
						if($value['day']!="") {
							$day1 = new DateTime($todo[$sa[$i]]['開始予定日']);
							if($day1 == $day2 && $todo[$sa[$i]]['完了']==0 && $todo[$sa[$i]]['保留']==0 && $todo[$sa[$i]]['child']==0 && $todo[$sa[$i]]['削除']==0) echo "<br>".$todo[$sa[$i]]['タイトル'];
						}
					}*/
				}
				else echo "<td>";
				$cnt++;
			?>
			</td>
	 
			<?php if ($cnt == 7): ?>
			</tr>
			<tr>
			<?php $cnt = 0; ?>
			<?php endif; ?>
	 
			<?php endforeach; ?>
			</tr>
	</table>
	</div>
<?php
}

//##################################################################
//				パネル表示用関数
//##################################################################

function echo_panel($title, $txt, $pattern) {
			echo "<div class='panel panel-{$pattern}' style='text-align:start;'>";
			
			echo "<div class='panel-heading'>";
			echo "<h3 class='panel-title'>{$title}</h3>";
			echo "</div>";
			echo "<div class='panel-body'>";
			echo $txt;
			echo "</div>";
			echo "</div>";
	
}







































?>