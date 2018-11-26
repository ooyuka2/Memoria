<?php

	if(!isset($ini)) $ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');

$pathArry[0] = $ini['dirWin'].'/data/tools/tool_data/tempcsv.csv';
$pathArry[1] = $ini['dirWin'].'/data/tools/tool_data/tempcsv2.csv';
// Zip�N���X���[�h
$zip = new ZipArchive($pathArry);
// Zip�t�@�C����
$zipFileName = "file_" . date("Ymds") .'.zip';
// Zip�t�@�C���ꎞ�ۑ��f�B���N�g��
$zipTmpDir = 'C:\xampp\htdocs\Memoria\data\tools\tool_data';
  
// Zip�t�@�C���I�[�v��
$result = $zip->open($zipTmpDir.$zipFileName, ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE);
if ($result !== true) {
    // ���s�������̏���
}
  
// �����������Ԃ��O��
set_time_limit(0);
  
foreach ($pathArry as $filepath) {
    $filename = basename($filepath);
    //echo $filename."<br>";
    // �擾�t�@�C����Zip�ɒǉ����Ă���
    $zip->addFromString($filename, file_get_contents($filepath));
}
                  
$zip->close();
  
// �X�g���[���ɏo��
header('Content-Type: application/zip; name="' . $zipFileName . '"');
header('Content-Disposition: attachment; filename="' . $zipFileName . '"');
header('Content-Length: '.filesize($zipTmpDir.$zipFileName));
echo file_get_contents($zipTmpDir.$zipFileName);
  
// �ꎞ�t�@�C�����폜���Ă���
unlink($zipTmpDir.$zipFileName);
?>