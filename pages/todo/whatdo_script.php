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

</script>