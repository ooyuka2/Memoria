<?php
header("Content-type: text/plain; charset=SJIS-win");

if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])
   && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
{
  // Ajax���N�G�X�g�̏ꍇ�̂ݏ�������

  if (isset($_POST['request']))
  {
      //�����ɉ�������̏����������iDB�o�^��t�@�C���ւ̏������݂Ȃǁj
      $str = mb_convert_encoding($_POST['request'], "SJIS-win", "auto");
      echo $str."OKaaaaaaaaaa������a";
  }
  else
  {
      echo 'The parameter of "request" is not found.';
  }
}
?>