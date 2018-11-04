<?php
	$file = readCsvFile2($ini['dirWin'].'/data/file.csv');
	//name,furi,summary,detail,count,syurui,date,delete
	$group = readCsvFile2($ini['dirWin'].'/data/file_group.csv');
	//group,abc,detail

	//変更動作についての文章。
	if(isset($_SESSION['change'])) {
		echo "<div class='alert alert-dismissible alert-info col-12'><button type='button' class='close' data-dismiss='alert'>&times;</button><p>{$_SESSION['change']}</p></div>";
		unset($_SESSION['change']);
	}
	//削除動作についての文章。
	//print_r($_SESSION);
	if(isset($_SESSION['delete'])) {
		echo "<div class='alert alert-dismissible alert-warning col-12'><button type='button' class='close' data-dismiss='alert'>&times;</button><p class='text-danger'>{$_SESSION['delete']}</p></div>";
		unset($_SESSION['delete']);
	}
?>

	<div class="col-12">
		<a href="./file.php?page=table_make&type=new" class="btn btn-info">新規</a>　
		<button onclick="location.reload()" class="btn btn-primary">再読み込み</button>
		<div class='table-responsive container-fluid'>
			<table class='table table-striped table-hover table-sm' id='datatable' style='overflow-x:auto'>
				<thead><!--
					<tr>
						<th class="col-3"><input type="text" class="form-control form-control-sm" style="width:100%"/></th>
						<th><input type="text" class="form-control form-control-sm" style="width:100%" /></th>
						<th class="col-8"><input type="text" class="form-control form-control-sm" style="width:100%" /></th>
						<th><input type="text" class="form-control form-control-sm" style="width:100%" /></th>
						<th><input type="text" class="form-control form-control-sm" style="width:100%" /></th>
						<th><input type="text" class="form-control form-control-sm" style="width:100%" /></th>
					</tr>-->
					<tr>
						<th class="col-3">メモ</th>
						<th>ふりがな</th>
						<th class="col-8">内容</th>
						<th>登録日時</th>
						<th>編集</th>
						<th>削除</th>
					</tr>
				</thead>
				<tbody>
				<?php
					for($i = 1; $i<count($file); $i++) {
						if((!isset($_GET['search']) || $_GET['search'] == $file[$i]['syurui']) && $file[$i]['delete']!=1) {
						//name,furi,summary,detail,count,syurui,date,delete
							echo "<tr class='syurui".$file[$i]['syurui']."'><td>";
							echo $file[$i]['name'];
							echo "</td><td>";
							echo $file[$i]['furi'];
							echo "</td><td>";
							if(serch_word_str($file[$i]['summary'], "http")) 
								
								echo "<a href='".$file[$i]['summary']."' target='_blank' onClick='move(".$i.")'>".$file[$i]['summary']."</a>";
							else
								echo "<a href='".$file[$i]['summary']."' onClick='move(".$i.")'>".$file[$i]['summary']."</a>";
							if($file[$i]['detail']!="")
							//echo "<span style='float: right;'><a href='./file.php?page=detail&p=".$i."'>詳細</span></td><td>";
							echo "<br>{$file[$i]['detail']}</td><td>";
							else { echo "</td><td>"; }
							echo $file[$i]['count'];
							echo "</td><td><a href='./file.php?page=table_make&type=change&p=".$i."' class='btn btn-info btn-sm'>編集</a>";
							echo "</td><td><button class='btn btn-danger btn-sm' onclick='delete_check(\"".$file[$i]['name']."\", ".$i.", \"file\")' style='margin:0'>削除</button>";
							echo "</td></tr>";
						}
					}
					
				?>
				</tbody>
				<tfoot>
					<tr>
						<th class="col-3">メモ</th>
						<th>ふりがな</th>
						<th class="col-8">内容</th>
						<th>登録日時</th>
						<th>編集</th>
						<th>削除</th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
	
