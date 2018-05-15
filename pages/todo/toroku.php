<?php
//id,タイトル,作業内容,納期,納期時間,開始予定日,終了予定日,パーセンテージ,
//完了,所感,level,top,parent,child,成果物,テーマ,優先度,登録日
	
	include('../function.php');
	$todo = readCsvFile2('../../data/todo.csv');
	$id = $_POST['id'][0];
	$number = $id;
	date_default_timezone_set('Asia/Tokyo');
	for($j=0; $j<count($_POST['name']);$j++) {
		if($_POST['name'][$j]!="") {
			$todo[$id]['id'] = $id;
			$todo[$id]['タイトル'] = $_POST['name'][$j];
			$todo[$id]['作業内容'] = str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['detail'][$j]);
			$todo[$id]['納期'] = $_POST['noki'][$j];
			$todo[$id]['納期時間'] = $_POST['time'][$j];
			$todo[$id]['開始予定日'] = $_POST['kaisi'][$j];
			$todo[$id]['終了予定日'] = $_POST['syuryo'][$j];
			$todo[$id]['パーセンテージ'] = 0;
			$todo[$id]['完了'] = 0;
			$todo[$id]['所感'] = "no comment";
			$todo[$id]['level'] = $_POST['level'][$j];
			$todo[$id]['top'] = $number;
			$todo[$id]['parent'] = 0;
			$todo[$id]['child'] = 0;
			$todo[$id]['成果物'] = $_POST['mono'][$j];
			if($j==0) $todo[$id]['テーマ'] = $_POST['theme'][$j];
			else $todo[$id]['テーマ'] = 0;
			$todo[$id]['優先度'] = $_POST['priority'][$j];
			$todo[$id]['登録日'] = date('Y/m/d H:i:s');
			$todo[$id]['保留'] = 0;
			$todo[$id]['削除'] = 0;
			$todo[$id]['時間管理テーマ'] = $_POST['theme2'][0];
			$todo[$id]['順番'] = $j;
			$todo[$id]['今日やること'] = 0;
			if($j==0) $todo[$id]['テーマ対応'] = $_POST['theme'][$j];
			else $todo[$id]['テーマ対応'] = 0;
			$todo[$id]['テーマ概要'] = "";
			$id++;
		}
	}
	
	$id = $_POST['id'][0];
	for($j=0; $j<count($_POST['name']);$j++) {
		if($_POST['name'][$j]!="") {
			if($todo[$id]['level']==1) $todo[$id]['parent'] = 0;
			else if(($todo[$id]['level']-$todo[($id-1)]['level'])==1) $todo[$id]['parent'] = $todo[($id-1)]['id'];
			else if($todo[$id]['level']==$todo[($id-1)]['level']) $todo[$id]['parent'] = $todo[($id-1)]['parent'];
			else {
				for($k=$id-1; $k>=0; $k--) {
					if($todo[$id]['level']==($todo[$k]['level'])+1) {
						$todo[$id]['parent'] = $todo[$k]['id'];
						break;
					}
				}
			}
			$child = 0;
			$i=$j+1;
			while($i<count($_POST['name']) && $_POST['level'][$j]<$_POST['level'][$i]) {
				if(($_POST['level'][$j]+1)==$_POST['level'][$i]) {
					$child++;
				}
				$i++;
			}
			$todo[$id]['child'] = $child;
			$id++;
		}
	}
	
	/*echo "<pre>";
	print_r($todo);
	echo "</pre>";*/
	writeCsvFile2("../../data/todo.csv", $todo);
	if($_POST['name'][0] == "") header( "Location: ../todo.php" );
	else header( "Location: ../todo.php?p={$_POST['id'][0]}" );
	exit();

?>