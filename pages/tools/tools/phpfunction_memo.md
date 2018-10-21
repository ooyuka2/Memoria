phpの関数などのメモ
=============
### ファイルパスの取得と関数読み込み
	header("Content-type: text/html; charset=SJIS-win");
	if(!isset($ini)) $ini = parse_ini_file(dirname ( __FILE__ ).'\data\config.ini');
	if(isset($_POST['pagetype'])) $pagetype = $_POST['pagetype'];
	include_once($ini['dirWin'].'/pages/function.php');

---
### CSVファイルの読み込み（見出しあり）
	$array = readCsvFile2($ini['dirWin'].'/data/tools/tools_data/CSV.csv');

---
### CSVファイルの読み込み（見出しなし）
	$array = readCsvFile($ini['dirWin'].'/data/tools/tools_data/CSV.csv');

---
### CSVファイルの書き込み（見出しあり）
	writeCsvFile2($CSVcsv, $array);

---
### CSVファイルの書き込み（見出しなし）
	writeCsvFile($CSVcsv, $array);

---
### テキストファイルの読み込み
	$text = file_get_contents($ini['dirWin'].'/data/tools/tools_data/a.txt');

---
### テキストファイルの書き込み
	file_put_contents($ini['dirWin'].'/data/tools/tools_data/a.txt', $text);

---
### 文字列置換
	$text = str_replace("\n","\r\n",$memo );


---
### 文字列検索(文字列を含むか否か)
	serch_word_str($word, $searchtext)

---
### 文字列の完全一致判定（大文字小文字などは区別する）
	allequal_word_str($word, $searchtext)

---
### 文字列の完全一致判定（大文字小文字などは区別しない）
	equal_word_str($word, $searchtext)

---
### 文字列分割
	explode ( string $delimiter , string $string [, int $limit = PHP_INT_MAX ] );


### なるべくメモリ使わない繰り返し
	$output = [];
	foreach ($data as &$value) {
		$output[] = $value;
		unset($value);
	}
---
### 配列のデバッグ
	print_r_pre($array);

---
### 時間差の計算
	$from = strtotime("-3600 second"); // 現在から3600秒前（＝1時間前）
	$to   = strtotime("now");          // 現在日時
	echo time_diff($from, $to);
	// 結果：0days 01:00:00

	$from = strtotime("2016-01-01");  // 2016年元旦 (0時0分0秒)
	$to   = strtotime("now");         // 現在日時
	echo time_diff($from, $to);
	// 結果：32days 12:34:56

	$from = strtotime("2016-01-01 06:00:00"); // 2016年元旦 6時
	$to   = strtotime("2017-01-01 15:00:00"); // 2017年元旦 15時
	echo time_diff($from, $to);
	// 結果：366days 09:00:00




