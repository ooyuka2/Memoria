var fso = new ActiveXObject("Scripting.FileSystemObject");
var thisFolder = fso.GetFolder(".").Path.replace(/\\/g, "/"); //自身のフォルダパス
//var parentFolder = fso.GetParentFolderName( thisFolder );	//自身の親のフォルダパス

const LogFolder = thisFolder + "/LOG/";	//logのファルダの在処（相対パスがベター）
const listcsvFile = LogFolder + "list.csv";		//リストファイルへのパス
const FinishFolder = thisFolder + "/Finish/";		//対処済みのlogのファルダの在処（相対パスがベター）
//const FinishListFile = FinishFolder + "finishlist.csv";
const listlockFile = thisFolder + "/script/list.lock";		//リストのロックファイルへのパス
const sec = 1;		//更新頻度（秒）

var list = new Array();		//logのファルダの中身のリスト

var numError = 0;	//logのファルダの中にある未対処のlogファイルの総数
var numTry = 0;		//logのファルダの中にある対処中のlogファイルの総数
var numFinish = 0;	//logのファルダの中にある対処済みのlogファイルの総数
var mySelect = 3;

var midnight = false;


/*	起動時に実行	*/
window.onload = function(){
	moveTo(50, 20); // 左隅近くの座標
	resizeTo((screen.width-100),(screen.height-100)); // 画面いっぱいより小さいくらいに広げる
	
	checkFolderFile(); //フォルダーの存在チェックと、リストファイルがないときは作成する
	updateFinishList();	//listファイルや退避フォルダの削除対象の更新
	updateLogTable();	//表の更新
	setInterval("updateLogTable()",1000 * sec); 	//表をsec秒毎(更新頻度)に更新
}

/*
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

更新に関わる関数

<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
*/

/*	表の更新	*/
function updateLogTable() {
	//今の時間を取得
	var now = new Date();
	//真夜中と昼間の12時くらいに行う処理
	if((now.getHours() == 0 || now.getHours() == 12) && midnight) {
		updateFinishList();	//listファイルや退避フォルダの削除対象の更新
		midnight = false;
	} else if(!(now.getHours() == 0 || now.getHours() == 12) && !midnight) {
		midnight = true;
	}
	while(!ListLock()) {}
	makeList();
	writeLogTable();
	unListLock();
}

/*	listファイルや退避フォルダの削除対象の更新	*/
function updateFinishList() {
	while(!ListLock()) {}
	makeList();
	finishAfter12Hours(); //12時間以上前に対処済みになったlogを表から削除する
	deleteAfter31Delete(); //対処済みフォルダに移動してから31日以上経過しているファイルの削除
	unListLock();
}

/*
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

テーブルの表示に関わる関数

<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
*/

/*	表への書き込み	*/
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
		LogTable = "<tr class='active'><td></td><td class='txtcenter'>logデータなし</td><td></td><td></td><td></td><td></td></tr>";
	}
	document.getElementById("LogTableBody").innerHTML = LogTable;
	var listTime = new Date(fso.GetFile(listcsvFile).DateLastModified);
	document.getElementById("listTime").innerHTML = listTime.toLocaleString();
	document.getElementById("numErrorAll").innerHTML = list.length;
	document.getElementById("numError").innerHTML = numError;
	document.getElementById("numTry").innerHTML = numTry;
	document.getElementById("numFinish").innerHTML = numFinish;
}

