<?php 
	//include('/Memoria/pages/function.php');
	if(!isset($ini)) $ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	
 ?>
<script language="javascript" type="text/javascript">

$(document).ready( function(){
// �y�[�W�ǂݍ��ݎ��Ɏ��s����������
	<?php echo "read_tool_php('".$ini['dirhtml']."/pages/tools/tools.php', 'toolstab');"; ?>
});
// ##############################################################################################################################
//
//            �y�[�W��ǂݍ��ފ֐�
//
// ##############################################################################################################################
function read_tool_php(filepath, tabname) {
	if(!$("#"+tabname).hasClass('active')) {
		$("li.active").removeClass("active");
		$("#"+tabname).addClass("active");
		
	}
	$("#tools").css('background','url(\"../img/grid.svg\") center center no-repeat').css('background-size','20% auto');
	$.ajax({
		beforeSend: function(xhr){
			xhr.overrideMimeType('text/html;charset=Shift_JIS');
		},
		type: "GET",
		scriptCharset:'Shift_JIS',
		url: filepath,
		//data: {"search":""},
	}).done(function(data, dataType) {
		// done�̃u���b�N���́AAjax�ʐM�����������ꍇ�ɌĂяo�����
		// PHP����Ԃ��Ă����f�[�^�̕\��
		$("#tools").html(data).css('background','');
	}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
		// �ʏ�͂�����textStatus��errorThrown�̒l�����ď�����؂蕪���邩�A�P���ɒʐM�Ɏ��s�����ۂ̏������L�q���܂��B
		// this;
		// this�͑��̃R�[���o�b�N�֐����l��AJAX�ʐM���̃I�v�V�����������܂��B
		// �G���[���b�Z�[�W�̕\��
		alert('Error : ' + errorThrown);
	});
	// �T�u�~�b�g��A�y�[�W�������[�h���Ȃ��悤�ɂ���
	return false;
}


// ##############################################################################################################################
//
//            ��r�pphp�ǂݍ��݊֐�
//
// ##############################################################################################################################
function goto_compare() {

	

	$("#tools").css('background','url(\"../img/grid.svg\") center center no-repeat').css('background-size','20% auto');
	$.ajax({
		beforeSend: function(xhr){
			xhr.overrideMimeType('text/html;charset=Shift_JIS');
		},
		type: "POST",
		scriptCharset:'Shift_JIS',
		url: <?php echo $ini['dirhtml']."/pages/tools/tools/compare.php;?>,
		//data: {"txtA":document.getElementById('txtA').value, "txtB":document.getElementById('txtB').value },
	}).done(function(data, dataType) {
		// done�̃u���b�N���́AAjax�ʐM�����������ꍇ�ɌĂяo�����

		// PHP����Ԃ��Ă����f�[�^�̕\��
		$("#tools").html(data).css('background','');

	}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
		// �ʏ�͂�����textStatus��errorThrown�̒l�����ď�����؂蕪���邩�A�P���ɒʐM�Ɏ��s�����ۂ̏������L�q���܂��B

		// this;
		// this�͑��̃R�[���o�b�N�֐����l��AJAX�ʐM���̃I�v�V�����������܂��B

		// �G���[���b�Z�[�W�̕\��
		alert('Error : ' + errorThrown);
	});
	// �T�u�~�b�g��A�y�[�W�������[�h���Ȃ��悤�ɂ���
	return false;
}


// ##############################################################################################################################
//
//            0�ȏ�Ȃ�}�C�i�X������֐�
//
// ##############################################################################################################################
function abs(val) {
  return val < 0 ? -val : val;
};

// ##############################################################################################################################
//
//            �T��p�̊֐�
//
// ##############################################################################################################################

function writeweekly(val) {
	document.getElementsByClassName('write')[val].value = 1;
}

// ##############################################################################################################################
//
//            �e�L�X�g�G���A�̍����̊֐�
//
// ##############################################################################################################################

function changetextform(element) {
	var textarea = element;
	if( textarea.scrollHeight != textarea.offsetHeight ){
		textarea.style.height = textarea.scrollHeight+'px';
	}
}

// ##############################################################################################################################
//
//            �g��Ȃ��֐�
//
// ##############################################################################################################################

