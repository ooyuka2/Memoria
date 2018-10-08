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
	
	if($("#todo_space_comp").length) {
		read_memo();
	}
	
	if($("#todo_keeper_comp").length) {
		read_keeper("1");
	}
	
	DD = new Date();
	if(DD.getHours() == 12) {
	$('head link:last').after('<link rel="stylesheet" href="/Memoria/img/bootstrap4/MDB/css/fairly.css">');
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
		setDateTime_start();
	}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
		// 通常はここでtextStatusやerrorThrownの値を見て処理を切り分けるか、単純に通信に失敗した際の処理を記述します。
		// this;
		// thisは他のコールバック関数同様にAJAX通信時のオプションを示します。
		// エラーメッセージの表示
		//alert('Error : ' + errorThrown);
		read_todo_tree(d, p, list, todofile);
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
//            メモパネル用の関数
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
		// doneのブロック内は、Ajax通信が成功した場合に呼び出される
		// PHPから返ってきたデータの表示
		$("#todo_space_comp").html(data).css('background','');
	}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
		// 通常はここでtextStatusやerrorThrownの値を見て処理を切り分けるか、単純に通信に失敗した際の処理を記述します。
		// this;
		// thisは他のコールバック関数同様にAJAX通信時のオプションを示します。
		// エラーメッセージの表示
		read_memo();
	});
	// サブミット後、ページをリロードしないようにする
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
//            時間管理の表示用の関数
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
		// doneのブロック内は、Ajax通信が成功した場合に呼び出される
		// PHPから返ってきたデータの表示
		$("#todo_keeper_comp").html(data).css('background','').css('min-height','');
	}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
		// 通常はここでtextStatusやerrorThrownの値を見て処理を切り分けるか、単純に通信に失敗した際の処理を記述します。
		// this;
		// thisは他のコールバック関数同様にAJAX通信時のオプションを示します。
		// エラーメッセージの表示
		read_memo();
	});
	// サブミット後、ページをリロードしないようにする
	return false;
}



