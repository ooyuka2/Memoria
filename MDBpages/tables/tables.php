<div class="col-12">
	<div class='table-responsive container-fluid'>
		<table class='table table-striped table-hover table-sm ' id='tablespage'>
			<thead>
				<tr>
<?php
	ini_set('display_errors', 0);
	$table = readCsvFile($ini['dirWin'].'/data/tables/' . $_GET['table'] . '.csv');

	for($i = 0; $i<count($table[0]); $i++) {
		echo "<th>". $table[0][$i] . "</th>";
	}
?>

				</tr>
			</thead>
			<tbody>
<?php
	for($i = 1; $i<count($table); $i++) {
		echo "<tr>";
		for($j = 0; $j<count($table[0]); $j++) {
			echo "<td>" . $table[$i][$j] . "</td>";
		}
		echo "</tr>";
	}
	
?>

			</tbody>
		</table>
	</div>
</div>
