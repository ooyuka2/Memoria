<?php
	ini_set('display_errors', 0);
	
	$tablecsv = $ini['dirWin'].'/data/tables/' . $_GET['table'] . '.csv';
	$tablejson = $ini['dirWin'].'/data/tables/' . $_GET['table'] . '.json';
	
	$table = readCsvFile2($tablecsv);
	
	make_jsonfile($table, $tablecsv, $tablejson);
	
?>
<div class="col-12">
	<div class='table-responsive container-fluid'>
		<table class='table table-striped table-hover table-sm w-auto' id='tablespage_json'  style='overflow-x:auto'>
			<thead>
				<tr>
					<?php
						foreach ($table[0] as $key => $val) {
							echo "<th style='min-width:100px'>". $table[0][$key] . "</th>";
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
