<?php 
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	if(!isset($todo)) {
		include_once($ini['dirWin'].'/pages/function.php');
		if(isset($_GET['file']) && $_GET['file'] == "old201804") {
			$todo = readCsvFile2($ini['dirWin'].'/data/old201804todo.csv');
			$file = "old201804";
		} else {
			$todo = readCsvFile2($ini['dirWin'].'/data/todo.csv');
			$file = "todo";
		}
	}
 ?>
<script language="javascript" type="text/javascript">
// ##############################################################################################################################
//
//            �ǂݍ��ݎ��̊֐�
//
// ##############################################################################################################################

$(document).ready( function(){
	<?php
		if((isset($_GET['d']) && $_GET['d']=="detail") && (isset($_GET['p']) && $_GET['p']<count($todo)) || !isset($_GET['d']) || $_GET['d']=="todo") {
			if(isset($_GET['d'])) $d = $_GET['d'];
			else $d = "todo";
			if(isset($_GET['p'])) $p = $_GET['p'];
			else $p = 0;
			if(isset($_GET['list'])) $list = $_GET['list'];
			else $list = "";
			if(isset($_GET['file'])) $file = $_GET['file'];
			else $file = "todo";
			echo "read_todo_tree('{$d}', '{$p}', '{$list}', '{$file}');";
			
		}
		if(!isset($_GET['p']) || $_GET['p']>=count($todo)) {
			echo 'todo_serch("");';
		}
	?>

});

// ##############################################################################################################################
//
//            todo�̌����p�̊֐�
//
// ##############################################################################################################################
function todo_serch(searchtext){
	if(searchtext != "") {
		//var h = makeform.height();
		$("#todo_space").css('background','url(\"../img/grid.svg\") center center no-repeat').css('background-size','20% auto').css('min-height','500px');
		
		$.ajax({
			beforeSend: function(xhr){
				xhr.overrideMimeType('text/html;charset=Shift_JIS');
			},
			type: "GET",
			scriptCharset:'Shift_JIS',
			url: "./todo/todo_serch.php",
			data: {"search":searchtext},
		}).done(function(data, dataType) {
			// done�̃u���b�N���́AAjax�ʐM�����������ꍇ�ɌĂяo�����

			// PHP����Ԃ��Ă����f�[�^�̕\��
			$("#todo_space").html(data).height("auto").css('background','');

		}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
			// �ʏ�͂�����textStatus��errorThrown�̒l�����ď�����؂蕪���邩�A�P���ɒʐM�Ɏ��s�����ۂ̏������L�q���܂��B

			// this;
			// this�͑��̃R�[���o�b�N�֐����l��AJAX�ʐM���̃I�v�V�����������܂��B

			// �G���[���b�Z�[�W�̕\��
			//alert('Error : ' + errorThrown);
			todo_serch(searchtext);
		});
	} else {
		
		var arg  = new Object;
		url = location.search.substring(1).split('&');
		
		for(i=0; url[i]; i++) {
			var k = url[i].split('=');
			arg[k[0]] = k[1];
		}
		if(arg.list != undefined) {
			var url = "./todo/" + arg.list + ".php";
			}
		/*
		} elseif(arg.p != undefined && arg.d == "todo") {
			var url = "./todo/todo.php?d=todo&p=" + arg.p;
		}
		*/
		 else {
			var url = "./todo/memo.php";
		}
		
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
			$("#todo_space").html(data);

		}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
			// �ʏ�͂�����textStatus��errorThrown�̒l�����ď�����؂蕪���邩�A�P���ɒʐM�Ɏ��s�����ۂ̏������L�q���܂��B

			// this;
			// this�͑��̃R�[���o�b�N�֐����l��AJAX�ʐM���̃I�v�V�����������܂��B

			// �G���[���b�Z�[�W�̕\��
			//alert('Error : ' + errorThrown);
			todo_serch(searchtext);
		});
	}
	// �T�u�~�b�g��A�y�[�W�������[�h���Ȃ��悤�ɂ���
	return false;
}


// ##############################################################################################################################
//
//            todo�̊K�w�\���p�̊֐�
//
// ##############################################################################################################################

function read_todo_tree(d, p, list, todofile) {
	$("#todo_tree").css('background','url(\"../img/grid-gray.svg\") center center no-repeat').css('background-size','20% auto').css('min-height','500px');;
	$.ajax({
		beforeSend: function(xhr){
			xhr.overrideMimeType('text/html;charset=Shift_JIS');
		},
		type: "GET",
		scriptCharset:'Shift_JIS',
		url: '/Memoria/pages/todo/todo_tree.php',
		data: {"d":d, "p":p, "list":list, "file":todofile},
	}).done(function(data, dataType) {
		// done�̃u���b�N���́AAjax�ʐM�����������ꍇ�ɌĂяo�����
		// PHP����Ԃ��Ă����f�[�^�̕\��
		$("#todo_tree").html(data).css('background','');
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


// ##############################################################################################################################
//
//            todo�ҏW�p�̊֐�
//
// ##############################################################################################################################

	function todo_delete_check(tilte, id){
		ret = confirm(tilte + "��{���ɍ폜���܂����H��낵���ł����H");
		if (ret == true){
			location.href = '/Memoria/pages/todo/delete.php?delete=OK&id='+id+'&pages=pages';
		}
	}


// ##############################################################################################################################
//
//            �����p�l���p�̊֐�
//
// ##############################################################################################################################



function switchingMemoPanel(element) {
	$(element).parent().next('div').stop().slideToggle(500);
	$(element).parent().next().next('div').stop().slideToggle(500);
	$(element).prev().stop().slideToggle(500);
	element.children[0].classList.toggle("glyphicon-resize-full");
	element.children[0].classList.toggle("glyphicon-resize-small");
}


// ##############################################################################################################################
//
//            �J�����_�[�p�֐��i�J�����_�[�y�[�W�̎��������p�j
//
// ##############################################################################################################################
<?php
if(isset($_GET['d']) && $_GET['d']=="calendar") {
	if(!isset($_GET['day']) && !isset($_GET['mounth']) && !isset($_GET['year'])) {
		$year = date('Y');
		$month = date('n');
		$day = date('d');
	} else {
		$year = $_GET['year'];
		$month = $_GET['mounth'];
		$day = date('d');
	}
?>

$(document).ready( function(){
	// �y�[�W�ǂݍ��ݎ��Ɏ��s����������
	<?php
		echo 'var year = '.$year.';';
		echo 'var month = '.$month.';';
		echo 'var day = '.$day.';';
	?>
	console.log(year);
	console.log(month);
	$("#calendar").css('background','url(\"../img/grid.svg\") center center no-repeat').css('background-size','20% auto');
	$.ajax({
		beforeSend: function(xhr){
			xhr.overrideMimeType('text/html;charset=Shift_JIS');
		},
		type: "POST",
		scriptCharset:'Shift_JIS',
		url: '/Memoria/pages/todo/calendar.php',
		data: {"year":year, "mounth":month, "day":day},
	}).done(function(data, dataType) {
		// done�̃u���b�N���́AAjax�ʐM�����������ꍇ�ɌĂяo�����
		// PHP����Ԃ��Ă����f�[�^�̕\��
		$("#calendar").html(data).css('background','');
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

<?php
}
?>

</script>