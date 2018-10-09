
// ##############################################################################################################################
//
//            �ǂݍ��ݎ��̊֐�
//
// ##############################################################################################################################
//$("#todo_tree_comp")������Γǂݍ��ފ֐�
$(document).ready(function(){

	
	if($("#weather_comp").length) {
		read_weather();
	}
	resize_textarea();
	setDateTime_start();
});


// ##############################################################################################################################
//
//            �S�̓I�ɂ悭�g���֐�
//
// ##############################################################################################################################

function resize_textarea() {
	//textarea�t�H�[�J�X���ɕ������̍������ă��T�C�Y
	$('textarea').keyup(function(e) {
		//���������獂���擾
		var height=this.scrollHeight + 'px';
		$(this).css("height", height);
		})
		.blur(function(e) {
		//$(this).css("height", "auto");
	});
}

document.onkeydown = 
	function (e) {
		if (event.ctrlKey ){
			 if (event.keyCode == 83){
				//alert("Crtl + S");
				event.keyCode = 0;
				return false;
			 }
		}
		if (e != null){
			if ((e.ctrlKey || e.metaKey) && e.which == 115){
				//alert("Crtl + S");
				return false;
			}
		}
		
	}


function setDateTime_start() {
	if($(".noki").size() || $(".kaisi").size() || $(".syuryo").size()) {
		$(".noki").datepicker({ dateFormat: "yy/mm/dd" });
		$(".kaisi").datepicker({ dateFormat: "yy/mm/dd" });
		$(".syuryo").datepicker({ dateFormat: "yy/mm/dd" });
		
		
		for(var i=document.getElementsByClassName("td-n2").length-1; i>=0; i--) {
			document.body.removeChild(document.getElementsByClassName("td-n2")[i]);
		}
	}
	
	if($(".time").size()) {	
		$( ".time" ).timeDropper({
			//�@�\�I�v�V����
			autoswitch: false,					//�N���b�N�ʒu�ړ�
			meridians: false,					 //12���� / 24���ԕ\��
			format: "HH:mm",					 //�����t�H�[�}�b�g
			mousewheel: false,					//�}�E�X�z�C�[����
			init_animation: "fadeIn",	 //�����A�j���[�V����
			setCurrentTime: false,			 //���ݎ����̐ݒ�

			//�X�^�C���I�v�V����
			primaryColor: "#1977cc",		//�ݒ蒆�̕���
			textColor: "#555555",			 //�ݒ��̕���
			backgroundColor: "#ffffff", //�w�i
			borderColor: "#1977cc"			//�g��
		});
	}
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

/**
 * Get the URL parameter value
 *
 * @param  name {string} �p�����[�^�̃L�[������
 * @return  url {url} �Ώۂ�URL������i�C�Ӂj
 */
function getParam(name, url) {
	if (!url) url = window.location.href;
	name = name.replace(/[\[\]]/g, "\\$&");
	var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
		results = regex.exec(url);
	if (!results) return null;
	if (!results[2]) return '';
	return decodeURIComponent(results[2].replace(/\+/g, " "));
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
//            �E�N���b�N���j���[�p�̊֐�
//
// ##############################################################################################################################
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

document.onmousemove = function (e){
	if(document.getElementById("tree_menu")) {
	var mouse_x=document.body.scrollLeft+event.clientX;
	var mouse_y=document.body.scrollTop+event.clientY;
	if(abs(mouse_x-tree_menu_x)>150 && abs(mouse_y-tree_menu_y)>150) document.getElementById("todo_tree_menu").innerHTML = "";
	}
};

if(document.getElementById("todo_tree_menu")) {
	$('#myTabContent').on('dblclick', function() {
		document.getElementById("todo_tree_menu").innerHTML = "";
	});
}

var tree_menu_x = 0;
var tree_menu_y = 0;

function tree_menu(id, top, pre, child, wait, whatdotoday, todofile) {
	tree_menu_x=event.clientX;//document.body.scrollLeft+
	tree_menu_y=event.clientY;//document.body.scrollTop+
	
	var menu = "<div class='btn-group-vertical' style='position: fixed; z-index: 1;' id='tree_menu'>";//

	if(pre!=100) { //child == 0 && 
		menu = menu + "<div class='btn-group' role='group'><button type='button' class='btn btn-default dropdown-toggle btn-xs btn-block' data-toggle='dropdown' aria-expanded='false'>��Ɛݒ�<span class='caret'></span></button><ul class='dropdown-menu' role='menu'>";
		
		for(j=Math.ceil(pre/10)*10; j<100; j+=10) 
		menu = menu + "<li role='presentation'><a role='menuitem' tabindex='-1' href='todo.php?page=whatdo&p="+id+"&f="+j+"' class='text-dark' style='padding-left:20px;'>"+j+"���܂Ŋ���</a></li>";
		menu = menu + "</ul>";
		menu = menu + "</div>";
	}
	
	if(wait == "") wait = 0;
	
	if(todofile  === "todo") menu = menu + "<a href='todo.php?page=whatdo&f=100&p="+id+"&file="+todofile+"' class='btn btn-default btn-xs btn-block'>�����ݒ�</a>";
	if(todofile  === "todo" && pre==100) menu = menu + "<a href='./todo/nofinish.php?p="+id+"' class='btn btn-default btn-xs btn-block'>�������ݒ�</a>";
	menu = menu + "<a href='todo.php?d=todo&p="+id+"&file="+todofile+"' class='btn btn-default btn-xs btn-block'>�����N���J��</a>";
	menu = menu + "<a href='todo.php?d=todo&p="+id+"&file="+todofile+"' class='btn btn-default btn-xs btn-block' target='_blank' >�V�����^�u�Ń����N���J��</a>";
	menu = menu + "<a href='todo.php?d=todo&p="+top+"&file="+todofile+"' class='btn btn-default btn-xs btn-block'>�ڍ׉�ʂ��J��</a>";
	if(todofile  === "todo") menu = menu + "<a href='todo.php?d=change&p="+top+"&file="+todofile+"' class='btn btn-default btn-xs btn-block'>�ҏW���J��</a>";
	menu = menu + "<a href='todo.php?d=renew&p="+top+"&file="+todofile+"' class='btn btn-default btn-xs btn-block'>���p����</a>";
	menu = menu + "<a href='todo.php?d=detail&p="+top+"&file="+todofile+"' class='btn btn-default btn-xs btn-block'>�t�B���^�[</a>";
	if((whatdotoday == 0 || whatdotoday == 2) && pre!=100) menu = menu + "<button class='btn btn-default btn-xs btn-block' onclick='todo_tree_wait("+top+", \"turn\", 1)'>�����撣��</button>";
	menu = menu + "<button class='btn btn-default btn-xs btn-block' onclick='todo_tree_wait("+top+", \"turn\", 2)'>�����撣��</button>";
	menu = menu + "<button class='btn btn-default btn-xs btn-block' onclick='todo_tree_wait("+top+", \"turn\", 0)'>���x�撣��</button>";
	if(wait == 0 && pre!=100) menu = menu + "<button class='btn btn-default btn-xs btn-block' onclick='todo_tree_wait("+id+", \"wait\", 0)'>�ۗ��ݒ�</button></div>";
	else if(pre!=100) //menu = menu + "<a href='todo.php?page=wait&p="+id+"&file="+todofile+"' class='btn btn-default btn-xs btn-block'>�����ݒ�</a></div>";
	menu = menu + "<button class='btn btn-default btn-xs btn-block' onclick='todo_tree_wait("+id+", \"wait\", 0)'>�����ݒ�</button></div>";
	
	document.getElementById("todo_tree_menu").innerHTML = menu;
	document.getElementById("tree_menu").style.left=tree_menu_x+"px";
	if(tree_menu_y < 500) document.getElementById("tree_menu").style.top=tree_menu_y+"px";
	else document.getElementById("tree_menu").style.top=tree_menu_y-150+"px";
}

//�ۗ��E�ۗ������E���������������x���̂��߂̊֐�
function todo_tree_wait(p, type, turn) {
	document.getElementById("todo_tree_menu").innerHTML = "";
	$.ajax({
		beforeSend: function(xhr){
			xhr.overrideMimeType('text/html;charset=Shift_JIS');
		},
		type: "GET",
		scriptCharset:'Shift_JIS',
		url: '/Memoria/pages/todo/change_todo_tree.php',
		data: {"type":type, "p":p, "turn":turn},
	}).done(function(data, dataType) {
		// done�̃u���b�N���́AAjax�ʐM�����������ꍇ�ɌĂяo�����
		// PHP����Ԃ��Ă����f�[�^�̕\��
		if(getParam('d') == "detail" || getParam('d') == null  || getParam('d') =="todo") {
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
		
	}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
		// �ʏ�͂�����textStatus��errorThrown�̒l�����ď�����؂蕪���邩�A�P���ɒʐM�Ɏ��s�����ۂ̏������L�q���܂��B
		// this;
		// this�͑��̃R�[���o�b�N�֐����l��AJAX�ʐM���̃I�v�V�����������܂��B
		// �G���[���b�Z�[�W�̕\��
		//alert('Error : ' + errorThrown);
		$("#todo_tree_comp").html('Error : ' + errorThrown);
	});
	// �T�u�~�b�g��A�y�[�W�������[�h���Ȃ��悤�ɂ���
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
		url: "/Memoria/pages/todo/changeMemo.php",
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
		
		//window.location.hash = "#"+file;
		
	}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
		// �ʏ�͂�����textStatus��errorThrown�̒l�����ď�����؂蕪���邩�A�P���ɒʐM�Ɏ��s�����ۂ̏������L�q���܂��B

		// this;
		// this�͑��̃R�[���o�b�N�֐����l��AJAX�ʐM���̃I�v�V�����������܂��B

		// �G���[���b�Z�[�W�̕\��
		//alert('Error : ' + errorThrown);
		changeMempPanel(file, element, min, lock);
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
		url: "/Memoria/pages/todo/changeMemo.php",
		data: {"file":file,"do":"readtxt"},
	}).done(function(data, dataType) {
		// done�̃u���b�N���́AAjax�ʐM�����������ꍇ�ɌĂяo�����
		
		// PHP����Ԃ��Ă����f�[�^�̕\��
		makeMemoPanel.html(data).height("auto").css('background','');
		$("#memobotton").remove();
		
		//window.location.hash = "#"+file;

	}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
		// �ʏ�͂�����textStatus��errorThrown�̒l�����ď�����؂蕪���邩�A�P���ɒʐM�Ɏ��s�����ۂ̏������L�q���܂��B

		// this;
		// this�͑��̃R�[���o�b�N�֐����l��AJAX�ʐM���̃I�v�V�����������܂��B

		// �G���[���b�Z�[�W�̕\��
		//alert('Error : ' + errorThrown);
		reReadMemoPanel();
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
		url: "/Memoria/pages/todo/changeMemo.php",
		data: {"file":file,"do":"change","txt":text,"min":min,"lockmemo":lockmemo},
	}).done(function(data, dataType) {
		// done�̃u���b�N���́AAjax�ʐM�����������ꍇ�ɌĂяo�����

		// PHP����Ԃ��Ă����f�[�^�̕\��
		makeMemoPanel.html(data).height("auto").css('background','');
		$("#memobotton").remove();
		
		//window.location.hash = "#"+file;

	}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
		// �ʏ�͂�����textStatus��errorThrown�̒l�����ď�����؂蕪���邩�A�P���ɒʐM�Ɏ��s�����ۂ̏������L�q���܂��B

		// this;
		// this�͑��̃R�[���o�b�N�֐����l��AJAX�ʐM���̃I�v�V�����������܂��B

		// �G���[���b�Z�[�W�̕\��
		//alert('Error : ' + errorThrown);
		saveMemoPanel();
	});
	// �T�u�~�b�g��A�y�[�W�������[�h���Ȃ��悤�ɂ���
	return false;
}

