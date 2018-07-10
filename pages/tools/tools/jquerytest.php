<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="SJIS-win" />
	<title>jQuery & Ajax & PHP Example</title>
	<?php
		header("Content-type: charset=SJIS-win");
	?>
	<script src="./jquery.min.js"></script>
	<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>-->
	<script>
	$(document).ready(function() {
		/**
		 * 送信ボタンクリック
		 */
		$('#send').click(function() {
			// POSTメソッドで送るデータを定義します var data = {パラメータ名 : 値};
			var data = {'request' : $('#request').val()};

			/**
			 * Ajax通信メソッド
			 * @param type	: HTTP通信の種類
			 * @param url	 : リクエスト送信先のURL
			 * @param data	: サーバに送信する値
			 */
			$.ajax({
				beforeSend: function(xhr){
					xhr.overrideMimeType('text/html;charset=Shift_JIS');
				},
				type: "POST",
				url: "send.php",
				scriptCharset:'Shift_JIS',
				data: data,
			}).done(function(data, dataType) {
				// doneのブロック内は、Ajax通信が成功した場合に呼び出される

				// PHPから返ってきたデータの表示
				alert(data);
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
	});
	</script>
</head>
<body>
	<h1>jQuery & Ajax & PHP Example</h1>
	<form method="post">
		<p><textarea id="request" cols="20" rows="4"></textarea></p>
		<p><input id="send" value="送信" type="submit" /></p>
	</form>
</body>
</html>
jQuery 1.8以