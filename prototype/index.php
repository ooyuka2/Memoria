<?php
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\data\config.ini');
		session_start();
		header("Content-type: text/html; charset=SJIS-win");
	if(!isset($_SESSION['staff']['�Ј�ID'])) {
		header( "Location: ".$ini['dirhtml']."/prototype/login.php" );
		exit();
	}
	include($ini['dirWin'].'/prototype/hedder.php');
?>
<body class="drawer drawer--left">
<?php
	include($ini['dirWin'].'/prototype/navigation.php');
?>



<!--Main Layout-->
<div class="main-contents">
<div class="pull-left drawer-hover"></div>
<main class="row">
	<div class="col-12">
		<h1>�v���g�^�C�v</h1>
	</div>
	<div class="col-lg-6 col-12"> <!-- container-fluid -->
		
		<?php
			$work = readCsvFile2($ini['dirWin'].'/prototype/data/work.csv');
			$txt = "<ui>";
			for($i = (count($work)-1); $i >= (count($work)-6); $i--) {
				$txt .= "<li>" . $work[$i]['��Ɨ\��J�n����'] . "�@�F�@" . $work[$i]['��ƃ^�C�g��'] . "</li>";
			}
			$txt .= "</ui><span class='pull-right'>etc�c�c</span>";
			echo_panel("�ŋ߂̐ݔ��ɑ΂���ύX���", $txt, "info");
		?>
	</div>
	<div class="col-lg-6 col-12"> <!-- container-fluid -->
		
		<?php
			$incident = readCsvFile2($ini['dirWin'].'/prototype/data/incident.csv');
			$incidentStatus = readCsvFile2($ini['dirWin'].'/prototype/data/incidentStatus.csv');
			$txt = "<ui>";
			for($i = (count($incident)-1); $i >= (count($incident)-6); $i--) $txt .= "<li>" .$incident[$i]['�C���V�f���g������'] . "�@�F�@�y" . $incidentStatus[$incident[$i]['�C���V�f���g�X�e�[�^�XID']]['�X�e�[�^�X'] . '�z<a style="color:#008db7" onclick="alert(\'���b�h�}�C���ƘA�g����ƕ֗����ȂƎv���܂�\')">' . $incident[$i]['�C���V�f���g���e'] . "</a></li>";
			$txt .= "</ui><span class='pull-right'><a style=\"color:#008db7\" onclick=\"alert('���b�h�}�C���ƘA�g����ƕ֗����ȂƎv���܂�')\">etc�c�c</a></span>";
			echo_panel("�ŋ߂̃C���V�f���g���", $txt, "danger");
		?>
	</div>
	<div class="col-lg-6 col-12"> <!-- container-fluid -->
		
		<?php
			$mashine = readCsvFile2($ini['dirWin'].'/prototype/data/equipment.csv');
			$txt = "<ui>";
			for($i = (count($incident)-1); $i >= (count($incident)-6); $i--) $txt .= "<li>" .$incident[$i]['�C���V�f���g������'] . '�@�F�@<a style="color:#008db7" onclick="">' . $mashine[mt_rand(0, (count($mashine)-1))]['�}�V����'] . '�Ď��V�X�e���ꎞ��~�\��</a></li>';
			$txt .= "</ui><span class='pull-right'><a style=\"color:#008db7\" onclick=\"\">etc�c�c</a></span>";
			echo_panel("�Ď��V�X�e���ꎞ��~�̂��m�点", $txt, "warning");
		?>
	</div>
	<div class="col-lg-6 col-12"> <!-- container-fluid -->
		
		<?php
			$work = readCsvFile2($ini['dirWin'].'/prototype/data/work.csv');
			$txt = "<ui>";
			for($i = (count($work)-1); $i >= (count($work)-6); $i--) {
				//$txt .= "<li>" . $work[$i]['��Ɨ\��J�n����'] . "�@�F�@" . $work[$i]['��ƃ^�C�g��'] . "</li>";
			}
			$txt .= "</ui>";
			echo_panel("���Ȃ��ւ̂��m�点", $txt, "info");
		?>
	</div>
	<!--Panel
	<div class="col-sm-6">
		<div class="card">
			<div class="card-body">
				<h3 class="card-title">Special title treatment</h3>
				<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
				<a href="#" class="btn btn-primary">Go somewhere</a>
			</div>
		</div>
	</div>
	<!--/.Panel-->
	<div class="col-12" style="height: 2000px"></div>
</main>
</div>
<!--Main Layout-->
<?php
	include($ini['dirWin'].'/prototype/footer.php');
?>

<script>
	$(document).ready(function() {
		//document.getElementsByClassName('todonav')[0].classList.add('activenav');
		navOnload();
	});
</script>
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
			<p class="heading lead">�g�b�v�y�[�W�̃T���v���ł��B</p>

			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true" class="white-text">&times;</span>
			</button>
		</div>

		<!--Body-->
		<div class="modal-body">
			<div class="text-center">
				<i class="fa fa-check fa-4x mb-3 animated rotateIn"></i>
				<p></p>
				<p>�g�b�v�y�[�W�ł͍ŋ߂̍�Ƃ⓱���\���PC�ɂ��Ă̐����Ȃǂ��ǂ߂�ƕ֗����ȂƎv���܂�</p>
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
</body>
</html>
