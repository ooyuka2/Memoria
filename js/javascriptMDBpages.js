// ##############################################################################################################################
//
//            �ǂݍ��ݎ��̊֐�
//
// ##############################################################################################################################
//$("#todo_tree_comp")������Γǂݍ��ފ֐�
$(document).ready(function(){
	
	if($("#todo_tree_comp").length) {
		if(getParam('d') == "detail" || getParam('d') == null  || getParam('d') == "todo") {
			if(getParam('d') != null) var d = getParam('d');
			else var d = "todo";
			if(getParam('p') != null) var p = getParam('p');
			else var p = 0;
			if(getParam('list') != null) var list = getParam('list');
			else var list = "";
			if(getParam('file') != null) var file = getParam('file');
			else var file = "todo";
			read_todo_tree(d, p, list, file);
		}
	}
	
	if($("#todo_space_comp").length && $("#todo_space_comp").html() == "") {
		read_memo();
	}
	
	if($("#todo_regularly_comp").length) {
		read_todo_regularly();
	}
	
	if($("#todo_keeper_comp").length) {
		read_keeper("1");
	}
	
	if($("#tools").length) {
		read_tool_php('/Memoria/pages/tools/tools.php', 'toolstab');
	}
	
	/*
	DD = new Date();
	if(DD.getHours() == 12) {
		$('head link:last').after('<link rel="stylesheet" href="/Memoria/img/bootstrap4/MDB/css/fairly.css">');
		setHref( "" );
	}
	*/
});
/*
	<?php
		if(!isset($_GET['p']) || $_GET['p']>=count($todo)) {
			echo 'todo_serch("");';
		}
	?>








*/



// ##############################################################################################################################
//
//           �i�r�Q�[�V�����̊֐�
//
// ##############################################################################################################################

$(document).ready(function() {
	
	// Drawer�ǂݍ���
	$('.drawer').drawer();
	
	// �h�����[���j���[���J�����Ƃ�
	$('.drawer').on('drawer.opened', function(){
		//alert('�h�����[���J���܂���');
		
	});
 
	// �h�����[���j���[�������Ƃ�
	$('.drawer').on('drawer.closed', function(){
		//alert('�h�����[�������܂���');
		 $(".drawer-hamburger").css("display","");
	});
});

function navOnload() {
	if($('.activenav').length) {
		$('.activenav').find('li').slideToggle(500);
		document.getElementsByClassName('activenav')[0].children[0].children[2].classList.toggle("fa-angle-down");
		document.getElementsByClassName('activenav')[0].children[0].children[2].classList.toggle("fa-angle-up");
	}
}

function navToggle(element) {
	$(element).parent().find('li').slideToggle(500);
	element.children[2].classList.toggle("fa-angle-down");
	element.children[2].classList.toggle("fa-angle-up");
}

$(".box__area").hover(function() {

});

$(function() {
	$(".drawer-hover").hover(
		function(){
			$(".drawer-hamburger").css("display","none");
			$('.drawer').drawer('open');
		}
	);
});
/*
$('#link').hover(function() {
    var t = setTimeout(function() {
      //�}�E�X�I�[�o�[���ɍs������Ajax����
      alert("ss");
    }, 1000);
    $(this).data('timeout', t);
}, function() {
    clearTimeout($(this).data('timeout'));
});
$(this)
*/
// ##############################################################################################################################
//
//            todo_tree�̊֐�
//
// ##############################################################################################################################

//todo_tree��ǂݍ��ނ��߂̊֐�
function read_todo_tree(d, p, list, todofile) {
	$("#todo_tree_comp").css('background','url(\"../img/grid-gray.svg\") center center no-repeat').css('background-size','20% auto').css('min-height','500px');
	$.ajax({
		beforeSend: function(xhr){
			xhr.overrideMimeType('text/html;charset=Shift_JIS');
		},
		type: "GET",
		scriptCharset:'Shift_JIS',
		url: '/Memoria/MDBpages/todo/todo_tree.php',
		data: {"d":d, "p":p, "list":list, "file":todofile},
	}).done(function(data, dataType) {
		// done�̃u���b�N���́AAjax�ʐM�����������ꍇ�ɌĂяo�����
		// PHP����Ԃ��Ă����f�[�^�̕\��
		$("#todo_tree_comp").html(data).css('background','');
		setDateTime_start();
	}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
		// �ʏ�͂�����textStatus��errorThrown�̒l�����ď�����؂蕪���邩�A�P���ɒʐM�Ɏ��s�����ۂ̏������L�q���܂��B
		// this;
		// this�͑��̃R�[���o�b�N�֐����l��AJAX�ʐM���̃I�v�V�����������܂��B
		// �G���[���b�Z�[�W�̕\��
		//alert('Error : ' + errorThrown);
		read_todo_tree(d, p, list, todofile);
	});
	// �T�u�~�b�g��A�y�[�W�������[�h���Ȃ��悤�ɂ���
	return false;
}

