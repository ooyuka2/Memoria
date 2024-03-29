// ##############################################################################################################################
//
//			読み込み時の関数
//
// ##############################################################################################################################

$(document).ready(function(){
	//$("#todo_tree_comp")があれば読み込む関数
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
		if(getParam('tab') == "compare") {
			read_tool_php("/Memoria/pages/tools/tools/compare_form.php", "comparetab");
		} else {
			read_tool_php('/Memoria/pages/tools/tools.php', 'toolstab');
		}
	}
	
	if($("#how_hour_comp").length) {
		if($("#how_hour_comp").width() < 380) read_how_hour("no");
		else read_how_hour("ok");
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
//		   ナビゲーションの関数
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
/*
$('#link').hover(function() {
	var t = setTimeout(function() {
	  //マウスオーバー時に行いたいAjax処理
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
//			todo_treeの関数
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
//			メモパネル用の関数
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
		
		//Crtl + Sで一つ目のパネルを編集モードにする
		document.onkeydown = 
			function (e) {
				if (event.ctrlKey ){
					 if (event.keyCode == 83){
						//alert("Crtl + S");
						event.keyCode = 0;
						$('.changeMempPanel').eq(0).click();
						return false;
					 }
				}
			}
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
//			時間管理の表示用の関数
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
		read_keeper(days);
	});
	// サブミット後、ページをリロードしないようにする
	return false;
}



// ##############################################################################################################################
//
//			やることメモの表示用の関数
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
		// doneのブロック内は、Ajax通信が成功した場合に呼び出される
		$("#todo_regularly_comp").html(data).css('background','').css('min-height','');
	}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
		// 通常はここでtextStatusやerrorThrownの値を見て処理を切り分けるか、単純に通信に失敗した際の処理を記述します。
		// this;
		// thisは他のコールバック関数同様にAJAX通信時のオプションを示します。
		// エラーメッセージの表示
		read_todo_regularly();
	});
	// サブミット後、ページをリロードしないようにする
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
		// doneのブロック内は、Ajax通信が成功した場合に呼び出される
		// PHPから返ってきたデータの表示
		read_todo_regularly();
		
	}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
		// 通常はここでtextStatusやerrorThrownの値を見て処理を切り分けるか、単純に通信に失敗した際の処理を記述します。
		// this;
		// thisは他のコールバック関数同様にAJAX通信時のオプションを示します。
		// エラーメッセージの表示
		read_todo_regularly();
	});
	// サブミット後、ページをリロードしないようにする
	return false;
}


// ##############################################################################################################################
//
//			todoの検索用の関数
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
			// doneのブロック内は、Ajax通信が成功した場合に呼び出される

			// PHPから返ってきたデータの表示
			$("#todo_space_comp").html(data).height("auto").css('background','');

		}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
			// 通常はここでtextStatusやerrorThrownの値を見て処理を切り分けるか、単純に通信に失敗した際の処理を記述します。

			// this;
			// thisは他のコールバック関数同様にAJAX通信時のオプションを示します。

			// エラーメッセージの表示
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
			// doneのブロック内は、Ajax通信が成功した場合に呼び出される

			// PHPから返ってきたデータの表示
			$("#todo_space_comp").html(data);

		}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
			// 通常はここでtextStatusやerrorThrownの値を見て処理を切り分けるか、単純に通信に失敗した際の処理を記述します。

			// this;
			// thisは他のコールバック関数同様にAJAX通信時のオプションを示します。

			// エラーメッセージの表示
			//alert('Error : ' + errorThrown);
			todo_serch(searchtext);
		});
	} else if(!$("#noserachalert").length) {
		$('main').prepend("<div class=\"alert alert-warning alert-dismissible fade show col-12\" role=\"alert\" id=\"noserachalert\"><strong>残念</strong>このページでは検索できないですよ。<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button></div>");
	}
	// サブミット後、ページをリロードしないようにする
	return false;
}


  
  
	
  



// ##############################################################################################################################
//
//			todo編集用の関数
//
// ##############################################################################################################################

	function todo_delete_check(tilte, id){
		ret = confirm(tilte + "を本当に削除しますか？よろしいですか？");
		if (ret == true){
			location.href = '/Memoria/pages/todo/delete.php?delete=OK&id='+id+'&pages=MDBpages';
		}
	}
	

// ##############################################################################################################################
//
//			テーブル用の関数
//
// ##############################################################################################################################
$(document).ready(function(){
	
	if($("#datatableFilter").length) {

		jQuery(function($){
			$.extend( $.fn.dataTable.defaults, { 
				language: {
					url: "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Japanese.json"
				} 
			}); 
			$('#datatableFilter').dataTable({
				// 件数切替の値を10〜50の10刻みにする
				lengthMenu: [ 50, 100, 150, 200, 250, 300, 500, 750, 1000 ],
				// 件数のデフォルトの値を50にする
				displayLength: 250,  
				//stateSave: true,
				columnDefs: [
					// 2列目を消す(visibleをfalseにすると消えます)
					{ targets: 1, visible: false },
					{ targets: 3, visible: false },
				],
				responsive: true, order: [[3, 'desc']],
			});

		});
		
	}
});
$(document).ready(function(){
	if($("#datatable").length) {
		/*
		var filterNum = $('#datatable thead th').length;
		var filterInput = "<tr>";
		for (var i=0; i<filterNum; i++) {
			filterInput += '<th><input type="text" class="form-control form-control-sm" style="width:100%"/></th>';
		}
		filterInput += "</tr>";
		$('#datatable thead').prepend(filterInput);
		*/
		var table = $('#datatable').DataTable({
					language: {
						url: "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Japanese.json"
					},
					// 件数切替の値を10〜50の10刻みにする
					lengthMenu: [ 50, 100, 150, 200, 250, 300, 500, 750, 1000 ],
					// 件数のデフォルトの値を50にする
					displayLength: 250,  
					//stateSave: true,
					columnDefs: [
						// 2列目を消す(visibleをfalseにすると消えます)
						{ targets: 1, visible: false },
						{ targets: 3, visible: false },
					],
					responsive: true, order: [[3, 'desc']],
				});
		/*
		$('#datatable th input').each( function () {
			var index = $('#datatable th input').index(this);
			//alert(index);
			$('#datatable th input').eq(index).on( 'keyup', function () {
				//alert(table.columns().indexes);
				table
					.columns( index )
					.search( this.value )
					.draw();
			} );
		} );
		*/
	}
});


