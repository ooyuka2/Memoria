<?php
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\data\config.ini');
		session_start();
		header("Content-type: text/html; charset=SJIS-win");
	if(!isset($_SESSION['staff']['id'])) {
		header( "Location: ".$ini['dirhtml']."/prototype/login.php" );
		exit();
	}
	$pagetype = "MDBpages";
	include_once($ini['dirWin'].'/pages/function.php');

	if(isset($_POST["csstype"])) {
		$_SESSION['staff']['style'] = $_POST['csstype'];
		
		$staff = readCsvFile2($ini['dirWin'].'/prototype/data/staff.csv');
		for($i=1; $i<count($staff);$i++) {
			if($_SESSION['staff']['id'] == $staff[$i]['id']) {
				$staff[$i]['style'] = $_POST['csstype'];
			}
		}
		writeCsvFile($ini['dirWin'].'/prototype/data/staff.csv', $staff);
		header( "Location: ".$ini['dirhtml']."/prototype/settings.php" );
		exit();
	}

	include($ini['dirWin'].'/prototype/hedder.php');
?>

<body class="drawer drawer--left">
<?php
	include($ini['dirWin'].'/prototype/navigation.php');
	if(!isset($_GET['page'])) $_GET['page'] = "top";
?>

<!--Main Layout-->
<div class="main-contents">
<div class="pull-left drawer-hover"></div>
<main class="row">
<div class="col-5 row container-fluid">
<?php
	include($ini['dirWin'].'/MDBpages/settings/expaple.php');
