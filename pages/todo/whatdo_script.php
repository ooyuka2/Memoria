<script language="javascript" type="text/javascript">

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

</script>