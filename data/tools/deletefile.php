<?php
	header("Content-type: text/html; charset=SJIS-win");
	if(!isset($ini)) $ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	include_once($ini['dirWin'].'/pages/function.php');
date_default_timezone_set('Asia/Tokyo');
 
//削除期限
//$expire = strtotime("1 hours ago");
$expire = strtotime("1 minutes ago");
 
//ディレクトリ
$dir = dirname(__FILE__) . 'C:/Users/ooyuka/Music/ConvertMusic/';
$dir = dirname(__FILE__) . 'C:/xampp/htdocs/Memoria/data/memo/';
 
remove_old_files($dir, $expire);
echo "<hr>finish";
  
function remove_old_files($dir, $timestamp){
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator(
            $dir,
             FilesystemIterator::CURRENT_AS_FILEINFO
            |FilesystemIterator::SKIP_DOTS
            |FilesystemIterator::KEY_AS_PATHNAME
        ), RecursiveIteratorIterator::LEAVES_ONLY
    );
 
    foreach($iterator as $pathname => $info){
        if($info->getMTime() < $timestamp){
            //chmod($pathname, 0666);
            //unlink($pathname);
            echo $pathname."<br>";
        }
    }
}
?>