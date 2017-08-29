var fso = new ActiveXObject("Scripting.FileSystemObject");
var thisFolder = fso.GetFolder(".").Path.replace(/\\/g, "/"); //���g�̃t�H���_�p�X
//var parentFolder = fso.GetParentFolderName( thisFolder );	//���g�̐e�̃t�H���_�p�X

const LogFolder = thisFolder + "/LOG/";	//log�̃t�@���_�̍ݏ��i���΃p�X���x�^�[�j
const listcsvFile = LogFolder + "list.csv";		//���X�g�t�@�C���ւ̃p�X
const FinishFolder = thisFolder + "/Finish/";		//�Ώ��ς݂�log�̃t�@���_�̍ݏ��i���΃p�X���x�^�[�j
//const FinishListFile = FinishFolder + "finishlist.csv";
const listlockFile = thisFolder + "/script/list.lock";		//���X�g�̃��b�N�t�@�C���ւ̃p�X
const sec = 1;		//�X�V�p�x�i�b�j

var list = new Array();		//log�̃t�@���_�̒��g�̃��X�g

var numError = 0;	//log�̃t�@���_�̒��ɂ��関�Ώ���log�t�@�C���̑���
var numTry = 0;		//log�̃t�@���_�̒��ɂ���Ώ�����log�t�@�C���̑���
var numFinish = 0;	//log�̃t�@���_�̒��ɂ���Ώ��ς݂�log�t�@�C���̑���
var mySelect = 3;

var midnight = false;


/*	�N�����Ɏ��s	*/
window.onload = function(){
	moveTo(50, 20); // �����߂��̍��W
	resizeTo((screen.width-100),(screen.height-100)); // ��ʂ����ς���菬�������炢�ɍL����
	
	checkFolderFile(); //�t�H���_�[�̑��݃`�F�b�N�ƁA���X�g�t�@�C�����Ȃ��Ƃ��͍쐬����
	updateFinishList();	//list�t�@�C����ޔ��t�H���_�̍폜�Ώۂ̍X�V
	updateLogTable();	//�\�̍X�V
	setInterval("updateLogTable()",1000 * sec); 	//�\��sec�b��(�X�V�p�x)�ɍX�V
}

/*
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

�X�V�Ɋւ��֐�

<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
*/

/*	�\�̍X�V	*/
function updateLogTable() {
	//���̎��Ԃ��擾
	var now = new Date();
	//�^�钆�ƒ��Ԃ�12�����炢�ɍs������
	if((now.getHours() == 0 || now.getHours() == 12) && midnight) {
		updateFinishList();	//list�t�@�C����ޔ��t�H���_�̍폜�Ώۂ̍X�V
		midnight = false;
	} else if(!(now.getHours() == 0 || now.getHours() == 12) && !midnight) {
		midnight = true;
	}
	while(!ListLock()) {}
	makeList();
	writeLogTable();
	unListLock();
}

/*	list�t�@�C����ޔ��t�H���_�̍폜�Ώۂ̍X�V	*/
function updateFinishList() {
	while(!ListLock()) {}
	makeList();
	finishAfter12Hours(); //12���Ԉȏ�O�ɑΏ��ς݂ɂȂ���log��\����폜����
	deleteAfter31Delete(); //�Ώ��ς݃t�H���_�Ɉړ����Ă���31���ȏ�o�߂��Ă���t�@�C���̍폜
	unListLock();
}

/*
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

�e�[�u���̕\���Ɋւ��֐�

<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
*/

/*	�\�ւ̏�������	*/
function writeLogTable() {
	readList();
	var LogTable = "";
	numError = 0;
	numTry = 0;
	numFinish = 0;
	if(list.length!=0) {
		for (var i=list.length-1; i>=0;i--) {
			if(mySelect == 3 || mySelect == list[i]['situation']) {
				LogTable += "<tr id='file" + list[i]['fileId'] + "'>" + tdlampString(i) + tdString(i) + "</tr>";
			} else if(list[i]['situation'] == 0) {
				numError++;
			} else if(list[i]['situation'] == 1) {
				numTry++;
			} else {
				numFinish++;
			}
		}
	} else {
		LogTable = "<tr class='active'><td></td><td class='txtcenter'>log�f�[�^�Ȃ�</td><td></td><td></td><td></td><td></td></tr>";
	}
	document.getElementById("LogTableBody").innerHTML = LogTable;
	var listTime = new Date(fso.GetFile(listcsvFile).DateLastModified);
	document.getElementById("listTime").innerHTML = listTime.toLocaleString();
	document.getElementById("numErrorAll").innerHTML = list.length;
	document.getElementById("numError").innerHTML = numError;
	document.getElementById("numTry").innerHTML = numTry;
	document.getElementById("numFinish").innerHTML = numFinish;
}

