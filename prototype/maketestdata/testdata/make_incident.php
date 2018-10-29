<?php
	header("Content-type: text/html; charset=SJIS-win");
	date_default_timezone_set('Asia/Tokyo');
	if(!isset($ini)) $ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\..\data\config.ini');
	include_once($ini['dirWin'].'/pages/function.php');
	
	
	$incident = readCsvFile2($ini['dirWin'].'/prototype/data/incident.csv');
	$tmp = $incident[0];
	$incident = array();
	$incident[0] = $tmp;
	
	$incidentEquipment = readCsvFile2($ini['dirWin'].'/prototype/data/incidentEquipment.csv');
	$tmp = $incidentEquipment[0];
	$incidentEquipment = array();
	$incidentEquipment[0] = $tmp;
	
	$incident = make_incident($incident, $incidentEquipment, $ini);
	writeCsvFile2($ini['dirWin'].'/prototype/data/incident.csv', $incident);
	echo "<h4>finishインシデント情報!</h4>";
	
	
function make_incident($incident, $incidentEquipment, $ini) {
	
	$mashine = readCsvFile2($ini['dirWin'].'/prototype/data/equipment.csv');
	$incidentStatus = readCsvFile2($ini['dirWin'].'/prototype/data/incidentStatus.csv');
	$incidentType = readCsvFile2($ini['dirWin'].'/prototype/data/incidentType.csv');
	
	for($i=1; $i<500; $i++) {
	
		$tmpType = mt_rand(1, 5);
		$tmpmashine = mt_rand(1, (count($mashine)-1));
		$tmpStatus = mt_rand(1, 20);
		if($tmpStatus <= 15) $tmpStatus = 5;
		else if($tmpStatus <= 17) $tmpStatus = 4;
		else if($tmpStatus <= 18) $tmpStatus = 3;
		else if($tmpStatus <= 19) $tmpStatus = 2;
		else if($tmpStatus <= 20) $tmpStatus = 1;
		
		$id = count($incident);
		$incident[$id]['インシデントID'] = $id;
		$incident[$id]['インシデント内容'] = $mashine[$tmpmashine]['用途'] . $incidentType[$tmpType]['内容'];
		$incident[$id]['インシデントステータスID'] = $tmpStatus;
		$incident[$id]['インシデントタイプID'] = $tmpType;
		$incident[$id]['インシデント発生日'] = date("Y/m/d H:i:s", mt_rand(strtotime($mashine[$tmpmashine]['導入日']), strtotime( "now" )));
		
		$ide = count($incidentEquipment);
		$incidentEquipment[$ide]['設備ID'] = $tmpmashine;
		$incidentEquipment[$ide]['インシデントID'] = $id;
	}
	$sort = array(); 
	foreach ((array) $incident as $key => $value) {
		$sort[$key] = $value['インシデント発生日'];
	}

	array_multisort($sort, SORT_ASC, $incident);
	$num = (count($incident)-1);
	$tmp = array();
	$tmp[0] = $incident[$num];
	$incident = array_merge($tmp, $incident);
	
	$num = (count($incident)-1);
	
	
	//writeCsvFile2($ini['dirWin'].'/prototype/data/work.csv', $incident);
	
	for($i=1; $i<count($incident); $i++) {
		$incident[$i]['インシデントID'] = $i;
	}
	
	unset($incident[$num]);
	writeCsvFile2($ini['dirWin'].'/prototype/data/incidentEquipment.csv', $incidentEquipment);
	return $incident;
}


?>