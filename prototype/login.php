<?php
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\data\config.ini');
	session_start();
	header("Content-type: text/html; charset=SJIS-win");
	$pagetype = "MDBpages";
	include_once($ini['dirWin'].'/pages/function.php');
	if(isset($_POST['userID'])) {
		$staff = readCsvFile2("./data/staff.csv");
		$login = false;
		for($i=1; $i<count($staff);$i++) {
			if($_POST['userID'] == $staff[$i]['�Ј�ID'] && password_verify($_POST['password'], $staff[$i]['�p�X���[�h'])) {
				$login = true;
				/*
				$_SESSION['staff']['id'] = $_POST['�Ј�ID'];
				$_SESSION['staff']['name'] = $staff[$i][0];
				$_SESSION['staff']['authority'] = $staff[$i][3];
				*/
				$_SESSION['staff'] = $staff[$i];
			}
		}
		if($login) { 
			header( "Location: ./index.php" ) ;
			exit();
		 }
	}
	
?>
<?php
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
	<div class="container-fluid col-12" style="">
		<h1>���O�C�����</h1>
		
<?php
		print_r_pre($_SESSION['staff']);
		if(isset($login) && !$login) { 
			echo "���O�C�����s<br>"; 
			echo password_hash("rasmuslerdorf", PASSWORD_DEFAULT)."\n";
		}
?>
		<form class='form-horizontal container-fluid' method='post' action='./login.php'>
			<div class="row">
				<div class='form-group col-12'>
					<label class='' for='userID'>�Ј��ԍ�</label>
					<div class='input-group'>
						<input type='text' id='userID' class='form-control' name='userID'  placeholder='�X�^�b�tID����͂��Ă�������' required>
					</div>
				</div>
				<div class='form-group col-12'>
					<label class='' for='password'>�p�X���[�h</label>
					<div class='input-group'>
						<input type='password' id='password' class='form-control' name='password' placeholder='�p�X���[�h����͂��Ă�������' required>
					</div>
				</div>
				<div class='form-group col-11'>
					<button type='reset' class='btn btn-default pull-right'>���Z�b�g</button>
				</div>
				<div class='form-group col-1'>
					<button type='submit' class='btn btn-default pull-right'>���O�C��</button>
				</div>
			</div>
		</form>
	<div class="row">
			<button type="button" class="btn btn-default" onclick="document.getElementsByName('userID')[0].value = 'D999999';document.getElementsByName('password')[0].value = 'rasmuslerdorf';">���A����</button>
			<button type="button" class="btn btn-primary" onclick="document.getElementsByName('userID')[0].value = 'D999998';document.getElementsByName('password')[0].value = 'rasmuslerdorf';">���B����</button>
			<button type="button" class="btn btn-secondary" onclick="document.getElementsByName('userID')[0].value = 'D999997';document.getElementsByName('password')[0].value = 'rasmuslerdorf';">���C����</button>
			<button type="button" class="btn btn-success" onclick="document.getElementsByName('userID')[0].value = 'D999996';document.getElementsByName('password')[0].value = 'rasmuslerdorf';">GL��D����</button>
			<button type="button" class="btn btn-info" onclick="document.getElementsByName('userID')[0].value = 'D999995';document.getElementsByName('password')[0].value = 'rasmuslerdorf';">GL��E����</button>
			<button type="button" class="btn btn-warning" onclick="document.getElementsByName('userID')[0].value = 'D999994';document.getElementsByName('password')[0].value = 'rasmuslerdorf';">������F����</button>
			<button type="button" class="btn  btn-elegant" onclick="document.getElementsByName('userID')[0].value = 'D999993';document.getElementsByName('password')[0].value = 'rasmuslerdorf';">�J��G����</button>
			<button type="button" class="btn btn-unique" onclick="document.getElementsByName('userID')[0].value = 'D999992';document.getElementsByName('password')[0].value = 'rasmuslerdorf';">�^�pH����</button>
			<button type="button" class="btn btn-btn-pink" onclick="document.getElementsByName('userID')[0].value = 'D999991';document.getElementsByName('password')[0].value = 'rasmuslerdorf';">�^�p�E��I����</button>
		</div>
	</div>
	</div>

	
	
	
</main>
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
			<p class="heading lead">���O�I���y�[�W�̃T���v���ł��B</p>

			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true" class="white-text">&times;</span>
			</button>
		</div>

		<!--Body-->
		<div class="modal-body">
			<div class="text-center">
				<i class="fa fa-check fa-4x mb-3 animated rotateIn"></i>
				<p></p>
				<p>�l�ɂ���Č�����ς��邱�Ƃō�Ɛ\���⓱���\���Ȃǂ̏��F�̗ނ����X���[�Y�ɍs���܂��B<br>
				�T���v���Ƃ��āA�����ȗ���̐l�̃��[�U�[��p�ӂ��܂����B<br>
				��ʉ����̃{�^�����������ƂŎЈ��ԍ��A�p�X���[�h�����͂���܂��̂ŁA�����Ă݂Ă��������B<br>
				���O�I�t�͉�ʍ����̃��j���[����s���܂�</p>
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

</body>
</html>
