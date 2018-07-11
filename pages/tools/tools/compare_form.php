<?php
	header("Content-type: text/plain; charset=SJIS-win");
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\..\data\config.ini');
	include($ini['dirWin'].'/pages/function.php');
	if(isset($_POST['txtA'])) {
		$txtA = $_POST['txtA'];
		$txtB = $_POST['txtB'];
	} else {
		$txtA = "";
		$txtB = "";
	}
?>


<div class="container-fluid">
	<form class='form-horizontal '>
		<div class="row">
			<div class="col-md-5">
				<legend>テキストエリアA</legend>
				<div class="form-group">
					<textarea placeholder="比較したい単語ごとに行を変える" rows="30" class="form-control" id="txtA" onKeyDown="changetextform(this);"><?php echo $txtA;?></textarea>
				</div>
			</div>
			<div class="col-md-1">
			</div>
			<div class="col-md-5">
				<legend>テキストエリアB</legend>
				<div class="form-group">
					<textarea placeholder=",やタグでは区切りません" rows="30" class="form-control" id="txtB" onKeyDown="changetextform(this);"><?php echo $txtB;?></textarea>
				</div>
			</div>
		</div>
	</form>
</div>

<div class="form-group" style="margin-bottom:0; position: fixed; bottom: 20px;right:0;width:1000px;">
	<div class="col-xs-offset-3 col-xs-3">
		<button type="button" class="btn btn-default btn-block" onClick="goto_compare();">文字列の一致判定</button>
	</div>
	<div class="col-xs-3">
		<button type="button" class="btn btn-primary btn-block" onClick="goto_compare();">文字列の完全一致判定</button>
	</div>
</div>
<div style="height: 100px"></div>
