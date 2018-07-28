<?php
	header("Content-type: text/html; charset=SJIS-win");
	if(!isset($ini)) $ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\..\data\config.ini');
	include_once($ini['dirWin'].'/pages/function.php');
	
	if(file_exists($ini['dirWin'].'/data/tools/temp.php')) {
		$program = file_get_contents($ini['dirWin'].'/data/tools/temp.php');
		$csvtxt = file_get_contents($ini['dirWin'].'/data/tools/tool_data/tempcsv.csv');
		if($csvtxt == "" || $csvtxt == "\n") $CSV[0][0] = "";
		else $CSV = readCsvFile($ini['dirWin'].'/data/tools/tool_data/tempcsv.csv');
	} else {
		$program = file_get_contents($ini['dirWin'].'/pages/tools/tools/template_php.php');
		$CSV[0][0] = "";
	}
	

?>
<div class="container-fluid">
	<?php
		echo "<form class='form-horizontal' id='program_form' method='post' action='".$ini['dirhtml'].'/pages/tools/tools/playground_save.php'."'>";
	?>
		<legend>置換ツール的な？</legend>
		<div class="form-group">
			<textarea rows="30" class="form-control" name="program" onKeyDown='changetextform(document.getElementsByName("program"));'><?php echo $program;?></textarea>
		</div>

		<legend>CSV形式で書いてね</legend>
		<div class="form-group">
			<textarea rows="30" class="form-control" name="CSV" onKeyDown='changetextform(document.getElementsByName("CSV"));'><?php 
			for($i=0; $i<count($CSV); $i++) {
				for($j=0; $j<count($CSV[$i]); $j++) {
					if($j!=0) echo ",";
					echo $CSV[$i][$j];
				}
				echo "\r\n";
			}
	
?></textarea>
		</div>
		<div class="form-group" style="margin-bottom:0; position: fixed; bottom: 20px;right:0;width:1000px;">
			<div class="col-xs-offset-6 col-xs-3">
				<button type="reset" class="btn btn-default btn-block">Reset</button>
			</div>
			<div class="col-xs-3">
			<?php
				echo "<button type='submit' class='btn btn-primary btn-block' id='submitbtn' onClick='playground_save()'>保存</button>";
				//onClick='read_tool_php(\"".$ini['dirhtml'].'/pages/tools/tools/playground_save.php'."\", \"resulttab\")'
			?>
			</div>

		</div>
	</form>
</div>