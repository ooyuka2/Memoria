<?php
	header("Content-type: text/plain; charset=SJIS-win");
	if(isset($_POST['pagetype'])) $pagetype = $_POST['pagetype'];
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\..\data\config.ini');
	include($ini['dirWin'].'/pages/function.php');
	if(isset($_POST['txtA'])) $txtA = mb_convert_encoding(str_replace("<br>","\r\n",$_POST['txtA'] ), "SJIS-win", "UTF-8");
	else $txtA = "";
	if(isset($_POST['txtB'])) $txtB = mb_convert_encoding(str_replace("<br>","\r\n",$_POST['txtB'] ), "SJIS-win", "UTF-8");
	else $txtB = "";
?>


<div class="container-fluid">
	<form class='form-horizontal '>
		<div class="row">
			<div class="col-md-5">
				<legend>�e�L�X�g�G���AA</legend>
				<div class="form-group">
					<textarea placeholder="��r�������P�ꂲ�Ƃɍs��ς���" rows="30" class="form-control" id="txtA" onKeyDown="changetextform(this);"><?php echo $txtA;?></textarea>
				</div>
			</div>
			<div class="col-md-1">
			</div>
			<div class="col-md-5">
				<legend>�e�L�X�g�G���AB</legend>
				<div class="form-group">
					<textarea placeholder=",��^�O�ł͋�؂�܂���" rows="30" class="form-control" id="txtB" onKeyDown="changetextform(this);"><?php echo $txtB;?></textarea>
				</div>
			</div>
		</div>
	</form>
</div>

<div class="form-group" style="margin-bottom:0; position: fixed; bottom: 20px;right:0;width:1000px;">
	<div class="col-xs-offset-6 col-xs-3">
		<button type="button" class="btn btn-default btn-block" onClick="goto_compare('equal');">������̈�v����</button>
	</div>
	<div class="col-xs-3">
		<button type="button" class="btn btn-primary btn-block" onClick="goto_compare('allequal');">������̊��S��v����</button>
	</div>
</div>
<div style="height: 100px"></div>