function deleteMemoPanel(path, file) {
	ret = confirm(file + "��{���ɍ폜���܂����H��낵���ł����H");
	if (ret == true){
		document.getElementById(file).style.display="none";
		location.href = "/Memoria/pages/todo/changeMemo.php?path="+path+"&do=delete";
	}


}

function changeMemoform() {
	var textarea = document.getElementById("memoform");
	if( textarea.scrollHeight > textarea.offsetHeight ){
		textarea.style.height = textarea.scrollHeight+'px';
	}
}

// ##############################################################################################################################
//
//            todo�ҏW�p�̊֐�
//
// ##############################################################################################################################


	function setDateTime(){
		for(var i=1; i<document.getElementsByClassName("name").length; i++) {
			document.getElementsByClassName("noki")[i].value = document.getElementsByClassName("noki")[0].value;
			document.getElementsByClassName("time")[i].value = document.getElementsByClassName("time")[0].value;
			document.getElementsByClassName("kaisi")[i].value = document.getElementsByClassName("kaisi")[0].value;
			document.getElementsByClassName("syuryo")[i].value = document.getElementsByClassName("syuryo")[0].value;
		}
	}



// ##############################################################################################################################
//
//            ������邱�Ɛ����̃y�[�W�p�̊֐�
//
// ##############################################################################################################################


