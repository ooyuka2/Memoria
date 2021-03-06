<?php
	header("Content-type: text/html; charset=SJIS-win");
	date_default_timezone_set('Asia/Tokyo');
	if(!isset($ini)) $ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\..\data\config.ini');
	include_once($ini['dirWin'].'/pages/function.php');
	
	
	$work = readCsvFile2($ini['dirWin'].'/prototype/data/work.csv');
	$tmp = $work[0];
	$work = array();
	$work[0] = $tmp;
	
	$workUser = readCsvFile2($ini['dirWin'].'/prototype/data/workUser.csv');
	$tmp = $workUser[0];
	$workUser = array();
	$workUser[0] = $tmp;
	
	$workStaff = readCsvFile2($ini['dirWin'].'/prototype/data/workStaff.csv');
	$tmp = $workStaff[0];
	$workStaff = array();
	$workStaff[0] = $tmp;
	
	$workEquipment = readCsvFile2($ini['dirWin'].'/prototype/data/workEquipment.csv');
	$tmp = $workEquipment[0];
	$workEquipment = array();
	$workEquipment[0] = $tmp;
	
	for($i=0; $i<10; $i++) {
		
		$work = make_work_data($work, $workUser, $workStaff, $workEquipment, $ini, 1);

		$workUser = readCsvFile2($ini['dirWin'].'/prototype/data/workUser.csv');
		$workStaff = readCsvFile2($ini['dirWin'].'/prototype/data/workStaff.csv');
		$workEquipment = readCsvFile2($ini['dirWin'].'/prototype/data/workEquipment.csv');
		
		$work = make_work_data($work, $workUser, $workStaff, $workEquipment, $ini, 2);

		$workUser = readCsvFile2($ini['dirWin'].'/prototype/data/workUser.csv');
		$workStaff = readCsvFile2($ini['dirWin'].'/prototype/data/workStaff.csv');
		$workEquipment = readCsvFile2($ini['dirWin'].'/prototype/data/workEquipment.csv');
		
		$work = make_work_data($work, $workUser, $workStaff, $workEquipment, $ini, 3);

		$workUser = readCsvFile2($ini['dirWin'].'/prototype/data/workUser.csv');
		$workStaff = readCsvFile2($ini['dirWin'].'/prototype/data/workStaff.csv');
		$workEquipment = readCsvFile2($ini['dirWin'].'/prototype/data/workEquipment.csv');
		
		$work = make_work_data($work, $workUser, $workStaff, $workEquipment, $ini, 4);

		$workUser = readCsvFile2($ini['dirWin'].'/prototype/data/workUser.csv');
		$workStaff = readCsvFile2($ini['dirWin'].'/prototype/data/workStaff.csv');
		$workEquipment = readCsvFile2($ini['dirWin'].'/prototype/data/workEquipment.csv');
	}
	
	$sort = array(); 
	foreach ((array) $work as $key => $value) {
		$sort[$key] = $value['ìÆI¹ú'];
	}

	array_multisort($sort, SORT_ASC, $work);
	$num = (count($work)-1);
	$tmp = array();
	$tmp[0] = $work[$num];
	$work = array_merge($tmp, $work);
	
	$num = (count($work)-1);
	
	
	
	for($i=1; $i<count($work); $i++) {
		$work[$i]['ìÆ\¿ID'] = $i;
	}
	unset($work[$num]);
	writeCsvFile2($ini['dirWin'].'/prototype/data/work.csv', $work);
	echo "<h4>finishìÆîñ!</h4>";
	//print_r_pre($work);
	
	
function make_work_data($work, $workUser, $workStaff, $workEquipment, $ini, $workTypenum) {
	
	$mashine = readCsvFile2($ini['dirWin'].'/prototype/data/equipment.csv');
	$workType = readCsvFile2($ini['dirWin'].'/prototype/data/workType.csv');
	$staff = readCsvFile2($ini['dirWin'].'/prototype/data/staff.csv');
	$user = readCsvFile2($ini['dirWin'].'/prototype/data/user.csv');
	
	for($i=1; $i<count($mashine); $i++) {
		$ram = mt_rand(0, 10);
		if($ram != 0 && $ram <= 4) $workTypenum = $ram;
		if($ram <= 8) {
			$workid = count($work);
			$work[$workid]['ìÆ\¿ID'] = $workid;
			$work[$workid]['ìÆàe'] = "<br><br>";
			$work[$workid]['ìÆ\èJnú'] = date("Y/m/d H:i:s", mt_rand(strtotime($mashine[$i]['±üú']), strtotime( "now" )));
			$work[$workid]['ìÆ\èI¹ú'] = date($work[$workid]['ìÆ\èJnú'], strtotime("+ 7 days"));
			$work[$workid]['ìÆJnÔ'] = $work[$workid]['ìÆ\èJnú'];
			$work[$workid]['ìÆI¹ú'] = date($work[$workid]['ìÆ\èJnú'], strtotime("+ 7 days"));
			$work[$workid]['ÄÌeiX[hvÛ'] = 0;
			$tmp = mt_rand(1, 3);
			$work[$workid]['\¿Ò'] = $staff[$tmp]['ÐõID'];
			$work[$workid]['R¸Ò'] = "D999996";
			$work[$workid]['ìÆ³FÒ'] = "D999991";
			$work[$workid]['ìÆ^CvID'] = $workTypenum;
			$work[$workid]['ìÆ^Cg'] = $workType[$workTypenum]['ìÆ^Cv'];
			$work[$workid]['ìÆè'] = "PD<br>QD<br>RD<br>SD<br>TD";
			
			$id=count($workStaff);
			$workStaff[$id]['ìÆ\¿ID'] = $workid;
			$workStaff[$id]['ÐõID'] = $work[$workid]['\¿Ò'];
			
			$id = (int)$id + 1;
			$workStaff[$id]['ìÆ\¿ID'] = $workid;
			$tmp = (int)$tmp + 1;
			if($tmp == 4) $tmp = 1;
			$workStaff[$id]['ÐõID'] = $staff[$tmp]['ÐõID'];
			
			$id=count($workEquipment);
			$workEquipment[$id]['ìÆ\¿ID'] = $workid;
			$workEquipment[$id]['ÝõID'] = $i;
			
			$id=count($workUser);
			$workUser[$id]['ìÆ\¿ID'] = $workid;
			$workUser[$id]['[U[ID'] = 1;
		}
	}
	
	writeCsvFile2($ini['dirWin'].'/prototype/data/workStaff.csv', $workStaff);
	//print_r_pre($workStaff);
	writeCsvFile2($ini['dirWin'].'/prototype/data/workEquipment.csv', $workEquipment);
	//print_r_pre($workEquipment);
	writeCsvFile2($ini['dirWin'].'/prototype/data/workUser.csv', $workUser);
	//print_r_pre($workUser);
	return $work;
}
?>