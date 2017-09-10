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
	setDateTime_start();
});

/*
if (!Modernizr.inputtypes.date) { //HTML5��input�v�f�ɑΉ����Ă��邩����
	$(document).on("click",document, function() {
			$(".noki").datepicker();
			$(".kaisi").datepicker();
			$(".syuryo").datepicker();
	    });
}*/

var menuHeight = $(".navbar").height();
var startPos = 0;
$(window).scroll(function(){
	var currentPos = $(this).scrollTop();
	if (currentPos > startPos) {
		if($(window).scrollTop() >= 200) {
			$(".navbar").css("top", "-" + menuHeight + "px");
		}
	} else {
		$(".navbar").css("top", 0 + "px");
	}
	startPos = currentPos;
});

document.onkeydown = 
	function (e) {
		if (event.ctrlKey ){
			 if (event.keyCode == 83){
				//alert("Crtl + S");
				event.keyCode = 0;
				return false;
			 }
		}
	}

document.onkeypress = 
	function (e) {
		if (e != null){
			if ((e.ctrlKey || e.metaKey) && e.which == 115){
				//alert("Crtl + S");
				return false;
			}
		}
	}

function setDateTime_start() {
	$(".noki").datepicker();
	$(".kaisi").datepicker();
	$(".syuryo").datepicker();
	
	
	for(var i=document.getElementsByClassName("td-n2").length-1; i>=0; i--) {
		document.body.removeChild(document.getElementsByClassName("td-n2")[i]);
	}
	
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
}

function execCopy(string){
	var temp = document.createElement('textarea');

	temp.value = string;
	temp.selectionStart = 0;
	temp.selectionEnd = temp.value.length;

	var s = temp.style;
	s.position = 'fixed';
	s.left = '-100%';

	document.body.appendChild(temp);
	temp.focus();
	temp.select();
	var result = document.execCommand('copy');
	temp.blur();
	
	document.body.removeChild(temp);
	// true �Ȃ���s�ł��Ă��� false�Ȃ玸�s���Ή����Ă��Ȃ���
	return result;
}


</script>
<?php
	include('setting.php');
	echo '<script src="../'.$color.'/js/bootstrap.min.js"></script>';
?>