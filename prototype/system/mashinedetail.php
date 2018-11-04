<?php

	$mashine = readCsvFile2($ini['dirWin'].'/prototype/data/equipment.csv');
	
	$os = readCsvFile2($ini['dirWin'].'/prototype/data/os.csv');
	$kiban = readCsvFile2($ini['dirWin'].'/prototype/data/kiban.csv');
	$equipmentStatus = readCsvFile2($ini['dirWin'].'/prototype/data/equipmentStatus.csv');
	$equipmentStatus2 = readCsvFile2($ini['dirWin'].'/prototype/data/equipmentStatus2.csv');
	$domain  = readCsvFile2($ini['dirWin'].'/prototype/data/domain.csv');
	$equipmentType = readCsvFile2($ini['dirWin'].'/prototype/data/equipmentType.csv');
	$where = readCsvFile2($ini['dirWin'].'/prototype/data/where.csv');
	$connext = readCsvFile2($ini['dirWin'].'/prototype/data/connext.csv');
	$Department = readCsvFile2($ini['dirWin'].'/prototype/data/Department.csv');
	
	
	echo "<h1>".$mashine[$_GET['mashineid']]['—p“r']."</h1>";
?>