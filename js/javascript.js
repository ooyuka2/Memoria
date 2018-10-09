
// ##############################################################################################################################
//
//            読み込み時の関数
//
// ##############################################################################################################################
//$("#todo_tree_comp")があれば読み込む関数
$(document).ready(function(){

	
	if($("#weather_comp").length) {
		read_weather();
	}
	resize_textarea();
	setDateTime_start();
});


// ##############################################################################################################################
//
//            全体的によく使う関数
//
// ##############################################################################################################################

function resize_textarea() {
	//textareaフォーカス時に文字数の高さ見てリサイズ
	$('textarea').keyup(function(e) {
		//文字数から高さ取得
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
			//機能オプション
			autoswitch: false,					//クリック位置移動
			meridians: false,					 //12時間 / 24時間表示
			format: "HH:mm",					 //時刻フォーマット
			mousewheel: false,					//マウスホイール可否
			init_animation: "fadeIn",	 //初期アニメーション
			setCurrentTime: false,			 //現在時刻の設定

			//スタイルオプション
			primaryColor: "#1977cc",		//設定中の文字
			textColor: "#555555",			 //設定後の文字
			backgroundColor: "#ffffff", //背景
			borderColor: "#1977cc"			//枠線
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
	// true なら実行できている falseなら失敗か対応していないか
	return result;
}

/**
 * Get the URL parameter value
 *
 * @param  name {string} パラメータのキー文字列
 * @return  url {url} 対象のURL文字列（任意）
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
//            0以上ならマイナスをつける関数
//
// ##############################################################################################################################
function abs(val) {
  return val < 0 ? -val : val;
};

// ##############################################################################################################################
//
//            右クリックメニュー用の関数
//
// ##############################################################################################################################
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
		menu = menu + "<div class='btn-group' role='group'><button type='button' class='btn btn-default dropdown-toggle btn-xs btn-block' data-toggle='dropdown' aria-expanded='false'>作業設定<span class='caret'></span></button><ul class='dropdown-menu' role='menu'>";
		
		for(j=Math.ceil(pre/10)*10; j<100; j+=10) 
		menu = menu + "<li role='presentation'><a role='menuitem' tabindex='-1' href='todo.php?page=whatdo&p="+id+"&f="+j+"' class='text-dark' style='padding-left:20px;'>"+j+"％まで完了</a></li>";
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
	if((whatdotoday == 0 || whatdotoday == 2) && pre!=100) menu = menu + "<button class='btn btn-default btn-xs btn-block' onclick='todo_tree_wait("+top+", \"turn\", 1)'>今日頑張る</button>";
	menu = menu + "<button class='btn btn-default btn-xs btn-block' onclick='todo_tree_wait("+top+", \"turn\", 2)'>明日頑張る</button>";
	menu = menu + "<button class='btn btn-default btn-xs btn-block' onclick='todo_tree_wait("+top+", \"turn\", 0)'>今度頑張る</button>";
	if(wait == 0 && pre!=100) menu = menu + "<button class='btn btn-default btn-xs btn-block' onclick='todo_tree_wait("+id+", \"wait\", 0)'>保留設定</button></div>";
	else if(pre!=100) //menu = menu + "<a href='todo.php?page=wait&p="+id+"&file="+todofile+"' class='btn btn-default btn-xs btn-block'>解除設定</a></div>";
	menu = menu + "<button class='btn btn-default btn-xs btn-block' onclick='todo_tree_wait("+id+", \"wait\", 0)'>解除設定</button></div>";
	
	document.getElementById("todo_tree_menu").innerHTML = menu;
	document.getElementById("tree_menu").style.left=tree_menu_x+"px";
	if(tree_menu_y < 500) document.getElementById("tree_menu").style.top=tree_menu_y+"px";
	else document.getElementById("tree_menu").style.top=tree_menu_y-150+"px";
}

//保留・保留解除・今日か明日か今度やるのための関数
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
		// doneのブロック内は、Ajax通信が成功した場合に呼び出される
		// PHPから返ってきたデータの表示
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
		// 通常はここでtextStatusやerrorThrownの値を見て処理を切り分けるか、単純に通信に失敗した際の処理を記述します。
		// this;
		// thisは他のコールバック関数同様にAJAX通信時のオプションを示します。
		// エラーメッセージの表示
		//alert('Error : ' + errorThrown);
		$("#todo_tree_comp").html('Error : ' + errorThrown);
	});
	// サブミット後、ページをリロードしないようにする
	return false;
}


// ##############################################################################################################################
//
//            メモパネル用の関数
//
// ##############################################################################################################################

function changeMempPanel(file, element, min, lock) {
	//location.href = path;
	//var data = {'memoform' : $('#memoform').val()};
	
	if(document.getElementById("memoform") != null) {
		ret = confirm(file + "を保存しますか？");
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
		// doneのブロック内は、Ajax通信が成功した場合に呼び出される

		// PHPから返ってきたデータの表示
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
		makebotton.prepend("<div id='memobotton'><button type='button' id='memosave' class='btn btn-info pull-right' onclick='saveMemoPanel()'>保存</button><span class='pull-right'>　</span><button type='button' id='memocancel' class='btn btn-default pull-right' onclick='reReadMemoPanel()'>キャンセル</button></div>");
		
		//window.location.hash = "#"+file;
		
	}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
		// 通常はここでtextStatusやerrorThrownの値を見て処理を切り分けるか、単純に通信に失敗した際の処理を記述します。

		// this;
		// thisは他のコールバック関数同様にAJAX通信時のオプションを示します。

		// エラーメッセージの表示
		//alert('Error : ' + errorThrown);
		changeMempPanel(file, element, min, lock);
	});
	// サブミット後、ページをリロードしないようにする
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
		// doneのブロック内は、Ajax通信が成功した場合に呼び出される
		
		// PHPから返ってきたデータの表示
		makeMemoPanel.html(data).height("auto").css('background','');
		$("#memobotton").remove();
		
		//window.location.hash = "#"+file;

	}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
		// 通常はここでtextStatusやerrorThrownの値を見て処理を切り分けるか、単純に通信に失敗した際の処理を記述します。

		// this;
		// thisは他のコールバック関数同様にAJAX通信時のオプションを示します。

		// エラーメッセージの表示
		//alert('Error : ' + errorThrown);
		reReadMemoPanel();
	});
	// サブミット後、ページをリロードしないようにする
	return false;
}

function saveMemoPanel() {
	file = $("#memoform").next().val();
	var makeMemoPanel = $("#memoform").parent();
	var text = $("#memoform").val();
	
	//チェックボックスの確認
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
		// doneのブロック内は、Ajax通信が成功した場合に呼び出される

		// PHPから返ってきたデータの表示
		makeMemoPanel.html(data).height("auto").css('background','');
		$("#memobotton").remove();
		
		//window.location.hash = "#"+file;

	}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
		// 通常はここでtextStatusやerrorThrownの値を見て処理を切り分けるか、単純に通信に失敗した際の処理を記述します。

		// this;
		// thisは他のコールバック関数同様にAJAX通信時のオプションを示します。

		// エラーメッセージの表示
		//alert('Error : ' + errorThrown);
		saveMemoPanel();
	});
	// サブミット後、ページをリロードしないようにする
	return false;
}

function deleteMemoPanel(path, file) {
	ret = confirm(file + "を本当に削除しますか？よろしいですか？");
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
//            todo編集用の関数
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
//            今日やること整理のページ用の関数
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
	document.getElementById(dobuttonname).innerHTML = "やる!";
	document.getElementById(donotbuttonname).innerHTML = "やらない";
}
function donotBotton(id) {
	var pid = document.getElementById('pid').value;
	pid = pid.replace("@"+id, "");
	document.getElementById('pid').value = pid;
	dobuttonname = "doButton" + id;
	donotbuttonname = "donotButton" + id;
	document.getElementById(dobuttonname).classList.toggle("disabled");
	document.getElementById(donotbuttonname).classList.toggle("disabled");
	document.getElementById(dobuttonname).innerHTML = "やる";
	document.getElementById(donotbuttonname).innerHTML = "やらない!";
}


// ##############################################################################################################################
//
//            週報用の関数
//
// ##############################################################################################################################

function writeweekly(val) {
	document.getElementsByClassName('write')[val].value = 1;
}

// ##############################################################################################################################
//
//            天気予報の表示用の関数
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
		// doneのブロック内は、Ajax通信が成功した場合に呼び出される
		// PHPから返ってきたデータの表示
		$("#weather_comp").html(data).css('background','').css('min-height','').css('max-width','');
	}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
		// 通常はここでtextStatusやerrorThrownの値を見て処理を切り分けるか、単純に通信に失敗した際の処理を記述します。
		// this;
		// thisは他のコールバック関数同様にAJAX通信時のオプションを示します。
		// エラーメッセージの表示
		read_weather();
	});
	// サブミット後、ページをリロードしないようにする
	return false;
}



// ##############################################################################################################################
//
//            やったこと表示のためのページの関数
//
// ##############################################################################################################################


function toggleMail() {
	var flug = document.getElementById('work_mail').checked;
	if(flug) {
		var note = document.getElementById('note').value;
		if (note.match(/（etc）/)) {
			note = note.replace("（etc）", "（メール対応etc）");
		} else {
			note = note.replace("etc）", "・メール対応etc）");
		}
		document.getElementById('note').value = note;
	} else {
		var note = document.getElementById('note').value;
		note = note.replace("・メール対応", "");
		note = note.replace("メール対応", "");
		document.getElementById('note').value = note;
	}
}

function toggleDoc() {
	var flug = document.getElementById('work_doc').checked;
	if(flug) {
		var note = document.getElementById('note').value;
		if (note.match(/（etc）/)) {
			note = note.replace("（etc）", "（ドキュメント更新etc）");
		} else {
			note = note.replace("etc）", "・ドキュメント更新etc）");
		}
		document.getElementById('note').value = note;
	} else {
		var note = document.getElementById('note').value;
		note = note.replace("・ドキュメント更新", "");
		note = note.replace("ドキュメント更新", "");
		document.getElementById('note').value = note;
	}
}

function toggleMake() {
	var flug = document.getElementById('work_make').checked;
	if(flug) {
		var note = document.getElementById('note').value;
		if (note.match(/（etc）/)) {
			note = note.replace("（etc）", "（申請書作成etc）");
		} else {
			note = note.replace("etc）", "・申請書作成etc）");
		}
		document.getElementById('note').value = note;
	} else {
		var note = document.getElementById('note').value;
		note = note.replace("・申請書作成", "");
		note = note.replace("申請書作成", "");
		document.getElementById('note').value = note;
	}
}

function toggleTime() {
	var flug = document.getElementById('work_time').checked;
	if(flug) {
		var note = document.getElementById('note').value;
		if (note.match(/（etc）/)) {
			note = note.replace("（etc）", "（時間管理etc）");
		} else {
			note = note.replace("etc）", "・時間管理etc）");
		}
		document.getElementById('note').value = note;
	} else {
		var note = document.getElementById('note').value;
		note = note.replace("・時間管理", "");
		note = note.replace("時間管理", "");
		document.getElementById('note').value = note;
	}
}

function toggleWeekly() {
	var flug = document.getElementById('work_weekly').checked;
	if(flug) {
		var note = document.getElementById('note').value;
		if (note.match(/（etc）/)) {
			note = note.replace("（etc）", "（週報etc）");
		} else {
			note = note.replace("etc）", "・週報etc）");
		}
		document.getElementById('note').value = note;
	} else {
		var note = document.getElementById('note').value;
		note = note.replace("・週報", "");
		note = note.replace("週報", "");
		document.getElementById('note').value = note;
	}
}

function checkNote() {
	var note = document.getElementById('note').value;
	if (note.match(/メール対応/)) {
		document.getElementById('work_mail').checked = true;
	} else {
		document.getElementById('work_mail').checked = false;
	}
	if (note.match(/ドキュメント更新/)) {
		document.getElementById('work_doc').checked = true;
	} else {
		document.getElementById('work_doc').checked = false;
	}
	if (note.match(/申請書作成/)) {
		document.getElementById('work_make').checked = true;
	} else {
		document.getElementById('work_make').checked = false;
	}
	if (note.match(/時間管理/)) {
		document.getElementById('work_time').checked = true;
	} else {
		document.getElementById('work_time').checked = false;
	}
	if (note.match(/週報/)) {
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
			if(document.getElementById('note').value == "事務仕事") {
				document.getElementById('note').value = "事務作業（メール対応etc）";
			}
			checkNote();
		};
	};
	
}


// ##############################################################################################################################
//
//            todo編集用の関数
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
		// doneのブロック内は、Ajax通信が成功した場合に呼び出される
		// PHPから返ってきたデータの表示
		last_id = Number(data);
	}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
		location.reload();
	});
	// サブミット後、ページをリロードしないようにする
	return false;
	}
	
	
	if(document.getElementsByClassName("new")) change_level();
	
	//<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>×</span></button>
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
		ret = confirm(tilte + "を本当に削除しますか？よろしいですか？");
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







