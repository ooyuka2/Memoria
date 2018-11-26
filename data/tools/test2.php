<?php

	if(!isset($ini)) $ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');

$pathArry[0] = $ini['dirWin'].'/data/tools/tool_data/tempcsv.csv';
$pathArry[1] = $ini['dirWin'].'/data/tools/tool_data/tempcsv2.csv';
// Zipクラスロード
$zip = new ZipArchive($pathArry);
// Zipファイル名
$zipFileName = "file_" . date("Ymds") .'.zip';
// Zipファイル一時保存ディレクトリ
$zipTmpDir = 'C:\xampp\htdocs\Memoria\data\tools\tool_data';
  
// Zipファイルオープン
$result = $zip->open($zipTmpDir.$zipFileName, ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE);
if ($result !== true) {
    // 失敗した時の処理
}
  
// 処理制限時間を外す
set_time_limit(0);
  
foreach ($pathArry as $filepath) {
    $filename = basename($filepath);
    //echo $filename."<br>";
    // 取得ファイルをZipに追加していく
    $zip->addFromString($filename, file_get_contents($filepath));
}
                  
$zip->close();
  
// ストリームに出力
header('Content-Type: application/zip; name="' . $zipFileName . '"');
header('Content-Disposition: attachment; filename="' . $zipFileName . '"');
header('Content-Length: '.filesize($zipTmpDir.$zipFileName));
echo file_get_contents($zipTmpDir.$zipFileName);
  
// 一時ファイルを削除しておく
unlink($zipTmpDir.$zipFileName);
?>