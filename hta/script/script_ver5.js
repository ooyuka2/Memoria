var fso = new ActiveXObject("Scripting.FileSystemObject");
var thisFolder = fso.GetFolder(".").Path.replace(/\\/g, "/"); //自身のフォルダパス
//var parentFolder = fso.GetParentFolderName( thisFolder );	//自身の親のフォルダパス

const LogFolder = thisFolder + "/LOG/";	//logのファルダの在処（相対パスがベター）
const listcsvFile = LogFolder + "list.csv";		//リストファイルへのパス
const FinishFolder = thisFolder + "/Finish/";		//対処済みのlogのファルダの在処（相対パスがベター）
const FinishListFile = FinishFolder + "finishlist.csv";
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
	resizeTo((screen.width-100),(screen.height-100)); // 画面いっぱいに広げる
	
	makeList();
	updateFinishList();	//FinishListFileの更新
	updateLogTable();	//表の更新
	setInterval("updateLogTable()",1000 * sec); 	//表をsec秒毎(更新頻度)に更新
}

/*	表の更新	*/
function updateLogTable() {
	//今の時間を取得
	var now = new Date();
	if(now.getHours() == 0 && midnight) {
		updateFinishList();	//FinishListFileの更新
		midnight = false;
	} else if(now.getHours() != 0 && !midnight) {
		midnight = true;
	}
	
	
	makeList();
	writeLogTable();
}

/*	list配列の初期化・読み込み	*/
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
				    document.getElementById("errormessage").innerHTML += toLocaleString( new Date(), true ) + ": readList()読み込み時でエラー発生<br>" + huga+ "<br>";
				    //終了条件
				    if (huga == 1) {
				    clearInterval(hoge);
				    }
				}, 500);
			}
			return;
		}
		catch(exception){
		    document.getElementById("errormessage").innerHTML += toLocaleString( new Date(), true ) + ": readList()読み込み時でエラー発生<br>";
		}
	}
}