function tree_operate(element) {
	$(element).parent().children('div').stop().slideToggle(500);
	element.classList.toggle("fa-chevron-right");
	element.classList.toggle("fa-chevron-down");
}

function tree_open() {
	while($(".fa-chevron-right").length > 0) {
		var element = document.getElementsByClassName("fa-chevron-right")[0];
		element.classList.toggle("fa-chevron-down");
		$(element).parent().children('div').slideDown(500);
		element.classList.toggle("fa-chevron-right");
	}
}

function tree_close() {
	while($(".fa-chevron-down").length > 0) {
		var element = document.getElementsByClassName("fa-chevron-down")[0];
		element.classList.toggle("fa-chevron-right");
		$(element).parent().children('div').slideUp(500);
		element.classList.toggle("fa-chevron-down");
	}
}


// ##############################################################################################################################
//
//            �����p�l���p�̊֐�
//
// ##############################################################################################################################

function read_memo(){
	$("#todo_space_comp").css('background','url(\"../img/grid-gray.svg\") center center no-repeat').css('background-size','20% auto').css('min-height','500px');
	$.ajax({
		beforeSend: function(xhr){
			xhr.overrideMimeType('text/html;charset=Shift_JIS');
		},
		type: "GET",
		scriptCharset:'Shift_JIS',
		url: '/Memoria/MDBpages/todo/memo.php',
	}).done(function(data, dataType) {
		// done�̃u���b�N���́AAjax�ʐM�����������ꍇ�ɌĂяo�����
		// PHP����Ԃ��Ă����f�[�^�̕\��
		$("#todo_space_comp").html(data).css('background','');
	}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
		// �ʏ�͂�����textStatus��errorThrown�̒l�����ď�����؂蕪���邩�A�P���ɒʐM�Ɏ��s�����ۂ̏������L�q���܂��B
		// this;
		// this�͑��̃R�[���o�b�N�֐����l��AJAX�ʐM���̃I�v�V�����������܂��B
		// �G���[���b�Z�[�W�̕\��
		read_memo();
	});
	// �T�u�~�b�g��A�y�[�W�������[�h���Ȃ��悤�ɂ���
	return false;
}


function switchingMemoPanel(element) {
	$(element).parent().next('div').stop().slideToggle(500);
	$(element).parent().next().next('div').stop().slideToggle(500);
	$(element).prev().stop().slideToggle(500);
	element.children[0].classList.toggle("fa-expand");
	element.children[0].classList.toggle("fa-compress");
}



// ##############################################################################################################################
//
//            ���ԊǗ��̕\���p�̊֐�
//
// ##############################################################################################################################

function read_keeper(days){
	$("#todo_keeper_comp").css('background','url(\"../img/grid-gray.svg\") center center no-repeat').css('background-size','20% auto').css('min-height','500px');
	$.ajax({
		beforeSend: function(xhr){
			xhr.overrideMimeType('text/html;charset=Shift_JIS');
		},
		type: "GET",
		scriptCharset:'Shift_JIS',
		url: '/Memoria/MDBpages/todo/keeper.php',
		data: {"day":days},
	}).done(function(data, dataType) {
		// done�̃u���b�N���́AAjax�ʐM�����������ꍇ�ɌĂяo�����
		// PHP����Ԃ��Ă����f�[�^�̕\��
		$("#todo_keeper_comp").html(data).css('background','').css('min-height','');
	}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
		// �ʏ�͂�����textStatus��errorThrown�̒l�����ď�����؂蕪���邩�A�P���ɒʐM�Ɏ��s�����ۂ̏������L�q���܂��B
		// this;
		// this�͑��̃R�[���o�b�N�֐����l��AJAX�ʐM���̃I�v�V�����������܂��B
		// �G���[���b�Z�[�W�̕\��
		read_keeper(days);
	});
	// �T�u�~�b�g��A�y�[�W�������[�h���Ȃ��悤�ɂ���
	return false;
}



// ##############################################################################################################################
//
//            ��邱�ƃ����̕\���p�̊֐�
//
// ##############################################################################################################################

