
<?php
	if(!isset($todo)) {
		include_once('../function.php');
		header("Content-type: text/html; charset=SJIS-win");
		if(!isset($_GET['file'])) {
			$todo = readCsvFile2('../../data/todo.csv');
			$working = readCsvFile2('../../data/working.csv');
			$file = "todo";
		} else {
			$todo = readCsvFile2('../../data/old201804todo.csv');
			$working = readCsvFile2('../../data/old201804working.csv');
			$file = "old201804";
		}
	}
	if(isset($_GET['finisflist_search'])) {
		$searchtext=$_GET['finisflist_search'];
	} else {
		$searchtext="";
	}
	//echo "<div class='clearfix'><div style='width: 30%; float: right;'><input type='text' onChange='finisflist_search(this)' value='{$searchtext}' class='form-control input-normal input-sm' id='finisflist_search'></div></div><div style='height: 5px'></div>";
	
	
	$c = 0;
	$ary = array();
	for($i=count($working)-1; $i>0; $i--) {
		if($working[$i]['id'] != "deskwork" && $working[$i]['id'] != "periodically" && $todo[$todo[$working[$i]['id']]['top']]['完了'] == 1 && serch_word($todo[$working[$i]['id']]['top'], $ary)==0) {
			$ary[$c] = $todo[$working[$i]['id']]['top'];
			$c++;
			$top = $todo[$working[$i]['id']]['top'];
			if(!isset($_GET['finisflist_search']) || strpos($todo[$top]['タイトル'],$_GET['finisflist_search']) !== false || strpos($todo[$top]['作業内容'],$_GET['finisflist_search']) !== false || strpos($todo[$working[$i]['id']]['タイトル'],$_GET['finisflist_search']) !== false || strpos($todo[$working[$i]['id']]['作業内容'],$_GET['finisflist_search']) !== false) {
				last_todo_panel($todo, $todo[$top]['id'],'success', $file);
			}
		}
	}

	if(isset($_GET['finisflist_search'])) {
		$todo = readCsvFile2('../data/old201804todo.csv');
		$working = readCsvFile2('../data/old201804working.csv');
		$file = "old201804";
		if(isset($_GET['finisflist_search'])) {
			$searchtext=$_GET['finisflist_search'];
		} else {
			$searchtext="";
		}
		$c = 0;
		$ary = array();
		for($i=count($working)-1; $i>0; $i--) {
			if($working[$i]['id'] != "deskwork" && $working[$i]['id'] != "periodically" && $todo[$todo[$working[$i]['id']]['top']]['完了'] == 1 && serch_word($todo[$working[$i]['id']]['top'], $ary)==0) {
				$ary[$c] = $todo[$working[$i]['id']]['top'];
				$c++;
				$top = $todo[$working[$i]['id']]['top'];
				if(!isset($_GET['finisflist_search']) || strpos($todo[$top]['タイトル'],$_GET['finisflist_search']) !== false || strpos($todo[$top]['作業内容'],$_GET['finisflist_search']) !== false || strpos($todo[$working[$i]['id']]['タイトル'],$_GET['finisflist_search']) !== false || strpos($todo[$working[$i]['id']]['作業内容'],$_GET['finisflist_search']) !== false) {
					last_todo_panel($todo, $todo[$top]['id'],'success', $file);
				}
			}
		}
	}
?>