<?php 
	//include('/Memoria/pages/function.php');
	$todo = readCsvFile2('../data/todo.csv');
 ?>
<script language="javascript" type="text/javascript">
	var new_field = "<fieldset style='position: relative'><div class='well bs-component'><div class='clearfix'><span class='pull-right close' onClick='minus( minusnumber );'>&times;</span><span class='pull-right close'>�@</span><span class='pull-right close' onClick='plus2( plusnumber );'>+</span></div><div class='form-group'><div class='col-xs-8'><div class='col-xs-12' style='margin-bottom:5px'><input type='text' class='form-control input-normal input-sm name' name='name[]' placeholder='�^�C�g��'><input type='hidden' name='id[]' class='id'></div><div class='col-xs-12' style='margin-bottom:5px'><textarea class='form-control input-normal input-sm detail' rows='3' name='detail[]'></textarea></div><div class='col-xs-12' style='margin-bottom:5px'><input type='text' class='form-control input-normal input-sm mono' name='mono[]' placeholder='���ʕ�'></div><div class='col-xs-2' style='margin-bottom:5px'><button type='button' class='btn btn-warning btn-xs' onClick='level_down(this)'>��</button><button type='button' class='btn btn-warning btn-xs eee' onClick='level_up(this)'>��</button></div><label class='col-sm-2 control-label' style='margin-bottom:5px'>���x��</label><div class='col-xs-3' style='margin-bottom:5px'><input type='number' class='form-control input-normal input-sm level' name='level[]' value='2' min='2' max='10' readonly></div><label class='col-sm-2 control-label' style='margin-bottom:5px'>�D��x</label><div class='col-xs-3' style='margin-bottom:5px'><input type='number' class='form-control input-normal input-sm priority' name='priority[]' min='1' max='10'></div></div><div class='col-xs-4'><div class='col-xs-12' style='margin-bottom:5px'><label class='control-label'>�[��</label><input type='text' class='form-control input-normal input-sm noki' name='noki[]'></div><div class='col-xs-12' style='margin-bottom:5px'><label class='control-label'>�[���̎���</label><input type='time' class='form-control input-normal input-sm time' name='time[]' step='900'></div><div class='col-xs-12' style='margin-bottom:5px'><label class='control-label'>�J�n�\�莞��</label><input type='text' class='form-control input-normal input-sm kaisi' name='kaisi[]'></div><div class='col-xs-12' style='margin-bottom:5px'><label class='control-label'>�I���\�����</label><input type='text' class='form-control input-normal input-sm syuryo' name='syuryo[]'></div></div></div></div></fieldset>";
	//<div class='form-group' style='margin-bottom:0; position: fixed; bottom: 50px;right:0;width:500px;'><div class='col-xs-offset-3 col-xs-3'><button type='reset' class='btn btn-default btn-block'>Reset</button></div><div class='col-xs-3'><button type='submit' class='btn btn-primary btn-block'>Submit</button></div></div>
	
	if(document.getElementsByClassName("new")) change_level();
	
	
	//<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>�~</span></button>
	var new_id = document.getElementsByClassName("name").length;
	<?php
		//if()
	?>
	var last_id = <?php echo count($todo); ?>;
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
			document.getElementsByClassName("new")[0].innerHTML += new_field.replace("minusnumber", String(i)).replace("plusnumber", String(i));
		}
		write_form(array, 0);
		setDateTime_start();
		change_level();
	}
	function minus(number) {
		//var array = ['', '','','','','','','',''];
		var array = read_form();
		document.getElementsByClassName("new")[0].innerHTML = "";
		for(var i=1; i<array.length-1; i++) {
			document.getElementsByClassName("new")[0].innerHTML += new_field.replace("minusnumber", String(i)).replace("plusnumber", String(i));
		}
		write_form_delete(array, number);
		setDateTime_start();
		change_level();
	}
	function plus2(pluskey) {
		//var array = ['', '','','','','','','',''];
		var array = read_form();
		document.getElementsByClassName("new")[0].innerHTML = "";
		for(var i=1; i<array.length+1; i++) {
			document.getElementsByClassName("new")[0].innerHTML += new_field.replace("minusnumber", String(i)).replace("plusnumber", String(i));
		}
		write_form_plus(array, pluskey);
		setDateTime_start();
		change_level();
	}
	
	function change_level() {
		//�e�̐e�̐e
		for(var i=0; i<(document.getElementsByClassName("level").length); i++) {
			var element = document.getElementsByClassName("level")[i];
			var level = element.value;
			var parent = element.parentNode.parentNode.parentNode.parentNode.parentNode; 
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
		var element = btnnode.parentNode.nextSibling.nextSibling.childNodes[0];
		//var element = btnnode.parentNode.nextSibling.nextSibling.nextSibling.nextSibling.childNodes[1];
		if(element.value > 2) element.value = parseInt(element.value) - 1;
		change_level();
	}
	
	function setDateTime(){
		for(var i=1; i<document.getElementsByClassName("name").length; i++) {
			document.getElementsByClassName("noki")[i].value = document.getElementsByClassName("noki")[0].value;
			document.getElementsByClassName("time")[i].value = document.getElementsByClassName("time")[0].value;
			document.getElementsByClassName("kaisi")[i].value = document.getElementsByClassName("kaisi")[0].value;
			document.getElementsByClassName("syuryo")[i].value = document.getElementsByClassName("syuryo")[0].value;
		}
	}
	

	
	function select_theme(theme) {
		location.href = '/Memoria/pages/todo.php?page=select_theme&theme='+theme;
	}

function todo_delete_check(tilte, id){
	ret = confirm(tilte + "��{���ɍ폜���܂����H��낵���ł����H");
	if (ret == true){
		location.href = '/Memoria/pages/todo.php?page=delete&delete=OK&id='+id;
	}
}

function finisflist_search(searchtext) {
	if(searchtext.value != "") {
		location.href = '/Memoria/pages/todo.php?list=finishlist&finisflist_search='+searchtext.value;
	} else {
		location.href = '/Memoria/pages/todo.php?list=finishlist';
	}
}

function goto_detail(id) {
	location.href = '/Memoria/pages/todo.php?d=detail&p='+id;
}

if(document.getElementById("finisflist_search")) {
	var elm = document.getElementById('finisflist_search');
	var val = elm.value;
	elm.value = '';
	elm.focus();
	elm.value = val;
}

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

var tree_menu_x = 0;
var tree_menu_y = 0;

function tree_menu(id, top, pre, child, wait, todofile) {
	tree_menu_x=event.clientX;//document.body.scrollLeft+
	tree_menu_y=event.clientY;//document.body.scrollTop+
	
	var menu = "<div class='btn-group-vertical' style='width:180px; position: fixed;' id='tree_menu'>";

	if(pre!=100) { //child == 0 && 
		menu = menu + "<div class='btn-group' role='group'><button type='button' class='btn btn-default dropdown-toggle btn-xs btn-block' data-toggle='dropdown' aria-expanded='false'>��Ɛݒ�<span class='caret'></span></button><ul class='dropdown-menu' role='menu'>";
		for(j=Math.ceil(pre/10)*10; j<100; j+=10) 
		menu = menu + "<li role='presentation'><a role='menuitem' tabindex='-1' href='todo.php?page=whatdo&p="+id+"&f="+j+"'>"+j+"���܂Ŋ���</a></li>";
		menu = menu + "</ul>";
		menu = menu + "</div>";
	}
	if(todofile  === "todo") menu = menu + "<a href='todo.php?page=whatdo&f=100&p="+id+"&file="+todofile+"' class='btn btn-default btn-xs btn-block'>�����ݒ�</a>";
	menu = menu + "<a href='todo.php?d=todo&p="+id+"&file="+todofile+"' class='btn btn-default btn-xs btn-block'>�����N���J��</a>";
	menu = menu + "<a href='todo.php?d=todo&p="+top+"&file="+todofile+"' class='btn btn-default btn-xs btn-block'>�ڍ׉�ʂ��J��</a>";
	if(todofile  === "todo") menu = menu + "<a href='todo.php?d=change&p="+top+"&file="+todofile+"' class='btn btn-default btn-xs btn-block'>�ҏW���J��</a>";
	menu = menu + "<a href='todo.php?d=renew&p="+top+"&file="+todofile+"' class='btn btn-default btn-xs btn-block'>���p����</a>";
	menu = menu + "<a href='todo.php?d=detail&p="+top+"&file="+todofile+"' class='btn btn-default btn-xs btn-block'>�t�B���^�[</a>";
	if(wait == 0 && pre!=100) menu = menu + "<a href='todo.php?page=wait&p="+id+"&file="+todofile+"' class='btn btn-default btn-xs btn-block'>�ۗ��ݒ�</a></div>";
	else if(pre!=100) menu = menu + "<a href='todo.php?page=wait&p="+id+"&file="+todofile+"' class='btn btn-default btn-xs btn-block'>�����ݒ�</a></div>";
	
	document.getElementById("todo_tree_menu").innerHTML = menu;
	document.getElementById("tree_menu").style.left=tree_menu_x+"px";
	if(tree_menu_y < 500) document.getElementById("tree_menu").style.top=tree_menu_y+"px";
	else document.getElementById("tree_menu").style.top=tree_menu_y-150+"px";
}

if(document.getElementById("todo_tree_menu")) {
	$('#myTabContent').on('dblclick', function() {
		document.getElementById("todo_tree_menu").innerHTML = "";
	});
}


document.onmousemove = function (e){
	if(document.getElementById("tree_menu")) {
	var mouse_x=document.body.scrollLeft+event.clientX;
	var mouse_y=document.body.scrollTop+event.clientY;
	if(abs(mouse_x-tree_menu_x)>100 && abs(mouse_y-tree_menu_y)>100) document.getElementById("todo_tree_menu").innerHTML = "";
	}
};


// ##############################################################################################################################
//
//            �����p�l���p�̊֐�
//
// ##############################################################################################################################

function changeMempPanel(path, file, element) {
	//location.href = path;
	//var data = {'memoform' : $('#memoform').val()};
		var makeform = $(element).parent().prev();
		makeform.html("�ʐM���B�B�B");
	
	$.ajax({
		type: "get",
		url: "./todo/changeMemo.php",
		data: {"file":file,"do":"readform"},
	}).done(function(data, dataType) {
		// done�̃u���b�N���́AAjax�ʐM�����������ꍇ�ɌĂяo�����

		// PHP����Ԃ��Ă����f�[�^�̕\��
		makeform.html("<textarea id='memoform' class='form-control input-normal input-sml'>"+data+"</textarea>");
		//alert(data);
		var textarea = document.getElementById("memoform");
		if( textarea.scrollHeight > textarea.offsetHeight ){
			textarea.style.height = textarea.scrollHeight+'px';
		}
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

$(document).ready(function() {
	/**
	 * ���M�{�^���N���b�N
	 */
	$('#sendmemo').click(function() {
		// POST���\�b�h�ő���f�[�^���`���܂� var data = {�p�����[�^�� : �l};
		var data = {'request' : $('#request').val()};

		/**
		 * Ajax�ʐM���\�b�h
		 * @param type	: HTTP�ʐM�̎��
		 * @param url	 : ���N�G�X�g���M���URL
		 * @param data	: �T�[�o�ɑ��M����l
		 */
		$.ajax({
			type: "POST",
			url: "changeMemo.php",
			data: data,
		}).done(function(data, dataType) {
			// done�̃u���b�N���́AAjax�ʐM�����������ꍇ�ɌĂяo�����

			// PHP����Ԃ��Ă����f�[�^�̕\��
			alert(data);
		}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
			// �ʏ�͂�����textStatus��errorThrown�̒l�����ď�����؂蕪���邩�A�P���ɒʐM�Ɏ��s�����ۂ̏������L�q���܂��B

			// this;
			// this�͑��̃R�[���o�b�N�֐����l��AJAX�ʐM���̃I�v�V�����������܂��B

			// �G���[���b�Z�[�W�̕\��
			alert('Error : ' + errorThrown);
		});

		// �T�u�~�b�g��A�y�[�W�������[�h���Ȃ��悤�ɂ���
		return false;
	});
});

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



</script>