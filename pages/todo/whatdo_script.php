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

function toggleTime() {
	var flug = document.getElementById('work_time').checked;
	if(flug) {
		var note = document.getElementById('note').value;
		if (note.match(/�ietc�j/)) {
			note = note.replace("�ietc�j", "�i���ԊǗ�etc�j");
		} else {
			note = note.replace("etc�j", "�E���ԊǗ�etc�j");
		}
		document.getElementById('note').value = note;
	} else {
		var note = document.getElementById('note').value;
		note = note.replace("�E���ԊǗ�", "");
		note = note.replace("���ԊǗ�", "");
		document.getElementById('note').value = note;
	}
}

function toggleWeekly() {
	var flug = document.getElementById('work_weekly').checked;
	if(flug) {
		var note = document.getElementById('note').value;
		if (note.match(/�ietc�j/)) {
			note = note.replace("�ietc�j", "�i�T��etc�j");
		} else {
			note = note.replace("etc�j", "�E�T��etc�j");
		}
		document.getElementById('note').value = note;
	} else {
		var note = document.getElementById('note').value;
		note = note.replace("�E�T��", "");
		note = note.replace("�T��", "");
		document.getElementById('note').value = note;
	}
}

function checkNote() {
	var note = document.getElementById('note').value;
	if (note.match(/���[���Ή�/)) {
		document.getElementById('work_mail').checked = true;
	} else {
		document.getElementById('work_mail').checked = false;
	}
	if (note.match(/�h�L�������g�X�V/)) {
		document.getElementById('work_doc').checked = true;
	} else {
		document.getElementById('work_doc').checked = false;
	}
	if (note.match(/�\�����쐬/)) {
		document.getElementById('work_make').checked = true;
	} else {
		document.getElementById('work_make').checked = false;
	}
	if (note.match(/���ԊǗ�/)) {
		document.getElementById('work_time').checked = true;
	} else {
		document.getElementById('work_time').checked = false;
	}
	if (note.match(/�T��/)) {
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
			if(document.getElementById('note').value == "�����d��") {
				document.getElementById('note').value = "������Ɓi���[���Ή�etc�j";
			}
			checkNote();
		};
	};
	
}

</script>