$(document).ready(function(){
	
	if($("#tablespage").length) {
		var filterNum = $('#tablespage thead th').length;
		var filterInput = "<tr>";
		for (var i=0; i<filterNum; i++) {
			filterInput += '<th><input type="text" class="form-control form-control-sm" style="width:100%"/></th>';
		}
		filterInput += "</tr>";
		$('#tablespage thead').prepend(filterInput);

		var table = $('#tablespage').DataTable({
					language: {
						url: "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Japanese.json"
					},
					// 件数切替の値を10〜50の10刻みにする
					lengthMenu: [ 25, 50, 100, 150, 200, 250, 300, 500, 750, 1000 ],
					// 件数のデフォルトの値を50にする
					displayLength: 25,  
					//stateSave: true,
					columnDefs: [
					],
					responsive: true, order: [[0, 'asc']],
					//scrollX: true,
					//scrollY: 600
				});
		$('#tablespage th input').each( function () {
			var index = $('#tablespage th input').index(this);
			//alert(index);
			$('#tablespage th input').eq(index).on( 'keyup', function () {
				//alert(table.columns().indexes);
				table
					.columns( index )
					.search( this.value )
					.draw();
			} );
		} );
		
		$('#tablespage tbody').on( 'mouseenter', 'td', function () {
			var colIdx = table.cell(this).index().column;

			$( table.cells().nodes() ).removeClass( 'highlight' );
			$( table.column( colIdx ).nodes() ).addClass( 'highlight' );
		} );
		
	}
});
if($("#furi").length && $("#name").length) {
	$(function() {
		$.fn.autoKana('#name', '#furi', {
			katakana : false  //true：カタカナ、false：ひらがな（デフォルト）
		});
	});
}
function check_furi() {
	if($("#furi").length && document.getElementById("furi").value=="")
	document.getElementById("furi").value=document.getElementById("name").value;
}

function delete_check(tilte, id, type){
	ret = confirm(tilte + "を本当に削除しますか？よろしいですか？");
	if (ret == true){
		location.href = './' + type + '/table_make.php?type=delete&p=' + id;
	}
}

// ##############################################################################################################################
//
//			ページを読み込む関数
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
		// doneのブロック内は、Ajax通信が成功した場合に呼び出される
		// PHPから返ってきたデータの表示
		$("#tools").html(data).css('background','');
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

// ##############################################################################################################################
//
//			比較用php読み込み関数
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
		// doneのブロック内は、Ajax通信が成功した場合に呼び出される

		// PHPから返ってきたデータの表示
		$("#tools").html(data).css('background','');

	}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
		// 通常はここでtextStatusやerrorThrownの値を見て処理を切り分けるか、単純に通信に失敗した際の処理を記述します。

		// this;
		// thisは他のコールバック関数同様にAJAX通信時のオプションを示します。

		// エラーメッセージの表示
		//alert('Error : ' + errorThrown);
		goto_compare();
	});
	// サブミット後、ページをリロードしないようにする
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
		// doneのブロック内は、Ajax通信が成功した場合に呼び出される

		// PHPから返ってきたデータの表示
		$("#tools").html(data).css('background','');

	}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
		// 通常はここでtextStatusやerrorThrownの値を見て処理を切り分けるか、単純に通信に失敗した際の処理を記述します。

		// this;
		// thisは他のコールバック関数同様にAJAX通信時のオプションを示します。

		// エラーメッセージの表示
		//alert('Error : ' + errorThrown);
		return_compareform(txtA, txtB);
	});
	// サブミット後、ページをリロードしないようにする
	return false;
}