/*	�\��1��ڂ̃����v�̕\��	*/
function tdlampString(i) {
	var td_lamp = "<td class='lamp lamp-color blink-lamp'><span class='lamp-hidden'>��</span></td>";
	if(list[i]['situation'] != 0) td_lamp = td_lamp.replace(" blink-lamp","");
	if ( list[i]['fileName'].indexOf('[��]') != -1)  td_lamp = td_lamp.replace("color","red");
	else if ( list[i]['fileName'].indexOf('[��]') != -1)  td_lamp = td_lamp.replace("color","yellow");
	else if ( list[i]['fileName'].indexOf('[��]') != -1)  td_lamp = td_lamp.replace("color","blue");
	else if ( list[i]['fileName'].indexOf('[��]') != -1)  td_lamp = td_lamp.replace("color","green");
	else if ( list[i]['fileName'].indexOf('[��]') != -1)  td_lamp = td_lamp.replace("color","white");
	else {
		td_lamp = td_lamp.replace("lamp lamp-color","");
		td_lamp = td_lamp.replace("<span class='lamp-hidden'>��</span>","");
	}
	return td_lamp;
}
/*	�\��2��ڈȍ~�̕\��	*/
function tdString(i) {
	var td_String = "<td class='situation txtcenter'>" + list[i]['createTime']
		+ "</td><td class='situation' onclick='openMemo("+i+")'>" + list[i]['fileName']
		+ "</td><td class='situation txtcenter'>" + list[i]['errorCount'] + "��</td>"
		+ "<td class='situation'><button type='button' class='btn btn-situation btn-block btn-xs' id='preventbtm_"
		+ list[i]['fileId']+"' onClick=\"prevent('" + list[i]['fileName'] + "','" + list[i]['situation'] + "')\">�i��</button></td>"
		+ "<td class='situation'><button type='button'  class='btn btn-default btn-block btn-xs' disabled>-</button></td>";
	
	if(list[i]['situation'] == 0) {
		td_String = td_String.replace(/situation/g, "danger");
		td_String = td_String.replace("�i��", "���Ώ�");
		numError++;
	} else if(list[i]['situation'] == 1) {
		td_String = td_String.replace(/situation/g, "warning");
		td_String = td_String.replace("�i��", "�Ώ���");
		numTry++;
	} else {
		td_String = td_String.replace(/situation/g, "success");
		td_String = td_String.replace("�i��", "�Ώ��ς�");
		var notdeletebutton = "<button type='button'  class='btn btn-default btn-block btn-xs' disabled>-</button>";
		var deletebutton = "<button type='button'  class='btn btn-success btn-block btn-xs' id='deletebtm_"+list[i]['fileId']+"' onClick='finish("+i+")'>�폜</button>";
		td_String = td_String.replace(notdeletebutton, deletebutton);
		numFinish++;
	}
	return td_String;
}

/*
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

���X�g�t�@�C���̓ǂݏ����Ɋւ��֐�

<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
*/

