<?php
 header("Content-type: text/html; charset=SJIS-win");
if (is_uploaded_file($_FILES["file"]["tmp_name"])) {
	$_FILES["file"]["name"] = mb_convert_encoding($_FILES["file"]["name"],'SJIS-win','UTF-8');
	$file_ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
  if (FileExtensionGetAllowUpload($file_ext) && move_uploaded_file($_FILES["file"]["tmp_name"], "C:/xampp/htdocs/Memoria/data/tools/tool_data/�Ă���.csv")) {
    echo $_FILES["file"]["name"] . "�@���A�b�v���[�h����܂���!<br>";
    $filepath = "C:/xampp/htdocs/Memoria/data/tools/tool_data/" . $_FILES["file"]["name"];
    //$file = readCsvFile($filepath);
    //writeCsvFile($filepath, $file);
    echo "<hr>����1";
    
    echo "<hr>����2";
    
    echo "<hr>";
    
  } else {
    echo "�t�@�C�����A�b�v���[�h�ł��܂���BCSV�t�@�C���ł����H<br>";
  }
} else {
  echo "no file. �t�@�C�����I������Ă��܂���B<br>";
}
 
?>

<?php
  //�A�b�v���[�h�ł���t�@�C���Ɋg���q�̐���������������
  function FileExtensionGetAllowUpload($ext){
    $allow_ext = array("csv");
    foreach($allow_ext as $v){
      if ($v === $ext){
        return 1;
      }
    }
    return 0;
  }
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