/*	表の1列目のランプの表示	*/
function tdlampString(i) {
	var td_lamp = "<td class='lamp lamp-color blink-lamp'><span class='lamp-hidden'>●</span></td>";
	if(list[i]['situation'] != 0) td_lamp = td_lamp.replace(" blink-lamp","");
	if ( list[i]['fileName'].indexOf('[赤]') != -1)  td_lamp = td_lamp.replace("color","red");
	else if ( list[i]['fileName'].indexOf('[黄]') != -1)  td_lamp = td_lamp.replace("color","yellow");
	else if ( list[i]['fileName'].indexOf('[青]') != -1)  td_lamp = td_lamp.replace("color","blue");
	else if ( list[i]['fileName'].indexOf('[緑]') != -1)  td_lamp = td_lamp.replace("color","green");
	else if ( list[i]['fileName'].indexOf('[白]') != -1)  td_lamp = td_lamp.replace("color","white");
	else {
		td_lamp = td_lamp.replace("lamp lamp-color","");
		td_lamp = td_lamp.replace("<span class='lamp-hidden'>●</span>","");
	}
	return td_lamp;
}
/*	表の2列目以降の表示	*/
function tdString(i) {
	var td_String = "<td class='situation txtcenter'>" + list[i]['createTime']
		+ "</td><td class='situation' onclick='openMemo("+i+")'>" + list[i]['fileName']
		+ "</td><td class='situation txtcenter'>" + list[i]['errorCount'] + "件</td>"
		+ "<td class='situation'><button type='button' class='btn btn-situation btn-block btn-xs' id='preventbtm_"
		+ list[i]['fileId']+"' onClick=\"prevent('" + list[i]['fileName'] + "','" + list[i]['situation'] + "')\">進捗</button></td>"
		+ "<td class='situation'><button type='button'  class='btn btn-default btn-block btn-xs' disabled>-</button></td>";
	
	if(list[i]['situation'] == 0) {
		td_String = td_String.replace(/situation/g, "danger");
		td_String = td_String.replace("進捗", "未対処");
		numError++;
	} else if(list[i]['situation'] == 1) {
		td_String = td_String.replace(/situation/g, "warning");
		td_String = td_String.replace("進捗", "対処中");
		numTry++;
	} else {
		td_String = td_String.replace(/situation/g, "success");
		td_String = td_String.replace("進捗", "対処済み");
		var notdeletebutton = "<button type='button'  class='btn btn-default btn-block btn-xs' disabled>-</button>";
		var deletebutton = "<button type='button'  class='btn btn-success btn-block btn-xs' id='deletebtm_"+list[i]['fileId']+"' onClick='finish("+i+")'>削除</button>";
		td_String = td_String.replace(notdeletebutton, deletebutton);
		numFinish++;
	}
	return td_String;
}

/*
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

リストファイルの読み書きに関わる関数

<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
*/

/*	list配列の初期化・読み込み	*/
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
				document.getElementById("errormessages").innerHTML += toLocaleString( new Date(), true ) + ": 読み込み失敗？" + count + "回目<br>";
				waitMoment();
			} else {
				tryflag = false;
			}
		}
		catch(exception){
		    document.getElementById("errormessages").innerHTML += toLocaleString( new Date(), true ) + ": readList()読み込み時でエラー発生<br>";
		}
	}
}

/*	リストファイルへの書き込み	*/
function writeList() {
	//ファイルへの書き込み
	//  オープンモード
	var FORREADING      = 1;    // 読み取り専用
	var FORWRITING      = 2;    // 書き込み専用
	var FORAPPENDING    = 8;    // 追加書き込み

	//  開くファイルの形式
	var TRISTATE_TRUE       = -1;   // Unicode
	var TRISTATE_FALSE      =  0;   // ASCII
	var TRISTATE_USEDEFAULT = -2;   // システムデフォルト
	var tryflag = true;
    while(tryflag) {
		try {
			//  ファイルを書き込み専用で開く
			var file = fso.OpenTextFile( listcsvFile, FORWRITING, true, TRISTATE_FALSE );

			//  ファイルへの書き込み
			for(i=0; i<list.length; i++) {
				var writeText = list[i]['fileId'] + "," + list[i]['fileName'] + "," + list[i]['situation'] + "," + list[i]['errorCount'] + "," + list[i]['situationDate'] + "," + list[i]['createTime'];
				file.WriteLine(writeText);
			}
			//  ファイルを閉じる
			file.Close();
			tryflag = false;
			return;
		}
		catch(exception){
		    document.getElementById("errormessages").innerHTML += toLocaleString( new Date(), true ) + ": writeList()でエラー発生<br>";
		    document.getElementById("errormessage").innerHTML 
		    	= "<div class='alert alert-danger alert-dismissible' role='alert'>"
		    	+ "<button type='button' class='close' data-dismiss='alert' aria-label='閉じる'>"
		    	+ "<span aria-hidden='true'>×</span></button><strong>警告</strong><hr>"
		    	+ "動作が安定していません。<br>"
		    	+ "他の端末からもこのシステムにアクセスしていて、競合が起きているのかもしれません。<br>"
		    	+ "一度、このウインドウを閉じて起動しなおしてください。<br>"
		    	+ "更新のタイミングをずらすことで解消される可能性が高いです。</div>";
		    document.getElementById("errormessage").style.top = (window.innerHeight/2 - 100) + "px";
		}
	}
}

