<?php
 
if (is_uploaded_file($_FILES["file"]["tmp_name"])) {
	$_FILES["file"]["name"] = mb_convert_encoding($_FILES["file"]["name"],'SJIS-win','UTF-8');
  if (move_uploaded_file($_FILES["file"]["tmp_name"], "C:Users/yukako/Desktop/data/" . $_FILES["file"]["name"])) {
    echo $_FILES["file"]["name"] . "をアップロードしました。";
    $filepath = "C:Users/yukako/Desktop/data/" . $_FILES["file"]["name"];
    $file = readCsvFile($filepath);
    writeCsvFile($filepath, $file);
    
    
  } else {
    echo "ファイルをアップロードできません。";
  }
} else {
  echo "ファイルが選択されていません。";
}
 
?>

<?php
 /*
if (is_uploaded_file($_FILES["file"]["tmp_name"])) {
	mb_internal_encoding("SJIS");
	//mb_convert_variables('SJIS-win',"Unicode",$file);
	$_FILES["file"]["name"] = mb_convert_encoding($_FILES["file"]["name"],'SJIS-win','Unicode');
	file_put_contents( $_FILES["file"]["tmp_name"], $file, LOCK_EX );
  if (move_uploaded_file($_FILES["file"]["tmp_name"], "C:Users/yukako/Desktop/data/" . $_FILES["file"]["name"])) {
    echo $_FILES["file"]["name"] . "をアップロードしました。";
    //mb_convert_variables('SJIS-win',"auto",$file);
   // mb_convert_variables('SJIS-win',"auto",$file);
    
  } else {
    echo "ファイルをアップロードできません。";
  }
} else {
  echo "ファイルが選択されていません。";
}
 */
?>

Unicode