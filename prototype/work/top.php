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

<h1>�\�����ꗗ</h1>

<!--
-->
<div class="form-group" style="margin-bottom:0; position: fixed; top: 80px;right:0;width:250px;">
	<button type="submit" class="btn btn-default btn-block waves-effect waves-light" style="margin-right:30px" data-toggle="modal" data-target="#centralModalInfo">���̃y�[�W�̐���</button>
</div>
<!-- Central Modal Medium Info -->
<div class="modal fade" id="centralModalInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-notify modal-info" role="document">
		<!--Content-->
		<div class="modal-content">
			<!--Header-->
			<div class="modal-header">
				<p class="heading lead">��Ɛ\�����̃g�b�v�y�[�W�ł�</p>

				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" class="white-text">&times;</span>
				</button>
			</div>

			<!--Body-->
			<div class="modal-body">
				<div class="text-center">
					<i class="fa fa-check fa-4x mb-3 animated rotateIn"></i>
					<p>�\�����̈ꗗ��A�{����Ɨ\��̈ꗗ�A�����̗\��etc���m�F�ł���y�[�W</p>
					
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