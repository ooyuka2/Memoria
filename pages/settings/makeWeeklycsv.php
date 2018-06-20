<?php
		//session_start();
		header("Content-type: text/html; charset=SJIS-win");
		include_once('../function.php');
		include_once('../../data/weekly.php');
		
		$todofile = '../../data/todo.csv';
		$oldtodofile = '../../data/old201804todo.csv';
		$weeklyfile = '../../data/weekly.csv';
		
		$todo0 = readCsvFile2($todofile);
		
		if(!file_exists ( $weeklyfile )) {
			$copyfile = "../../data/bk/todo_".date('YmdHis').".csv";
			copy( $todofile , $copyfile );
			$copyfile = "../../data/bk/old201804todo_".date('YmdHis').".csv";
			copy( $oldtodofile , $copyfile );
			
			
			
			$weekly[0]["todoid"] = "todoid";
			$weekly[0]["テーマ概要"] = "テーマ概要";
			$weekly[0]["KPI"] = "KPI";
			$weekly[0]["担当"] = "担当";
			$weekly[0]["済み"] = "済み";
			$weekly[0]["進捗"] = "進捗";
			$weekly[0]["今後の予定"] = "今後の予定";
			$weekly[0]["parentid"] = "parentid";
			$weekly[0]["最終更新日時"] = "最終更新日時";
			$weekly[0]["表示"] = "表示";

			$c = 0;
			for($i=0; $i<count($todo0); $i++) {
				$todo[$i]["id"] = $todo0[$i]["id"];
				$todo[$i]["タイトル"] = $todo0[$i]["タイトル"];
				$todo[$i]["作業内容"] = $todo0[$i]["作業内容"];
				$todo[$i]["納期"] = $todo0[$i]["納期"];
				$todo[$i]["納期時間"] = $todo0[$i]["納期時間"];
				$todo[$i]["開始予定日"] = $todo0[$i]["開始予定日"];
				$todo[$i]["終了予定日"] = $todo0[$i]["終了予定日"];
				$todo[$i]["パーセンテージ"] = $todo0[$i]["パーセンテージ"];
				$todo[$i]["完了"] = $todo0[$i]["完了"];
				$todo[$i]["所感"] = $todo0[$i]["所感"];
				$todo[$i]["level"] = $todo0[$i]["level"];
				$todo[$i]["top"] = $todo0[$i]["top"];
				$todo[$i]["parent"] = $todo0[$i]["parent"];
				$todo[$i]["child"] = $todo0[$i]["child"];
				$todo[$i]["成果物"] = $todo0[$i]["成果物"];
				$todo[$i]["テーマ"] = $todo0[$i]["テーマ"];
				$todo[$i]["優先度"] = $todo0[$i]["優先度"];
				$todo[$i]["登録日"] = $todo0[$i]["登録日"];
				$todo[$i]["保留"] = $todo0[$i]["保留"];
				$todo[$i]["削除"] = $todo0[$i]["削除"];
				$todo[$i]["時間管理テーマ"] = $todo0[$i]["時間管理テーマ"];
				$todo[$i]["順番"] = $todo0[$i]["順番"];
				$todo[$i]["今日やること"] = $todo0[$i]["今日やること"];
				
				if($todo[$i]['時間管理テーマ'] != 0 && ($todo[$i]['時間管理テーマ'] < 30) && $todo0[$i]["level"] == 1 ) {
					$c =$c +1;
					$weekly[$c]["todoid"] = $todo[$i]["id"];
					$weekly[$c]["テーマ概要"] = "";
					$weekly[$c]["KPI"] = "";
					$weekly[$c]["担当"] = $todo0[$i]["担当"];
					$weekly[$c]["済み"] = "";
					$weekly[$c]["進捗"] = "";
					$weekly[$c]["今後の予定"] = "";
					$weekly[$c]["parentid"] = "0";
					$weekly[$c]["最終更新日時"] = date('Y/m/d H:i:s');
					$weekly[$c]["表示"] = "0";
				
				}
				
			}
			writeCsvFile2($weeklyfile, $weekly);
			writeCsvFile2($todofile, $todo);
			
			$todo0 = readCsvFile2($oldtodofile);
			
			$todo = array();
			
			for($i=0; $i<count($todo0); $i++) {
				$todo[$i]["id"] = $todo0[$i]["id"];
				$todo[$i]["タイトル"] = $todo0[$i]["タイトル"];
				$todo[$i]["作業内容"] = $todo0[$i]["作業内容"];
				$todo[$i]["納期"] = $todo0[$i]["納期"];
				$todo[$i]["納期時間"] = $todo0[$i]["納期時間"];
				$todo[$i]["開始予定日"] = $todo0[$i]["開始予定日"];
				$todo[$i]["終了予定日"] = $todo0[$i]["終了予定日"];
				$todo[$i]["パーセンテージ"] = $todo0[$i]["パーセンテージ"];
				$todo[$i]["完了"] = $todo0[$i]["完了"];
				$todo[$i]["所感"] = $todo0[$i]["所感"];
				$todo[$i]["level"] = $todo0[$i]["level"];
				$todo[$i]["top"] = $todo0[$i]["top"];
				$todo[$i]["parent"] = $todo0[$i]["parent"];
				$todo[$i]["child"] = $todo0[$i]["child"];
				$todo[$i]["成果物"] = $todo0[$i]["成果物"];
				$todo[$i]["テーマ"] = $todo0[$i]["テーマ"];
				$todo[$i]["優先度"] = $todo0[$i]["優先度"];
				$todo[$i]["登録日"] = $todo0[$i]["登録日"];
				$todo[$i]["保留"] = $todo0[$i]["保留"];
				$todo[$i]["削除"] = $todo0[$i]["削除"];
				$todo[$i]["時間管理テーマ"] = $todo0[$i]["時間管理テーマ"];
				$todo[$i]["順番"] = $todo0[$i]["順番"];
				$todo[$i]["今日やること"] = $todo0[$i]["今日やること"];
				
			}
			writeCsvFile2($oldtodofile, $todo);
			header( "Location: /Memoria/pages/todo.php" );
			exit();
		} else {
			//echo "ある";
			echo "<script>alert('更新済み');location.href = '/Memoria/pages/todo.php';</script>";
		}
?>
