<?php
	header("Content-type: text/html; charset=SJIS-win");
	date_default_timezone_set('Asia/Tokyo');
	if(!isset($ini)) $ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	include_once($ini['dirWin'].'/pages/function.php');
	
	
	$type= [
		['サーバー','svr' , 'Windows2012R2'],
		['サーバー','svr' , 'Windows2012'],
		['サーバー','svr' , 'Windows2008'],
		['サーバー','svr' , 'Windows2008R2'],
		['サーバー','svr' , 'Windows2003'],
		['サーバー','svr' , 'Windows2016'],
		['処理クライアント','clt' , 'WindowsXP'],
		['処理クライアント','clt' , 'WindowsXP'],
		['処理クライアント','clt' , 'WindowsXP'],
		['処理クライアント','clt' , 'Windows7'],
		['処理クライアント','clt' , 'Windows7'],
		['処理クライアント','clt' , 'Windows7'],
		['処理クライアント','clt' , 'Windows7'],
		['処理クライアント','clt' , 'Windows7'],
		['処理クライアント','clt' , 'Windows7'],
		['処理クライアント','clt' , 'Windows7'],
		['処理クライアント','clt' , 'Windows7'],
		['処理クライアント','clt' , 'Windows7'],
		['処理クライアント','clt' , 'Windows10'],
		['処理クライアント','clt' , 'Windows10'],
		['処理クライアント','clt' , 'Windows10'],
		['処理クライアント','clt' , 'Windows10'],
		['FW','fls' , ''],
		['スイッチ','sic' , ''],
		['ハブ','hub' , '']
	];
	
	$kiban = [
		['桜','skr'],['梅','ume'],['秋桜','cos'],['紫陽花','hyd']
	];
	
	$kyoten = [
		['りんご','app'],['ばなな','bnn'],['みかん','org'],['もも','mom']
	];
	
	$mashine = readCsvFile2($ini['dirWin'].'/prototype/data/mashine.csv');
	//print_r($mashine);
	
	
	$start = strtotime('2010-01-01 00:00:00'); // 0
	$end = strtotime('2018-10-26 03:14:07'); // 2147483647
	$count = count($mashine);
	
	for($i=count($mashine); $i<$count+200; $i++) {
		
		$tmptype = mt_rand(0, 24);
		$tmpkiban = mt_rand(0, 3);
		$tmpkyoten = mt_rand(0, 3);
		echo $tmptype . $tmpkiban . $tmpkyoten ."<br>";
		
		$tmp = 0;
		for($j=1; $j<count($mashine); $j++) {
			//echo $mashine[$j]['hostname'];
			if(serch_word_str($mashine[$j]['hostname'], $kiban[$tmpkiban][1] . $type[$tmptype][1] . $tmpkyoten[$tmpkyoten][1])) $tmp++;
		}
		
		$mashine[$i]['mashineID'] = "m" . sprintf('%06d', $i);
		$mashine[$i]['拠点'] = $kyoten[$tmpkyoten][0];
		$mashine[$i]['hostname'] = $kiban[$tmpkiban][1] . $type[$tmptype][1] . $tmpkyoten[$tmpkyoten][1] . sprintf('%03d', ($tmp+1));
		$mashine[$i]['ipaddress'] = "10.2.45." . ($i+1);
		$mashine[$i]['ipaddress2'] = "";
		$mashine[$i]['ipaddress3'] = "";
		$mashine[$i]['whattodo'] = $kiban[$tmpkiban][0].$type[$tmptype][0];
		$mashine[$i]['detail'] = "";
		$tnp = $tmptype = mt_rand(0, 24);
		if($tnp <= 3) $mashine[$i]['status'] = "導入中";
		else if($tnp <= 15) $mashine[$i]['status'] = "稼働中";
		else if($tnp <= 18) $mashine[$i]['status'] = "稼働中(残課題あり)";
		else if($tnp <= 20) $mashine[$i]['status'] = "稼働中（近々停止予定）";
		else if($tnp <= 21) $mashine[$i]['status'] = "停止中";
		else if($tnp <= 23) $mashine[$i]['status'] = "撤去作業中";
		else if($tnp <= 24) $mashine[$i]['status'] = "撤去・返却・廃棄済み";
		$mashine[$i]['os'] = $type[$tmptype][2];
		$mashine[$i]['macaddress'] = sprintf('%02d', mt_rand(0, 99)) . "-" . sprintf('%02d', mt_rand(0, 99)) . "-" . sprintf('%02d', mt_rand(0, 99)) . "-" . sprintf('%02d', mt_rand(0, 99)) . "-" . sprintf('%02d', mt_rand(0, 99));
		$mashine[$i]['部署'] = "基盤部";
		$mashine[$i]['導入日時'] = date("Y/m/d", mt_rand($start, $end));
		$mashine[$i]['撤去日時'] = "";
	}
	
	
	
	
	
	
	
	
	writeCsvFile2($ini['dirWin'].'/prototype/data/mashine.csv', $mashine);
	
?>