function doBotton(id) {
	var pid = document.getElementById('pid').value;
	pid = pid + "@" + id;
	document.getElementById('pid').value = pid;
	dobuttonname = "doButton" + id;
	donotbuttonname = "donotButton" + id;
	document.getElementById(dobuttonname).classList.toggle("disabled");
	document.getElementById(donotbuttonname).classList.toggle("disabled");
	document.getElementById(dobuttonname).innerHTML = "���!";
	document.getElementById(donotbuttonname).innerHTML = "���Ȃ�";
}
function donotBotton(id) {
	var pid = document.getElementById('pid').value;
	pid = pid.replace("@"+id, "");
	document.getElementById('pid').value = pid;
	dobuttonname = "doButton" + id;
	donotbuttonname = "donotButton" + id;
	document.getElementById(dobuttonname).classList.toggle("disabled");
	document.getElementById(donotbuttonname).classList.toggle("disabled");
	document.getElementById(dobuttonname).innerHTML = "���";
	document.getElementById(donotbuttonname).innerHTML = "���Ȃ�!";
}


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
//            �V�C�\��̕\���p�̊֐�
//
// ##############################################################################################################################

function read_weather(){
	$("#weather_comp").css('background','url(\"../img/grid-gray.svg\") center center no-repeat').css('background-size','20% auto').css('min-height','100px').css('max-width','100px');
	$.ajax({
		beforeSend: function(xhr){
			xhr.overrideMimeType('text/html;charset=Shift_JIS');
		},
		type: "GET",
		scriptCharset:'Shift_JIS',
		url: '/Memoria/pages/other/weather.php',
	}).done(function(data, dataType) {
		// done�̃u���b�N���́AAjax�ʐM�����������ꍇ�ɌĂяo�����
		// PHP����Ԃ��Ă����f�[�^�̕\��
		$("#weather_comp").html(data).css('background','').css('min-height','').css('max-width','');
	}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
		// �ʏ�͂�����textStatus��errorThrown�̒l�����ď�����؂蕪���邩�A�P���ɒʐM�Ɏ��s�����ۂ̏������L�q���܂��B
		// this;
		// this�͑��̃R�[���o�b�N�֐����l��AJAX�ʐM���̃I�v�V�����������܂��B
		// �G���[���b�Z�[�W�̕\��
		read_weather();
	});
	// �T�u�~�b�g��A�y�[�W�������[�h���Ȃ��悤�ɂ���
	return false;
}



