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
<h1>作業申請書の作成</h1>
<?php
	echo "<form class='form-horizontal container-fluid' method='post' action='./work/makeWork.php?toroku=" . $id . "' style='padding-top: 50px;'>";
?>

	<div class="form-group row">
		<label for="staticEmail" class="col-1 col-form-label">申請者：</label>
		<div class="col-11">
			<input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?php echo $_SESSION['staff']['苗字'].' '.$_SESSION['staff']['名前']; ?>">
		</div>

		<label for="staticEmail" class="col-1 col-form-label">作業者：</label>
		<div class="col-11">
			<input type="text"  class="form-control" value="">
		</div>

		<label for="staticEmail" class="col-1 col-form-label">作業の種類：</label>
		<div class="col-2">
			<span class="custom-dropdown">
				<select name="syurui" id="">
					<?php
						for($i=1;$i<count($workType);$i++) {
							if($syurui==$i)
								echo "<option value='{$i}'selected>{$workType[$i]['作業タイプ']}</option>";
							else echo "<option value='{$i}'>{$workType[$i]['作業タイプ']}</option>";
						}
					?>
				</select>
			</span>
		</div>
		<label for="staticEmail" class="col-1 col-form-label">その他の理由：</label>
		<div class="col-8">
			<input type="text"  class="form-control" value="">
		</div>
		
		<label for="staticEmail" class="col-1 col-form-label">対象設備：</label>
		<div class="col-11">
			<input type="text"  class="form-control" value="">
		</div>
		
                <label for="staticEmail" class="col-2 col-form-label">利用するユーザー：</label>
                <div class="form-check col-1">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" value="" checked>
                    特権ユーザー
                  </label>
                </div>
                <div class="form-check col-1">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" value="">
                    その他のユーザー
                  </label>
                </div>
		<label for="staticEmail" class="col-2 col-form-label">その他のユーザー：</label>
		<div class="col-6">
			<input type="text"  class="form-control" value="">
		</div>
		
                <label for="staticEmail" class="col-2 col-form-label">監視のメンテナンスモード：</label>
                <div class="form-check col-1">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                    あり
                  </label>
                </div>
                <div class="form-check col-1">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="option2">
                    なし
                  </label>
                </div>
		<label for="staticEmail" class="col-2 col-form-label">メンテナンス対象：</label>
		<div class="col-6">
			<input type="text"  class="form-control" value="">
		</div>
		
		<div class='form-group col-12'>
			<label class='' for='summary'>作業の詳細：</label>
			<div class='input-group'>
				<?php echo "<textarea class='form-control input-normal input-sm' name='summary' id='summary'>{$summary}</textarea>"; ?>
			</div>
		</div>
		
		<div class='form-group col-12'>
			<label for="exampleInputFile">添付資料</label>
			<div class='input-group'>
				<input type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
			</div>
		</div>
		
	</div>

	<div class='row'>
		<div class='form-group col-11'>
			<button type='reset' class='btn btn-default pull-right'>リセット</button>
		</div>
		<div class='form-group col-1'>
			<button type='submit' class='btn btn-default pull-right'>送信</button>
		</div>
	</div>

</form>
</div>