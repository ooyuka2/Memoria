<?php
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	$pagetype = "prototype";
	include_once($ini['dirWin'].'/pages/function.php');
	date_default_timezone_set('Asia/Tokyo');
	
	$staff = readCsvFile2($link_data.'/staff.csv');
	$workType = readCsvFile2($link_data.'/workType.csv');
	
	
	if(isset($_GET['type']) && $_GET['type'] == "new") {
		$id=count($workType);
		$name = "";
		$furi = "";
		$summary = "";
		$detail = "";
		$syurui = 2;
	} else if(isset($_GET['type']) && $_GET['type'] == "change" && isset($_GET['p'])) {
		$id=$_GET['p'];
		$name = $dictionary[$_GET['p']]['name'];
		$furi = $dictionary[$_GET['p']]['furi'];
		$summary = $dictionary[$_GET['p']]['summary'];
		$detail = $dictionary[$_GET['p']]['detail'];
		$syurui = $dictionary[$_GET['p']]['syurui'];
	}
	
	
?>
<div style='width:90%; margin: 0 auto'>
<h1>��Ɛ\�����̍쐬</h1>
<?php
	echo "<form class='form-horizontal container-fluid' method='post' action='./work/makeWork.php?toroku=" . $id . "' style='padding-top: 50px;'>";
?>

	<div class="form-group row">
		<label for="staticEmail" class="col-1 col-form-label">�\���ҁF</label>
		<div class="col-11">
			<input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?php echo $_SESSION['staff']['�c��'].' '.$_SESSION['staff']['���O']; ?>">
		</div>

		<label for="staticEmail" class="col-1 col-form-label">��ƎҁF</label>
		<div class="col-11">
			<input type="text"  class="form-control" value="">
		</div>

		<label for="staticEmail" class="col-1 col-form-label">��Ƃ̎�ށF</label>
		<div class="col-2">
			<span class="custom-dropdown">
				<select name="syurui" id="">
					<?php
						for($i=1;$i<count($workType);$i++) {
							if($syurui==$i)
								echo "<option value='{$i}'selected>{$workType[$i]['��ƃ^�C�v']}</option>";
							else echo "<option value='{$i}'>{$workType[$i]['��ƃ^�C�v']}</option>";
						}
					?>
				</select>
			</span>
		</div>
		<label for="staticEmail" class="col-1 col-form-label">���̑��̗��R�F</label>
		<div class="col-8">
			<input type="text"  class="form-control" value="">
		</div>
		
		<label for="staticEmail" class="col-1 col-form-label">�Ώېݔ��F</label>
		<div class="col-11">
			<input type="text"  class="form-control" value="">
		</div>
		
                <label for="staticEmail" class="col-2 col-form-label">���p���郆�[�U�[�F</label>
                <div class="form-check col-1">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" value="" checked>
                    �������[�U�[
                  </label>
                </div>
                <div class="form-check col-1">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" value="">
                    ���̑��̃��[�U�[
                  </label>
                </div>
		<label for="staticEmail" class="col-2 col-form-label">���̑��̃��[�U�[�F</label>
		<div class="col-6">
			<input type="text"  class="form-control" value="">
		</div>
		
                <label for="staticEmail" class="col-2 col-form-label">�Ď��̃����e�i���X���[�h�F</label>
                <div class="form-check col-1">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                    ����
                  </label>
                </div>
                <div class="form-check col-1">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="option2">
                    �Ȃ�
                  </label>
                </div>
		<label for="staticEmail" class="col-2 col-form-label">�����e�i���X�ΏہF</label>
		<div class="col-6">
			<input type="text"  class="form-control" value="">
		</div>
		
		<div class='form-group col-12'>
			<label class='' for='summary'>��Ƃ̏ڍׁF</label>
			<div class='input-group'>
				<?php echo "<textarea class='form-control input-normal input-sm' name='summary' id='summary'>{$summary}</textarea>"; ?>
			</div>
		</div>
		
		<div class='form-group col-12'>
			<label for="exampleInputFile">�Y�t����</label>
			<div class='input-group'>
				<input type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
			</div>
		</div>
		
	</div>

	<div class='row'>
		<div class='form-group col-11'>
			<button type='reset' class='btn btn-default pull-right'>���Z�b�g</button>
		</div>
		<div class='form-group col-1'>
			<button type='submit' class='btn btn-default pull-right'>���M</button>
		</div>
	</div>

</form>
</div>