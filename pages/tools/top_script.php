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
	if(tabname == "resulttab") {
		$("li.hidden").removeClass("hidden");
		$("#"+tabname).addClass("show");
	} else if($('li.show').get()) {
		$("li.show").removeClass("");
		$("#resulttab").addClass("hidden");
	}
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
		//alert('Error : ' + errorThrown);
		read_tool_php(filepath, tabname);
	});
	// �T�u�~�b�g��A�y�[�W�������[�h���Ȃ��悤�ɂ���
	return false;
}



// ##############################################################################################################################
//
//            ��r�pphp�ǂݍ��݊֐�
//
// ##############################################################################################################################
function goto_compare(type) {
	$("#tools").css('background','url(\"../img/grid.svg\") center center no-repeat').css('background-size','20% auto');
	$.ajax({
		beforeSend: function(xhr){
			xhr.overrideMimeType('text/html;charset=Shift_JIS');
		},
		type: "POST",
		scriptCharset:'Shift_JIS',
		url: '<?php echo $ini['dirhtml']."/pages/tools/tools/compare.php";?>',
		data: {"txtA":document.getElementById('txtA').value, "txtB":document.getElementById('txtB').value, "type":type },
	}).done(function(data, dataType) {
		// done�̃u���b�N���́AAjax�ʐM�����������ꍇ�ɌĂяo�����

		// PHP����Ԃ��Ă����f�[�^�̕\��
		$("#tools").html(data).css('background','');

	}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
		// �ʏ�͂�����textStatus��errorThrown�̒l�����ď�����؂蕪���邩�A�P���ɒʐM�Ɏ��s�����ۂ̏������L�q���܂��B

		// this;
		// this�͑��̃R�[���o�b�N�֐����l��AJAX�ʐM���̃I�v�V�����������܂��B

		// �G���[���b�Z�[�W�̕\��
		//alert('Error : ' + errorThrown);
		goto_compare();
	});
	// �T�u�~�b�g��A�y�[�W�������[�h���Ȃ��悤�ɂ���
	return false;
}

function return_compareform(txtA, txtB) {
	$("#tools").css('background','url(\"../img/grid.svg\") center center no-repeat').css('background-size','20% auto');
	$.ajax({
		beforeSend: function(xhr){
			xhr.overrideMimeType('text/html;charset=Shift_JIS');
		},
		type: "POST",
		scriptCharset:'Shift_JIS',
		url: '<?php echo $ini['dirhtml']."/pages/tools/tools/compare_form.php";?>',
		data: {"txtA":txtA, "txtB":txtB},
	}).done(function(data, dataType) {
		// done�̃u���b�N���́AAjax�ʐM�����������ꍇ�ɌĂяo�����

		// PHP����Ԃ��Ă����f�[�^�̕\��
		$("#tools").html(data).css('background','');

	}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
		// �ʏ�͂�����textStatus��errorThrown�̒l�����ď�����؂蕪���邩�A�P���ɒʐM�Ɏ��s�����ۂ̏������L�q���܂��B

		// this;
		// this�͑��̃R�[���o�b�N�֐����l��AJAX�ʐM���̃I�v�V�����������܂��B

		// �G���[���b�Z�[�W�̕\��
		//alert('Error : ' + errorThrown);
		return_compareform(txtA, txtB);
	});
	// �T�u�~�b�g��A�y�[�W�������[�h���Ȃ��悤�ɂ���
	return false;
}

// ##############################################################################################################################
//
//            MarkDown�œǂݍ��݃y�[�W�p�֐�
//
// ##############################################################################################################################

function read_md_php(filepath) {
	$("#tools").css('background','url(\"../img/grid.svg\") center center no-repeat').css('background-size','20% auto');
	$.ajax({
		beforeSend: function(xhr){
			xhr.overrideMimeType('text/html;charset=Shift_JIS');
		},
		type: "POST",
		scriptCharset:'Shift_JIS',
		url: '<?php echo $ini['dirhtml']."/pages/tools/tools/read_md.php";?>',
		data: {"file":filepath},
	}).done(function(data, dataType) {
		// done�̃u���b�N���́AAjax�ʐM�����������ꍇ�ɌĂяo�����
		// PHP����Ԃ��Ă����f�[�^�̕\��
		$("#tools").html(data).css('background','');
	}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
		// �ʏ�͂�����textStatus��errorThrown�̒l�����ď�����؂蕪���邩�A�P���ɒʐM�Ɏ��s�����ۂ̏������L�q���܂��B
		// this;
		// this�͑��̃R�[���o�b�N�֐����l��AJAX�ʐM���̃I�v�V�����������܂��B
		// �G���[���b�Z�[�W�̕\��
		//alert('Error : ' + errorThrown);
		read_md_php(filepath);
	});
	// �T�u�~�b�g��A�y�[�W�������[�h���Ȃ��悤�ɂ���
	return false;
}


// ##############################################################################################################################
//
//            �ꎞ�I�ȃv���O�����̕ۑ��p�֐�
//
// ##############################################################################################################################

function playground_save() {
	// HTML�ł̑��M���L�����Z��
	event.preventDefault();

	// ����Ώۂ̃t�H�[���v�f���擾
	var $form = $("#program_form");

	// ���M�{�^�����擾
	var $button = $('#submitbtn');

	$.ajax({
		beforeSend: function(xhr){
			xhr.overrideMimeType('text/html;charset=Shift_JIS');
			$button.attr('disabled', true);
		},
		// ������
		complete: function(xhr, textStatus) {
			// �{�^����L�������A�đ��M������
			$button.attr('disabled', false);
		},
		url: $form.attr('action'),
		type: $form.attr('method'),
		data: $form.serialize(),
		timeout: 10000,  // �P�ʂ̓~���b
	}).done(function(data, dataType) {
		// done�̃u���b�N���́AAjax�ʐM�����������ꍇ�ɌĂяo�����
		// PHP����Ԃ��Ă����f�[�^�̕\��

		read_tool_php("/Memoria/data/tools/temp.php", "resulttab");
		$("#tools").before(data);
		//$("#tools").html(data + "<br><br>" + beforehtml).css('background','');
	}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
		// �ʐM���s���̏���
		alert('NG...');
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
</script>