function tree_operate(element) {
	$(element).parent().children('div').stop().slideToggle(500);
	element.classList.toggle("glyphicon-chevron-right");
	element.classList.toggle("glyphicon-chevron-down");
}

function tree_open() {
	while($(".glyphicon-chevron-right").length > 0) {
		var element = document.getElementsByClassName("glyphicon-chevron-right")[0];
		element.classList.toggle("glyphicon-chevron-down");
		$(element).parent().children('div').slideDown(500);
		element.classList.toggle("glyphicon-chevron-right");
	}
}

function tree_close() {
	while($(".glyphicon-chevron-down").length > 0) {
		var element = document.getElementsByClassName("glyphicon-chevron-down")[0];
		element.classList.toggle("glyphicon-chevron-right");
		$(element).parent().children('div').slideUp(500);
		element.classList.toggle("glyphicon-chevron-down");
	}
}

function gotoid(todoid) {
	// �X�N���[���̑��x
	var speed = 400; // �~���b
	// �A���J�[�̒l�擾
	var href = todoid;
	// �ړ�����擾
	var target = $(href == "#" || href == "" ? 'html' : href);
	// �ړ���𐔒l�Ŏ擾
	var position = target.offset().top;
	// �X���[�X�X�N���[��
	$('body,html').animate({scrollTop:position}, speed, 'swing');
	return false;
}



// ##############################################################################################################################
//
//            �����p�l���p�̊֐�
//
// ##############################################################################################################################

function changeMempPanel(file, element, min, lock) {
	//location.href = path;
	//var data = {'memoform' : $('#memoform').val()};
	
	if(document.getElementById("memoform") != null) {
		ret = confirm(file + "��ۑ����܂����H");
		if (ret == true){
			saveMemoPanel();
		} else {
			return false;
		}
	}
	
	var makeform = $(element).parent().prev();
	var makebotton = $(element).parent();
	
	var h = makeform.height();
	
	makeform.height(h).css('background','url(\"/Memoria/img/grid-gray.svg\") center center no-repeat').css('background-size','20% auto');

	
	$.ajax({
		beforeSend: function(xhr){
			xhr.overrideMimeType('text/html;charset=Shift_JIS');
		},
		type: "POST",
		scriptCharset:'Shift_JIS',
		url: "./todo/changeMemo.php",
		data: {"file":file,"do":"readform"},
	}).done(function(data, dataType) {
		// done�̃u���b�N���́AAjax�ʐM�����������ꍇ�ɌĂяo�����

		// PHP����Ԃ��Ă����f�[�^�̕\��
		if(min=='n') minstr = "/checked";
		else minstr = "";
		if(lock=='y') lockstr = "/checked";
		else lockstr = "";
		
		makeform.html("<textarea id='memoform' class='form-control input-normal input-sml' onKeyPress='changeMemoform()'>"+data+"</textarea><input type='hidden' value='"+file+"'></input><span class='pull-right'><label class='checkbox-inline'><input type='checkbox' id='minisize' value='minisize' "+minstr+"> mini size</label><label class='checkbox-inline'><input type='checkbox' id='lockmemo' value='lock' "+lockstr+"> lock</label></span>").height("auto").css('background','');
		//alert(data);
		var textarea = document.getElementById("memoform");
		if( textarea.scrollHeight > textarea.offsetHeight ){
			textarea.style.height = textarea.scrollHeight+'px';
		}
		makebotton.prepend("<div id='memobotton'><button type='button' id='memosave' class='btn btn-info pull-right' onclick='saveMemoPanel()'>�ۑ�</button><span class='pull-right'>�@</span><button type='button' id='memocancel' class='btn btn-default pull-right' onclick='reReadMemoPanel()'>�L�����Z��</button></div>");
		
		window.location.hash = "#"+file;
		
	}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
		// �ʏ�͂�����textStatus��errorThrown�̒l�����ď�����؂蕪���邩�A�P���ɒʐM�Ɏ��s�����ۂ̏������L�q���܂��B

		// this;
		// this�͑��̃R�[���o�b�N�֐����l��AJAX�ʐM���̃I�v�V�����������܂��B

		// �G���[���b�Z�[�W�̕\��
		alert('Error : ' + errorThrown);
	});
	// �T�u�~�b�g��A�y�[�W�������[�h���Ȃ��悤�ɂ���
	return false;
}