// ##############################################################################################################################
//
//			MarkDownで読み込みページ用関数
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
		// doneのブロック内は、Ajax通信が成功した場合に呼び出される
		// PHPから返ってきたデータの表示
		$("#tools").html(data).css('background','');
	}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
		// 通常はここでtextStatusやerrorThrownの値を見て処理を切り分けるか、単純に通信に失敗した際の処理を記述します。
		// this;
		// thisは他のコールバック関数同様にAJAX通信時のオプションを示します。
		// エラーメッセージの表示
		//alert('Error : ' + errorThrown);
		read_md_php(filepath);
	});
	// サブミット後、ページをリロードしないようにする
	return false;
}


// ##############################################################################################################################
//
//			一時的なプログラムの保存用関数
//
// ##############################################################################################################################

function playground_save() {
	// HTMLでの送信をキャンセル
	event.preventDefault();

	// 操作対象のフォーム要素を取得
	var $form = $("#program_form");

	// 送信ボタンを取得
	var $button = $('#submitbtn');

	$.ajax({
		beforeSend: function(xhr){
			xhr.overrideMimeType('text/html;charset=Shift_JIS');
			$button.attr('disabled', true);
		},
		// 応答後
		complete: function(xhr, textStatus) {
			// ボタンを有効化し、再送信を許可
			$button.attr('disabled', false);
		},
		url: $form.attr('action'),
		type: $form.attr('method'),
		data: $form.serialize(),
		timeout: 10000,  // 単位はミリ秒
	}).done(function(data, dataType) {
		// doneのブロック内は、Ajax通信が成功した場合に呼び出される
		// PHPから返ってきたデータの表示

		read_tool_php("/Memoria/data/tools/temp.php", "resulttab");
		$("#tools").before(data);
		//$("#tools").html(data + "<br><br>" + beforehtml).css('background','');
	}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
		// 通信失敗時の処理
		alert('NG...');
	});
	// サブミット後、ページをリロードしないようにする
	return false;
}



// ##############################################################################################################################
//
//			スマートテーブル用の関数
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
// ##############################################################################################################################
//
//            今月の仕事時間の表示用の関数
//
// ##############################################################################################################################

function read_how_hour(line){
	$("#how_hour_comp").css('background','url(\"../img/grid-gray.svg\") center center no-repeat').css('background-size','20% auto').css('min-height','100px').css('max-width','100px');
	$.ajax({
		beforeSend: function(xhr){
			xhr.overrideMimeType('text/html;charset=Shift_JIS');
		},
		type: "GET",
		scriptCharset:'Shift_JIS',
		url: '/Memoria/pages/other/how_hour.php',
		data: {"line":line},
	}).done(function(data, dataType) {
		// doneのブロック内は、Ajax通信が成功した場合に呼び出される
		// PHPから返ってきたデータの表示
		$("#how_hour_comp").html(data).css('background','').css('min-height','').css('max-width','');
	}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
		// 通常はここでtextStatusやerrorThrownの値を見て処理を切り分けるか、単純に通信に失敗した際の処理を記述します。
		// this;
		// thisは他のコールバック関数同様にAJAX通信時のオプションを示します。
		// エラーメッセージの表示
		alert("エラー");
		//read_how_hour();
	});
	// サブミット後、ページをリロードしないようにする
	return false;
}

// ##############################################################################################################################
//
//			mm:dd形式の時間に30分追加したり減らしたりちょうどよくする用の関数
//
// ##############################################################################################################################
function change_seccond(timeStr, arithmetic, sec){
	var hh = Number(timeStr.substr(0,2));
	var mm = Number(timeStr.substr(3,2));

	if(arithmetic == "セット") { 
		if(mm>=0 && mm<15) {
			mm = 15;
		} else if(mm>=15 && mm<30) {
			mm = 30;
		}else if(mm>=30 && mm<45) {
			mm = 45;
		} else {
			hh = hh+1;
			mm = 0;
		}
	} else if(arithmetic == "+" && mm+sec>=60) { 
		hh = hh + Math.floor((mm+sec) / 60);
		mm = ((mm+sec)%60);
	} else if(arithmetic == "+" && mm+sec<60) {
		mm = sec + mm;
	} else if(arithmetic == "-" && mm>sec) {
		mm = mm - sec;
	} else if(arithmetic == "-" && mm<=sec && mm-(sec%60)>=0) {
		hh = hh - Math.floor(1+(sec-mm) / 60);
		mm = mm-(sec%60) ;
		a = 1;
	} else if(arithmetic == "-" && mm<=sec && mm-(sec%60)<0) {
		hh = hh - Math.floor(1+(sec-mm) / 60);
		mm = 60+mm-(sec%60) ;
	}
	return ( '00' + hh).slice( -2 ) + ":" + ( '00' + mm).slice( -2 );
}
//return ( '00' + hh).slice( -2 ); + ":" + ( '00' + mm).slice( -2 );
//change_seccond(timeStr, "+", 30)
//change_seccond(timeStr, "-", 30)