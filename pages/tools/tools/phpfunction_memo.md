php�̊֐��Ȃǂ̃���
=============
### �t�@�C���p�X�̎擾�Ɗ֐��ǂݍ���
	if(!isset($ini)) $ini = parse_ini_file(dirname ( __FILE__ ).'\data\config.ini');
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
### �����񌟍�
	serch_word_str($word, $searchtext)

---
### ������̊��S��v����i�啶���������Ȃǂ͔��肵�Ȃ��j
	equal_word_str($word, $searchtext)





