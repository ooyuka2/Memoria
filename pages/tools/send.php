<?php
//header("Content-type: text/plain; charset=SJIS-win");

if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])
   && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
{
  // Ajaxリクエストの場合のみ処理する

  if (isset($_POST['request']))
  {
      //ここに何かしらの処理を書く（DB登録やファイルへの書き込みなど）
      echo $_POST['request']."OKaaaaaaaaaaあああa";
  }
  else
  {
      echo 'The parameter of "request" is not found.';
  }
}
?>