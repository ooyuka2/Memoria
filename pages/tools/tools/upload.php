<?php
 
if (is_uploaded_file($_FILES["file"]["tmp_name"])) {
	$_FILES["file"]["name"] = mb_convert_encoding($_FILES["file"]["name"],'SJIS-win','UTF-8');
  if (move_uploaded_file($_FILES["file"]["tmp_name"], "C:Users/yukako/Desktop/data/" . $_FILES["file"]["name"])) {
    echo $_FILES["file"]["name"] . "���A�b�v���[�h���܂����B";
    $filepath = "C:Users/yukako/Desktop/data/" . $_FILES["file"]["name"];
    $file = readCsvFile($filepath);
    writeCsvFile($filepath, $file);
    
    
  } else {
    echo "�t�@�C�����A�b�v���[�h�ł��܂���B";
  }
} else {
  echo "�t�@�C�����I������Ă��܂���B";
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
    echo $_FILES["file"]["name"] . "���A�b�v���[�h���܂����B";
    //mb_convert_variables('SJIS-win',"auto",$file);
   // mb_convert_variables('SJIS-win',"auto",$file);
    
  } else {
    echo "�t�@�C�����A�b�v���[�h�ł��܂���B";
  }
} else {
  echo "�t�@�C�����I������Ă��܂���B";
}
 */
?>

Unicode