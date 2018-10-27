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
				$youto = "サーバー";
			} else if($tmptype <= 8) {
				$name = "clt";
				$youto = "処理クライアント";
				$tmptype = 6;
			} else if($tmptype <= 14) {
				$name = "clt";
				$youto = "処理クライアント";
				$tmptype = 7;
			} else if($tmptype <= 16) {
				$name = "clt";
				$youto = "処理クライアント";
				$tmptype = 8;
			}
			$tmpkiban = mt_rand(1, 4);
			$tmpkyoten = mt_rand(1, 4);
			
			$tmp = 1;
			for($j=1; $j<count($mashine); $j++) {
				//echo $mashine[$j]['hostname'];
				if(serch_word_str($mashine[$j]['マシン名'], $kiban[$tmpkiban]['基盤名'] . $name . $where[$tmpkyoten]['略称'])) $tmp++;
			}
			$mashine[$i]['設備ID'] = $i;
			$mashine[$i]['マシン名'] = $kiban[$tmpkiban]['基盤名'] . $name . $where[$tmpkyoten]['略称'] . sprintf('%03d', $tmp);
			$mashine[$i]['IPアドレス'] = $ipaddress . $ip;
			$mashine[$i]['IPアドレス2'] = "";
			$mashine[$i]['IPアドレス3'] = "";
			$mashine[$i]['用途'] = $kiban[$tmpkiban]['説明'] . $youto . $tmp . "号機";
			$mashine[$i]['MACアドレス'] = sprintf('%02d', mt_rand(0, 99)) . "-" . sprintf('%02d', mt_rand(0, 99)) . "-" . sprintf('%02d', mt_rand(0, 99)) . "-" . sprintf('%02d', mt_rand(0, 99)) . "-" . sprintf('%02d', mt_rand(0, 99));
			$mashine[$i]['導入日'] = date("Y/m/d", mt_rand($start, $end));
			$mashine[$i]['撤去日'] = "";
			$mashine[$i]['設備詳細説明'] = "";
			$mashine[$i]['OSID'] = $tmptype;
			$mashine[$i]['基盤ID'] = $tmpkiban;
			$mashine[$i]['設備ステータスID'] = 0;
			$mashine[$i]['設備ステータス2ID'] = 1;
			$mashine[$i]['ドメイン名'] = ($ip % 2);
			$mashine[$i]['特権ユーザー'] = $domain[($ip % 2)]['ドメイン名'] . "\\admin";
			$mashine[$i]['設備管理部門'] = 1;
			$mashine[$i]['設備タイプID'] = 1;
			$mashine[$i]['拠点ID'] = $tmpkyoten;
			$mashine[$i]['平時接続方法'] = mt_rand(1, 4);
			if(($ip % 3) == 1) $mashine[$i]['メンテナンス時接続方法'] = 4;
			else $mashine[$i]['メンテナンス時接続方法'] = $mashine[$i]['平時接続方法'];
			
			$tnp = $tmptype = mt_rand(0, 24);
			if($tnp == 0) $mashine[$i]['設備ステータスID'] = 1;
			else if($tnp <= 2) $mashine[$i]['設備ステータスID'] = 2;
			else if($tnp <= 18) $mashine[$i]['設備ステータスID'] = 4;
			else if($tnp <= 20) $mashine[$i]['設備ステータスID'] = 3;
			else if($tnp <= 22) $mashine[$i]['設備ステータスID'] = 5;
			else if($tnp <= 23) $mashine[$i]['設備ステータスID'] = 6;
			else if($tnp <= 24) {
				$mashine[$i]['設備ステータスID'] = 7;
				$mashine[$i]['撤去日'] = date("Y/m/d", mt_rand(strtotime($mashine[$i]['導入日']), $end));
			}
			
			if($tnp == 23 || $tnp == 24 || $tnp == 20 ) $mashine[$i]['設備ステータス2ID'] = 2;
			
			
			$ip += mt_rand(0, 10);
			$i++;
		}
		
		$tmp = 1;
		for($j=1; $j<count($mashine); $j++) {
			//echo $mashine[$j]['hostname'];
			if(serch_word_str($mashine[$j]['マシン名'], $kiban[$tmpkiban]['基盤名'] . "fws" . $where[$tmpkyoten]['略称'])) $tmp++;
		}
		
		$mashine[$i]['設備ID'] = $i;
		$mashine[$i]['マシン名'] = $kiban[$tmpkiban]['基盤名'] . "fws" . $where[$tmpkyoten]['略称'] . sprintf('%03d', $tmp);
		$mashine[$i]['IPアドレス'] = $ipaddress . "1";
		$mashine[$i]['IPアドレス2'] = "";
		$mashine[$i]['IPアドレス3'] = "";
		$mashine[$i]['用途'] = "ファイヤーウォール" . $tmp . "号機";
		$mashine[$i]['MACアドレス'] = sprintf('%02d', mt_rand(0, 99)) . "-" . sprintf('%02d', mt_rand(0, 99)) . "-" . sprintf('%02d', mt_rand(0, 99)) . "-" . sprintf('%02d', mt_rand(0, 99)) . "-" . sprintf('%02d', mt_rand(0, 99));
		$mashine[$i]['導入日'] = date("Y/m/d", mt_rand($start, $end));
		$mashine[$i]['撤去日'] = "";
		$mashine[$i]['設備詳細説明'] = "";
		$mashine[$i]['OSID'] = "";
		$mashine[$i]['基盤ID'] = $tmpkiban;
		$mashine[$i]['設備ステータスID'] = 0;
		$mashine[$i]['設備ステータス2ID'] = 1;
		$mashine[$i]['ドメイン名'] = "";
		$mashine[$i]['特権ユーザー'] = "admin";
		$mashine[$i]['設備管理部門'] = 1;
		$mashine[$i]['設備タイプID'] = 1;
		$mashine[$i]['拠点ID'] = $tmpkyoten;
		$mashine[$i]['平時接続方法'] = 5;
		$mashine[$i]['メンテナンス時接続方法'] = 5;
		
		return $mashine;
	}
	
?>