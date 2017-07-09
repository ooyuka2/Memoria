<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="/Memoria/js/javascript.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>
<script src="http://felicegattuso.com/projects/timedropper/js/timedropper/timedropper.js"></script>
<script src="/Memoria/js/modernizr-custom.js"></script>
<script type="text/javascript">
$(function () {
  $('[data-toggle="popover"]').popover();
  $('[data-toggle="tooltip"]').tooltip();
  if (!Modernizr.inputtypes.date) {
	  $(".noki").datepicker();
	  $(".kaisi").datepicker();
	  $(".syuryo").datepicker();
  }
});
$( ".time" ).timeDropper({
  //機能オプション
  autoswitch: false,          //クリック位置移動
  meridians: false,           //12時間 / 24時間表示
  format: "HH:mm",           //時刻フォーマット
  mousewheel: false,          //マウスホイール可否
  init_animation: "fadeIn",   //初期アニメーション
  setCurrentTime: false,       //現在時刻の設定

  //スタイルオプション
  primaryColor: "#1977cc",    //設定中の文字
  textColor: "#555555",       //設定後の文字
  backgroundColor: "#ffffff", //背景
  borderColor: "#1977cc"      //枠線
});
if (!Modernizr.inputtypes.date) { //HTML5のinput要素に対応しているか判定
	$(document).on("click",document, function() {
			$(".noki").datepicker();
			$(".kaisi").datepicker();
			$(".syuryo").datepicker();
	    });
}

</script>
<?php
	include('setting.php');
	echo '<script src="../'.$color.'/js/bootstrap.min.js"></script>';
?>