// ##############################################################################################################################
//
//            ��������ƕ\���̂��߂̃y�[�W�̊֐�
//
// ##############################################################################################################################


function toggleMail() {
	var flug = document.getElementById('work_mail').checked;
	if(flug) {
		var note = document.getElementById('note').value;
		if (note.match(/�ietc�j/)) {
			note = note.replace("�ietc�j", "�i���[���Ή�etc�j");
		} else {
			note = note.replace("etc�j", "�E���[���Ή�etc�j");
		}
		document.getElementById('note').value = note;
	} else {
		var note = document.getElementById('note').value;
		note = note.replace("�E���[���Ή�", "");
		note = note.replace("���[���Ή�", "");
		document.getElementById('note').value = note;
	}
}

function toggleDoc() {
	var flug = document.getElementById('work_doc').checked;
	if(flug) {
		var note = document.getElementById('note').value;
		if (note.match(/�ietc�j/)) {
			note = note.replace("�ietc�j", "�i�h�L�������g�X�Vetc�j");
		} else {
			note = note.replace("etc�j", "�E�h�L�������g�X�Vetc�j");
		}
		document.getElementById('note').value = note;
	} else {
		var note = document.getElementById('note').value;
		note = note.replace("�E�h�L�������g�X�V", "");
		note = note.replace("�h�L�������g�X�V", "");
		document.getElementById('note').value = note;
	}
}

