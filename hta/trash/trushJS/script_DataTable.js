

	var list = new Array();
	var fso = new ActiveXObject("Scripting.FileSystemObject");
	
	/*	起動時に実行	*/
	window.onload = function(){
		moveTo(50, 20); // 左隅近くの座標
		resizeTo((screen.width-100),(screen.height-100)); // 画面いっぱいに広げる
		
		updateLogTable();
		setInterval("updateLogTable()",1000 * 600); //10分に一回更新
	}
	
	/*	表の更新	*/
	function updateLogTable() {
		makeList();
		writeLogTable();
	}
	/*	list配列の初期化・読み込み	*/
	function readList() {
		list = [];
		var f = fso.GetFile("LOG/list.csv");
		var rs = f.OpenAsTextStream();
		var i = 0;
		while (!rs.AtEndOfStream) {
			list[i] = rs.ReadLine().split(",");
			i++;
		}
		rs.close();
	}
	
	/*	表への書き込み	*/
	function writeLogTable() {
		readList();
		var LogTable = "";
		var numError = 0;
		var numNoError = 0;
		var numTry = 0;
		if(list.length!=0) {
			for (var i=list.length-1; i>=0;i--) {
				if(document.selectForm.mySelect.value == 3 || document.selectForm.mySelect.value == list[i][2]) {
					if ( list[i][1].indexOf('[赤]') != -1) {
						LogTable += "<tr class='danger'><td class='lamp lamp-red'><span class='lamp-hidden'>・</span></td>";
					} else if ( list[i][1].indexOf('[黄]') != -1) {
						LogTable += "<tr class='tr-yellow'><td class='lamp lamp-yellow'><span class='lamp-hidden'>・</span></td>";
					} else if ( list[i][1].indexOf('[青]') != -1) {
						LogTable += "<tr class='info'><td class='lamp lamp-blue'><span class='lamp-hidden'>・</span></td>";
					} else if ( list[i][1].indexOf('[緑]') != -1) {
						LogTable += "<tr class='success'><td class='lamp lamp-green'><span class='lamp-hidden'>・</span></td>";
					} else {
						LogTable += "<tr><td></td>";
					}
					LogTable += "<td onclick='openMemo("+i+")'>" + list[i][1] + "</td>"
					if(list[i][2] == 0) {
						LogTable += "<td><button type='button' class='btn btn-danger btn-block btn-xs' id='preventbtm_"+list[i][0]+"' onClick='prevent("+i+")'>未対処</button></td>";
						numNoError++;
					} else if(list[i][2] == 1) {
						LogTable += "<td><button type='button' class='btn btn-warning btn-block btn-xs' id='preventbtm_"+list[i][0]+"' onClick='prevent("+i+")'>対処中</button></td>";
						numTry++;
					} else {
						LogTable += "<td><button type='button' class='btn btn-info btn-block btn-xs' id='preventbtm_"+list[i][0]+"' onClick='prevent("+i+")'>対処済み</button></td>";
					}
					if(list[i][2] != 2) {
						LogTable += "<td><button type='button'  class='btn btn-default btn-block btn-xs' disabled>削除</button></td></tr>";
					} else {
						LogTable += "<td><button type='button'  class='btn btn-success btn-block btn-xs' id='deletebtm_"+list[i][0]+"' onClick='finish("+i+")'>削除</button></td></tr>";
					}
				} else if(list[i][2] == 0) {
					numNoError++;
				} else if(list[i][2] == 1) {
					numTry++;
				}
				numError++;
			}
		} else {
			LogTable = "<tr class='active'><td></td><td class='center'>logデータなし</td><td></td><td></td></tr>";
		}
		document.getElementById("LogTableBody").innerHTML = LogTable;
		var listTime = new Date(fso.GetFile("LOG/list.csv").DateLastModified);
		document.getElementById("listTime").innerHTML = listTime.toLocaleString();
		document.getElementById("numError").innerHTML = numError;
		document.getElementById("numNoError").innerHTML = numNoError;
		document.getElementById("numTry").innerHTML = numTry;
		dataReload();
	}
	
	/*	LOGフォルダーの*.logを確認とlist配列の作成	*/
	function makeList() {
		if(list.length==0) {
			readList();
		}
		//  Folderオブジェクトを取得
		var Dir = fso.GetFolder( "LOG" );
		//  Fileオブジェクトを取得
		var files = new Enumerator( Dir.Files );
		
		var tmplist = new Array();
		var newid = 0;
		if(list.length!=0) newid = parseInt(list[(list.length-1)][0]) + 1;
		var Flug = true;
		i = 0;
		
		//  格納したFileオブジェクトのファイル名を全て表示
		for( files.moveFirst(); !files.atEnd(); files.moveNext() ) {
			var fileName = files.item().Name;
			var logfile = ".log";
			// ファイル名が*.logであることの確認
			if ((fileName.lastIndexOf(logfile)+logfile.length===fileName.length)&&(logfile.length<=fileName.length)) {
				Flug = true;
				if(list.length!=0) {
					for(j=0; j<list.length; j++) {
				    	if(list[j][1] === fileName ) {
				    		//取得したファイルの更新日時を確認
							var createDateTime = new Date(files.item().DateLastModified);
							var createTime = createDateTime.toLocaleString();
				    		//取得したファイルのファイル名をtmpListに格納
				    		tmplist[i] = list[j];
				    		tmplist[i][3] = createTime;
				    		Flug = false;
				    		i++;
				    	}
					}
				}
				if(Flug) {
					//取得したファイルの更新日時を確認
					var createDateTime = new Date(files.item().DateLastModified);
					var createTime = createDateTime.toLocaleString();
					//取得したファイルのファイル名をtmpListに格納
					tmplist[i] =  new Array();
					tmplist[i][0] = newid;
					newid++;
					tmplist[i][1] = fileName;
					tmplist[i][2] = 0;
					tmplist[i][3] = createTime;
					i++;
				}
			}
		}
		//更新日時を確認して並び替え
		for(i=0; i<tmplist.length; i++) {
			for(j=i+1; j<tmplist.length; j++) {
				var date1 = new Date(tmplist[i][3]);
				var date2 = new Date(tmplist[j][3]);
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
			list[i][0] = tmplist[i][0];
			list[i][1] = tmplist[i][1];
			list[i][2] = tmplist[i][2];
		}
		writeList();
	}
	
	/*	list.csvへの書き込み	*/
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

		//  ファイルを書き込み専用で開く
		var file = fso.OpenTextFile( "LOG/list.csv", FORWRITING, true, TRISTATE_FALSE );

		//  ファイルへの書き込み
		for(i=0; i<list.length; i++) {
			var writeText = list[i][0] + "," + list[i][1] + "," + list[i][2];
			file.WriteLine(writeText);
		}
		//  ファイルを閉じる
		file.Close();
	}
	/*	ファイル名をクリックされたときにメモ帳を開く	*/
	function openMemo(row) {
		var shell = new ActiveXObject("WScript.Shell");
		shell.exec("C:/WINDOWS/system32/notepad.exe LOG/" + list[row][1]);
	}
	
	/*	対処状況のボタンが押されたときの動作	*/
	function prevent(row) {
		list[row][2]++;
		if (list[row][2] == 3) list[row][2] = 0;
		updateLogTable();
	}
	
	/*	削除のボタンが押されたときの動作	*/
	function finish(row) {
		ret = confirm(list[row][1] + "\n本当に削除しますか？");
		if (ret == true){
			fso.MoveFile( "LOG/"+list[row][1], "対処済み/"+list[row][1] );
			updateLogTable();
		}
	}
	
	
