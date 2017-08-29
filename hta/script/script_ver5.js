var fso = new ActiveXObject("Scripting.FileSystemObject");
var thisFolder = fso.GetFolder(".").Path.replace(/\\/g, "/"); //���g�̃t�H���_�p�X
//var parentFolder = fso.GetParentFolderName( thisFolder );	//���g�̐e�̃t�H���_�p�X

const LogFolder = thisFolder + "/LOG/";	//log�̃t�@���_�̍ݏ��i���΃p�X���x�^�[�j
const listcsvFile = LogFolder + "list.csv";		//���X�g�t�@�C���ւ̃p�X
const FinishFolder = thisFolder + "/Finish/";		//�Ώ��ς݂�log�̃t�@���_�̍ݏ��i���΃p�X���x�^�[�j
const FinishListFile = FinishFolder + "finishlist.csv";
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
	resizeTo((screen.width-100),(screen.height-100)); // ��ʂ����ς��ɍL����
	
	makeList();
	updateFinishList();	//FinishListFile�̍X�V
	updateLogTable();	//�\�̍X�V
	setInterval("updateLogTable()",1000 * sec); 	//�\��sec�b��(�X�V�p�x)�ɍX�V
}

/*	�\�̍X�V	*/
function updateLogTable() {
	//���̎��Ԃ��擾
	var now = new Date();
	if(now.getHours() == 0 && midnight) {
		updateFinishList();	//FinishListFile�̍X�V
		midnight = false;
	} else if(now.getHours() != 0 && !midnight) {
		midnight = true;
	}
	
	
	makeList();
	writeLogTable();
}

/*	list�z��̏������E�ǂݍ���	*/
function readList() {
	readlist = [];
	list = [];
	var tryflag = true;
    while(tryflag) {
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
			tryflag = false;
			if(list.length==0) {
				var huga = 0;
				var hoge = setInterval(function() {
				    readList();
				    huga++;
				    document.getElementById("errormessage").innerHTML += toLocaleString( new Date(), true ) + ": readList()�ǂݍ��ݎ��ŃG���[����<br>" + huga+ "<br>";
				    //�I������
				    if (huga == 1) {
				    clearInterval(hoge);
				    }
				}, 500);
			}
			return;
		}
		catch(exception){
		    document.getElementById("errormessage").innerHTML += toLocaleString( new Date(), true ) + ": readList()�ǂݍ��ݎ��ŃG���[����<br>";
		}
	}
}


