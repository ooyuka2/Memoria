phpの関数などのメモ
=============
### ファイルパスの取得と関数読み込み
	if(!isset($ini)) $ini = parse_ini_file(dirname ( __FILE__ ).'\data\config.ini');
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
### 文字列検索
	serch_word_str($word, $searchtext)

---
### 文字列の完全一致判定（大文字小文字などは判定しない）
	equal_word_str($word, $searchtext)