jQuery.fn.dataTableExt.oApi.fnReloadAjax = function ( oSettings, sNewSource, fnCallback, bStandingRedraw )
{
    // DataTables 1.10 compatibility - if 1.10 then `versionCheck` exists.
    // 1.10's API has ajax reloading built in, so we use those abilities
    // directly.
    if ( jQuery.fn.dataTable.versionCheck ) {
        var api = new jQuery.fn.dataTable.Api( oSettings );
 
        if ( sNewSource ) {
            api.ajax.url( sNewSource ).load( fnCallback, !bStandingRedraw );
        }
        else {
            api.ajax.reload( fnCallback, !bStandingRedraw );
        }
        return;
    }
 
    if ( sNewSource !== undefined && sNewSource !== null ) {
        oSettings.sAjaxSource = sNewSource;
    }
 
    // Server-side processing should just call fnDraw
    if ( oSettings.oFeatures.bServerSide ) {
        this.fnDraw();
        return;
    }
 
    this.oApi._fnProcessingDisplay( oSettings, true );
    var that = this;
    var iStart = oSettings._iDisplayStart;
    var aData = [];
 
    this.oApi._fnServerParams( oSettings, aData );
 
    oSettings.fnServerData.call( oSettings.oInstance, oSettings.sAjaxSource, aData, function(json) {
        /* Clear the old information from the table */
        that.oApi._fnClearTable( oSettings );
 
        /* Got the data - add it to the table */
        var aData =  (oSettings.sAjaxDataProp !== "") ?
            that.oApi._fnGetObjectDataFn( oSettings.sAjaxDataProp )( json ) : json;
 
        for ( var i=0 ; i<aData.length ; i++ )
        {
            that.oApi._fnAddData( oSettings, aData[i] );
        }
 
        oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
 
        that.fnDraw();
 
        if ( bStandingRedraw === true )
        {
            oSettings._iDisplayStart = iStart;
            that.oApi._fnCalculateEnd( oSettings );
            that.fnDraw( false );
        }
 
        that.oApi._fnProcessingDisplay( oSettings, false );
 
        /* Callback user function - for event handlers etc */
        if ( typeof fnCallback == 'function' && fnCallback !== null )
        {
            fnCallback( oSettings );
        }
    }, oSettings );
};