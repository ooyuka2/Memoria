<?php
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\data\config.ini');
	include_once($ini['dirWin'].'/pages/function.php');
	include($ini['dirWin'].'/pages/hedder.php');
?>
<body>
<?php
	include($ini['dirWin'].'/pages/navigation.php');
	if(isset($_POST["csstype"])) {
		$ini['csstype'] = $_POST['csstype'];
		write_ini_file($ini['dirWin'].'/data/config.ini', $ini);
		header( "Location: ".$ini['dirhtml']."/pages/settings.php" );
		exit();
	} else if(isset($_POST["default-ini"])) {
		$ini['myname'] = $_POST['myname'];
		$ini['weeklyTo'] = $_POST['weeklyTo'];
		$ini['thema1'] = rtrim(str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['thema1']), '\\');
		$ini['incidentID'] = $_POST['incidentID'];
		$ini['incidentKPI'] = $_POST['incidentKPI'];
		$ini['servicesID'] = $_POST['servicesID'];
		$ini['servicesKPI'] = $_POST['servicesKPI'];
		
		write_ini_file($ini['dirWin'].'/data/config.ini', $ini);
		header( "Location: ".$ini['dirhtml']."/pages/settings.php" );
		exit();
	} 
?>


<div class="jumbotron special">
	<!--	<div class="honoka"></div> -->
	<div class="container" style="margin-right:50px">
		<div class="row clearfix" style="background-image:'../img/circle.png';">
			<div class="col-xs-7 txtright col-xs-offset-5"><!--	outline -->
				<h1>Setting</h1>
				<?php
					//Memoria�̃e�[�}�ҏW
					$txt = "<form class='form-horizontal' method='post' action='./settings.php'>";
					$txt .= '<div class="form-group">';
					$txt .= "<button type='button' class=\"btn btn-default\" onclick=\"setHref('../img/honoka/css/bootstrap.css'); setHref2('../img/honoka/css/example.css'); setValue('honoka')\" style='margin: 0 5px auto; background-color: #ffd700;'>�I�����W</button>";
					$txt .= "<button type='button' class=\"btn btn-default\" onclick=\"setHref('../img/niko/css/bootstrap.css'); setHref2('../img/niko/css/example.css');setValue('niko')\" style='margin: 0 5px auto; background-color: #f3d4df;'>�s���N</button>";
					$txt .= "<button type='button' class=\"btn btn-default\" onclick=\"setHref('../img/rin/css/bootstrap.css'); setHref2('../img/rin/css/example.css');setValue('rin')\" style='margin: 0 5px auto; background-color: #ffff99;'>���F</button>";
					$txt .= "<button type='button' class=\"btn btn-default\" onclick=\"setHref('../img/umi/css/bootstrap.css'); setHref2('../img/umi/css/example.css');setValue('umi')\" style='margin: 0 5px auto;background-color: #add8ff;'>�F</button>";
					$txt .= "<button type='button' class=\"btn btn-default\" onclick=\"setHref('../img/frandre/css/bootstrap.css'); setHref2('../img/frandre/css/example.css');setValue('frandre')\" style='margin: 0 5px auto; background-color: #dd4814;'>�ԐF</button>";
					$txt .= '</div><div class="form-group pull-right">';
					$txt .= "<button type='submit' value='niko' class='btn btn-danger' id='csstype' name='csstype' style='margin: 0 10px auto'>�m��</button></div>";
					$txt .= "</form>";
					
					echo_panel("Memoria�̃e�[�}�ҏW", $txt, "info");
					

					
					//��{�I�Ȑݒ荀�ڂ̍X�V
					$keeper_theme = readCsvFile2($ini['dirWin'].'/data/todo_keeper_theme.csv');
					$txt = "<form class='form-horizontal' method='post' action='./settings.php'>";
					$txt .= '<div class="form-group">';
					$txt .= '<label class="control-label">����</label>';
					$txt .= '<input type="text" class="form-control" name="myname" placeholder="�����i�c���j" value="'.$ini['myname'].'">';
					//$txt .= '<span id="helpBlock" class="help-block">��ɏT��ŗ��p</span>';
					$txt .= "</div>";
					$txt .= '<div class="form-group">';
					$txt .= '<label class="control-label">�T��̈���</label>';
					$txt .= '<input type="text" class="form-control" name="weeklyTo" placeholder="�Z���Z���l" value="'.$ini['weeklyTo'].'">';
					$txt .= "</div>";
					$txt .= '<div class="form-group">';
					$txt .= '<label class="control-label">�T��̃G�N�Z���̃p�X</label>';
					//$txt .= '<input type="text" class="form-control" name="thema1" placeholder="����������������<br>��������������" value="'.$ini['thema1'].'">';
					$txt .= '<textarea placeholder="�T��̃G�N�Z���̃p�X" rows="3" class="form-control" name="thema1">'.str_replace("<br>","\r\n",$ini['thema1'] ).'</textarea>';
					//$txt .= '<span id="helpBlock" class="help-block"></span>';
					$txt .= "</div>";
					
					$txt .= '<div class="form-group">';
					$txt .= '<label class="control-label">�C���V�f���gID</label>';
					$txt .= "<select class='form-control' name='incidentID'>";
					$txt .= "<option value='0'>���ԊǗ��e�[�}�̑I��</option>";
					for($i=1;$i<count($keeper_theme);$i++) {
						if($ini['incidentID'] == $keeper_theme[$i]['id']) {
							$txt .= "<option value='{$keeper_theme[$i]['id']}' selected>{$keeper_theme[$i]['�e�[�}']}</option>";
						} else {
							$txt .= "<option value='{$keeper_theme[$i]['id']}'>{$keeper_theme[$i]['�e�[�}']}</option>";//col-sm-2
						}
					}
					$txt .= "</select>";
					$txt .= "</div>";
					$txt .= '<div class="form-group">';
					$txt .= '<label class="control-label">�C���V�f���gKPI</label>';
					$txt .= '<input type="text" class="form-control" name="incidentKPI" value="'.$ini['incidentKPI'].'">';
					$txt .= "</div>";
					
					$txt .= '<div class="form-group">';
					$txt .= '<label class="control-label">�T�[�r�X���PID</label>';
					$txt .= "<select class='form-control' name='servicesID'>";
					$txt .= "<option value='0'>���ԊǗ��e�[�}�̑I��</option>";
					for($i=1;$i<count($keeper_theme);$i++) {
						if($ini['servicesID'] == $keeper_theme[$i]['id']) {
							$txt .= "<option value='{$keeper_theme[$i]['id']}' selected>{$keeper_theme[$i]['�e�[�}']}</option>";
						} else {
							$txt .= "<option value='{$keeper_theme[$i]['id']}'>{$keeper_theme[$i]['�e�[�}']}</option>";//col-sm-2
						}
					}
					$txt .= "</select>";
					$txt .= "</div>";
					$txt .= '<div class="form-group">';
					$txt .= '<label class="control-label">�T�[�r�X���PKPI</label>';
					$txt .= '<input type="text" class="form-control" name="servicesKPI" value="'.$ini['servicesKPI'].'">';
					$txt .= "</div>";
					
					$txt .= '<div class="form-group pull-right">';
					$txt .= "<button type='submit' class='btn btn-danger' id='default-ini' name='default-ini' style='margin: 0 10px auto'>�X�V</button></div>";
					$txt .= "</form>";
					
					echo_panel("��{�I�Ȑݒ荀�ڂ̍X�V(��ɏT��ŗ��p)", $txt, "info");
					
					//data�t�@�C���̍X�V
					if($ini['datavarsion'] == "20180716") $txt = "�f�[�^�͍ŐV�̏�Ԃł�";
					else {
						$txt = "�f�[�^�̍X�V���K�v�ł��B���̃o�[�W������{$ini['datavarsion']}���ł��B<br><br>";
						if($ini['datavarsion'] == "20180707") {
							$txt .= '<div id="sampleWrap">';
							$txt .= '<a href="/Memoria/pages/settings/20180716.php" class="btn btn-danger btn-block btn-sm">var.20180716�X�V</a>';
							$txt .= '</div>';
						}
					}
					echo_panel("data�t�@�C���̍X�V", $txt, "info");
				?>
				
				<!--
				<div class="basedon small">
					<span class="last-version"></span>todo.csv�̍X�Vver+Order<span class="base-version"></span>
				</div>
				<div id="sampleWrap">
					<a href="/Memoria/pages/settings/PlusOrder.php" class="btn btn-danger btn-block btn-sm">�X�V</a>
				</div>
				<div class="basedon small">
					<span class="last-version"></span>working.csv�̍X�Vver+periodically<span class="base-version"></span>
				</div>
				<div id="sampleWrap">
					<a href="/Memoria/pages/settings/xxx_20171022.php" class="btn btn-danger btn-block btn-sm">�X�V</a>
				</div>
				<div class="basedon small">
					<span class="last-version"></span>todo.csv�̍X�Vver+������邱��<span class="base-version"></span>
				</div>
				<div id="sampleWrap">
					<a href="/Memoria/pages/settings/PlusTodayDo.php" class="btn btn-danger btn-block btn-sm">�X�V</a>
				</div>
				<div class="basedon small">
					<span class="last-version"></span>todo.csv�̍X�Vver+�e�[�}�Ή��A�e�[�}�T�v<span class="base-version"></span>
				</div>
				<div id="sampleWrap">
					<a href="/Memoria/pages/settings/xxx_20180507.php" class="btn btn-danger btn-block btn-sm">�X�V</a>
				</div>
				
				<div class="basedon small">
					<span class="last-version"></span>todo���X�g�𕪂���<span class="base-version"></span>
				</div>
				<div id="sampleWrap">
					<a href="/Memoria/pages/settings/makeBK.php" class="btn btn-danger btn-block btn-sm">�X�V</a>
				</div>
				<div class="basedon small">
					<span class="last-version"></span>�S���ǉ�<span class="base-version"></span>
				</div>
				<div id="sampleWrap">
					<a href="/Memoria/pages/settings/Pluspeople.php" class="btn btn-danger btn-block btn-sm">�X�V</a>
				</div>
				<div class="basedon small">
					<span class="last-version"></span>�T����C��<span class="base-version"></span>
				</div>
				<div id="sampleWrap">
					<a href="/Memoria/pages/settings/makeWeeklycsv.php" class="btn btn-danger btn-block btn-sm">�X�V</a>
				</div>
				-->
			</div>
		</div>
	</div>
</div>

<?php
	include($ini['dirWin'].'/pages/footer.php');
?>
<script>
	window.onload = function(){
			document.getElementsByClassName('setting')[0].classList.add('active');
	}
</script>
<script type="text/javascript">
function setHref( $href ) {
		jQuery( '#sampleLink' ).attr( 'href', $href );
}
function setHref2( $href ) {
		jQuery( '#sampleLink2' ).attr( 'href', $href );
}setValue('honoka')
function setValue( iro ) {
		document.getElementById("csstype").value=iro;
}
</script>
</body>
</html>
