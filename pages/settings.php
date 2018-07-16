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
					//Memoriaのテーマ編集
					$txt = "<form class='form-horizontal' method='post' action='./settings.php'>";
					$txt .= '<div class="form-group">';
					$txt .= "<button type='button' class=\"btn btn-default\" onclick=\"setHref('../img/honoka/css/bootstrap.css'); setHref2('../img/honoka/css/example.css'); setValue('honoka')\" style='margin: 0 5px auto; background-color: #ffd700;'>オレンジ</button>";
					$txt .= "<button type='button' class=\"btn btn-default\" onclick=\"setHref('../img/niko/css/bootstrap.css'); setHref2('../img/niko/css/example.css');setValue('niko')\" style='margin: 0 5px auto; background-color: #f3d4df;'>ピンク</button>";
					$txt .= "<button type='button' class=\"btn btn-default\" onclick=\"setHref('../img/rin/css/bootstrap.css'); setHref2('../img/rin/css/example.css');setValue('rin')\" style='margin: 0 5px auto; background-color: #ffff99;'>黄色</button>";
					$txt .= "<button type='button' class=\"btn btn-default\" onclick=\"setHref('../img/umi/css/bootstrap.css'); setHref2('../img/umi/css/example.css');setValue('umi')\" style='margin: 0 5px auto;background-color: #add8ff;'>青色</button>";
					$txt .= "<button type='button' class=\"btn btn-default\" onclick=\"setHref('../img/frandre/css/bootstrap.css'); setHref2('../img/frandre/css/example.css');setValue('frandre')\" style='margin: 0 5px auto; background-color: #dd4814;'>赤色</button>";
					$txt .= '</div><div class="form-group pull-right">';
					$txt .= "<button type='submit' value='niko' class='btn btn-danger' id='csstype' name='csstype' style='margin: 0 10px auto'>確定</button></div>";
					$txt .= "</form>";
					
					echo_panel("Memoriaのテーマ編集", $txt, "info");
					

					
					//基本的な設定項目の更新
					$keeper_theme = readCsvFile2($ini['dirWin'].'/data/todo_keeper_theme.csv');
					$txt = "<form class='form-horizontal' method='post' action='./settings.php'>";
					$txt .= '<div class="form-group">';
					$txt .= '<label class="control-label">氏名</label>';
					$txt .= '<input type="text" class="form-control" name="myname" placeholder="氏名（苗字）" value="'.$ini['myname'].'">';
					//$txt .= '<span id="helpBlock" class="help-block">主に週報で利用</span>';
					$txt .= "</div>";
					$txt .= '<div class="form-group">';
					$txt .= '<label class="control-label">週報の宛先</label>';
					$txt .= '<input type="text" class="form-control" name="weeklyTo" placeholder="〇●〇●様" value="'.$ini['weeklyTo'].'">';
					$txt .= "</div>";
					$txt .= '<div class="form-group">';
					$txt .= '<label class="control-label">週報のエクセルのパス</label>';
					//$txt .= '<input type="text" class="form-control" name="thema1" placeholder="□□□□□□□□<br>□□□□□□□" value="'.$ini['thema1'].'">';
					$txt .= '<textarea placeholder="週報のエクセルのパス" rows="3" class="form-control" name="thema1">'.str_replace("<br>","\r\n",$ini['thema1'] ).'</textarea>';
					//$txt .= '<span id="helpBlock" class="help-block"></span>';
					$txt .= "</div>";
					
					$txt .= '<div class="form-group">';
					$txt .= '<label class="control-label">インシデントID</label>';
					$txt .= "<select class='form-control' name='incidentID'>";
					$txt .= "<option value='0'>時間管理テーマの選択</option>";
					for($i=1;$i<count($keeper_theme);$i++) {
						if($ini['incidentID'] == $keeper_theme[$i]['id']) {
							$txt .= "<option value='{$keeper_theme[$i]['id']}' selected>{$keeper_theme[$i]['テーマ']}</option>";
						} else {
							$txt .= "<option value='{$keeper_theme[$i]['id']}'>{$keeper_theme[$i]['テーマ']}</option>";//col-sm-2
						}
					}
					$txt .= "</select>";
					$txt .= "</div>";
					$txt .= '<div class="form-group">';
					$txt .= '<label class="control-label">インシデントKPI</label>';
					$txt .= '<input type="text" class="form-control" name="incidentKPI" value="'.$ini['incidentKPI'].'">';
					$txt .= "</div>";
					
					$txt .= '<div class="form-group">';
					$txt .= '<label class="control-label">サービス改善ID</label>';
					$txt .= "<select class='form-control' name='servicesID'>";
					$txt .= "<option value='0'>時間管理テーマの選択</option>";
					for($i=1;$i<count($keeper_theme);$i++) {
						if($ini['servicesID'] == $keeper_theme[$i]['id']) {
							$txt .= "<option value='{$keeper_theme[$i]['id']}' selected>{$keeper_theme[$i]['テーマ']}</option>";
						} else {
							$txt .= "<option value='{$keeper_theme[$i]['id']}'>{$keeper_theme[$i]['テーマ']}</option>";//col-sm-2
						}
					}
					$txt .= "</select>";
					$txt .= "</div>";
					$txt .= '<div class="form-group">';
					$txt .= '<label class="control-label">サービス改善KPI</label>';
					$txt .= '<input type="text" class="form-control" name="servicesKPI" value="'.$ini['servicesKPI'].'">';
					$txt .= "</div>";
					
					$txt .= '<div class="form-group pull-right">';
					$txt .= "<button type='submit' class='btn btn-danger' id='default-ini' name='default-ini' style='margin: 0 10px auto'>更新</button></div>";
					$txt .= "</form>";
					
					echo_panel("基本的な設定項目の更新(主に週報で利用)", $txt, "info");
					
					//dataファイルの更新
					if($ini['datavarsion'] == "20180716") $txt = "データは最新の状態です";
					else {
						$txt = "データの更新が必要です。今のバージョンは{$ini['datavarsion']}分です。<br><br>";
						if($ini['datavarsion'] == "20180707") {
							$txt .= '<div id="sampleWrap">';
							$txt .= '<a href="/Memoria/pages/settings/20180716.php" class="btn btn-danger btn-block btn-sm">var.20180716更新</a>';
							$txt .= '</div>';
						}
					}
					echo_panel("dataファイルの更新", $txt, "info");
				?>
				
				<!--
				<div class="basedon small">
					<span class="last-version"></span>todo.csvの更新ver+Order<span class="base-version"></span>
				</div>
				<div id="sampleWrap">
					<a href="/Memoria/pages/settings/PlusOrder.php" class="btn btn-danger btn-block btn-sm">更新</a>
				</div>
				<div class="basedon small">
					<span class="last-version"></span>working.csvの更新ver+periodically<span class="base-version"></span>
				</div>
				<div id="sampleWrap">
					<a href="/Memoria/pages/settings/xxx_20171022.php" class="btn btn-danger btn-block btn-sm">更新</a>
				</div>
				<div class="basedon small">
					<span class="last-version"></span>todo.csvの更新ver+今日やること<span class="base-version"></span>
				</div>
				<div id="sampleWrap">
					<a href="/Memoria/pages/settings/PlusTodayDo.php" class="btn btn-danger btn-block btn-sm">更新</a>
				</div>
				<div class="basedon small">
					<span class="last-version"></span>todo.csvの更新ver+テーマ対応、テーマ概要<span class="base-version"></span>
				</div>
				<div id="sampleWrap">
					<a href="/Memoria/pages/settings/xxx_20180507.php" class="btn btn-danger btn-block btn-sm">更新</a>
				</div>
				
				<div class="basedon small">
					<span class="last-version"></span>todoリストを分ける<span class="base-version"></span>
				</div>
				<div id="sampleWrap">
					<a href="/Memoria/pages/settings/makeBK.php" class="btn btn-danger btn-block btn-sm">更新</a>
				</div>
				<div class="basedon small">
					<span class="last-version"></span>担当追加<span class="base-version"></span>
				</div>
				<div id="sampleWrap">
					<a href="/Memoria/pages/settings/Pluspeople.php" class="btn btn-danger btn-block btn-sm">更新</a>
				</div>
				<div class="basedon small">
					<span class="last-version"></span>週報情報修正<span class="base-version"></span>
				</div>
				<div id="sampleWrap">
					<a href="/Memoria/pages/settings/makeWeeklycsv.php" class="btn btn-danger btn-block btn-sm">更新</a>
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