/*	LOGフォルダーの*.logを確認とlist配列の作成	*/
function makeList() {
	readList();
	//  Folderオブジェクトを取得
	var Dir = fso.GetFolder( LogFolder );
	//  Fileオブジェクトを取得
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
	
	//  格納したFileオブジェクトのファイル名を全て表示
	for( files.moveFirst(); !files.atEnd(); files.moveNext() ) {
		var fileName = files.item().Name;
		var logfile = ".log";
		var xxx;
		
		// ファイル名が*.logであることの確認
		if((fileName.lastIndexOf(logfile)+logfile.length!==fileName.length) || (logfile.length>fileName.length)) {
			continue;
			alert(fileName);
		}
		Flug = true;
		for(j=0; j<list.length; j++) {
			
			//すでにlist配列にあるかどうかの確認
	    	if( list.length!=0 && list[j]['fileName'] === fileName ) {
	    		//取得したファイルの更新日時を確認
				var createDateTime = new Date(files.item().DateLastModified);
				//取得したファイルの行数を数える
				var countRow = readlogLine(files.item());
				
				//取得したファイルのファイル名をtmpListに格納
				tmplist[i] = list[j];
				tmplist[i]['errorCount'] = countRow;
				tmplist[i]['createTime'] = createDateTime;//createTime;
				Flug = false;
				i++;
			}
		}
		if(Flug) {
			//取得したファイルの更新日時を確認
			var createDateTime = new Date(files.item().DateLastModified);
			//取得したファイルの行数を数える
			var countRow = readlogLine(files.item());
			//今の時間を取得
			var now = new Date();
			//取得したファイルのファイル名をtmpListに格納
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
	//更新日時を確認して並び替え
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
	//list配列への格納
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

/*	ファイルに書き込まれている行数を数える	*/
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
		countRow = "読込失敗";
	}
	return countRow;
}
/*	ロックファイルがあるかどうかを確認。ロックファイルの更新日時が５分以上前の時は削除	*/
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
/*	ロックファイルを作成	*/
function ListLock() {
	var returnFlag = false;
	while(checkListLock()) {}
	try {
		fso.CreateTextFile(listlockFile);
		returnFlag = true;
	} catch(exception) {
		document.getElementById("errormessages").innerHTML += toLocaleString( new Date(), true ) + ": ListLock()でエラー発生<br>";
		returnFlag = false;
	}
	return returnFlag;
}

function unListLock() {
	try {
		waitMoment();
		fso.DeleteFile( listlockFile );
	} catch(exception){
		document.getElementById("errormessages").innerHTML += toLocaleString( new Date(), true ) + ": unListLock()でエラー発生<br>";
	}
}

/*	フォルダーの存在チェックと、リストファイルがないときは作成する	*/
function checkFolderFile() {
	var alertMessage = "";
	if( !fso.FolderExists( LogFolder ) ) alertMessage += LogFolder + "\n\nログを格納するフォルダが存在しません\n\n";
	if( !fso.FolderExists( FinishFolder ) ) alertMessage += FinishFolder + "\n\n対処済みのログを格納するフォルダが存在しません\n\n";
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

ユーザーの操作に関わる関数

<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
*/

/*	ファイル名をクリックされたときにメモ帳を開く	*/
function openMemo(row) {
	var shell = new ActiveXObject("WScript.Shell");
	shell.exec("C:/WINDOWS/system32/notepad.exe " + LogFolder + list[row]['fileName']);
}

/*	対処状況のボタンが押されたときの動作	*/
function prevent(filename, situation) {
	//リストファイルの更新
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
	
	//表の更新
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


/*	削除のボタンが押されたときに表から削除する	*/
function finish(row) {
	ret = confirm(list[row]['fileName'] + "\n本当に削除しますか？");
	if (ret == true){
		writeFinishDay(row) //対処完了日をログファイルに追記
		try {
			fso.MoveFile( LogFolder+list[row]['fileName'], FinishFolder+list[row]['fileName'] );
		} catch(exception){}
		updateLogTable();
	}
}

/*	ヘッダーの進捗状況をクリックしたときの動作	*/
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

表やファイルからの自動削除に関わる関数

<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
*/

/*	12時間以上前に対処済みになったlogを表から削除する	*/
function finishAfter12Hours() {
	var before12 = new Date();
	before12.setHours( before12.getHours() - 12 );
	
	for(i=0; i<list.length; i++) {
		var situationDate =  new Date(list[i]['situationDate']);
		if (list[i]['situation'] == 2 && before12.getTime() > situationDate.getTime()){
			writeFinishDay(i) //対処完了日をログファイルに追記
			try {
				fso.MoveFile( LogFolder+list[i]['fileName'], FinishFolder+list[i]['fileName'] );
			} catch(exception){}
		}
	}
}

/* 対処完了日をログファイルに追記 */
function writeFinishDay(i) {
	var FORAPPENDING    = 8;    // 追加書き込み

	try {
		var file = fso.OpenTextFile(LogFolder+list[i]['fileName'], FORAPPENDING, true);
		var FinishDateTime = new Date(list[i]['situationDate']);
		file.WriteLine();
		file.WriteLine(">>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>");
		file.WriteLine(toLocaleString( FinishDateTime, true ) + "	対応完了");
		file.Close();
	} catch(exception){}
}

/*	対処済みフォルダに移動してから31日以上経過しているファイルの削除	*/
function deleteAfter31Delete() {
	//  Folderオブジェクトを取得
	var Dir = fso.GetFolder( FinishFolder );
	//  Fileオブジェクトを取得
	var files = new Enumerator( Dir.Files );
	
	var before31 = new Date();
	before31.setDate( before31.getDate() - 31 );
	
	//  格納したFileオブジェクトのファイル名を全て表示
	for( files.moveFirst(); !files.atEnd(); files.moveNext() ) {
		var fileName = files.item().Name;
		var logfile = ".log";
		
		// ファイル名が*.logであることの確認
		if((fileName.lastIndexOf(logfile)+logfile.length!==fileName.length) || (logfile.length>fileName.length)) {
			continue;
		}
	    var checkDate = new Date( files.item().DateLastModified );
		if(before31.getTime() > checkDate.getTime()) {
			//削除フォルダに移動後、31日立っているものを削除
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

アプリケーションの見た目に関わる関数

<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
*/

/*	表の見出し部分の固定	*/
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

補助的な関数

<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
*/

/*	date関数を文字列に変換する	例）2008/5/1 2:00:00	*/
function toLocaleString( date, sec ) {
	if(sec) {
		return date.getFullYear() + "/" + ( '0' + (date.getMonth() + 1) ).slice( -2 ) + "/" + ( '00' + date.getDate() ).slice( -2 ) + " " + ( '00' + date.getHours() ).slice( -2 ) + ":" + ( '00' + date.getMinutes() ).slice( -2 ) + ":" + ( '00' + date.getSeconds() ).slice( -2 );
	}
    return date.getFullYear() + "/" + ( '0' + (date.getMonth() + 1) ).slice( -2 ) + "/" + ( '00' + date.getDate() ).slice( -2 ) + " " + ( '00' + date.getHours() ).slice( -2 ) + ":" + ( '00' + date.getMinutes() ).slice( -2 );
}

/*	0.1秒待つ動作	*/
function waitMoment() {
	const d1 = new Date();
	while (true) {
		const d2 = new Date();
			if (d2 - d1 > 100) {
		break;
		}
	}
}