/*	list�z��̏������E�ǂݍ���	*/
function readList() {
	var beforeListLength = list.length;
	readlist = [];
	list = [];
	var tryflag = true;
	var count = 0;
    while(tryflag && count < 10) {
		try {
			var f = fso.GetFile(listcsvFile);
			var rs = f.OpenAsTextStream();
			var i = 0;
			while (!rs.AtEndOfStream) {
				readlist[i] = rs.ReadLine().split(",");
				list[i] = new Array();
				list[i]['fileId'] = readlist[i][0];
				list[i]['fileName'] = readlist[i][1];
				list[i]['situation'] = readlist[i][2];
				list[i]['errorCount'] = readlist[i][3];
				list[i]['situationDate'] = readlist[i][4];
				list[i]['createTime'] = readlist[i][5];
				i++;
			}
			rs.close();
			if(list.length < beforeListLength - 2) {
				count++;
				document.getElementById("errormessages").innerHTML += toLocaleString( new Date(), true ) + ": �ǂݍ��ݎ��s�H" + count + "���<br>";
				waitMoment();
			} else {
				tryflag = false;
			}
		}
		catch(exception){
		    document.getElementById("errormessages").innerHTML += toLocaleString( new Date(), true ) + ": readList()�ǂݍ��ݎ��ŃG���[����<br>";
		}
	}
}

/*	���X�g�t�@�C���ւ̏�������	*/
function writeList() {
	//�t�@�C���ւ̏�������
	//  �I�[�v�����[�h
	var FORREADING      = 1;    // �ǂݎ���p
	var FORWRITING      = 2;    // �������ݐ�p
	var FORAPPENDING    = 8;    // �ǉ���������

	//  �J���t�@�C���̌`��
	var TRISTATE_TRUE       = -1;   // Unicode
	var TRISTATE_FALSE      =  0;   // ASCII
	var TRISTATE_USEDEFAULT = -2;   // �V�X�e���f�t�H���g
	var tryflag = true;
    while(tryflag) {
		try {
			//  �t�@�C�����������ݐ�p�ŊJ��
			var file = fso.OpenTextFile( listcsvFile, FORWRITING, true, TRISTATE_FALSE );

			//  �t�@�C���ւ̏�������
			for(i=0; i<list.length; i++) {
				var writeText = list[i]['fileId'] + "," + list[i]['fileName'] + "," + list[i]['situation'] + "," + list[i]['errorCount'] + "," + list[i]['situationDate'] + "," + list[i]['createTime'];
				file.WriteLine(writeText);
			}
			//  �t�@�C�������
			file.Close();
			tryflag = false;
			return;
		}
		catch(exception){
		    document.getElementById("errormessages").innerHTML += toLocaleString( new Date(), true ) + ": writeList()�ŃG���[����<br>";
		    document.getElementById("errormessage").innerHTML 
		    	= "<div class='alert alert-danger alert-dismissible' role='alert'>"
		    	+ "<button type='button' class='close' data-dismiss='alert' aria-label='����'>"
		    	+ "<span aria-hidden='true'>�~</span></button><strong>�x��</strong><hr>"
		    	+ "���삪���肵�Ă��܂���B<br>"
		    	+ "���̒[����������̃V�X�e���ɃA�N�Z�X���Ă��āA�������N���Ă���̂�������܂���B<br>"
		    	+ "��x�A���̃E�C���h�E����ċN�����Ȃ����Ă��������B<br>"
		    	+ "�X�V�̃^�C�~���O�����炷���Ƃŉ��������\���������ł��B</div>";
		    document.getElementById("errormessage").style.top = (window.innerHeight/2 - 100) + "px";
		}
	}
}

