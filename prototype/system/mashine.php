<?php
	$file = readCsvFile2($ini['dirWin'].'/prototype/data/equipment.csv');
	
	$os = readCsvFile2($ini['dirWin'].'/prototype/data/os.csv');
	$kiban = readCsvFile2($ini['dirWin'].'/prototype/data/kiban.csv');
	$equipmentStatus = readCsvFile2($ini['dirWin'].'/prototype/data/equipmentStatus.csv');
	$equipmentStatus2 = readCsvFile2($ini['dirWin'].'/prototype/data/equipmentStatus2.csv');
	$domain  = readCsvFile2($ini['dirWin'].'/prototype/data/domain.csv');
	$equipmentType = readCsvFile2($ini['dirWin'].'/prototype/data/equipmentType.csv');
	$where = readCsvFile2($ini['dirWin'].'/prototype/data/where.csv');
	$connext = readCsvFile2($ini['dirWin'].'/prototype/data/connext.csv');
	$Department = readCsvFile2($ini['dirWin'].'/prototype/data/Department.csv');

?>

	<div class="col-12">
		<a href="./file.php?page=table_make&type=new" class="btn btn-info">新規</a>　
		<button onclick="location.reload()" class="btn btn-primary">再読み込み</button>
		<div class='table-responsive container-fluid'>
			<table class='table table-striped table-hover table-sm' id='tablespage' cellspacing="0" width="100%">
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
						echo "<td><button class='btn btn-light btn-sm'>詳細</button></td>";
						echo "<td>" . $where[$file[$i]['拠点ID']]['名前'] . "</td>";
						echo "<td>" . $equipmentStatus[$file[$i]['設備ステータスID']]['ステータス名'] . "</td>";
						echo "<td>" . $file[$i]['マシン名'] . "</td>";
						echo "<td>" . $file[$i]['IPアドレス'] . "</td>";
						echo "<td>" . $file[$i]['用途'] . "</td>";
						if($file[$i]['OSID'] == "") echo "<td></td>";
						else echo "<td>" . $os[$file[$i]['OSID']]['OS名'] . "</td>";
						echo "<td>" . $Department[$file[$i]['設備管理部門']]['部署名'] . "</td>";
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