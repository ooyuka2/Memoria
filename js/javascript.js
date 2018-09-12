$(document).ready(function(){
  //textareaフォーカス時に文字数の高さ見てリサイズ
  $('textarea').keyup(function(e) {
    //文字数から高さ取得
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
