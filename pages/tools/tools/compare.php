<?php
	header("Content-type: text/plain; charset=SJIS-win");
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\..\data\config.ini');
	include($ini['dirWin'].'/pages/function.php');
	
	if(isset($_POST['txtA'])) $txtA = mb_convert_encoding($_POST['txtA'], "SJIS-win", "UTF-8");
	else $txtA = "";
	if(isset($_POST['txtB'])) $txtB = mb_convert_encoding($_POST['txtB'], "SJIS-win", "UTF-8");
	else $txtB = "";
	
	
	if(strpos($txtA , '\r\n') !== false && strpos($txtB, '\r\n') !== false) {
		echo "データがあります";

	} else {
		echo "データが足りません。";

	}
	
	/*
	
	
	
		if($_POST['type'] == "equal") 
		else 
	
	
	
	
	*/
?>

<div class="form-group" style="margin-bottom:0; position: fixed; bottom: 20px;right:0;width:1000px;">
	<div class="col-xs-offset-9 col-xs-3">
		<?php echo "<button type='button' class='btn btn-default btn-block' onclick='return_compareform(\"{$txtA}\", \"{$txtB}\")'>戻る</button>"; ?>
	</div>
</div>