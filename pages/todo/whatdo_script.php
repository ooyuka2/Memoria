<script language="javascript" type="text/javascript">

function toggleMail() {
	var flug = document.getElementById('work_mail').checked;
	if(flug) {
		var note = document.getElementById('note').value;
		if (note.match(/�ietc�j/)) {
			note = note.replace("�ietc�j", "�i���[���Ή�etc�j");
		} else {
			note = note.replace("etc�j", "�E���[���Ή�etc�j");
		}
		document.getElementById('note').value = note;
	} else {
		var note = document.getElementById('note').value;
		note = note.replace("�E���[���Ή�", "");
		note = note.replace("���[���Ή�", "");
		document.getElementById('note').value = note;
	}
}

function toggleDoc() {
	var flug = document.getElementById('work_doc').checked;
	if(flug) {
		var note = document.getElementById('note').value;
		if (note.match(/�ietc�j/)) {
			note = note.replace("�ietc�j", "�i�h�L�������g�X�Vetc�j");
		} else {
			note = note.replace("etc�j", "�E�h�L�������g�X�Vetc�j");
		}
		document.getElementById('note').value = note;
	} else {
		var note = document.getElementById('note').value;
		note = note.replace("�E�h�L�������g�X�V", "");
		note = note.replace("�h�L�������g�X�V", "");
		document.getElementById('note').value = note;
	}
}

function toggleMake() {
	var flug = document.getElementById('work_make').checked;
	if(flug) {
		var note = document.getElementById('note').value;
		if (note.match(/�ietc�j/)) {
			note = note.replace("�ietc�j", "�i�\�����쐬etc�j");
		} else {
			note = note.replace("etc�j", "�E�\�����쐬etc�j");
		}
		document.getElementById('note').value = note;
	} else {
		var note = document.getElementById('note').value;
		note = note.replace("�E�\�����쐬", "");
		note = note.replace("�\�����쐬", "");
		document.getElementById('note').value = note;
	}
}

</script>