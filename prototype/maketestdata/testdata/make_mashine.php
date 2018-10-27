<?php
	header("Content-type: text/html; charset=SJIS-win");
	date_default_timezone_set('Asia/Tokyo');
	if(!isset($ini)) $ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\..\data\config.ini');
	include_once($ini['dirWin'].'/pages/function.php');
	
	
	$mashine = readCsvFile2($ini['dirWin'].'/prototype/data/equipment.csv');
	$tmp = $mashine[0];
	$mashine = array();
	$mashine[0] = $tmp;
	
	//print_r_pre($mashine);
	$mashine = makemashin($mashine, 1, "10.2.1.");
	$mashine = makemashin($mashine, count($mashine), "10.2.45.");
	$mashine = makemashin($mashine, count($mashine), "10.2.60.");
	
	writeCsvFile2($ini['dirWin'].'/prototype/data/equipment.csv', $mashine);
	
	echo "<h4>finish!</h4>";
	print_r_pre($mashine);
	
	
	function makemashin($mashine, $i, $ipaddress) {
		if(!isset($ini)) $ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\..\data\config.ini');
		
		$os = readCsvFile2($ini['dirWin'].'/prototype/data/os.csv');
		$kiban = readCsvFile2($ini['dirWin'].'/prototype/data/kiban.csv');
		$equipmentStatus = readCsvFile2($ini['dirWin'].'/prototype/data/equipmentStatus.csv');
		$equipmentStatus2 = readCsvFile2($ini['dirWin'].'/prototype/data/equipmentStatus2.csv');
		$domain  = readCsvFile2($ini['dirWin'].'/prototype/data/domain.csv');
		$equipmentType = readCsvFile2($ini['dirWin'].'/prototype/data/equipmentType.csv');
		$where = readCsvFile2($ini['dirWin'].'/prototype/data/where.csv');
		$connext = readCsvFile2($ini['dirWin'].'/prototype/data/connext.csv');
		
		$ip = 2;
		
		$start = strtotime('2010-01-01 00:00:00'); // 0
		$end = strtotime( "now" );
		
		while($ip<255) {
			$tmptype = mt_rand(1, 16);
			if($tmptype <= 5) {
				$name = "svr";
				$youto = "�T�[�o�[";
			} else if($tmptype <= 8) {
				$name = "clt";
				$youto = "�����N���C�A���g";
				$tmptype = 6;
			} else if($tmptype <= 14) {
				$name = "clt";
				$youto = "�����N���C�A���g";
				$tmptype = 7;
			} else if($tmptype <= 16) {
				$name = "clt";
				$youto = "�����N���C�A���g";
				$tmptype = 8;
			}
			$tmpkiban = mt_rand(1, 4);
			$tmpkyoten = mt_rand(1, 4);
			
			$tmp = 1;
			for($j=1; $j<count($mashine); $j++) {
				//echo $mashine[$j]['hostname'];
				if(serch_word_str($mashine[$j]['�}�V����'], $kiban[$tmpkiban]['��Ֆ�'] . $name . $where[$tmpkyoten]['����'])) $tmp++;
			}
			$mashine[$i]['�ݔ�ID'] = $i;
			$mashine[$i]['�}�V����'] = $kiban[$tmpkiban]['��Ֆ�'] . $name . $where[$tmpkyoten]['����'] . sprintf('%03d', $tmp);
			$mashine[$i]['IP�A�h���X'] = $ipaddress . $ip;
			$mashine[$i]['IP�A�h���X2'] = "";
			$mashine[$i]['IP�A�h���X3'] = "";
			$mashine[$i]['�p�r'] = $kiban[$tmpkiban]['����'] . $youto . $tmp . "���@";
			$mashine[$i]['MAC�A�h���X'] = sprintf('%02d', mt_rand(0, 99)) . "-" . sprintf('%02d', mt_rand(0, 99)) . "-" . sprintf('%02d', mt_rand(0, 99)) . "-" . sprintf('%02d', mt_rand(0, 99)) . "-" . sprintf('%02d', mt_rand(0, 99));
			$mashine[$i]['������'] = date("Y/m/d", mt_rand($start, $end));
			$mashine[$i]['�P����'] = "";
			$mashine[$i]['�ݔ��ڍא���'] = "";
			$mashine[$i]['OSID'] = $tmptype;
			$mashine[$i]['���ID'] = $tmpkiban;
			$mashine[$i]['�ݔ��X�e�[�^�XID'] = 0;
			$mashine[$i]['�ݔ��X�e�[�^�X2ID'] = 1;
			$mashine[$i]['�h���C����'] = ($ip % 2);
			$mashine[$i]['�������[�U�['] = $domain[($ip % 2)]['�h���C����'] . "\\admin";
			$mashine[$i]['�ݔ��Ǘ�����'] = 1;
			$mashine[$i]['�ݔ��^�C�vID'] = 1;
			$mashine[$i]['���_ID'] = $tmpkyoten;
			$mashine[$i]['�����ڑ����@'] = mt_rand(1, 4);
			if(($ip % 3) == 1) $mashine[$i]['�����e�i���X���ڑ����@'] = 4;
			else $mashine[$i]['�����e�i���X���ڑ����@'] = $mashine[$i]['�����ڑ����@'];
			
			$tnp = $tmptype = mt_rand(0, 24);
			if($tnp == 0) $mashine[$i]['�ݔ��X�e�[�^�XID'] = 1;
			else if($tnp <= 2) $mashine[$i]['�ݔ��X�e�[�^�XID'] = 2;
			else if($tnp <= 18) $mashine[$i]['�ݔ��X�e�[�^�XID'] = 4;
			else if($tnp <= 20) $mashine[$i]['�ݔ��X�e�[�^�XID'] = 3;
			else if($tnp <= 22) $mashine[$i]['�ݔ��X�e�[�^�XID'] = 5;
			else if($tnp <= 23) $mashine[$i]['�ݔ��X�e�[�^�XID'] = 6;
			else if($tnp <= 24) {
				$mashine[$i]['�ݔ��X�e�[�^�XID'] = 7;
				$mashine[$i]['�P����'] = date("Y/m/d", mt_rand(strtotime($mashine[$i]['������']), $end));
			}
			
			if($tnp == 23 || $tnp == 24 || $tnp == 20 ) $mashine[$i]['�ݔ��X�e�[�^�X2ID'] = 2;
			
			
			$ip += mt_rand(0, 10);
			$i++;
		}
		
		$tmp = 1;
		for($j=1; $j<count($mashine); $j++) {
			//echo $mashine[$j]['hostname'];
			if(serch_word_str($mashine[$j]['�}�V����'], $kiban[$tmpkiban]['��Ֆ�'] . "fws" . $where[$tmpkyoten]['����'])) $tmp++;
		}
		
		$mashine[$i]['�ݔ�ID'] = $i;
		$mashine[$i]['�}�V����'] = $kiban[$tmpkiban]['��Ֆ�'] . "fws" . $where[$tmpkyoten]['����'] . sprintf('%03d', $tmp);
		$mashine[$i]['IP�A�h���X'] = $ipaddress . "1";
		$mashine[$i]['IP�A�h���X2'] = "";
		$mashine[$i]['IP�A�h���X3'] = "";
		$mashine[$i]['�p�r'] = "�t�@�C���[�E�H�[��" . $tmp . "���@";
		$mashine[$i]['MAC�A�h���X'] = sprintf('%02d', mt_rand(0, 99)) . "-" . sprintf('%02d', mt_rand(0, 99)) . "-" . sprintf('%02d', mt_rand(0, 99)) . "-" . sprintf('%02d', mt_rand(0, 99)) . "-" . sprintf('%02d', mt_rand(0, 99));
		$mashine[$i]['������'] = date("Y/m/d", mt_rand($start, $end));
		$mashine[$i]['�P����'] = "";
		$mashine[$i]['�ݔ��ڍא���'] = "";
		$mashine[$i]['OSID'] = "";
		$mashine[$i]['���ID'] = $tmpkiban;
		$mashine[$i]['�ݔ��X�e�[�^�XID'] = 0;
		$mashine[$i]['�ݔ��X�e�[�^�X2ID'] = 1;
		$mashine[$i]['�h���C����'] = "";
		$mashine[$i]['�������[�U�['] = "admin";
		$mashine[$i]['�ݔ��Ǘ�����'] = 1;
		$mashine[$i]['�ݔ��^�C�vID'] = 1;
		$mashine[$i]['���_ID'] = $tmpkyoten;
		$mashine[$i]['�����ڑ����@'] = 5;
		$mashine[$i]['�����e�i���X���ڑ����@'] = 5;
		
		return $mashine;
	}
	
?>