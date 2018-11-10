<?php
	$mashine = readCsvFile2($ini['dirWin'].'/prototype/data/equipment.csv');
	
	$os = readCsvFile2($ini['dirWin'].'/prototype/data/os.csv');
	$kiban = readCsvFile2($ini['dirWin'].'/prototype/data/kiban.csv');
	$equipmentStatus = readCsvFile2($ini['dirWin'].'/prototype/data/equipmentStatus.csv');
	//$equipmentStatus2 = readCsvFile2($ini['dirWin'].'/prototype/data/equipmentStatus2.csv');
	//$domain  = readCsvFile2($ini['dirWin'].'/prototype/data/domain.csv');
	//$equipmentType = readCsvFile2($ini['dirWin'].'/prototype/data/equipmentType.csv');
	$where = readCsvFile2($ini['dirWin'].'/prototype/data/where.csv');
	//$connext = readCsvFile2($ini['dirWin'].'/prototype/data/connext.csv');
	//$Department = readCsvFile2($ini['dirWin'].'/prototype/data/Department.csv');
	//print_r_pre($mashine);
?>

<div class="col-md-12" style="margin-top:20px" id="chart_where_os">
</div>

<div class="col-md-12" style="margin-top:20px">
	<div class="card h-100">
		<div class='card-body row' style='padding-bottom:0;'>
			<h2 class="col-md-12"><?php echo $where[1]['名前'];?>拠点・基盤別マシン数</h2>
			<table class='table table-striped table-hover table-sm col-md-6'>
				<thead>
					<tr>
						<th></th>
						<?php
							for($i = 1; $i<count($kiban); $i++) {
								echo "<th>" . $kiban[$i]['説明'] . "</th>";
							}
						?>
					</tr>
				</thead>
				<tbody>
					<?php
						$array = array();
						for($i = 1; $i<count($os); $i++) {
							for($j = 1; $j<count($kiban); $j++) {
								$array[$i][$j] = 0;
							}
						}
						for($i = 1; $i<count($mashine); $i++) {
							if($mashine[$i]['OSID'] != "" && $mashine[$i]['拠点ID'] == 1 && $mashine[$i]['設備ステータスID'] > 2 && $mashine[$i]['設備ステータスID'] < 7)
								$array[$mashine[$i]['OSID']][$mashine[$i]['基盤ID']]++;
						}
						
						
						for($i = 1; $i<count($os); $i++) {
							echo "<tr><th>" . $os[$j]['OS名'] . "</th>";
								for($j = 1; $j<count($kiban); $j++) {
									echo "<td>" . $array[$i][$j] . "台</td>";
								}
							echo "</tr>";
						}
						echo "<tr><th>合計</th>";
							for($i = 1; $i<count($kiban); $i++) {
								$tmp = 0;
								for($j = 1; $j<count($os); $j++) {
									$tmp += $array[$j][$i];
								}
								echo "<td>" . $tmp . "台</td>";
							}
						echo "</tr>";
					?>
				</tbody>
			</table>
			<?php
				echo "<div class='col-md-6'><canvas id='graph_where_os" . $where[1]['拠点ID'] . "'></canvas></div>";
			?>
		</div>
	</div>
</div>

