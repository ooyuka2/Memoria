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
  //�@�\�I�v�V����
  autoswitch: false,          //�N���b�N�ʒu�ړ�
  meridians: false,           //12���� / 24���ԕ\��
  format: "HH:mm",           //�����t�H�[�}�b�g
  mousewheel: false,          //�}�E�X�z�C�[����
  init_animation: "fadeIn",   //�����A�j���[�V����
  setCurrentTime: false,       //���ݎ����̐ݒ�

  //�X�^�C���I�v�V����
  primaryColor: "#1977cc",    //�ݒ蒆�̕���
  textColor: "#555555",       //�ݒ��̕���
  backgroundColor: "#ffffff", //�w�i
  borderColor: "#1977cc"      //�g��
});
if (!Modernizr.inputtypes.date) { //HTML5��input�v�f�ɑΉ����Ă��邩����
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