/*	LOG�t�H���_�[��*.log���m�F��list�z��̍쐬	*/
function makeList() {
	readList();
	//  Folder�I�u�W�F�N�g���擾
	var Dir = fso.GetFolder( LogFolder );
	//  File�I�u�W�F�N�g���擾
	var files = new Enumerator( Dir.Files );
	
	var tmplist = new Array();
	var newid = 0;
	if(list.length!=0) {
		for(i=0; i<list.length; i++) {
			if(newid < parseInt(list[i]['fileId'])) newid = parseInt(list[i]['fileId']) + 1;
		}
	}
	var Flug = true;
	i = 0;
	
	//  �i�[����File�I�u�W�F�N�g�̃t�@�C������S�ĕ\��
	for( files.moveFirst(); !files.atEnd(); files.moveNext() ) {
		var fileName = files.item().Name;
		var logfile = ".log";
		var xxx;
		
		// �t�@�C������*.log�ł��邱�Ƃ̊m�F
		if((fileName.lastIndexOf(logfile)+logfile.length!==fileName.length) || (logfile.length>fileName.length)) {
			continue;
			alert(fileName);
		}
		Flug = true;
		for(j=0; j<list.length; j++) {
			
			//���ł�list�z��ɂ��邩�ǂ����̊m�F
	    	if( list.length!=0 && list[j]['fileName'] === fileName ) {
	    		//�擾�����t�@�C���̍X�V�������m�F
				var createDateTime = new Date(files.item().DateLastModified);
				//�擾�����t�@�C���̍s���𐔂���
				var countRow = readlogLine(files.item());
				
				//�擾�����t�@�C���̃t�@�C������tmpList�Ɋi�[
				tmplist[i] = list[j];
				tmplist[i]['errorCount'] = countRow;
				tmplist[i]['createTime'] = createDateTime;//createTime;
				Flug = false;
				i++;
			}
		}
		if(Flug) {
			//�擾�����t�@�C���̍X�V�������m�F
			var createDateTime = new Date(files.item().DateLastModified);
			//�擾�����t�@�C���̍s���𐔂���
			var countRow = readlogLine(files.item());
			//���̎��Ԃ��擾
			var now = new Date();
			//�擾�����t�@�C���̃t�@�C������tmpList�Ɋi�[
			tmplist[i] =  new Array();
			tmplist[i]['fileId'] = newid;
			newid++;
			tmplist[i]['fileName'] = fileName;
			tmplist[i]['situation'] = 0;
			tmplist[i]['errorCount'] = countRow;
			tmplist[i]['createTime'] = createDateTime;//createTime;
			tmplist[i]['situationDate'] = toLocaleString( now, true );
			i++;
		}
	}
	//�X�V�������m�F���ĕ��ёւ�
	for(i=0; i<tmplist.length; i++) {
		for(j=i+1; j<tmplist.length; j++) {
			var date1 = new Date(tmplist[i]['createTime']);
			var date2 = new Date(tmplist[j]['createTime']);
			if(date1.getTime() > date2.getTime()) {
				var w = tmplist[i];
				tmplist[i] = tmplist[j];
				tmplist[j] = w;
			}
		}
	}
	//list�z��ւ̊i�[
	list = [];
	for(i=0; i<tmplist.length; i++) {
		list[i] =  new Array();
		list[i]['fileId'] = tmplist[i]['fileId'];
		list[i]['fileName'] = tmplist[i]['fileName'];
		list[i]['situation'] = tmplist[i]['situation'];
		list[i]['errorCount'] = tmplist[i]['errorCount'];
		list[i]['situationDate'] = tmplist[i]['situationDate'];
		createTime = new Date(tmplist[i]['createTime']);
		list[i]['createTime'] = toLocaleString( createTime, false );
	}
	writeList();
}

/*	�t�@�C���ɏ������܂�Ă���s���𐔂���	*/
function readlogLine(file) {
	var countRow = 0;
	try {
		var rs = file.OpenAsTextStream();
		while (!rs.AtEndOfStream) {
			rs.ReadLine();
			countRow++;
		}
		rs.close();
	} catch(exception) {
		countRow = "�Ǎ����s";
	}
	return countRow;
}
/*	���b�N�t�@�C�������邩�ǂ������m�F�B���b�N�t�@�C���̍X�V�������T���ȏ�O�̎��͍폜	*/
function checkListLock() {
	var lockFlag = fso.FileExists( listlockFile );
	var count = 0;
	//var returnFlag = false;
	
	if(lockFlag) {
		count++;
		waitMoment();
		try {
			var before5 = new Date();
			before5.setMinutes( before5.getMinutes() - 5 );
			//var checkDate = new Date( files.item().DateLastModified );
			var checkDate = new Date( fso.GetFile( listlockFile ).DateLastModified );
			if(before5.getTime() > checkDate.getTime()) {
				fso.DeleteFile( listlockFile );
			}
		} catch(exception){}
		lockFlag = fso.FileExists( listlockFile );
	}
	return lockFlag;
}
/*	���b�N�t�@�C�����쐬	*/
function ListLock() {
	var returnFlag = false;
	while(checkListLock()) {}
	try {
		fso.CreateTextFile(listlockFile);
		returnFlag = true;
	} catch(exception) {
		document.getElementById("errormessages").innerHTML += toLocaleString( new Date(), true ) + ": ListLock()�ŃG���[����<br>";
		returnFlag = false;
	}
	return returnFlag;
}