/*	表への書き込み	*/
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
				if ( list[i]['fileName'].indexOf('[赤]') != -1) {
					if (list[i]['situation'] == 0) LogTable += "<tr><td class='lamp lamp-red blink-lamp'><span class='lamp-hidden'>●</span></td>";
					else LogTable += "<tr><td class='lamp lamp-red'><span class='lamp-hidden'>●</span></td>";
				} else if ( list[i]['fileName'].indexOf('[黄]') != -1) {
					if (list[i]['situation'] == 0) LogTable += "<tr><td class='lamp lamp-yellow blink-lamp'><span class='lamp-hidden'>●</span></td>";
					else LogTable += "<tr><td class='lamp lamp-yellow'><span class='lamp-hidden'>●</span></td>";
				} else if ( list[i]['fileName'].indexOf('[青]') != -1) {
					if (list[i]['situation'] == 0) LogTable += "<tr><td class='lamp lamp-blue blink-lamp'><span class='lamp-hidden'>●</span></td>";
					else LogTable += "<tr><td class='lamp lamp-blue'><span class='lamp-hidden'>●</span></td>";
				} else if ( list[i]['fileName'].indexOf('[緑]') != -1) {
					if (list[i]['situation'] == 0) LogTable += "<tr><td class='lamp lamp-green blink-lamp'><span class='lamp-hidden'>●</span></td>";
					else LogTable += "<tr><td class='lamp lamp-green'><span class='lamp-hidden'>●</span></td>";
				} else if ( list[i]['fileName'].indexOf('[白]') != -1) {
					if (list[i]['situation'] == 0) LogTable += "<tr><td class='lamp lamp-white blink-lamp'><span class='lamp-hidden'>●</span></td>";
					else LogTable += "<tr><td class='lamp lamp-white'><span class='lamp-hidden'>●</span></td>";
				} else {
					LogTable += "<tr><td></td>";
				}
				
				if(list[i]['situation'] == 0) {
					LogTable += "<td class='danger txtcenter'>" + list[i]['createTime'] + "</td><td class='danger' onclick='openMemo("+i+")'>" + list[i]['fileName'] + "</td><td class='danger txtcenter'>" + list[i]['errorCount'] + "件</td>";
					LogTable += "<td class='danger'><button type='button' class='btn btn-danger btn-block btn-xs' id='preventbtm_"+list[i]['fileId']+"' onClick='prevent("+i+")'>未対処</button></td>";
					LogTable += "<td class='danger'><button type='button'  class='btn btn-default btn-block btn-xs' disabled>-</button></td></tr>";
					numError++;
				} else if(list[i]['situation'] == 1) {
					LogTable += "<td class='warning txtcenter'>" + list[i]['createTime'] + "</td><td class='warning' onclick='openMemo("+i+")'>" + list[i]['fileName'] + "</td><td class='warning txtcenter'>" + list[i]['errorCount'] + "件</td>";
					LogTable += "<td class='warning'><button type='button' class='btn btn-warning btn-block btn-xs' id='preventbtm_"+list[i]['fileId']+"' onClick='prevent("+i+")'>対処中</button></td>";
					LogTable += "<td class='warning'><button type='button'  class='btn btn-default btn-block btn-xs' disabled>-</button></td></tr>";
					numTry++;
				} else {
					LogTable += "<td class='success txtcenter'>" + list[i]['createTime'] + "</td><td class='success' onclick='openMemo("+i+")'>" + list[i]['fileName'] + "</td><td class='success txtcenter'>" + list[i]['errorCount'] + "件</td>";
					LogTable += "<td class='success'><button type='button' class='btn btn-info btn-block btn-xs' id='preventbtm_"+list[i]['fileId']+"' onClick='prevent("+i+")'>対処済み</button></td>";
					LogTable += "<td class='success'><button type='button'  class='btn btn-success btn-block btn-xs' id='deletebtm_"+list[i]['fileId']+"' onClick='finish("+i+")'>削除</button></td></tr>";
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

/*	LOGフォルダーの*.logを確認とlist配列の作成	*/
function makeList() {
	//if(list.length==0) {
		readList();
	//}
	//  Folderオブジェクトを取得
	var Dir = fso.GetFolder( LogFolder );
	//  Fileオブジェクトを取得
	var files = new Enumerator( Dir.Files );
	
	var tmplist = new Array();
	var newid = 0;
	if(list.length!=0) newid = parseInt(list[(list.length-1)]['fileId']) + 1;
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
				var countRow = 0;
				var rs = files.item().OpenAsTextStream();
				while (!rs.AtEndOfStream) {
					rs.ReadLine();
					countRow++;
				}
				rs.close();
				
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
			var countRow = 0;
			var rs = files.item().OpenAsTextStream();
			while (!rs.AtEndOfStream) {
				rs.ReadLine();
				countRow++;
			}
			rs.close();
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
		    document.getElementById("errormessage").innerHTML += toLocaleString( new Date(), true ) + ": writeList()でエラー発生<br>";
		}
	}
}
/*	ファイル名をクリックされたときにメモ帳を開く	*/
function openMemo(row) {
	var shell = new ActiveXObject("WScript.Shell");
	shell.exec("C:/WINDOWS/system32/notepad.exe " + LogFolder + list[row]['fileName']);
}

/*	対処状況のボタンが押されたときの動作	*/
function prevent(row) {
	list[row]['situation']++;
	if (list[row]['situation'] == 3) list[row]['situation'] = 0;
	var now = new Date();
	list[row]['situationDate'] = toLocaleString( now, true );
	writeList();
	updateLogTable();
}

/*	削除のボタンが押されたときに表から削除する	*/
function finish(row) {
	ret = confirm(list[row]['fileName'] + "\n本当に削除しますか？");
	if (ret == true){
		fso.MoveFile( LogFolder+list[row]['fileName'], FinishFolder+list[row]['fileName'] );
		updateLogTable();
	}
}

/*	12時間以上前に対処済みになったlogを表から削除する	*/
function finish_after12() {
	var before12 = new Date();
	before12.setHours( before12.getHours() - 12 );
	for(i=0; i<list.length; i++) {
		var situationDate =  new Date(list[i]['situationDate']);
		if (list[i]['situation'] == 2 && before12.getTime() > situationDate.getTime()){
			//後で直す
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
		    document.getElementById("errormessage").innerHTML += toLocaleString( new Date(), true ) + ": updateFinishList()読み込み時でエラー発生<br>";
		}
	}
}

