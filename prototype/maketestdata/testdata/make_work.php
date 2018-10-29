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
	
	$sort = array(); 
	foreach ((array) $work as $key => $value) {
		$sort[$key] = $value['作業終了日時'];
	}

	array_multisort($sort, SORT_ASC, $work);
	$num = (count($work)-1);
	$tmp = array();
	$tmp[0] = $work[$num];
	$work = array_merge($tmp, $work);
	
	$num = (count($work)-1);
	
	
	
	for($i=1; $i<count($work); $i++) {
		$work[$i]['作業申請書ID'] = $i;
	}
	unset($work[$num]);
	writeCsvFile2($ini['dirWin'].'/prototype/data/work.csv', $work);
	echo "<h4>finish作業情報!</h4>";
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
			$work[$workid]['作業申請書ID'] = $workid;
			$work[$workid]['作業内容'] = "○○○○○○○○○○○○<br>○○○○○○○○○○○○○○○○<br>○○○○○○○○○○○○○○○○";
			$work[$workid]['作業予定開始日時'] = date("Y/m/d H:i:s", mt_rand(strtotime($mashine[$i]['導入日']), strtotime( "now" )));
			$work[$workid]['作業予定終了日時'] = date($work[$workid]['作業予定開始日時'], strtotime("+ 7 days"));
			$work[$workid]['作業開始時間'] = $work[$workid]['作業予定開始日時'];
			$work[$workid]['作業終了日時'] = date($work[$workid]['作業予定開始日時'], strtotime("+ 7 days"));
			$work[$workid]['監視のメンテナンスモード要否'] = 0;
			$tmp = mt_rand(1, 3);
			$work[$workid]['申請者'] = $staff[$tmp]['社員ID'];
			$work[$workid]['審査者'] = "D999996";
			$work[$workid]['作業承認者'] = "D999991";
			$work[$workid]['作業タイプID'] = $workTypenum;
			$work[$workid]['作業タイトル'] = $workType[$workTypenum]['作業タイプ'];
			$work[$workid]['作業手順'] = "１．○○○○○<br>２．○○○○○<br>３．○○○○○<br>４．○○○○○<br>５．○○○○○";
			
			$id=count($workStaff);
			$workStaff[$id]['作業申請書ID'] = $workid;
			$workStaff[$id]['社員ID'] = $work[$workid]['申請者'];
			
			$id = (int)$id + 1;
			$workStaff[$id]['作業申請書ID'] = $workid;
			$tmp = (int)$tmp + 1;
			if($tmp == 4) $tmp = 1;
			$workStaff[$id]['社員ID'] = $staff[$tmp]['社員ID'];
			
			$id=count($workEquipment);
			$workEquipment[$id]['作業申請書ID'] = $workid;
			$workEquipment[$id]['設備ID'] = $i;
			
			$id=count($workUser);
			$workUser[$id]['作業申請書ID'] = $workid;
			$workUser[$id]['ユーザーID'] = 1;
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