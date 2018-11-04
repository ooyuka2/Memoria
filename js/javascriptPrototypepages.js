


// ##############################################################################################################################
//
//            �ǂݍ��ݎ��̊֐�
//
// ##############################################################################################################################
//$("#todo_tree_comp")������Γǂݍ��ފ֐�
$(document).ready(function(){
	
	if($("#tools2").length) {
		read_tool_php2('/Memoria/prototype/maketestdata/tools.php', 'toolstab');
	}
	
	if($("#chart_work_incident").length) {
		read_php_ajax('/Memoria/prototype/graph/chart_work_incident.php', "#chart_work_incident");
	}
	if($("#chart_where_os").length) {
		read_php_ajax('/Memoria/prototype/graph/chart_where_os.php', "#chart_where_os");
	}

});

function read_php_ajax(path, dom) {
	$(dom).css('background','url(\"../img/grid-gray.svg\") center center no-repeat').css('background-size','20% auto').css('min-height','500px');
	$.ajax({
		beforeSend: function(xhr){
			xhr.overrideMimeType('text/html;charset=Shift_JIS');
		},
		type: "GET",
		scriptCharset:'Shift_JIS',
		url: path,
	}).done(function(data, dataType) {
		// done�̃u���b�N���́AAjax�ʐM�����������ꍇ�ɌĂяo�����
		// PHP����Ԃ��Ă����f�[�^�̕\��
		$(dom).html(data).css('background','');
	}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
		read_php_ajex(path, dom);
	});
	// �T�u�~�b�g��A�y�[�W�������[�h���Ȃ��悤�ɂ���
	return false;
}

// ##############################################################################################################################
//
//            �e�X�g�f�[�^�쐬�p�̊֐�
//
// ##############################################################################################################################


function read_tool_php2(filepath, tabname) {
	if(tabname == "resulttab") {
		$("li.d-none").removeClass("d-none");
		$("#"+tabname).addClass("d-block");
	} else if($('li.d-block').get()) {
		$("li.d-block").removeClass("d-block");
		$("#resulttab").addClass("d-none");
	}
	if(!$("#"+tabname).hasClass('active')) {
		$("a.active").removeClass("active");
		$("#"+tabname+" a:first").addClass("active");
		
	}
	$("#tools2").css('background','url(\"../img/grid.svg\") center center no-repeat').css('background-size','20% auto');
	$.ajax({
		beforeSend: function(xhr){
			xhr.overrideMimeType('text/html;charset=Shift_JIS');
		},
		type: "GET",
		scriptCharset:'Shift_JIS',
		url: filepath,
		data: {"pagetype":"MDBpages"},
	}).done(function(data, dataType) {
		// done�̃u���b�N���́AAjax�ʐM�����������ꍇ�ɌĂяo�����
		// PHP����Ԃ��Ă����f�[�^�̕\��
		$("#tools2").html(data).css('background','');
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