/*	FinishListFileの更新と、対処済みフォルダに移動してから31日以上経過しているファイルの削除	*/
function updateFinishList() {
	finish_after12(); //12時間以上前に対処済みになったlogを表から削除する
	//FinishListFileを読み取る
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
	//今の時間を取得
	var now = new Date();
	
	//  Folderオブジェクトを取得
	var Dir = fso.GetFolder( FinishFolder );
	//  Fileオブジェクトを取得
	var files = new Enumerator( Dir.Files );
	
	var Flug = true;
	var i = 0;
	
	//  格納したFileオブジェクトのファイル名を全て表示
	for( files.moveFirst(); !files.atEnd(); files.moveNext() ) {
		var fileName = files.item().Name;
		var logfile = ".log";
		
		// ファイル名が*.logであることの確認
		if((fileName.lastIndexOf(logfile)+logfile.length!==fileName.length) || (logfile.length>fileName.length)) {
			continue;
		}
		Flug = true;
		var before31 = new Date();
		before31.setDate( before31.getDate() - 31 );
		for(j=0; j<beforeFinishList.length; j++) {
			//すでにFinishList配列にあるかどうかの確認
	    	if( beforeFinishList.length!=0 && beforeFinishList[j][0] === fileName) {
	    		var checkDate = new Date(beforeFinishList[j][1]);
	    		if(before31.getTime() > checkDate.getTime()) {
	    			//削除フォルダに移動後、31日立っているものを削除
	    			fso.DeleteFile( FinishFolder + fileName );
	    			Flug = false;
	    		} else {
					//取得したファイルのファイル名をFinishListに格納
					FinishList[i] = beforeFinishList[j];
					Flug = false;
					i++;
				}
			}
		}
		if(Flug) {
			//取得したファイルのファイル名をtmpListに格納
			FinishList[i] =  new Array();
			FinishList[i][0] = fileName;
			FinishList[i][1] = toLocaleString( now, true );
			i++;
		}
	}	
	
	if(FinishList.length != 0) {
		//ファイルへの書き込み
		//  オープンモード
		var FORREADING      = 1;    // 読み取り専用
		var FORWRITING      = 2;    // 書き込み専用
		var FORAPPENDING    = 8;    // 追加書き込み

		//  開くファイルの形式
		var TRISTATE_TRUE       = -1;   // Unicode
		var TRISTATE_FALSE      =  0;   // ASCII
		var TRISTATE_USEDEFAULT = -2;   // システムデフォルト
		
DoSomething(FinishList);
		
		/*
		//  ファイルを書き込み専用で開く
		var file = fso.OpenTextFile( FinishListFile, FORWRITING, true, TRISTATE_FALSE );
		//  ファイルへの書き込み
		for(i=0; i<FinishList.length; i++) {
			var writeText = FinishList[i][0] + "," + FinishList[i][1];
			file.WriteLine(writeText);
		}
		//  ファイルを閉じる
		file.Close();
		*/
	}
}

function DoSomething(FinishList){
	var i= 0;
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
			var file = fso.OpenTextFile( FinishListFile, FORWRITING, true, TRISTATE_FALSE );
			//  ファイルへの書き込み
			for(i=0; i<FinishList.length; i++) {
				var writeText = FinishList[i][0] + "," + FinishList[i][1];
				file.WriteLine(writeText);
			}
			file.Close();
			tryflag = false;
			return;
		}
		catch(exception){
		    document.getElementById("errormessage").innerHTML += toLocaleString( new Date(), true ) + ": updateFinishList()でエラー発生<br>";
		}
	}
}

/*	date関数を文字列に変換する	例）2008/5/1 2:00:00	*/
function toLocaleString( date, sec ) {
	if(sec) {
		return date.getFullYear() + "/" + ( '0' + (date.getMonth() + 1) ).slice( -2 ) + "/" + ( '00' + date.getDate() ).slice( -2 ) + " " + ( '00' + date.getHours() ).slice( -2 ) + ":" + ( '00' + date.getMinutes() ).slice( -2 ) + ":" + ( '00' + date.getSeconds() ).slice( -2 );
	}
    return date.getFullYear() + "/" + ( '0' + (date.getMonth() + 1) ).slice( -2 ) + "/" + ( '00' + date.getDate() ).slice( -2 ) + " " + ( '00' + date.getHours() ).slice( -2 ) + ":" + ( '00' + date.getMinutes() ).slice( -2 );
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


/*	表の見出し部分の固定	*/
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