?>
</div>
<div class="col-7"><!--	outline -->
	<h1>Setting</h1>
	<?php
		//Memoria�̃e�[�}�ҏW
		$txt = "<form class='form-horizontal' method='post' action='./settings.php'>";
		$txt .= '<div class="form-group">';
		$txt .= "<button type='button' class=\"btn\" onclick=\"setHref('/Memoria/img/bootstrap4/MDB/css/honoka.css'); setValue('honoka')\" style='margin: 0 5px auto; background-color: #f8b500;'>�I�����W</button>";
		$txt .= "<button type='button' class=\"btn\" onclick=\"setHref('/Memoria/img/bootstrap4/MDB/css/niko.css'); setValue('niko')\" style='margin: 0 5px auto; background-color: #f3d4df;'>�s���N</button>";
		$txt .= "<button type='button' class=\"btn\" onclick=\"setHref('/Memoria/img/bootstrap4/MDB/css/rin.css'); setValue('rin')\" style='margin: 0 5px auto; background-color: #ffdc00;'>���F</button>";
		$txt .= "<button type='button' class=\"btn\" onclick=\"setHref('/Memoria/img/bootstrap4/MDB/css/umi.css'); setValue('umi')\" style='margin: 0 5px auto;background-color: #add8ff;'>�F</button>";
		$txt .= "<button type='button' class=\"btn\" onclick=\"setHref('/Memoria/img/bootstrap4/MDB/css/frandre.css'); setValue('frandre')\" style='margin: 0 5px auto; background-color: #dd4814;'>�ԐF</button>";
		$txt .= "<button type='button' class=\"btn\" onclick=\"setHref(''); setValue('white')\" style='margin: 0 5px auto; background-color: #000;'>���m�N��</button>";
		$txt .= '</div><div class="form-group pull-right">';
		$txt .= "<button type='submit' value='niko' class='btn btn-danger' id='csstype' name='csstype' style='margin: 0 10px auto'>�m��</button></div>";
		$txt .= "</form>";
		
		echo_panel("Memoria�̃e�[�}�ҏW", $txt, "info");
		

		/*
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
		$txt .= '<label class="control-label">�T��\��KPI</label>';
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
		$txt .= '<label class="control-label">�T�[�r�X���P�e�[�}</label>';
		$txt .= '<input type="text" class="form-control" name="servicesTheme" value="'.$ini['servicesTheme'].'">';
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
		$txt .= '<label class="control-label">�C���V�f���g�e�[�}</label>';
		$txt .= '<input type="text" class="form-control" name="incidentTheme" value="'.$ini['incidentTheme'].'">';
		$txt .= "</div>";
		
		$txt .= '<div class="form-group pull-right">';
		$txt .= "<button type='submit' class='btn btn-danger' id='default-ini' name='default-ini' style='margin: 0 10px auto'>�X�V</button></div>";
		$txt .= "</form>";
		
		echo_panel("��{�I�Ȑݒ荀�ڂ̍X�V(��ɏT��ŗ��p)", $txt, "info");
		
		//data�t�@�C���̍X�V
		if($ini['datavarsion'] == "20181015") $txt = "�f�[�^�͍ŐV�̏�Ԃł�";
		else {
			$txt = "�f�[�^�̍X�V���K�v�ł��B���̃o�[�W������{$ini['datavarsion']}���ł��B<br><br>";
			if($ini['datavarsion'] == "20180717") {
				$txt .= '<div id="sampleWrap">';
				$txt .= '<a href="/Memoria/pages/settings/20181015.php" class="btn btn-danger btn-block btn-sm">var.20181015�X�V</a>';
				$txt .= '</div>';
			} else if($ini['datavarsion'] == "20180707") {
				$txt .= '<div id="sampleWrap">';
				$txt .= '<a href="/Memoria/pages/settings/20180716.php" class="btn btn-danger btn-block btn-sm">var.20180716�X�V</a>';
				$txt .= '</div>';
			} else if($ini['datavarsion'] == "20180716") {
				$txt .= '<div id="sampleWrap">';
				$txt .= '<a href="/Memoria/pages/settings/20180717.php" class="btn btn-danger btn-block btn-sm">var.20180717�X�V</a>';
				$txt .= '</div>';
			}
		}
		echo_panel("data�t�@�C���̍X�V", $txt, "info");
		*/
	?>
	
	<!--
	<div class="basedon small">
		<span class="last-version"></span>todo.csv�̍X�Vver+Order<span class="base-version"></span>
	</div>
	<div id="sampleWrap">
		<a href="/Memoria/prototype/settings/PlusOrder.php" class="btn btn-danger btn-block btn-sm">�X�V</a>
	</div>
	<div class="basedon small">
		<span class="last-version"></span>working.csv�̍X�Vver+periodically<span class="base-version"></span>
	</div>
	<div id="sampleWrap">
		<a href="/Memoria/prototype/settings/xxx_20171022.php" class="btn btn-danger btn-block btn-sm">�X�V</a>
	</div>
	<div class="basedon small">
		<span class="last-version"></span>todo.csv�̍X�Vver+������邱��<span class="base-version"></span>
	</div>
	<div id="sampleWrap">
		<a href="/Memoria/prototype/settings/PlusTodayDo.php" class="btn btn-danger btn-block btn-sm">�X�V</a>
	</div>
	<div class="basedon small">
		<span class="last-version"></span>todo.csv�̍X�Vver+�e�[�}�Ή��A�e�[�}�T�v<span class="base-version"></span>
	</div>
	<div id="sampleWrap">
		<a href="/Memoria/prototype/settings/xxx_20180507.php" class="btn btn-danger btn-block btn-sm">�X�V</a>
	</div>
	
	<div class="basedon small">
		<span class="last-version"></span>todo���X�g�𕪂���<span class="base-version"></span>
	</div>
	<div id="sampleWrap">
		<a href="/Memoria/prototype/settings/makeBK.php" class="btn btn-danger btn-block btn-sm">�X�V</a>
	</div>
	<div class="basedon small">
		<span class="last-version"></span>�S���ǉ�<span class="base-version"></span>
	</div>
	<div id="sampleWrap">
		<a href="/Memoria/prototype/settings/Pluspeople.php" class="btn btn-danger btn-block btn-sm">�X�V</a>
	</div>
	<div class="basedon small">
		<span class="last-version"></span>�T����C��<span class="base-version"></span>
	</div>
	<div id="sampleWrap">
		<a href="/Memoria/prototype/settings/makeWeeklycsv.php" class="btn btn-danger btn-block btn-sm">�X�V</a>
	</div>
	-->
</div>

</main>
</div>
<!--Main Layout-->
<?php
	include($ini['dirWin'].'/prototype/footer.php');
?>

<script>
	$(document).ready(function() {
		//document.getElementsByClassName('settingsnav')[0].classList.add('activenav');
		navOnload();
	});
	
function setValue( iro ) {
		document.getElementById("csstype").value=iro;
}

//bar
var ctxB = document.getElementById("barChart").getContext('2d');
var myBarChart = new Chart(ctxB, {
    type: 'bar',
    data: {
        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>

</body>
</html>
