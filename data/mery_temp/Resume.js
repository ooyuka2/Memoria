#title = "Mery 再開"
#begingroup = true
// Mery 再開マクロ
// 中断マクロで Mery を終了していた場合，その終了前の状態に復帰する
// ※起動時実行マクロ専用
//
// 【制限事項】
//  1. Undo/Redo バッファはクリアされる
//  2. 矩形選択は維持されない

var fso = new ActiveXObject("Scripting.FileSystemObject");
var shell = new ActiveXObject("WScript.Shell");
var saveDir  = fso.BuildPath(shell.SpecialFolders("Appdata"), "Mery\\Suspend");
var settingFile = saveDir + "\\setting.txt";

// 中断マクロで中断したか判定
if (!fso.FileExists(settingFile)) {
	Quit();
}

// 起動直後または同等の状態かを判定
if (Editor.Documents.Count > 1 || document.FullName || document.Text ){
	Quit();
}

var setting = LoadFromFile(settingFile);
var lines = setting.split("\n");
var isNewDoc = true;
var errNotFound = "";
for (var i=0; i<lines.length; i++) {
	if (!lines[i] || lines[i].indexOf("# ") == 0) {
		continue;
	}
	// 0: ファイルパス
	// 1: 編集内容ファイルパス
	// 2-3: スクロール座標(x, y)
	// 4-7: 選択範囲
	// 8: ファイル更新日付(秒)
	var a = lines[i].split("/");

	if (!isNewDoc) {
		Editor.NewFile();
		isNewDoc = true;
	}
	var doc = Editor.Documents.Item(Editor.Documents.Count-1);
	if (a[0]) {
		if (!fso.FileExists(a[0])) {
			errNotFound += "\n" + a[0];
			continue;
		}
		Editor.OpenFile(a[0]);
		isNewDoc = false;
	}

	if (a[1]) {
		// 中断時からファイルが改変されている場合は確認
		if (a[0]) {
			var modified = new Date(fso.GetFile(a[0]).DateLastModified);
			if (a.length > 8 && modified.getTime() != Number(a[8])) {
				if (!Confirm('"' + a[0] + '" は，\n前回中断時以降に変更されています．\n中断時の変更を反映しますが？')) {
					continue;
				}
			}
		}
		
		doc.Text = LoadFromFile(a[1]);
		isNewDoc = false;
	}

	ScrollX = Number(a[2]);
	ScrollY = Number(a[3]);
	var sel = doc.Selection;
	sel.SetActivePoint(mePosLogical, Number(a[4]), Number(a[5]));
	sel.SetAnchorPoint(mePosLogical, Number(a[6]), Number(a[7]));
}

// 最後に空の『無題』を開いてしまった場合は閉じる
if (isNewDoc) {
	Editor.Documents.Item(Editor.Documents.Count-1).Close();
}

// データ削除
if (fso.FolderExists(saveDir)) {
	//fso.DeleteFolder(saveDir, true);
}

// エラーがあった場合は表示
if (errNotFound) {
	Alert("以下のファイルが開けませんでした．" + errNotFound);
}

// ファイル読み込み
function LoadFromFile(path) {
	var adodb = new ActiveXObject("ADODB.Stream");
	adodb.Charset = "utf-8";
	adodb.Type = 2;
	adodb.Open();
	adodb.LoadFromFile(path);
	var text = adodb.ReadText(-1);
	adodb.Close();
	return text;
};