<div class="col-md-12" style="margin-top:20px">
	<div class="card h-100">
		<div class='card-body row' style='padding-bottom:0;'>
			<h2 class="col-md-12"><?php echo $where[2]['名前'];?>拠点・基盤別マシン数</h2>
			<?php
				echo "<div class='col-md-6'><canvas id='graph_where_os" . $where[2]['拠点ID'] . "'></canvas></div>";
			?>
			<table class='table table-striped table-hover table-sm col-md-6'>
				<thead>
					<tr>
						<th></th>
						<?php
							for($i = 1; $i<count($kiban); $i++) {
								echo "<th>" . $kiban[$i]['説明'] . "</th>";
							}
						?>
					</tr>
				</thead>
				<tbody>
					<?php
						$array = array();
						for($i = 1; $i<count($os); $i++) {
							for($j = 1; $j<count($kiban); $j++) {
								$array[$i][$j] = 0;
							}
						}
						for($i = 1; $i<count($mashine); $i++) {
							if($mashine[$i]['OSID'] != "" && $mashine[$i]['拠点ID'] == 2 && $mashine[$i]['設備ステータスID'] > 2 && $mashine[$i]['設備ステータスID'] < 7)
								$array[$mashine[$i]['OSID']][$mashine[$i]['基盤ID']]++;
						}
						
						
						for($i = 1; $i<count($os); $i++) {
							echo "<tr><th>" . $os[$j]['OS名'] . "</th>";
								for($j = 1; $j<count($kiban); $j++) {
									echo "<td>" . $array[$i][$j] . "台</td>";
								}
							echo "</tr>";
						}
						echo "<tr><th>合計</th>";
							for($i = 1; $i<count($kiban); $i++) {
								$tmp = 0;
								for($j = 1; $j<count($os); $j++) {
									$tmp += $array[$j][$i];
								}
								echo "<td>" . $tmp . "台</td>";
							}
						echo "</tr>";
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="col-md-12" style="margin-top:20px">
	<div class="card h-100">
		<div class='card-body row' style='padding-bottom:0;'>
			<h2 class="col-md-12"><?php echo $where[3]['名前'];?>拠点・基盤別マシン数</h2>
			<table class='table table-striped table-hover table-sm col-md-6'>
				<thead>
					<tr>
						<th></th>
						<?php
							for($i = 1; $i<count($kiban); $i++) {
								echo "<th>" . $kiban[$i]['説明'] . "</th>";
							}
						?>
					</tr>
				</thead>
				<tbody>
					<?php
						$array = array();
						for($i = 1; $i<count($os); $i++) {
							for($j = 1; $j<count($kiban); $j++) {
								$array[$i][$j] = 0;
							}
						}
						for($i = 1; $i<count($mashine); $i++) {
							if($mashine[$i]['OSID'] != "" && $mashine[$i]['拠点ID'] == 3 && $mashine[$i]['設備ステータスID'] > 2 && $mashine[$i]['設備ステータスID'] < 7)
								$array[$mashine[$i]['OSID']][$mashine[$i]['基盤ID']]++;
						}
						
						
						for($i = 1; $i<count($os); $i++) {
							echo "<tr><th>" . $os[$j]['OS名'] . "</th>";
								for($j = 1; $j<count($kiban); $j++) {
									echo "<td>" . $array[$i][$j] . "台</td>";
								}
							echo "</tr>";
						}
						echo "<tr><th>合計</th>";
							for($i = 1; $i<count($kiban); $i++) {
								$tmp = 0;
								for($j = 1; $j<count($os); $j++) {
									$tmp += $array[$j][$i];
								}
								echo "<td>" . $tmp . "台</td>";
							}
						echo "</tr>";
					?>
				</tbody>
			</table>
			<?php
				echo "<div class='col-md-6'><canvas id='graph_where_os" . $where[3]['拠点ID'] . "'></canvas></div>";
			?>
		</div>
	</div>
</div>

<div class="col-md-12" style="margin-top:20px">
	<div class="card h-100">
		<div class='card-body row' style='padding-bottom:0;'>
			<h2 class="col-md-12"><?php echo $where[4]['名前'];?>拠点・基盤別マシン数</h2>
			<?php
				echo "<div class='col-md-6'><canvas id='graph_where_os" . $where[4]['拠点ID'] . "'></canvas></div>";
			?>
			<table class='table table-striped table-hover table-sm col-md-6'>
				<thead>
					<tr>
						<th></th>
						<?php
							for($i = 1; $i<count($kiban); $i++) {
								echo "<th>" . $kiban[$i]['説明'] . "</th>";
							}
						?>
					</tr>
				</thead>
				<tbody>
					<?php
						$array = array();
						for($i = 1; $i<count($os); $i++) {
							for($j = 1; $j<count($kiban); $j++) {
								$array[$i][$j] = 0;
							}
						}
						for($i = 1; $i<count($mashine); $i++) {
							if($mashine[$i]['OSID'] != "" && $mashine[$i]['拠点ID'] == 4) $array[$mashine[$i]['OSID']][$mashine[$i]['基盤ID']]++;
						}
						
						
						for($i = 1; $i<count($os); $i++) {
							echo "<tr><th>" . $os[$j]['OS名'] . "</th>";
								for($j = 1; $j<count($kiban); $j++) {
									echo "<td>" . $array[$i][$j] . "台</td>";
								}
							echo "</tr>";
						}
						echo "<tr><th>合計</th>";
							for($i = 1; $i<count($kiban); $i++) {
								$tmp = 0;
								for($j = 1; $j<count($os); $j++) {
									$tmp += $array[$j][$i];
								}
								echo "<td>" . $tmp . "台</td>";
							}
						echo "</tr>";
					?>
				</tbody>
			</table>
		</div>
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
				<p class="heading lead">設備についての概要についてまとまっているページです。</p>

				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" class="white-text">&times;</span>
				</button>
			</div>

			<!--Body-->
			<div class="modal-body">
				<div class="text-center">
					<i class="fa fa-check fa-4x mb-3 animated rotateIn"></i>
					<p>拠点別・基盤種類別などのマシンの数がわかるようになってます。</p>
					<p>とりあえず、撤去済みと導入前・導入作業中のマシンは抜いてます</p>
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