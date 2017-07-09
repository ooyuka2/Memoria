<?php
	$todo = readCsvFile2('../data/todo.csv');
	if($_GET['delete']=="wait") {
		echo "<button onClick='todo_delete_check('{$todo[$_GET['id']]['タイトル']}', '{$_GET['id']}')'>削除確認ページ</button>";
	} else if($_GET['delete']=="OK"){
		//削除対象がないかの確認
		$top=$todo[$_GET['id']]['top'];
		$todo[$_GET['id']]['削除'] = 1;
		if($todo[$_GET['id']]['parent'] != 0) {
			$todo[$todo[$_GET['id']]['parent']]['child'] -= 1;
		}
		for($i=1; $i<count($todo); $i++) {
			if($todo[$i]['parent'] == $_GET['id']) {
				$todo[$i]['削除'] = 1;
				if($todo[$i]['child'] != 0) {
					$todo = todo_delete_child($i, $todo);
				}
			}
		}
		/*
	echo "<pre>";
	
	for($i=1; $i<count($todo); $i++) {
		if($todo[$i]['top'] == $top) {
			print_r($todo[$i]);
		}
	}
	echo "</pre>";*/
		writeCsvFile2("../data/todo.csv", $todo);
		header( "Location: ./todo.php" );
		exit();
	} else {
		echo "削除に失敗しました。プログラムを確認してください。";
	}
	
	function todo_delete_child($id, $todo) {
		for($i=1; $i<count($todo); $i++) {
			if($todo[$i]['parent'] == $id) {
				$todo[$i]['削除'] = 1;
				if($todo[$i]['child'] != 0) {
					$todo = todo_delete_child($i, $todo);
				}
			}
		}
		return $todo;
	}
?>