function read_todo_regularly(){
	$("#todo_regularly_comp").css('background','url(\"../img/grid-gray.svg\") center center no-repeat').css('background-size','20% auto').css('min-height','200px');
	$.ajax({
		beforeSend: function(xhr){
			xhr.overrideMimeType('text/html;charset=Shift_JIS');
		},
		type: "GET",
		scriptCharset:'Shift_JIS',
		url: '/Memoria/pages/todo/todo_regularly.php',
		data: {"pagetype":"MDBpages"},
	}).done(function(data, dataType) {
		// done�̃u���b�N���́AAjax�ʐM�����������ꍇ�ɌĂяo�����
		$("#todo_regularly_comp").html(data).css('background','').css('min-height','');
	}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
		// �ʏ�͂�����textStatus��errorThrown�̒l�����ď�����؂蕪���邩�A�P���ɒʐM�Ɏ��s�����ۂ̏������L�q���܂��B
		// this;
		// this�͑��̃R�[���o�b�N�֐����l��AJAX�ʐM���̃I�v�V�����������܂��B
		// �G���[���b�Z�[�W�̕\��
		read_todo_regularly();
	});
	// �T�u�~�b�g��A�y�[�W�������[�h���Ȃ��悤�ɂ���
	return false;
}

function change_todo_regularly_privateuser(change, numbers) {
	$.ajax({
		beforeSend: function(xhr){
			xhr.overrideMimeType('text/html;charset=Shift_JIS');
		},
		type: "GET",
		scriptCharset:'Shift_JIS',
		url: '/Memoria/pages/todo/todo_regularly.php',
		data: {"pagetype":"MDBpages", "change":change, "number":numbers},
	}).done(function(data, dataType) {
		// done�̃u���b�N���́AAjax�ʐM�����������ꍇ�ɌĂяo�����
		// PHP����Ԃ��Ă����f�[�^�̕\��
		read_todo_regularly();
		
	}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
		// �ʏ�͂�����textStatus��errorThrown�̒l�����ď�����؂蕪���邩�A�P���ɒʐM�Ɏ��s�����ۂ̏������L�q���܂��B
		// this;
		// this�͑��̃R�[���o�b�N�֐����l��AJAX�ʐM���̃I�v�V�����������܂��B
		// �G���[���b�Z�[�W�̕\��
		read_todo_regularly();
	});
	// �T�u�~�b�g��A�y�[�W�������[�h���Ȃ��悤�ɂ���
	return false;
}


// ##############################################################################################################################
//
//            todo�̌����p�̊֐�
//
// ##############################################################################################################################
function todo_serch(searchtext){
	if(searchtext != "" && $("#todo_space_comp").length) {
		//var h = makeform.height();
		$("#todo_space_comp").css('background','url(\"../img/grid.svg\") center center no-repeat').css('background-size','20% auto').css('min-height','500px');
		
		$.ajax({
			beforeSend: function(xhr){
				xhr.overrideMimeType('text/html;charset=Shift_JIS');
			},
			type: "GET",
			scriptCharset:'Shift_JIS',
			url: "/Memoria/pages/todo/todo_serch.php",
			data: {"search":searchtext,"pagetype":"MDBpages"},
		}).done(function(data, dataType) {
			// done�̃u���b�N���́AAjax�ʐM�����������ꍇ�ɌĂяo�����

			// PHP����Ԃ��Ă����f�[�^�̕\��
			$("#todo_space_comp").html(data).height("auto").css('background','');

		}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
			// �ʏ�͂�����textStatus��errorThrown�̒l�����ď�����؂蕪���邩�A�P���ɒʐM�Ɏ��s�����ۂ̏������L�q���܂��B

			// this;
			// this�͑��̃R�[���o�b�N�֐����l��AJAX�ʐM���̃I�v�V�����������܂��B

			// �G���[���b�Z�[�W�̕\��
			//alert('Error : ' + errorThrown);
			todo_serch(searchtext);
		});
	} else if($("#todo_space_comp").length) {

		var arg  = new Object;
		url = location.search.substring(1).split('&');
		/*
		for(i=0; url[i]; i++) {
			var k = url[i].split('=');
			arg[k[0]] = k[1];
		}
		if(arg.list != undefined) {
			var url = "./todo/" + arg.list + ".php";
			}

		} elseif(arg.p != undefined && arg.d == "todo") {
			var url = "./todo/todo.php?d=todo&p=" + arg.p;
		}

		 else {		*/
			var url = "/Memoria/MDBpages/todo/memo.php";
		//}
		
		$.ajax({
			beforeSend: function(xhr){
				xhr.overrideMimeType('text/html;charset=Shift_JIS');
			},
			type: "GET",
			scriptCharset:'Shift_JIS',
			url: url,
			data: {"search":searchtext},
		}).done(function(data, dataType) {
			// done�̃u���b�N���́AAjax�ʐM�����������ꍇ�ɌĂяo�����

			// PHP����Ԃ��Ă����f�[�^�̕\��
			$("#todo_space_comp").html(data);

		}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
			// �ʏ�͂�����textStatus��errorThrown�̒l�����ď�����؂蕪���邩�A�P���ɒʐM�Ɏ��s�����ۂ̏������L�q���܂��B

			// this;
			// this�͑��̃R�[���o�b�N�֐����l��AJAX�ʐM���̃I�v�V�����������܂��B

			// �G���[���b�Z�[�W�̕\��
			//alert('Error : ' + errorThrown);
			todo_serch(searchtext);
		});
	} else if(!$("#noserachalert").length) {
		$('main').prepend("<div class=\"alert alert-warning alert-dismissible fade show col-12\" role=\"alert\" id=\"noserachalert\"><strong>�c�O</strong>���̃y�[�W�ł͌����ł��Ȃ��ł���B<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button></div>");
	}
	// �T�u�~�b�g��A�y�[�W�������[�h���Ȃ��悤�ɂ���
	return false;
}


  
  
    
  



