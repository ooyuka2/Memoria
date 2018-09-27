$(document).ready(function(){
  //textarea�t�H�[�J�X���ɕ������̍������ă��T�C�Y
  $('textarea').keyup(function(e) {
    //���������獂���擾
    var height=this.scrollHeight + 'px';
    $(this).css("height", height);
    })
    .blur(function(e) {
    //$(this).css("height", "auto");
  });
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
	if($(".noki").size() || $(".kaisi").size() || $(".syuryo").size()) {
		$(".noki").datepicker();
		$(".kaisi").datepicker();
		$(".syuryo").datepicker();
		
		
		for(var i=document.getElementsByClassName("td-n2").length-1; i>=0; i--) {
			document.body.removeChild(document.getElementsByClassName("td-n2")[i]);
		}
		
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
	if((whatdotoday == 0 || whatdotoday == 2) && pre!=100) menu = menu + "<a href='todo.php?page=whatTodayDo&turn=1&p="+top+"' class='btn btn-default btn-xs btn-block'>�����撣��</a>";
	else if(whatdotoday == 1 && pre!=100) {
		menu = menu + "<a href='todo.php?page=whatTodayDo&turn=2&p="+top+"' class='btn btn-default btn-xs btn-block'>�����撣��</a>";
		menu = menu + "<a href='todo.php?page=whatTodayDo&turn=0&p="+top+"' class='btn btn-default btn-xs btn-block'>���x�撣��</a>";
	}
	if(wait == 0 && pre!=100) menu = menu + "<a href='todo.php?page=wait&p="+id+"&file="+todofile+"' class='btn btn-default btn-xs btn-block'>�ۗ��ݒ�</a></div>";
	else if(pre!=100) menu = menu + "<a href='todo.php?page=wait&p="+id+"&file="+todofile+"' class='btn btn-default btn-xs btn-block'>�����ݒ�</a></div>";
	
	document.getElementById("todo_tree_menu").innerHTML = menu;
	document.getElementById("tree_menu").style.left=tree_menu_x+"px";
	if(tree_menu_y < 500) document.getElementById("tree_menu").style.top=tree_menu_y+"px";
	else document.getElementById("tree_menu").style.top=tree_menu_y-150+"px";
}



// ##############################################################################################################################
//
//            �����p�l���p�̊֐�
//
// ##############################################################################################################################


function changeMemoform() {
	var textarea = document.getElementById("memoform");
	if( textarea.scrollHeight > textarea.offsetHeight ){
		textarea.style.height = textarea.scrollHeight+'px';
	}
}