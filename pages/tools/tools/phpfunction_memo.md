php�̊֐��Ȃǂ̃���
=============
### �t�@�C���p�X�̎擾�Ɗ֐��ǂݍ���
	header("Content-type: text/html; charset=SJIS-win");
	if(!isset($ini)) $ini = parse_ini_file(dirname ( __FILE__ ).'\data\config.ini');
	if(isset($_POST['pagetype'])) $pagetype = $_POST['pagetype'];
	include_once($ini['dirWin'].'/pages/function.php');

---
### CSV�t�@�C���̓ǂݍ��݁i���o������j
	$array = readCsvFile2($ini['dirWin'].'/data/tools/tools_data/CSV.csv');

---
### CSV�t�@�C���̓ǂݍ��݁i���o���Ȃ��j
	$array = readCsvFile($ini['dirWin'].'/data/tools/tools_data/CSV.csv');

---
### CSV�t�@�C���̏������݁i���o������j
	writeCsvFile2($CSVcsv, $array);

---
### CSV�t�@�C���̏������݁i���o���Ȃ��j
	writeCsvFile($CSVcsv, $array);

---
### �e�L�X�g�t�@�C���̓ǂݍ���
	$text = file_get_contents($ini['dirWin'].'/data/tools/tools_data/a.txt');

---
### �e�L�X�g�t�@�C���̏�������
	file_put_contents($ini['dirWin'].'/data/tools/tools_data/a.txt', $text);

---
### ������u��
	$text = str_replace("\n","\r\n",$memo );


---
### �����񌟍�(��������܂ނ��ۂ�)
	serch_word_str($word, $searchtext)

---
### ������̊��S��v����i�啶���������Ȃǂ͋�ʂ���j
	allequal_word_str($word, $searchtext)

---
### ������̊��S��v����i�啶���������Ȃǂ͋�ʂ��Ȃ��j
	equal_word_str($word, $searchtext)

---
### �����񕪊�
	explode ( string $delimiter , string $string [, int $limit = PHP_INT_MAX ] );


### �Ȃ�ׂ��������g��Ȃ��J��Ԃ�
	$output = [];
	foreach ($data as &$value) {
		$output[] = $value;
		unset($value);
	}
---
### �z��̃f�o�b�O
	print_r_pre($array);

---
### ���ԍ��̌v�Z
	$from = strtotime("-3600 second"); // ���݂���3600�b�O�i��1���ԑO�j
	$to   = strtotime("now");          // ���ݓ���
	echo time_diff($from, $to);
	// ���ʁF0days 01:00:00

	$from = strtotime("2016-01-01");  // 2016�N���U (0��0��0�b)
	$to   = strtotime("now");         // ���ݓ���
	echo time_diff($from, $to);
	// ���ʁF32days 12:34:56

	$from = strtotime("2016-01-01 06:00:00"); // 2016�N���U 6��
	$to   = strtotime("2017-01-01 15:00:00"); // 2017�N���U 15��
	echo time_diff($from, $to);
	// ���ʁF366days 09:00:00




