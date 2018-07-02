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
		 * ���M�{�^���N���b�N
		 */
		$('#send').click(function() {
			// POST���\�b�h�ő���f�[�^���`���܂� var data = {�p�����[�^�� : �l};
			var data = {'request' : $('#request').val()};

			/**
			 * Ajax�ʐM���\�b�h
			 * @param type	: HTTP�ʐM�̎��
			 * @param url	 : ���N�G�X�g���M���URL
			 * @param data	: �T�[�o�ɑ��M����l
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
				// done�̃u���b�N���́AAjax�ʐM�����������ꍇ�ɌĂяo�����

				// PHP����Ԃ��Ă����f�[�^�̕\��
				alert(data);
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
	});
	</script>
</head>
<body>
	<h1>jQuery & Ajax & PHP Example</h1>
	<form method="post">
		<p><textarea id="request" cols="20" rows="4"></textarea></p>
		<p><input id="send" value="���M" type="submit" /></p>
	</form>
</body>
</html>
jQuery 1.8��