<?php
	header("Content-type: text/html; charset=SJIS-win");
	date_default_timezone_set('Asia/Tokyo');
	if(!isset($ini)) $ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\..\data\config.ini');
	include_once($ini['dirWin'].'/pages/function.php');
	
	
	$mashine = readCsvFile2($ini['dirWin'].'/prototype/data/equipment.csv');
	$tmp = $mashine[0];
	$mashine = array();
	$mashine[0] = $tmp;
	
	
	//�ݔ����̃_�~�[�f�[�^�쐬
	//print_r_pre($mashine);
	$mashine = makemashin($mashine, 1, "10.2.1.");
	$mashine = makemashin($mashine, count($mashine), "10.2.45.");
	$mashine = makemashin($mashine, count($mashine), "10.2.60.");
	
	writeCsvFile2($ini['dirWin'].'/prototype/data/equipment.csv', $mashine);
	
	
	$mashineChange = readCsvFile2($ini['dirWin'].'/prototype/data/equipmentChange.csv');
	$staff = readCsvFile2($ini['dirWin'].'/prototype/data/staff.csv');
	$tmp = $mashineChange[0];
	$mashineChange = array();
	$mashineChange[0] = $tmp;
	
	
	//�ݔ����X�V���̗����̃_�~�[�f�[�^�쐬
	for($i=1; $i<count($mashine); $i++) {
		//�ݔ��ύX����ID,�ύX���e,�Ј�ID,�ݔ�ID,�ύX����
		$id = count($mashineChange);
		$mashineChange[$id]['�ݔ��ύX����ID'] = $id;
		$mashineChange[$id]['�ύX���e'] = "�V�K�o�^";
		$mashineChange[$id]['�Ј�ID'] = $staff[mt_rand(1, 3)]['�Ј�ID'];
		$mashineChange[$id]['�ݔ�ID'] = $i;
		$mashineChange[$id]['�ύX����'] = date($mashine[$i]['������'], strtotime("- 14 days"));
		
		if($mashine[$i]['�ݔ��X�e�[�^�XID'] > 3) {
			$id = count($mashineChange);
			$mashineChange[$id]['�ݔ��ύX����ID'] = $id;
			$mashineChange[$id]['�ύX���e'] = "�����[�X����";
			$mashineChange[$id]['�Ј�ID'] = $staff[mt_rand(4, 6)]['�Ј�ID'];
			$mashineChange[$id]['�ݔ�ID'] = $i;
			$mashineChange[$id]['�ύX����'] = date($mashine[$i]['������'], strtotime("+ 7 days"));
			
			$tmp = mt_rand(0, 20);
			
			for($j=0; $j<$tmp; $j++) {
				$id = count($mashineChange);
				$mashineChange[$id]['�ݔ��ύX����ID'] = $id;
				$mashineChange[$id]['�ύX���e'] = "������ύX�B�����ˁ���";
				$mashineChange[$id]['�Ј�ID'] = $staff[mt_rand(1, 3)]['�Ј�ID'];
				$mashineChange[$id]['�ݔ�ID'] = $i;
				$mashineChange[$id]['�ύX����'] = date("Y/m/d H:i:s", mt_rand(strtotime($mashine[$i]['������']), strtotime( "now" )));
			}
			
			if($mashine[$i]['�ݔ��X�e�[�^�XID'] == 7) {
				$id = count($mashineChange);
				$mashineChange[$id]['�ݔ��ύX����ID'] = $id;
				$mashineChange[$id]['�ύX���e'] = "�P�������m�F";
				$mashineChange[$id]['�Ј�ID'] = $staff[mt_rand(4, 6)]['�Ј�ID'];
				$mashineChange[$id]['�ݔ�ID'] = $i;
				$mashineChange[$id]['�ύX����'] = $mashine[$i]['�P����'];
			}
		}
	}
	/*
	for($i=1; $i<count($mashineChange); $i++) {
		if (strtotime('2011-08-12') > strtotime('2011-01-12')) {
		
		}
	}*/
	foreach ((array) $mashineChange as $key => $value) {
		$sort[$key] = $value['�ύX����'];
	}

	array_multisort($sort, SORT_ASC, $mashineChange);
	$num = (count($mashineChange)-1);
	$tmp = array();
	$tmp[0] = $mashineChange[$num];
	$mashineChange = array_merge($tmp, $mashineChange);
	
	$num = (count($mashineChange)-1);
	
	for($i=1; $i<count($mashineChange); $i++) {
		$mashineChange[$i]['�ݔ��ύX����ID'] = $i;
	}
	unset($mashineChange[$num]);
	writeCsvFile2($ini['dirWin'].'/prototype/data/equipmentChange.csv', $mashineChange);
	
	
	
	//OS��{���̃_�~�[�f�[�^�쐬
	//�ݔ�ID,�ݔ��^�C�vID,OS����,�o�b�N�A�b�v�ݒ�,�s�v�\�t�g�E�F�A�̍폜,�z�X�g���ݒ�,IP�A�h���X�ݒ�,�Z�L�����e�B�΍�\�t�g����,�A�N�Z�X���O�\�t�g����,�Ď��\�t�g�E�F�A����,�w��F�ؑ��u����,�f�o�C�X����\�t�g����
	$basicEquipmentSetting = readCsvFile2($ini['dirWin'].'/prototype/data/basicEquipmentSetting.csv');
	$tmp = $basicEquipmentSetting[0];
	$basicEquipmentSetting = array();
	$basicEquipmentSetting[0] = $tmp;
	
	for($i=1; $i<count($mashine); $i++) {
	
		if($mashine[$i]['�ݔ��^�C�vID'] == 1) {
			$basicEquipmentSetting[$i]['�ݔ�ID'] = $mashine[$i]['�ݔ�ID'];
			$basicEquipmentSetting[$i]['�ݔ��^�C�vID'] = 1;
			$basicEquipmentSetting[$i]['OS����'] = 1;
			$basicEquipmentSetting[$i]['�o�b�N�A�b�v�ݒ�'] = 1;
			$basicEquipmentSetting[$i]['�s�v�\�t�g�E�F�A�̍폜'] = 1;
			$basicEquipmentSetting[$i]['�z�X�g���ݒ�'] = 1;
			$basicEquipmentSetting[$i]['IP�A�h���X�ݒ�'] = 1;
			if($mashine[$i]['�ݔ��X�e�[�^�XID'] == 3) {
				$basicEquipmentSetting[$i]['�Z�L�����e�B�΍�\�t�g����'] = 1;
				$basicEquipmentSetting[$i]['�A�N�Z�X���O�\�t�g����'] = 1;
				$basicEquipmentSetting[$i]['�Ď��\�t�g�E�F�A����'] = 1;
				$basicEquipmentSetting[$i]['�w��F�ؑ��u����'] = 1;
				$basicEquipmentSetting[$i]['�f�o�C�X����\�t�g����'] = 1;
			} else {
				$basicEquipmentSetting[$i]['�Z�L�����e�B�΍�\�t�g����'] = 1;
				$basicEquipmentSetting[$i]['�A�N�Z�X���O�\�t�g����'] = 1;
				$basicEquipmentSetting[$i]['�Ď��\�t�g�E�F�A����'] = 0;
				$basicEquipmentSetting[$i]['�w��F�ؑ��u����'] = 1;
				$basicEquipmentSetting[$i]['�f�o�C�X����\�t�g����'] = 1;
			}
		}
	
	}
	
	writeCsvFile2($ini['dirWin'].'/prototype/data/basicEquipmentSetting.csv', $basicEquipmentSetting);
	
	
	
	
	
	echo "<h4>finish�ݔ����!</h4>";
	//print_r_pre($mashine);
	
	
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
			$mashine[$i]['������'] = date("Y/m/d H:i:s", mt_rand($start, $end));
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
				$mashine[$i]['�P����'] = date("Y/m/d H:i:s", mt_rand(strtotime($mashine[$i]['������']), $end));
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
		$mashine[$i]['������'] = date("Y/m/d H:i:s", mt_rand($start, $end));
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