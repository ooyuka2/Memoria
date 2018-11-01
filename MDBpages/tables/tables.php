<?php
	ini_set('display_errors', 0);
	
	$tablecsv = $ini['dirWin'].'/data/tables/' . $_GET['table'] . '.csv';
	$tablejson = $ini['dirWin'].'/data/tables/' . $_GET['table'] . '.json';
	
	$table = readCsvFile2($tablecsv);
	if(!file_exists ( $tablejson ) || filemtime ( $tablejson ) < filemtime ( $tablecsv )) { //
	
		for($i = 0; $i<count($table); $i++) {
			$json[$i] = $table[$i];
		}
		
		//print_r_pre($json);
		$value = "{\r\n	\"data\": [\r\n";
		//echo $value;
		for($i = 1; $i<count($json); $i++) {
			$value .= "		[\r\n";
			foreach ($json[$i] as $key => $val) {
				$value .= "			\"" . str_replace("	","@@", $json[$i][$key] ) . "\",\r\n"; //	
			}
			$value = substr_replace($value, '', -3, -2);
			$value .= "		],\r\n";
		}
		$value = substr_replace($value, '', -3, -2);
		$value .= "	]\r\n}";
		//echo $value;
		$value = mb_convert_encoding($value, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
		//require( $ini['dirWin'].'/js/ssp.class.php' );
		//$value = json_encode($value, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		file_put_contents($tablejson , $value);
		//var_dump(mb_convert_encoding($value, "SJIS-win", "ASCII,JIS,UTF-8,EUC-JP,SJIS, SJIS-win, Unicode"));
		
	}
?>
<div class="col-12">
	<div class='table-responsive container-fluid'>
		<table class='table table-striped table-hover table-sm' id='tablespage_json'>
			<thead>
				<tr>
<?php


	foreach ($table[0] as $key => $val) {
		echo "<th>". $table[0][$key] . "</th>";
	}
?>

				</tr>
			</thead>
			<tbody>
<?php
/*
	for($i = 1; $i<count($table); $i++) {
		echo "<tr>";
		for($j = 0; $j<count($table[0]); $j++) {
			echo "<td>" . $table[$i][$j] . "</td>";
		}
		echo "</tr>";
	}
*/
?>

			</tbody>
		</table>
	</div>
</div>
