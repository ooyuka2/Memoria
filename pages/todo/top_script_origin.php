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
//            読み込み時の関数
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
//            todoの検索用の関数
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
			// doneのブロック内は、Ajax通信が成功した場合に呼び出される

			// PHPから返ってきたデータの表示
			$("#todo_space").html(data).height("auto").css('background','');

		}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
			// 通常はここでtextStatusやerrorThrownの値を見て処理を切り分けるか、単純に通信に失敗した際の処理を記述します。

			// this;
			// thisは他のコールバック関数同様にAJAX通信時のオプションを示します。

			// エラーメッセージの表示
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
			// doneのブロック内は、Ajax通信が成功した場合に呼び出される

			// PHPから返ってきたデータの表示
			$("#todo_space").html(data);

		}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
			// 通常はここでtextStatusやerrorThrownの値を見て処理を切り分けるか、単純に通信に失敗した際の処理を記述します。

			// this;
			// thisは他のコールバック関数同様にAJAX通信時のオプションを示します。

			// エラーメッセージの表示
			//alert('Error : ' + errorThrown);
			todo_serch(searchtext);
		});
	}
	// サブミット後、ページをリロードしないようにする
	return false;
}




// ##############################################################################################################################
//
//            todo編集用の関数
//
// ##############################################################################################################################




	//var new_field = document.getElementById("new_field_set").innerHTML;
	
	var new_field = "<fieldset style='position: relative'><div class='well bs-component'><div class='clearfix'><span class='pull-right close' onClick='minus( minusnumber );'>&times;</span><span class='pull-right close'>　</span><span class='pull-right close' onClick='plus2( plusnumber );'>+</span></div><div class='form-group'><div class='col-xs-8'><div class='col-xs-12' style='margin-bottom:5px'><input type='text' class='form-control input-normal input-sm name' name='name[]' placeholder='タイトル' required><input type='hidden' name='id[]' class='id'></div><div class='col-xs-12' style='margin-bottom:5px'><textarea class='form-control input-normal input-sm detail' rows='3' name='detail[]'></textarea></div><div class='col-xs-12' style='margin-bottom:5px'><input type='text' class='form-control input-normal input-sm mono' name='mono[]' placeholder='成果物'></div><div class='col-xs-2' style='margin-bottom:5px'><button type='button' class='btn btn-warning btn-xs' onClick='level_down(this)'>▲</button><button type='button' class='btn btn-warning btn-xs eee' onClick='level_up(this)'>▼</button></div><label class='col-sm-2 control-label' style='margin-bottom:5px'>レベル</label><div class='col-xs-3' style='margin-bottom:5px'><input type='number' class='form-control input-normal input-sm level' name='level[]' value='2' min='2' max='10' readonly></div><label class='col-sm-2 control-label' style='margin-bottom:5px'>優先度</label><div class='col-xs-3' style='margin-bottom:5px'><input type='number' class='form-control input-normal input-sm priority' name='priority[]' min='1' max='10'></div></div><div class='col-xs-4'><div class='col-xs-12' style='margin-bottom:5px'><label class='control-label'>納期</label><input type='text' class='form-control input-normal input-sm noki' name='noki[]'></div><div class='col-xs-12' style='margin-bottom:5px'><label class='control-label'>納期の時間</label><input type='time' class='form-control input-normal input-sm time' name='time[]' step='900'></div><div class='col-xs-12' style='margin-bottom:5px'><label class='control-label'>開始予定時刻</label><input type='text' class='form-control input-normal input-sm kaisi' name='kaisi[]'></div><div class='col-xs-12' style='margin-bottom:5px'><label class='control-label'>終了予定日時</label><input type='text' class='form-control input-normal input-sm syuryo' name='syuryo[]'></div></div></div></div></fieldset>";
	//<div class='form-group' style='margin-bottom:0; position: fixed; bottom: 50px;right:0;width:500px;'><div class='col-xs-offset-3 col-xs-3'><button type='reset' class='btn btn-default btn-block'>Reset</button></div><div class='col-xs-3'><button type='submit' class='btn btn-primary btn-block'>Submit</button></div></div>
	
	if(document.getElementsByClassName("new")) change_level();
	
	
	//<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>×</span></button>
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
			document.getElementsByClassName("new")[0].innerHTML += new_field.replace("minusnumber", String(i)).replace("plusnumber", String(i));
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
			document.getElementsByClassName("new")[0].innerHTML += new_field.replace("minusnumber", String(i)).replace("plusnumber", String(i));
		}
		resize_textarea();
		write_form_plus(array, pluskey);
		setDateTime_start();
		change_level();
	}
	
	function change_level() {
		//親の親の親
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
	

	

	
	function select_theme(theme) {
		location.href = '/Memoria/pages/todo.php?page=select_theme&theme='+theme;
	}

	function todo_delete_check(tilte, id){
		ret = confirm(tilte + "を本当に削除しますか？よろしいですか？");
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

// ##############################################################################################################################
//
//            todoの階層表示用の関数
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
		// doneのブロック内は、Ajax通信が成功した場合に呼び出される
		// PHPから返ってきたデータの表示
		$("#todo_tree").html(data).css('background','');
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
//            メモパネル用の関数
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
//            カレンダー用関数（カレンダーページの時だけ利用）
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
	// ページ読み込み時に実行したい処理
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
		// doneのブロック内は、Ajax通信が成功した場合に呼び出される
		// PHPから返ってきたデータの表示
		$("#calendar").html(data).css('background','');
	}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
		// 通常はここでtextStatusやerrorThrownの値を見て処理を切り分けるか、単純に通信に失敗した際の処理を記述します。
		// this;
		// thisは他のコールバック関数同様にAJAX通信時のオプションを示します。
		// エラーメッセージの表示
		alert('Error : ' + errorThrown);
	});
	// サブミット後、ページをリロードしないようにする
	return false;
});

<?php
}
?>

</script>