function reReadMemoPanel(){

	file = $("#memoform").next().val();
	var makeMemoPanel = $("#memoform").parent();
	var h = makeMemoPanel.height();
	makeMemoPanel.height(h).css('background','url(\"/Memoria/img/grid-gray.svg\") center center no-repeat').css('background-size','20% auto');
	
	
	$.ajax({
		beforeSend: function(xhr){
			xhr.overrideMimeType('text/html;charset=Shift_JIS');
		},
		type: "POST",
		scriptCharset:'Shift_JIS',
		url: "./todo/changeMemo.php",
		data: {"file":file,"do":"readtxt"},
	}).done(function(data, dataType) {
		// done�̃u���b�N���́AAjax�ʐM�����������ꍇ�ɌĂяo�����
		
		// PHP����Ԃ��Ă����f�[�^�̕\��
		makeMemoPanel.html(data).height("auto").css('background','');
		$("#memobotton").remove();
		
		window.location.hash = "#"+file;

	}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
		// �ʏ�͂�����textStatus��errorThrown�̒l�����ď�����؂蕪���邩�A�P���ɒʐM�Ɏ��s�����ۂ̏������L�q���܂��B

		// this;
		// this�͑��̃R�[���o�b�N�֐����l��AJAX�ʐM���̃I�v�V�����������܂��B

		// �G���[���b�Z�[�W�̕\��
		alert('Error : ' + errorThrown);
	});
	// �T�u�~�b�g��A�y�[�W�������[�h���Ȃ��悤�ɂ���
	return false;
}

function saveMemoPanel() {
	file = $("#memoform").next().val();
	var makeMemoPanel = $("#memoform").parent();
	var text = $("#memoform").val();
	
	//�`�F�b�N�{�b�N�X�̊m�F
	if($('#lockmemo').prop('checked')) var lockmemo = "y";
	else var lockmemo = "n";
	if($('#minisize').prop('checked')) var min = "n";
	else var min = "y";
	
	var h = makeMemoPanel.height();

	makeMemoPanel.height(h).css('background','url(\"/Memoria/img/grid-gray.svg\") center center no-repeat').css('background-size','20% auto');

	
	$.ajax({
		beforeSend: function(xhr){
			xhr.overrideMimeType('text/html;charset=Shift_JIS');
		},
		type: "POST",
		scriptCharset:'Shift_JIS',
		url: "./todo/changeMemo.php",
		data: {"file":file,"do":"change","txt":text,"min":min,"lockmemo":lockmemo},
	}).done(function(data, dataType) {
		// done�̃u���b�N���́AAjax�ʐM�����������ꍇ�ɌĂяo�����

		// PHP����Ԃ��Ă����f�[�^�̕\��
		makeMemoPanel.html(data).height("auto").css('background','');
		$("#memobotton").remove();
		
		window.location.hash = "#"+file;

	}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
		// �ʏ�͂�����textStatus��errorThrown�̒l�����ď�����؂蕪���邩�A�P���ɒʐM�Ɏ��s�����ۂ̏������L�q���܂��B

		// this;
		// this�͑��̃R�[���o�b�N�֐����l��AJAX�ʐM���̃I�v�V�����������܂��B

		// �G���[���b�Z�[�W�̕\��
		alert('Error : ' + errorThrown);
	});
	// �T�u�~�b�g��A�y�[�W�������[�h���Ȃ��悤�ɂ���
	return false;
}

function deleteMemoPanel(path, file) {
	ret = confirm(file + "��{���ɍ폜���܂����H��낵���ł����H");
	if (ret == true){
		document.getElementById(file).style.display="none";
		location.href = "./todo/changeMemo.php?path=../"+path+"&do=delete";
	}


}

function switchingMemoPanel(element) {
	$(element).parent().next('div').stop().slideToggle(500);
	$(element).parent().next().next('div').stop().slideToggle(500);
	$(element).prev().stop().slideToggle(500);
	element.children[0].classList.toggle("glyphicon-resize-full");
	element.children[0].classList.toggle("glyphicon-resize-small");
}


</script>