function toggleMake() {
	var flug = document.getElementById('work_make').checked;
	if(flug) {
		var note = document.getElementById('note').value;
		if (note.match(/�ietc�j/)) {
			note = note.replace("�ietc�j", "�i�\�����쐬etc�j");
		} else {
			note = note.replace("etc�j", "�E�\�����쐬etc�j");
		}
		document.getElementById('note').value = note;
	} else {
		var note = document.getElementById('note').value;
		note = note.replace("�E�\�����쐬", "");
		note = note.replace("�\�����쐬", "");
		document.getElementById('note').value = note;
	}
}

function toggleTime() {
	var flug = document.getElementById('work_time').checked;
	if(flug) {
		var note = document.getElementById('note').value;
		if (note.match(/�ietc�j/)) {
			note = note.replace("�ietc�j", "�i���ԊǗ�etc�j");
		} else {
			note = note.replace("etc�j", "�E���ԊǗ�etc�j");
		}
		document.getElementById('note').value = note;
	} else {
		var note = document.getElementById('note').value;
		note = note.replace("�E���ԊǗ�", "");
		note = note.replace("���ԊǗ�", "");
		document.getElementById('note').value = note;
	}
}

function toggleWeekly() {
	var flug = document.getElementById('work_weekly').checked;
	if(flug) {
		var note = document.getElementById('note').value;
		if (note.match(/�ietc�j/)) {
			note = note.replace("�ietc�j", "�i�T��etc�j");
		} else {
			note = note.replace("etc�j", "�E�T��etc�j");
		}
		document.getElementById('note').value = note;
	} else {
		var note = document.getElementById('note').value;
		note = note.replace("�E�T��", "");
		note = note.replace("�T��", "");
		document.getElementById('note').value = note;
	}
}