/*	�\�ւ̏�������	*/
function writeLogTable() {
	readList();
	var LogTable = "";
	numError = 0;
	numTry = 0;
	numFinish = 0;
	if(list.length!=0) {
		for (var i=list.length-1; i>=0;i--) {
			//if(document.selectForm.mySelect.value == 3 || document.selectForm.mySelect.value == list[i]['situation']) {
			if(mySelect == 3 || mySelect == list[i]['situation']) {
				if ( list[i]['fileName'].indexOf('[��]') != -1) {
					if (list[i]['situation'] == 0) LogTable += "<tr><td class='lamp lamp-red blink-lamp'><span class='lamp-hidden'>��</span></td>";
					else LogTable += "<tr><td class='lamp lamp-red'><span class='lamp-hidden'>��</span></td>";
				} else if ( list[i]['fileName'].indexOf('[��]') != -1) {
					if (list[i]['situation'] == 0) LogTable += "<tr><td class='lamp lamp-yellow blink-lamp'><span class='lamp-hidden'>��</span></td>";
					else LogTable += "<tr><td class='lamp lamp-yellow'><span class='lamp-hidden'>��</span></td>";
				} else if ( list[i]['fileName'].indexOf('[��]') != -1) {
					if (list[i]['situation'] == 0) LogTable += "<tr><td class='lamp lamp-blue blink-lamp'><span class='lamp-hidden'>��</span></td>";
					else LogTable += "<tr><td class='lamp lamp-blue'><span class='lamp-hidden'>��</span></td>";
				} else if ( list[i]['fileName'].indexOf('[��]') != -1) {
					if (list[i]['situation'] == 0) LogTable += "<tr><td class='lamp lamp-green blink-lamp'><span class='lamp-hidden'>��</span></td>";
					else LogTable += "<tr><td class='lamp lamp-green'><span class='lamp-hidden'>��</span></td>";
				} else if ( list[i]['fileName'].indexOf('[��]') != -1) {
					if (list[i]['situation'] == 0) LogTable += "<tr><td class='lamp lamp-white blink-lamp'><span class='lamp-hidden'>��</span></td>";
					else LogTable += "<tr><td class='lamp lamp-white'><span class='lamp-hidden'>��</span></td>";
				} else {
					LogTable += "<tr><td></td>";
				}
				
				if(list[i]['situation'] == 0) {
					LogTable += "<td class='danger txtcenter'>" + list[i]['createTime'] + "</td><td class='danger' onclick='openMemo("+i+")'>" + list[i]['fileName'] + "</td><td class='danger txtcenter'>" + list[i]['errorCount'] + "��</td>";
					LogTable += "<td class='danger'><button type='button' class='btn btn-danger btn-block btn-xs' id='preventbtm_"+list[i]['fileId']+"' onClick='prevent("+i+")'>���Ώ�</button></td>";
					LogTable += "<td class='danger'><button type='button'  class='btn btn-default btn-block btn-xs' disabled>-</button></td></tr>";
					numError++;
				} else if(list[i]['situation'] == 1) {
					LogTable += "<td class='warning txtcenter'>" + list[i]['createTime'] + "</td><td class='warning' onclick='openMemo("+i+")'>" + list[i]['fileName'] + "</td><td class='warning txtcenter'>" + list[i]['errorCount'] + "��</td>";
					LogTable += "<td class='warning'><button type='button' class='btn btn-warning btn-block btn-xs' id='preventbtm_"+list[i]['fileId']+"' onClick='prevent("+i+")'>�Ώ���</button></td>";
					LogTable += "<td class='warning'><button type='button'  class='btn btn-default btn-block btn-xs' disabled>-</button></td></tr>";
					numTry++;
				} else {
					LogTable += "<td class='success txtcenter'>" + list[i]['createTime'] + "</td><td class='success' onclick='openMemo("+i+")'>" + list[i]['fileName'] + "</td><td class='success txtcenter'>" + list[i]['errorCount'] + "��</td>";
					LogTable += "<td class='success'><button type='button' class='btn btn-info btn-block btn-xs' id='preventbtm_"+list[i]['fileId']+"' onClick='prevent("+i+")'>�Ώ��ς�</button></td>";
					LogTable += "<td class='success'><button type='button'  class='btn btn-success btn-block btn-xs' id='deletebtm_"+list[i]['fileId']+"' onClick='finish("+i+")'>�폜</button></td></tr>";
					numFinish++;
				}
				
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

/*	LOG�t�H���_�[��*.log���m�F��list�z��̍쐬	*/
function makeList() {
	//if(list.length==0) {
		readList();
	//}
	//  Folder�I�u�W�F�N�g���擾
	var Dir = fso.GetFolder( LogFolder );
	//  File�I�u�W�F�N�g���擾
	var files = new Enumerator( Dir.Files );
	
	var tmplist = new Array();
	var newid = 0;
	if(list.length!=0) newid = parseInt(list[(list.length-1)]['fileId']) + 1;
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
				var countRow = 0;
				var rs = files.item().OpenAsTextStream();
				while (!rs.AtEndOfStream) {
					rs.ReadLine();
					countRow++;
				}
				rs.close();
				
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
			var countRow = 0;
			var rs = files.item().OpenAsTextStream();
			while (!rs.AtEndOfStream) {
				rs.ReadLine();
				countRow++;
			}
			rs.close();
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
		    document.getElementById("errormessage").innerHTML += toLocaleString( new Date(), true ) + ": writeList()�ŃG���[����<br>";
		}
	}
}
/*	�t�@�C�������N���b�N���ꂽ�Ƃ��Ƀ��������J��	*/
function openMemo(row) {
	var shell = new ActiveXObject("WScript.Shell");
	shell.exec("C:/WINDOWS/system32/notepad.exe " + LogFolder + list[row]['fileName']);
}

/*	�Ώ��󋵂̃{�^���������ꂽ�Ƃ��̓���	*/
function prevent(row) {
	list[row]['situation']++;
	if (list[row]['situation'] == 3) list[row]['situation'] = 0;
	var now = new Date();
	list[row]['situationDate'] = toLocaleString( now, true );
	writeList();
	updateLogTable();
}

/*	�폜�̃{�^���������ꂽ�Ƃ��ɕ\����폜����	*/
function finish(row) {
	ret = confirm(list[row]['fileName'] + "\n�{���ɍ폜���܂����H");
	if (ret == true){
		fso.MoveFile( LogFolder+list[row]['fileName'], FinishFolder+list[row]['fileName'] );
		updateLogTable();
	}
}

/*	12���Ԉȏ�O�ɑΏ��ς݂ɂȂ���log��\����폜����	*/
function finish_after12() {
	var before12 = new Date();
	before12.setHours( before12.getHours() - 12 );
	for(i=0; i<list.length; i++) {
		var situationDate =  new Date(list[i]['situationDate']);
		if (list[i]['situation'] == 2 && before12.getTime() > situationDate.getTime()){
			//��Œ���
			fso.MoveFile( LogFolder+list[i]['fileName'], FinishFolder+list[i]['fileName'] );
		}
	}
}

function DoSomething2(){
	var tryflag = true;
    while(tryflag) {
		try {
			var beforeFinishList = new Array();
			var f = fso.GetFile( FinishListFile );
			var rs = f.OpenAsTextStream();
			var i = 0;
			while (!rs.AtEndOfStream) {
				beforeFinishList[i] = rs.ReadLine().split(",");
				i++;
			}
			rs.close();
			tryflag = false;
			return beforeFinishList;
		}
		catch(exception){
		    document.getElementById("errormessage").innerHTML += toLocaleString( new Date(), true ) + ": updateFinishList()�ǂݍ��ݎ��ŃG���[����<br>";
		}
	}
}

/*	FinishListFile�̍X�V�ƁA�Ώ��ς݃t�H���_�Ɉړ����Ă���31���ȏ�o�߂��Ă���t�@�C���̍폜	*/
function updateFinishList() {
	finish_after12(); //12���Ԉȏ�O�ɑΏ��ς݂ɂȂ���log��\����폜����
	//FinishListFile��ǂݎ��
	var beforeFinishList = new Array();
	var FinishList = new Array();
	/*
	var f = fso.GetFile( FinishListFile );
	var rs = f.OpenAsTextStream();
	var i = 0;
	while (!rs.AtEndOfStream) {
		beforeFinishList[i] = rs.ReadLine().split(",");
		i++;
	}
	rs.close();
	*/
	beforeFinishList = DoSomething2();
	//���̎��Ԃ��擾
	var now = new Date();
	
	//  Folder�I�u�W�F�N�g���擾
	var Dir = fso.GetFolder( FinishFolder );
	//  File�I�u�W�F�N�g���擾
	var files = new Enumerator( Dir.Files );
	
	var Flug = true;
	var i = 0;
	
	//  �i�[����File�I�u�W�F�N�g�̃t�@�C������S�ĕ\��
	for( files.moveFirst(); !files.atEnd(); files.moveNext() ) {
		var fileName = files.item().Name;
		var logfile = ".log";
		
		// �t�@�C������*.log�ł��邱�Ƃ̊m�F
		if((fileName.lastIndexOf(logfile)+logfile.length!==fileName.length) || (logfile.length>fileName.length)) {
			continue;
		}
		Flug = true;
		var before31 = new Date();
		before31.setDate( before31.getDate() - 31 );
		for(j=0; j<beforeFinishList.length; j++) {
			//���ł�FinishList�z��ɂ��邩�ǂ����̊m�F
	    	if( beforeFinishList.length!=0 && beforeFinishList[j][0] === fileName) {
	    		var checkDate = new Date(beforeFinishList[j][1]);
	    		if(before31.getTime() > checkDate.getTime()) {
	    			//�폜�t�H���_�Ɉړ���A31�������Ă�����̂��폜
	    			fso.DeleteFile( FinishFolder + fileName );
	    			Flug = false;
	    		} else {
					//�擾�����t�@�C���̃t�@�C������FinishList�Ɋi�[
					FinishList[i] = beforeFinishList[j];
					Flug = false;
					i++;
				}
			}
		}
		if(Flug) {
			//�擾�����t�@�C���̃t�@�C������tmpList�Ɋi�[
			FinishList[i] =  new Array();
			FinishList[i][0] = fileName;
			FinishList[i][1] = toLocaleString( now, true );
			i++;
		}
	}	
	
	if(FinishList.length != 0) {
		//�t�@�C���ւ̏�������
		//  �I�[�v�����[�h
		var FORREADING      = 1;    // �ǂݎ���p
		var FORWRITING      = 2;    // �������ݐ�p
		var FORAPPENDING    = 8;    // �ǉ���������

		//  �J���t�@�C���̌`��
		var TRISTATE_TRUE       = -1;   // Unicode
		var TRISTATE_FALSE      =  0;   // ASCII
		var TRISTATE_USEDEFAULT = -2;   // �V�X�e���f�t�H���g
		
DoSomething(FinishList);
		
		/*
		//  �t�@�C�����������ݐ�p�ŊJ��
		var file = fso.OpenTextFile( FinishListFile, FORWRITING, true, TRISTATE_FALSE );
		//  �t�@�C���ւ̏�������
		for(i=0; i<FinishList.length; i++) {
			var writeText = FinishList[i][0] + "," + FinishList[i][1];
			file.WriteLine(writeText);
		}
		//  �t�@�C�������
		file.Close();
		*/
	}
}

function DoSomething(FinishList){
	var i= 0;
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
			var file = fso.OpenTextFile( FinishListFile, FORWRITING, true, TRISTATE_FALSE );
			//  �t�@�C���ւ̏�������
			for(i=0; i<FinishList.length; i++) {
				var writeText = FinishList[i][0] + "," + FinishList[i][1];
				file.WriteLine(writeText);
			}
			file.Close();
			tryflag = false;
			return;
		}
		catch(exception){
		    document.getElementById("errormessage").innerHTML += toLocaleString( new Date(), true ) + ": updateFinishList()�ŃG���[����<br>";
		}
	}
}

/*	date�֐��𕶎���ɕϊ�����	��j2008/5/1 2:00:00	*/
function toLocaleString( date, sec ) {
	if(sec) {
		return date.getFullYear() + "/" + ( '0' + (date.getMonth() + 1) ).slice( -2 ) + "/" + ( '00' + date.getDate() ).slice( -2 ) + " " + ( '00' + date.getHours() ).slice( -2 ) + ":" + ( '00' + date.getMinutes() ).slice( -2 ) + ":" + ( '00' + date.getSeconds() ).slice( -2 );
	}
    return date.getFullYear() + "/" + ( '0' + (date.getMonth() + 1) ).slice( -2 ) + "/" + ( '00' + date.getDate() ).slice( -2 ) + " " + ( '00' + date.getHours() ).slice( -2 ) + ":" + ( '00' + date.getMinutes() ).slice( -2 );
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


/*	�\�̌��o�������̌Œ�	*/
$(document).ready(function(){
	var $table = $('table');
	var divtopTexthight = 80;
	$table.floatThead({
		top:divtopTexthight,
		responsiveContainer: function($table){
			return $table.closest('.table-responsive');
		}
	});
});