function unListLock() {
	try {
		waitMoment();
		fso.DeleteFile( listlockFile );
	} catch(exception){
		document.getElementById("errormessages").innerHTML += toLocaleString( new Date(), true ) + ": unListLock()�ŃG���[����<br>";
	}
}

/*	�t�H���_�[�̑��݃`�F�b�N�ƁA���X�g�t�@�C�����Ȃ��Ƃ��͍쐬����	*/
function checkFolderFile() {
	var alertMessage = "";
	if( !fso.FolderExists( LogFolder ) ) alertMessage += LogFolder + "\n\n���O���i�[����t�H���_�����݂��܂���\n\n";
	if( !fso.FolderExists( FinishFolder ) ) alertMessage += FinishFolder + "\n\n�Ώ��ς݂̃��O���i�[����t�H���_�����݂��܂���\n\n";
	if( alertMessage != "" ) {
		alert(alertMessage);
		window.close();
	}
	if( !fso.FileExists( listcsvFile ) ) fso.CreateTextFile(listcsvFile);
}

/*
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

���[�U�[�̑���Ɋւ��֐�

<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
*/

/*	�t�@�C�������N���b�N���ꂽ�Ƃ��Ƀ��������J��	*/
function openMemo(row) {
	var shell = new ActiveXObject("WScript.Shell");
	shell.exec("C:/WINDOWS/system32/notepad.exe " + LogFolder + list[row]['fileName']);
}

/*	�Ώ��󋵂̃{�^���������ꂽ�Ƃ��̓���	*/
function prevent(filename, situation) {
	//���X�g�t�@�C���̍X�V
	situation = parseInt(situation) + 1;
	if (situation == 3) situation = 0;
	while(!ListLock()) {}
	readList();
	var now = new Date();
	for(i=0; i<list.length; i++) {
		if(list[i]['fileName'] == filename) {
			
			list[i]['situation'] = situation;
			list[i]['situationDate'] = toLocaleString( now, true );
		}
	}
	writeList();
	unListLock();
	//updateLogTable();
	
	//�\�̍X�V
	if(situation == 0) {
		//numError++;
		numFinish--;
	} else if(situation == 1) {
		//numTry++;
		numError--;
	} else {
		//numFinish++;
		numTry--;
	}
	for(i=0; i<list.length; i++) {
		if(list[i]['fileName'] == filename) {
			document.getElementById("file" + list[i]['fileId']).innerHTML = tdlampString(i) + tdString(i);
		}
	}
	document.getElementById("numError").innerHTML = numError;
	document.getElementById("numTry").innerHTML = numTry;
	document.getElementById("numFinish").innerHTML = numFinish;
}


/*	�폜�̃{�^���������ꂽ�Ƃ��ɕ\����폜����	*/
function finish(row) {
	ret = confirm(list[row]['fileName'] + "\n�{���ɍ폜���܂����H");
	if (ret == true){
		writeFinishDay(row) //�Ώ������������O�t�@�C���ɒǋL
		try {
			fso.MoveFile( LogFolder+list[row]['fileName'], FinishFolder+list[row]['fileName'] );
		} catch(exception){}
		updateLogTable();
	}
}

/*	�w�b�_�[�̐i���󋵂��N���b�N�����Ƃ��̓���	*/
function changeProgress(num) {
	var beforemySelect = mySelect + 1;
	if (beforemySelect == 4) beforemySelect = 0;
	document.getElementsByClassName("checkProgress")[beforemySelect].classList.toggle("active");
	
	mySelect = num;
	
	var aftermySelect = mySelect + 1;
	if (aftermySelect == 4) aftermySelect = 0;
	document.getElementsByClassName("checkProgress")[aftermySelect].classList.toggle("active");

	updateLogTable();
}


/*
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

�\��t�@�C������̎����폜�Ɋւ��֐�

<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
*/

