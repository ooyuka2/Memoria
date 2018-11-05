<?php
	$mashine = readCsvFile2($ini['dirWin'].'/prototype/data/equipment.csv');
	
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
	<div class='table-responsive container-fluid'>
		<table class='table table-striped table-hover table-sm' id='tablespage' cellspacing="0">
			<thead>
				<tr>
					<th class="th-sm" style="min-width:100px">IPアドレス</th>
					<th class="th-sm" style="min-width:100px">マシン名</th>
					<th class="th-sm" style="min-width:100px">拠点</th>
					<th class="th-sm" style="min-width:100px">ステータス</th>
					<th class="th-sm" style="min-width:100px">用途</th>
					<th class="th-sm" style="min-width:100px">OS</th>
					<th class="th-sm" style="min-width:100px">担当部署</th>
					<th class="th-sm" style="min-width:100px">利用有無</th>
				</tr>
			</thead>
			<tbody>
			<?php
				for($i = 0; $i<256; $i++) {
					$flug = 0;
					for($j = 1; $j<count($mashine); $j++) {
						if(equal_word_str($mashine[$j]['IPアドレス'], "10.2.1.".$i) && $mashine[$j]['設備ステータスID'] != 7) {
							echo "<tr>";
							echo "<td>" . $mashine[$j]['IPアドレス'] . "</td>";
							echo "<td><a href='".$link_system_html."?page=mashinedetail'&mashineid=".$mashine[$j]['設備ID']."'>" . $mashine[$j]['マシン名'] . "</a></td>";
							echo "<td>" . $where[$mashine[$j]['拠点ID']]['名前'] . "</td>";
							echo "<td>" . $equipmentStatus[$mashine[$j]['設備ステータスID']]['ステータス名'] . "</td>";
							echo "<td>" . $mashine[$j]['用途'] . "</td>";
							if($mashine[$j]['OSID'] == "") echo "<td></td>";
							else echo "<td>" . $os[$mashine[$j]['OSID']]['OS名'] . "</td>";
							echo "<td>" . $Department[$mashine[$j]['設備管理部門']]['部署名'] . "</td>";
							echo "<td>利用有り</td>";
							echo "</tr>";
							$flug = 1;
						}
					}
					if($flug == 0) {
						echo "<tr>";
						echo "<td>10.2.1.".$i. "</td>";
						echo "<td>-</td>";
						
						echo "<td>-</td>";
						echo "<td>-</td>";
						echo "<td>-</td>";
						echo "<td>-</td>";
						echo "<td>-</td>";
						echo "<td>利用無し</td>";
						echo "</tr>";
					}
				}
				for($i = 0; $i<256; $i++) {
					$flug = 0;
					for($j = 1; $j<count($mashine); $j++) {
						if(equal_word_str($mashine[$j]['IPアドレス'], "10.2.45.".$i) && $mashine[$j]['設備ステータスID'] != 7) {
							echo "<tr>";
							echo "<td>" . $mashine[$j]['IPアドレス'] . "</td>";
							echo "<td><a href='".$link_system_html."?page=mashinedetail&mashineid=".$mashine[$j]['設備ID']."''>" . $mashine[$j]['マシン名'] . "</a></td>";
							echo "<td>" . $where[$mashine[$j]['拠点ID']]['名前'] . "</td>";
							echo "<td>" . $equipmentStatus[$mashine[$j]['設備ステータスID']]['ステータス名'] . "</td>";
							echo "<td>" . $mashine[$j]['用途'] . "</td>";
							if($mashine[$j]['OSID'] == "") echo "<td></td>";
							else echo "<td>" . $os[$mashine[$j]['OSID']]['OS名'] . "</td>";
							echo "<td>" . $Department[$mashine[$j]['設備管理部門']]['部署名'] . "</td>";
							echo "<td>利用有り</td>";
							echo "</tr>";
							$flug = 1;
						}
					}
					if($flug == 0) {
						echo "<tr>";
						echo "<td>10.2.45.".$i. "</td>";
						echo "<td>-</td>";
						
						echo "<td>-</td>";
						echo "<td>-</td>";
						echo "<td>-</td>";
						echo "<td>-</td>";
						echo "<td>-</td>";
						echo "<td>利用無し</td>";
						echo "</tr>";
					}
				}
				for($i = 0; $i<256; $i++) {
					$flug = 0;
					for($j = 1; $j<count($mashine); $j++) {
						if(equal_word_str($mashine[$j]['IPアドレス'], "10.2.60.".$i) && $mashine[$j]['設備ステータスID'] != 7) {
							echo "<tr>";
							echo "<td>" . $mashine[$j]['IPアドレス'] . "</td>";
							echo "<td><a href='".$link_system_html."?page=mashinedetail&mashineid=".$mashine[$j]['設備ID']."''>" . $mashine[$j]['マシン名'] . "</a></td>";
							echo "<td>" . $where[$mashine[$j]['拠点ID']]['名前'] . "</td>";
							echo "<td>" . $equipmentStatus[$mashine[$j]['設備ステータスID']]['ステータス名'] . "</td>";
							echo "<td>" . $mashine[$j]['用途'] . "</td>";
							if($mashine[$j]['OSID'] == "") echo "<td></td>";
							else echo "<td>" . $os[$mashine[$j]['OSID']]['OS名'] . "</td>";
							echo "<td>" . $Department[$mashine[$j]['設備管理部門']]['部署名'] . "</td>";
							echo "<td>利用有り</td>";
							echo "</tr>";
							$flug = 1;
						}
					}
					if($flug == 0) {
						echo "<tr>";
						echo "<td>10.2.60.".$i. "</td>";
						echo "<td>-</td>";
						
						echo "<td>-</td>";
						echo "<td>-</td>";
						echo "<td>-</td>";
						echo "<td>-</td>";
						echo "<td>-</td>";
						echo "<td>利用無し</td>";
						echo "</tr>";
					}
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
				<p class="heading lead">IPアドレス毎の一覧です。</p>

				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" class="white-text">&times;</span>
				</button>
			</div>

			<!--Body-->
			<div class="modal-body">
				<div class="text-center">
					<i class="fa fa-check fa-4x mb-3 animated rotateIn"></i>
					<p>現在登録されていない(もしくは撤去済み)のIPアドレスは存在しないものとして表示されます</p>
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