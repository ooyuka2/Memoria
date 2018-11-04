<?php
	date_default_timezone_set('Asia/Tokyo');
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	$pagetype = "MDBpages";
	include_once($ini['dirWin'].'/pages/function.php');
	include $ini['dirWin']. "/prototype/rooting.php";
	
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
?>
<div class="card h-100">
	<div class='card-body row justify-content-center' style='padding-bottom:0;'>
		<h2 class="col-12">���_�ʃ}�V����(�h�[�i�c�O���t�֕ύX�\��)</h2>
		<table class='table table-striped table-hover table-sm col-12'>
			<thead>
				<tr>
					<th></th>
					<?php
						for($i = 1; $i<count($where); $i++) {
							echo "<th>" . $where[$i]['���O'] . "���_</th>";
						}
					?>
				</tr>
			</thead>
			<tbody>
				<?php
					$array = array();
					for($i = 1; $i<count($os); $i++) {
						for($j = 1; $j<count($where); $j++) {
							$array[$i][$j] = 0;
						}
					}
					for($i = 1; $i<count($mashine); $i++) {
						if($mashine[$i]['OSID'] != "" && $mashine[$i]['�ݔ��X�e�[�^�XID'] > 2 && $mashine[$i]['�ݔ��X�e�[�^�XID'] < 7)
							$array[$mashine[$i]['OSID']][$mashine[$i]['���_ID']]++;
					}
					
					
					for($i = 1; $i<count($os); $i++) {
						echo "<tr><th>" . $os[$j]['OS��'] . "</th>";
							for($j = 1; $j<count($where); $j++) {
								echo "<td>" . $array[$i][$j] . "��</td>";
							}
						echo "</tr>";
					}
					echo "<tr><th>���v</th>";
						for($i = 1; $i<count($where); $i++) {
							$tmp = 0;
							for($j = 1; $j<count($os); $j++) {
								$tmp += $array[$j][$i];
							}
							echo "<td>" . $tmp . "��</td>";
						}
					echo "</tr>";
				?>
			</tbody>
		</table>
		<?php
			for($i = 1; $i<count($where); $i++) {
				//echo "<th>" . $where[$i]['���O'] . "���_</th>";
			}
			$array = array();
			for($i = 1; $i<count($os); $i++) {
				for($j = 1; $j<count($where); $j++) {
					$array[$i][$j] = 0;
				}
			}
			for($i = 1; $i<count($mashine); $i++) {
				if($mashine[$i]['OSID'] != "" && $mashine[$i]['�ݔ��X�e�[�^�XID'] > 2 && $mashine[$i]['�ݔ��X�e�[�^�XID'] < 7)
					$array[$mashine[$i]['OSID']][$mashine[$i]['���_ID']]++;
			}
			
			
			for($i = 1; $i<count($os); $i++) {
				//echo "<tr><th>" . $os[$j]['OS��'] . "</th>";
					for($j = 1; $j<count($where); $j++) {
						//echo "<td>" . $array[$i][$j] . "��</td>";
					}
				//echo "</tr>";
			}
			//echo "<tr><th>���v</th>";
				for($i = 1; $i<count($where); $i++) {
					$tmp = 0;
					for($j = 1; $j<count($os); $j++) {
						$tmp += $array[$j][$i];
					}
					//echo "<td>" . $tmp . "��</td>";
				}
			//echo "</tr>";
		?>
		
		
	</div>
</div>
	