/*	12���Ԉȏ�O�ɑΏ��ς݂ɂȂ���log��\����폜����	*/
function finishAfter12Hours() {
	var before12 = new Date();
	before12.setHours( before12.getHours() - 12 );
	
	for(i=0; i<list.length; i++) {
		var situationDate =  new Date(list[i]['situationDate']);
		if (list[i]['situation'] == 2 && before12.getTime() > situationDate.getTime()){
			writeFinishDay(i) //�Ώ������������O�t�@�C���ɒǋL
			try {
				fso.MoveFile( LogFolder+list[i]['fileName'], FinishFolder+list[i]['fileName'] );
			} catch(exception){}
		}
	}
}

/* �Ώ������������O�t�@�C���ɒǋL */
function writeFinishDay(i) {
	var FORAPPENDING    = 8;    // �ǉ���������

	try {
		var file = fso.OpenTextFile(LogFolder+list[i]['fileName'], FORAPPENDING, true);
		var FinishDateTime = new Date(list[i]['situationDate']);
		file.WriteLine();
		file.WriteLine(">>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>");
		file.WriteLine(toLocaleString( FinishDateTime, true ) + "	�Ή�����");
		file.Close();
	} catch(exception){}
}

/*	�Ώ��ς݃t�H���_�Ɉړ����Ă���31���ȏ�o�߂��Ă���t�@�C���̍폜	*/
function deleteAfter31Delete() {
	//  Folder�I�u�W�F�N�g���擾
	var Dir = fso.GetFolder( FinishFolder );
	//  File�I�u�W�F�N�g���擾
	var files = new Enumerator( Dir.Files );
	
	var before31 = new Date();
	before31.setDate( before31.getDate() - 31 );
	
	//  �i�[����File�I�u�W�F�N�g�̃t�@�C������S�ĕ\��
	for( files.moveFirst(); !files.atEnd(); files.moveNext() ) {
		var fileName = files.item().Name;
		var logfile = ".log";
		
		// �t�@�C������*.log�ł��邱�Ƃ̊m�F
		if((fileName.lastIndexOf(logfile)+logfile.length!==fileName.length) || (logfile.length>fileName.length)) {
			continue;
		}
	    var checkDate = new Date( files.item().DateLastModified );
		if(before31.getTime() > checkDate.getTime()) {
			//�폜�t�H���_�Ɉړ���A31�������Ă�����̂��폜
			try {
				fso.DeleteFile( FinishFolder + fileName );
			} catch(exception){}
		}
	}
} 

/*
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

�A�v���P�[�V�����̌����ڂɊւ��֐�

<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
*/

/*	�\�̌��o�������̌Œ�	*/
$(document).ready(function(){
	var $table = $('table');
	var divtopTexthight = document.getElementById("topText").offsetHeight + 20;
	$table.floatThead({
		top:divtopTexthight,
		responsiveContainer: function($table){
			return $table.closest('.table-responsive');
		}
	});
	document.getElementById("header_space").style.top = document.getElementById("topText").offsetHeight + "px";
});


/*
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

�⏕�I�Ȋ֐�

<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
*/

/*	date�֐��𕶎���ɕϊ�����	��j2008/5/1 2:00:00	*/
function toLocaleString( date, sec ) {
	if(sec) {
		return date.getFullYear() + "/" + ( '0' + (date.getMonth() + 1) ).slice( -2 ) + "/" + ( '00' + date.getDate() ).slice( -2 ) + " " + ( '00' + date.getHours() ).slice( -2 ) + ":" + ( '00' + date.getMinutes() ).slice( -2 ) + ":" + ( '00' + date.getSeconds() ).slice( -2 );
	}
    return date.getFullYear() + "/" + ( '0' + (date.getMonth() + 1) ).slice( -2 ) + "/" + ( '00' + date.getDate() ).slice( -2 ) + " " + ( '00' + date.getHours() ).slice( -2 ) + ":" + ( '00' + date.getMinutes() ).slice( -2 );
}

/*	0.1�b�҂���	*/
function waitMoment() {
	const d1 = new Date();
	while (true) {
		const d2 = new Date();
			if (d2 - d1 > 100) {
		break;
		}
	}
}