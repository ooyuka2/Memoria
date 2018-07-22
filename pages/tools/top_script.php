<?php 
	//include('/Memoria/pages/function.php');
	if(!isset($ini)) $ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	
 ?>
<script language="javascript" type="text/javascript">
$(document).ready( function(){
// ページ読み込み時に実行したい処理
	<?php echo "read_tool_php('".$ini['dirhtml']."/pages/tools/tools.php', 'toolstab');"; ?>
});
// ##############################################################################################################################
//
//            ページを読み込む関数
//
// ##############################################################################################################################
function read_tool_php(filepath, tabname) {
	if(tabname == "resulttab") {
		$("li.hidden").removeClass("hidden");
		$("#"+tabname).addClass("show");
	} else if($('li.show').get()) {
		$("li.show").removeClass("");
		$("#resulttab").addClass("hidden");
	}
	if(!$("#"+tabname).hasClass('active')) {
		$("li.active").removeClass("active");
		$("#"+tabname).addClass("active");
		
	}
	$("#tools").css('background','url(\"../img/grid.svg\") center center no-repeat').css('background-size','20% auto');
	$.ajax({
		beforeSend: function(xhr){
			xhr.overrideMimeType('text/html;charset=Shift_JIS');
		},
		type: "GET",
		scriptCharset:'Shift_JIS',
		url: filepath,
		//data: {"search":""},
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
//            比較用php読み込み関数
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
		url: '<?php echo $ini['dirhtml']."/pages/tools/tools/compare.php";?>',
		data: {"txtA":document.getElementById('txtA').value, "txtB":document.getElementById('txtB').value, "type":type },
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
		url: '<?php echo $ini['dirhtml']."/pages/tools/tools/compare_form.php";?>',
		data: {"txtA":txtA, "txtB":txtB},
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
//            MarkDownで読み込みページ用関数
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
		url: '<?php echo $ini['dirhtml']."/pages/tools/tools/read_md.php";?>',
		data: {"file":filepath},
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
//            一時的なプログラムの保存用関数
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
//            0以上ならマイナスをつける関数
//
// ##############################################################################################################################
function abs(val) {
  return val < 0 ? -val : val;
};
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
//            テキストエリアの高さの関数
//
// ##############################################################################################################################
function changetextform(element) {
	var textarea = element;
	if( textarea.scrollHeight != textarea.offsetHeight ){
		textarea.style.height = textarea.scrollHeight+'px';
	}
}
</script>