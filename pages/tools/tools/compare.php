<?php
	header("Content-type: text/plain; charset=SJIS-win");
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\..\data\config.ini');
	include($ini['dirWin'].'/pages/function.php');
	
	if(isset($_POST['txtA'])) $txtA = mb_convert_encoding($_POST['txtA'], "SJIS-win", "UTF-8");
	else $txtA = "";
	if(isset($_POST['txtB'])) $txtB = mb_convert_encoding($_POST['txtB'], "SJIS-win", "UTF-8");
	else $txtB = "";
	
	
	$txtA = str_replace("\n","<br>",$txtA );
	$txtB = str_replace("\n","<br>",$txtB );
	if(strpos($txtA , '<br>') !== false && strpos($txtB, '<br>') !== false) {
		//echo "�f�[�^������܂�";
		
		$arrayA = explode("<br>", $txtA);
		$arrayB = explode("<br>", $txtB);
		
		$compareA = "";
		$compareB = "";
		$compareAB = "";
		
		$array = array();
		for($i=0; $i<count($arrayA); $i++) {
			$flug = 0;
			for($j=0; $j<count($arrayB); $j++) {
				if($_POST['type'] == "equal" && equal_word_str($arrayA[$i], $arrayB[$j])) $flug = 1;
				if($_POST['type'] == "allequal" && allequal_word_str($arrayA[$i], $arrayB[$j])) $flug = 1;
			}
			
			
			if($flug == 0 && $arrayA[$i] != "" && serch_word($arrayA[$i], $array)==0) {
				$compareA .= $arrayA[$i]."<br>";
				$array[count($array)] = $arrayA[$i];
			}
			else if($arrayA[$i] != "" && serch_word($arrayA[$i], $array)==0) {
				$compareAB .= $arrayA[$i]."<br>";
				$array[count($array)] = $arrayA[$i];
			}
		}
		
		for($i=0; $i<count($arrayB); $i++) {
			$flug = 0;
			for($j=0; $j<count($arrayA); $j++) {
				if($_POST['type'] == "equal" && equal_word_str($arrayA[$j], $arrayB[$i])) $flug = 1;
				if($_POST['type'] == "allequal" && allequal_word_str($arrayA[$j], $arrayB[$i])) $flug = 1;
			}
			if($flug == 0 && $arrayB[$i] != "" && serch_word($arrayB[$i], $array)==0) {
				$compareB .= $arrayB[$i]."<br>";
				$array[count($array)] = $arrayB[$i];
			}
		}
		
		
		echo "<div class = 'col-xs-6'>";
		echo_panel("�e�L�X�g�G���AA�̂�", $compareA, "info");
		echo "</div><div class = 'col-xs-6'>";
		echo_panel("�e�L�X�g�G���AB�̂�", $compareB, "success");
		echo "</div><div class = 'col-xs-12'>";
		echo_panel("����", $compareAB, "warning");
		echo "</div>";

	} else {
		echo "�f�[�^������܂���B";

	}
?>

<div class="form-group" style="margin-bottom:0; position: fixed; bottom: 20px;right:0;width:1000px;">
	<div class="col-xs-offset-9 col-xs-3">
		<?php echo "<button type='button' class='btn btn-default btn-block' onclick='return_compareform(\"{$txtA}\", \"{$txtB}\")'>�߂�</button>"; ?>
	</div>
</div>