// ##############################################################################################################################
//
//            todo�ҏW�p�̊֐�
//
// ##############################################################################################################################

	function todo_delete_check(tilte, id){
		ret = confirm(tilte + "��{���ɍ폜���܂����H��낵���ł����H");
		if (ret == true){
			location.href = '/Memoria/pages/todo/delete.php?delete=OK&id='+id+'&pages=MDBpages';
		}
	}
	

// ##############################################################################################################################
//
//            �e�[�u���p�̊֐�
//
// ##############################################################################################################################
$(document).ready(function(){
	
	if($("#datatable").length) {

		jQuery(function($){
			$.extend( $.fn.dataTable.defaults, { 
				language: {
					url: "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Japanese.json"
				} 
			}); 
			$('#datatable').dataTable({
				// �����ؑւ̒l��10�`50��10���݂ɂ���
				lengthMenu: [ 50, 100, 150, 200, 250, 300, 500, 750, 1000 ],
				// �����̃f�t�H���g�̒l��50�ɂ���
				displayLength: 250,  
				//stateSave: true,
				columnDefs: [
					// 2��ڂ�����(visible��false�ɂ���Ə����܂�)
					{ targets: 1, visible: false },
					{ targets: 3, visible: false },
				],
				responsive: true, order: [[3, 'desc']],
			});

		});
		
	}
});
$(document).ready(function(){
	
	if($("#tables").length) {

		jQuery(function($){
			$.extend( $.fn.dataTable.defaults, { 
				language: {
					url: "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Japanese.json"
				} 
			}); 
			$('#tables').dataTable({
				// �����ؑւ̒l��10�`50��10���݂ɂ���
				lengthMenu: [ 25, 50, 100, 150, 200, 250, 300, 500, 750, 1000 ],
				// �����̃f�t�H���g�̒l��50�ɂ���
				displayLength: 100,  
				//stateSave: true,
				columnDefs: [
				],
				responsive: true, order: [[0, 'asc']],
				scrollX: true,
				scrollY: 800
			});

		});
		
	}
});
if($("#furi").length && $("#name").length) {
	$(function() {
		$.fn.autoKana('#name', '#furi', {
			katakana : false  //true�F�J�^�J�i�Afalse�F�Ђ炪�ȁi�f�t�H���g�j
		});
	});
}
function check_furi() {
	if($("#furi").length && document.getElementById("furi").value=="")
	document.getElementById("furi").value=document.getElementById("name").value;
}

function delete_check(tilte, id, type){
	ret = confirm(tilte + "��{���ɍ폜���܂����H��낵���ł����H");
	if (ret == true){
		location.href = './' + type + '/table_make.php?type=delete&p=' + id;
	}
}

// ##############################################################################################################################
//
//            �y�[�W��ǂݍ��ފ֐�
//
// ##############################################################################################################################
function read_tool_php(filepath, tabname) {
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
	$("#tools").css('background','url(\"../img/grid.svg\") center center no-repeat').css('background-size','20% auto');
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
		url: "/Memoria/pages/tools/tools/compare.php",
		data: {"txtA":document.getElementById('txtA').value, "txtB":document.getElementById('txtB').value, "type":type, "pagetype":"MDBpages" },
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
		url: "/Memoria/pages/tools/tools/compare_form.php",
		data: {"txtA":txtA, "txtB":txtB, "pagetype":"MDBpages"},
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
		url: "/Memoria/pages/tools/tools/read_md.php",
		data: {"file":filepath, "pagetype":"MDBpages"},
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
//            �X�}�[�g�e�[�u���p�̊֐�
//
// ##############################################################################################################################
$(document).ready(function(){
	
	if($("#smarttable").length) {
		smartTable_hidden("#smarttable", 6, 2);
		smartTable_hidden("#smarttable", 6, 4);
	}
});

function smartTable_hidden(name, all, n) {
	$( name + " tr > th:nth-child(" + all + "n + " + n + ")" ).addClass("d-none");
	$( name + " tr > td:nth-child(" + all + "n + " + n + ")" ).addClass("d-none");
	//$("#smarttable td:nth-child(6n+1)").addClass("d-none");
}

