<?php
	$mail = readCsvFile2($ini['dirWin'].'/data/mail.csv');
	//name,furi,summary,detail,count,syurui,date,delete
	$group = readCsvFile2($ini['dirWin'].'/data/mail_group.csv');
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
		<a href="./mail.php?page=table_make&type=new" class="btn btn-info">新規</a>　
		<button onclick="location.reload()" class="btn btn-primary">再読み込み</button>
		<div class='table-responsive container-fluid'>
			<table class='table table-striped table-hover table-sm' id='datatable'>
				<thead>
					<tr>
						<th class="col-3">タイトル</th>
						<th>ふりがな</th>
						<th class="col-8">宛先・内容</th>
						<th>登録日時</th>
						<th>編集</th>
						<th>削除</th>
					</tr>
				</thead>
				<tbody>
				<?php
					for($i = 1; $i<count($mail); $i++) {
						if((!isset($_GET['search']) || $_GET['search'] == $mail[$i]['syurui']) && $mail[$i]['delete']!=1) {
						//name,furi,summary,detail,count,syurui,date,delete
							echo "<tr class='syurui".$mail[$i]['syurui']."'><td>";
							echo $mail[$i]['name'];
							echo "</td><td>";
							echo $mail[$i]['furi'];
							echo "</td><td>";
							echo "<span class='text-primary'>".$mail[$i]['summary']."</span>";
							echo "<br>{$mail[$i]['detail']}</td><td>";
							
							echo $mail[$i]['date'];
							echo "</td><td><a href='./mail.php?page=table_make&type=change&p=".$i."' class='btn btn-info'>編集</a>";
							echo "</td><td><button class='btn btn-danger' onclick='delete_check(\"".$mail[$i]['name']."\", ".$i.", \"mail\")' style='margin:0'>削除</button>";
							echo "</td></tr>";
						}
					}
					
				?>
				</tbody>
			</table>
		</div>
	</div>
	
