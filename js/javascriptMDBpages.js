// ##############################################################################################################################
//
//            読み込み時の関数
//
// ##############################################################################################################################
//$("#todo_tree_comp")があれば読み込む関数
$(document).ready(function(){
	if($("#todo_tree_comp").length) {
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
	}
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
//           ナビゲーションの関数
//
// ##############################################################################################################################

$(document).ready(function() {
	
	// Drawer読み込み
	$('.drawer').drawer();
	
	// ドロワーメニューが開いたとき
	$('.drawer').on('drawer.opened', function(){
		//alert('ドロワーが開きました');
		
	});
 
	// ドロワーメニューが閉じたとき
	$('.drawer').on('drawer.closed', function(){
		//alert('ドロワーが閉じられました');
		 $(".drawer-hamburger").css("display","");
	});
});

function navOnload() {
	if($('.activenav').length) {
		$('.activenav').find('li').slideToggle(500);
		document.getElementsByClassName('activenav')[0].children[0].children[1].classList.toggle("fa-angle-down");
		document.getElementsByClassName('activenav')[0].children[0].children[1].classList.toggle("fa-angle-up");
	}
}

function navToggle(element) {
	$(element).parent().find('li').slideToggle(500);
	element.children[1].classList.toggle("fa-angle-down");
	element.children[1].classList.toggle("fa-angle-up");
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


// ##############################################################################################################################
//
//            todo_treeの関数
//
// ##############################################################################################################################

//todo_treeを読み込むための関数
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
		// doneのブロック内は、Ajax通信が成功した場合に呼び出される
		// PHPから返ってきたデータの表示
		$("#todo_tree_comp").html(data).css('background','');
	}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
		// 通常はここでtextStatusやerrorThrownの値を見て処理を切り分けるか、単純に通信に失敗した際の処理を記述します。
		// this;
		// thisは他のコールバック関数同様にAJAX通信時のオプションを示します。
		// エラーメッセージの表示
		//alert('Error : ' + errorThrown);
		read_tool_php(filepath, tabname);
	});
	// サブミット後、ページをリロードしないようにする
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
//            右クリックメニュー用の関数
//
// ##############################################################################################################################


var tree_menu_x = 0;
var tree_menu_y = 0;

function tree_menu(id, top, pre, child, wait, todofile) {
	tree_menu_x=event.clientX;//document.body.scrollLeft+
	tree_menu_y=event.clientY;//document.body.scrollTop+
	
	var menu = "<div class='btn-group-vertical' style='width:220px; position: fixed; z-index: 1;' id='tree_menu'>";//

	if(pre!=100) { //child == 0 && 
		menu = menu + "<div class='btn-group' role='group'><button type='button' class='btn btn-default dropdown-toggle btn-xs btn-block' data-toggle='dropdown' aria-expanded='false'>作業設定<span class='caret'></span></button><ul class='dropdown-menu' role='menu'>";
		
		for(j=Math.ceil(pre/10)*10; j<100; j+=10) 
		menu = menu + "<li role='presentation'><a role='menuitem' tabindex='-1' href='todo.php?page=whatdo&p="+id+"&f="+j+"'>"+j+"％まで完了</a></li>";
		menu = menu + "</ul>";
		menu = menu + "</div>";
	}
	
	if(wait == "") wait = 0;
	
	if(todofile  === "todo") menu = menu + "<a href='todo.php?page=whatdo&f=100&p="+id+"&file="+todofile+"' class='btn btn-default btn-xs btn-block'>完了設定</a>";
	if(todofile  === "todo" && pre==100) menu = menu + "<a href='./todo/nofinish.php?p="+id+"' class='btn btn-default btn-xs btn-block'>未完了設定</a>";
	menu = menu + "<a href='todo.php?d=todo&p="+id+"&file="+todofile+"' class='btn btn-default btn-xs btn-block'>リンクを開く</a>";
	menu = menu + "<a href='todo.php?d=todo&p="+id+"&file="+todofile+"' class='btn btn-default btn-xs btn-block' target='_blank' >新しいタブでリンクを開く</a>";
	menu = menu + "<a href='todo.php?d=todo&p="+top+"&file="+todofile+"' class='btn btn-default btn-xs btn-block'>詳細画面を開く</a>";
	if(todofile  === "todo") menu = menu + "<a href='todo.php?d=change&p="+top+"&file="+todofile+"' class='btn btn-default btn-xs btn-block'>編集を開く</a>";
	menu = menu + "<a href='todo.php?d=renew&p="+top+"&file="+todofile+"' class='btn btn-default btn-xs btn-block'>流用する</a>";
	menu = menu + "<a href='todo.php?d=detail&p="+top+"&file="+todofile+"' class='btn btn-default btn-xs btn-block'>フィルター</a>";
	if(wait == 0 && pre!=100) menu = menu + "<a href='todo.php?page=wait&p="+id+"&file="+todofile+"' class='btn btn-default btn-xs btn-block'>保留設定</a></div>";
	else if(pre!=100) menu = menu + "<a href='todo.php?page=wait&p="+id+"&file="+todofile+"' class='btn btn-default btn-xs btn-block'>解除設定</a></div>";
	
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
	if(abs(mouse_x-tree_menu_x)>150 && abs(mouse_y-tree_menu_y)>150) document.getElementById("todo_tree_menu").innerHTML = "";
	}
};

function gotoid(todoid) {
	// スクロールの速度
	var speed = 400; // ミリ秒
	// アンカーの値取得
	var href = todoid;
	// 移動先を取得
	var target = $(href == "#" || href == "" ? 'html' : href);
	// 移動先を数値で取得
	var position = target.offset().top;
	// スムーススクロール
	$('body,html').animate({scrollTop:position}, speed, 'swing');
	return false;
}