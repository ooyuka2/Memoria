<?php
	$file = readCsvFile2($ini['dirWin'].'/prototype/data/mashine.csv');
	//name,furi,summary,detail,count,syurui,date,delete
	//$group = readCsvFile2($ini['dirWin'].'/data/file_group.csv');
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
			<table class='table table-striped table-hover ' id='tablespage' cellspacing="0" width="100%">
				<thead>
					<tr>
						<th class="th-sm">詳細</th>
						<th class="th-sm">拠点</th>
						<th class="th-sm">ステータス</th>
						<th class="th-sm">マシン名</th>
						<th class="th-sm">IPアドレス</th>
						<th class="th-sm">用途</th>
						<th class="th-sm">OS</th>
						<th>担当部署</th>
					</tr>
				</thead>
				<tbody>
				<?php
					for($i = 1; $i<count($file); $i++) {
						echo "<tr>";
						echo "<td><button class='btn btn-info'>詳細</button></td>";
						echo "<td>" . $file[$i]['拠点'] . "</td>";
						echo "<td>" . $file[$i]['status'] . "</td>";
						echo "<td>" . $file[$i]['hostname'] . "</td>";
						echo "<td>" . $file[$i]['ipaddress'] . "</td>";
						echo "<td>" . $file[$i]['whattodo'] . "</td>";
						echo "<td>" . $file[$i]['os'] . "</td>";
						echo "<td>" . $file[$i]['部署'] . "</td>";
						echo "</tr>";
					}
					
				?>
				</tbody>
			</table>
		</div>
	</div>
	
	<div class="form-group" style="margin-bottom:0; position: fixed; top: 80px;right:0;width:250px;">
		<button type="submit" class="btn btn-default btn-block waves-effect waves-light" style="margin-right:30px" data-toggle="modal" data-target="#centralModalInfo">このページの説明</button>
	</div>
	<!-- Central Modal Medium Info -->
	<div class="modal fade" id="centralModalInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-notify modal-info" role="document">
			<!--Content-->
			<div class="modal-content">
				<!--Header-->
				<div class="modal-header">
					<p class="heading lead">設備毎一覧です。</p>

					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true" class="white-text">&times;</span>
					</button>
				</div>

				<!--Body-->
				<div class="modal-body">
					<div class="text-center">
						<i class="fa fa-check fa-4x mb-3 animated rotateIn"></i>
						<p></p>
						<p>今は列ごとの並べ替え・全体検索にしか対応してませんが、列ごとのフィルターや列の追加/非表示とかもできるようにしたいです</p>
					</div>
				</div>

				<!--Footer-->
				<div class="modal-footer justify-content-center">
				</div>
			</div>
			<!--/.Content-->
		</div>
	</div>
	<!-- Central Modal Medium Info-->