function checkNote() {
	var note = document.getElementById('note').value;
	if (note.match(/���[���Ή�/)) {
		document.getElementById('work_mail').checked = true;
	} else {
		document.getElementById('work_mail').checked = false;
	}
	if (note.match(/�h�L�������g�X�V/)) {
		document.getElementById('work_doc').checked = true;
	} else {
		document.getElementById('work_doc').checked = false;
	}
	if (note.match(/�\�����쐬/)) {
		document.getElementById('work_make').checked = true;
	} else {
		document.getElementById('work_make').checked = false;
	}
	if (note.match(/���ԊǗ�/)) {
		document.getElementById('work_time').checked = true;
	} else {
		document.getElementById('work_time').checked = false;
	}
	if (note.match(/�T��/)) {
		document.getElementById('work_weekly').checked = true;
	} else {
		document.getElementById('work_weekly').checked = false;
	}
}

//startTimeChange()

function finishTimeChange() {
	var finishTime = document.getElementById('finishTime').value;
	
	document.getElementById('finishTime').value = "13:00";
}

function changePID() {
	//document.getElementById('pid').value;
	var options = document.getElementById('selectPeriodically').options;
	for(var i = 0; i < options.length; i++){
		if(options[i].selected == true){
			document.getElementById('pid').value = options[i].value;
			document.getElementById('note').value = options[i].text;
			if(document.getElementById('note').value == "�����d��") {
				document.getElementById('note').value = "������Ɓi���[���Ή�etc�j";
			}
			checkNote();
		};
	};
	
}


// ##############################################################################################################################
//
//            todo�ҏW�p�̊֐�
//
// ##############################################################################################################################
	
	
	var last_id = 0;
	if($("#new_field_set").length) {
		var new_field = document.getElementById("new_field_set").innerHTML;
		document.getElementById("new_field_set").innerHTML = "";
		return_count_todo();
	}
	
	function return_count_todo() {
	$.ajax({
		beforeSend: function(xhr){
			xhr.overrideMimeType('text/html;charset=Shift_JIS');
		},
		type: "POST",
		scriptCharset:'Shift_JIS',
		url: '/Memoria/pages/todo/return_count_todo.php',
	}).done(function(data, dataType) {
		// done�̃u���b�N���́AAjax�ʐM�����������ꍇ�ɌĂяo�����
		// PHP����Ԃ��Ă����f�[�^�̕\��
		last_id = Number(data);
	}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
		location.reload();
	});
	// �T�u�~�b�g��A�y�[�W�������[�h���Ȃ��悤�ɂ���
	return false;
	}
	
	
	if(document.getElementsByClassName("new")) change_level();
	
	//<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>�~</span></button>
	var new_id = document.getElementsByClassName("name").length;
	
	function read_form() {
		var array = new Array();
		for(var i=0; i<document.getElementsByClassName("name").length; i++) {
			array[i] = new Array();
			array[i][0] = document.getElementsByClassName("name")[i].value;
			document.getElementsByClassName("name")[i].value = "";
			array[i][1] = document.getElementsByClassName("detail")[i].value;
			document.getElementsByClassName("detail")[i].value = "";
			array[i][2] = document.getElementsByClassName("mono")[i].value;
			document.getElementsByClassName("mono")[i].value = "";
			array[i][3] = document.getElementsByClassName("level")[i].value;
			document.getElementsByClassName("level")[i].value = "";
			array[i][4] = document.getElementsByClassName("priority")[i].value;
			document.getElementsByClassName("priority")[i].value = "";
			array[i][5] = document.getElementsByClassName("noki")[i].value;
			document.getElementsByClassName("noki")[i].value = "";
			array[i][6] = document.getElementsByClassName("time")[i].value;
			document.getElementsByClassName("time")[i].value = "";
			array[i][7] = document.getElementsByClassName("kaisi")[i].value;
			document.getElementsByClassName("kaisi")[i].value = "";
			array[i][8] = document.getElementsByClassName("syuryo")[i].value;
			document.getElementsByClassName("syuryo")[i].value = "";
			array[i][9] = document.getElementsByClassName("id")[i].value;
			document.getElementsByClassName("id")[i].value = "";
		}
		return array;
	}
	
	function write_form(array, deletekey) {
		var j = 0;
		for(var i=0; i<(document.getElementsByClassName("name").length); i++) {
			if((deletekey!=0 && i!=deletekey) || deletekey==0 && i!=(document.getElementsByClassName("name").length-1)) {
				document.getElementsByClassName("name")[j].value = array[i][0];
				document.getElementsByClassName("detail")[j].value = array[i][1];
				document.getElementsByClassName("mono")[j].value = array[i][2];
				document.getElementsByClassName("level")[j].value = array[i][3];
				document.getElementsByClassName("priority")[j].value = array[i][4];
				document.getElementsByClassName("noki")[j].value = array[i][5];
				document.getElementsByClassName("time")[j].value = array[i][6];
				document.getElementsByClassName("kaisi")[j].value = array[i][7];
				document.getElementsByClassName("syuryo")[j].value = array[i][8];
				document.getElementsByClassName("id")[j].value = array[i][9];
				j++;
			}
		}
		if(deletekey==0) {
			if(document.getElementsByClassName("level")[(new_id-1)].value != 1)
				document.getElementsByClassName("level")[new_id].value = document.getElementsByClassName("level")[(new_id-1)].value;
			document.getElementsByClassName("priority")[new_id].value = document.getElementsByClassName("priority")[(new_id-1)].value;
			document.getElementsByClassName("noki")[new_id].value = document.getElementsByClassName("noki")[(new_id-1)].value;
			document.getElementsByClassName("time")[new_id].value = document.getElementsByClassName("time")[(new_id-1)].value;
			document.getElementsByClassName("kaisi")[new_id].value = document.getElementsByClassName("kaisi")[(new_id-1)].value;
			document.getElementsByClassName("syuryo")[new_id].value = document.getElementsByClassName("syuryo")[(new_id-1)].value;
			document.getElementsByClassName("id")[new_id].value = last_id;
			last_id++;
			new_id++;
		} else {
			new_id = new_id-1;
		}
	}
	function write_form_delete(array, deletekey) {
		var j = 0;
		for(var i=0; i<(document.getElementsByClassName("name").length+1); i++) {
			if((deletekey!=0 && i!=deletekey) || deletekey==0 && i!=(document.getElementsByClassName("name").length-1)) {
				document.getElementsByClassName("name")[j].value = array[i][0];
				document.getElementsByClassName("detail")[j].value = array[i][1];
				document.getElementsByClassName("mono")[j].value = array[i][2];
				document.getElementsByClassName("level")[j].value = array[i][3];
				document.getElementsByClassName("priority")[j].value = array[i][4];
				document.getElementsByClassName("noki")[j].value = array[i][5];
				document.getElementsByClassName("time")[j].value = array[i][6];
				document.getElementsByClassName("kaisi")[j].value = array[i][7];
				document.getElementsByClassName("syuryo")[j].value = array[i][8];
				document.getElementsByClassName("id")[j].value = array[i][9];
				j++;
			}
		}
		new_id = new_id-1;
	}
	function write_form_plus(array, pluskey) {
		for(var i=0; i<(document.getElementsByClassName("name").length); i++) {
			if(i<pluskey) {
				document.getElementsByClassName("name")[i].value = array[i][0];
				document.getElementsByClassName("detail")[i].value = array[i][1];
				document.getElementsByClassName("mono")[i].value = array[i][2];
				document.getElementsByClassName("level")[i].value = array[i][3];
				document.getElementsByClassName("priority")[i].value = array[i][4];
				document.getElementsByClassName("noki")[i].value = array[i][5];
				document.getElementsByClassName("time")[i].value = array[i][6];
				document.getElementsByClassName("kaisi")[i].value = array[i][7];
				document.getElementsByClassName("syuryo")[i].value = array[i][8];
				document.getElementsByClassName("id")[i].value = array[i][9];
			}
			else if (i==pluskey) {
				document.getElementsByClassName("level")[i].value = array[i][3];
				document.getElementsByClassName("priority")[i].value = array[i][4];
				document.getElementsByClassName("noki")[i].value = array[i][5];
				document.getElementsByClassName("time")[i].value = array[i][6];
				document.getElementsByClassName("kaisi")[i].value = array[i][7];
				document.getElementsByClassName("syuryo")[i].value = array[i][8];
				document.getElementsByClassName("id")[i].value = last_id;
				last_id++;
				new_id++;
			} else {
				document.getElementsByClassName("name")[i].value = array[(i-1)][0];
				document.getElementsByClassName("detail")[i].value = array[(i-1)][1];
				document.getElementsByClassName("mono")[i].value = array[(i-1)][2];
				document.getElementsByClassName("level")[i].value = array[(i-1)][3];
				document.getElementsByClassName("priority")[i].value = array[(i-1)][4];
				document.getElementsByClassName("noki")[i].value = array[(i-1)][5];
				document.getElementsByClassName("time")[i].value = array[(i-1)][6];
				document.getElementsByClassName("kaisi")[i].value = array[(i-1)][7];
				document.getElementsByClassName("syuryo")[i].value = array[(i-1)][8];
				document.getElementsByClassName("id")[i].value = array[(i-1)][9];
			}
		}
	}
	function plus() {
		var array = read_form();
		document.getElementsByClassName("new")[0].innerHTML = "";
		for(var i=1; i<array.length+1; i++) {
			document.getElementsByClassName("new")[0].innerHTML += new_field.replace("minus(0", "minus(" + String(i)).replace("plus2(0", "plus2(" + String(i));
		}
		resize_textarea();
		write_form(array, 0);
		setDateTime_start();
		change_level();
	}
	function minus(number) {
		//var array = ['', '','','','','','','',''];
		var array = read_form();
		document.getElementsByClassName("new")[0].innerHTML = "";
		for(var i=1; i<array.length-1; i++) {
			document.getElementsByClassName("new")[0].innerHTML += new_field.replace("minus(0", "minus(" + String(i)).replace("plus2(0", "plus2(" + String(i));
		}
		resize_textarea();
		write_form_delete(array, number);
		setDateTime_start();
		change_level();
	}
	function plus2(pluskey) {
		//var array = ['', '','','','','','','',''];
		var array = read_form();
		document.getElementsByClassName("new")[0].innerHTML = "";
		for(var i=1; i<array.length+1; i++) {
			document.getElementsByClassName("new")[0].innerHTML += new_field.replace("minus(0", "minus(" + String(i)).replace("plus2(0", "plus2(" + String(i));
		}
		resize_textarea();
		write_form_plus(array, pluskey);
		setDateTime_start();
		change_level();
	}
	
	function change_level() {
		
		for(var i=0; i<(document.getElementsByClassName("level").length); i++) {
			var element = document.getElementsByClassName("level")[i];
			var level = element.value;
			if($(".bs-component").length) {
				var parent = element.parentNode.parentNode.parentNode.parentNode.parentNode; 
			} else {
				var parent = element.parentNode.parentNode.parentNode.parentNode; 
			}
			if(level < 2)		parent.style.right = parseInt(level * 40) + "px";
			else if(level > 2)	parent.style.left = parseInt((level - 2) * 40) + "px";
			else parent.style.left = 0 + "px";
		}
	}
	function level_up(btnnode) {
		//var element = btnnode.parentNode.nextSibling.nextSibling.nextSibling.nextSibling.childNodes[1];
		var element = btnnode.parentNode.nextSibling.nextSibling.childNodes[0];
		var index = $('.level').index(element);
		if(element.value != 1 && parseInt(document.getElementsByClassName("level")[(index-1)].value) + 1 != parseInt(element.value)) 
		element.value = parseInt(element.value) + 1;
		change_level();
	}
	
	function level_down(btnnode) {
		if($(".bs-component").length) {
			var element = btnnode.parentNode.nextSibling.nextSibling.childNodes[0];
		} else {
			var element = btnnode.parentNode.nextSibling.nextSibling.nextSibling.childNodes[0];
		}
		//var element = btnnode.parentNode.nextSibling.nextSibling.nextSibling.nextSibling.childNodes[1];
		if(element.value > 2) element.value = parseInt(element.value) - 1;
		change_level();
	}

	
	function select_theme(theme) {
		if($(".bs-component").length) {
			location.href = './todo.php?page=select_theme&theme='+theme;
		} else {
			location.href = './todo/select_theme.php?theme='+theme;
		}
	}

	function todo_delete_check(tilte, id){
		ret = confirm(tilte + "��{���ɍ폜���܂����H��낵���ł����H");
		if (ret == true){
			location.href = './todo.php?page=delete&delete=OK&id='+id;
		}
	}

	function finisflist_search(searchtext) {
		if(searchtext.value != "") {
			location.href = './todo.php?list=finishlist&finisflist_search='+searchtext.value;
		} else {
			location.href = './todo.php?list=finishlist';
		}
	}

	function goto_detail(id) {
		location.href = './todo.php?d=detail&p='+id;
	}

	if(document.getElementById("finisflist_search")) {
		var elm = document.getElementById('finisflist_search');
		var val = elm.value;
		elm.value = '';
		elm.focus();
		elm.value = val;
	}







