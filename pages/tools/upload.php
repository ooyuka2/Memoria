<?php
 
if (is_uploaded_file($_FILES["file"]["tmp_name"])) {
	$file = file_get_contents($_FILES["file"]["tmp_name"]);
	$file = mb_convert_encoding($file,'SJIS-win');
	$_FILES["file"]["name"] = mb_convert_encoding($_FILES["file"]["name"],'SJIS-win','auto');
	file_put_contents( $_FILES["file"]["tmp_name"], $file, LOCK_EX );
  if (move_uploaded_file($_FILES["file"]["tmp_name"], "../../data/change_chat/" . $_FILES["file"]["name"])) {
    echo $_FILES["file"]["name"] . "をアップロードしました。";
  } else {
    echo "ファイルをアップロードできません。";
  }
} else {
  echo "ファイルが選択されていません。";
}
 
?>