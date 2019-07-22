#title = "Mery 中断"
// -----------------------------------------------------------------------------
// Mery 中断マクロ
// 現在開いているファイルの状態を記録して Mery を終了
// 再開マクロを実行することで，終了直前の状態に復帰できる
// 【制限事項】
//  1. Undo/Redo バッファはクリアされる
//  2. 矩形選択は維持されない
// -----------------------------------------------------------------------------



var fso = new ActiveXObject("Scripting.FileSystemObject");
var shell = new ActiveXObject("WScript.Shell");
var saveDir  = fso.BuildPath(shell.SpecialFolders("Appdata"), "Mery\\Suspend");
var settingFile = saveDir + "\\setting.txt";

// 古いデータがあるときは削除
if (fso.FolderExists(saveDir)) {
	fso.DeleteFolder(saveDir, true);

	// 削除完了まで待機
	while (fso.FolderExists(saveDir)) {
		Sleep(50);
	}
}
fso.CreateFolder(saveDir);

var text = "";
for (var i=0; i<Editors.Count; i++) {
	var edit = Editors.Item(i);
	for (var j=0; j<edit.Documents.Count; j++) {
		var doc = edit.Documents.Item(j);
		var sel = doc.Selection;
		doc.Activate();
		text += doc.FullName.replace(/\//g, "\\");

		text += "/";
		if (!doc.Saved) {	// 保存済みでない場合は中断用ファイル作成
			var tempFileName = saveDir + "\\" + fso.GetTempName();
			SaveToFile(tempFileName, doc.Text);
			text += tempFileName;
		}

		text += "/" + ScrollX + "/" + ScrollY;
		text += "/" + sel.GetActivePointX(mePosLogical) + "/" + sel.GetActivePointY(mePosLogical);
		text += "/" + sel.GetAnchorPointX(mePosLogical) + "/" + sel.GetAnchorPointY(mePosLogical);
		
		// ファイル更新日時を記録
		text += "/";
		if (doc.Name) {
			var modified = new Date(fso.GetFile(doc.FullName).DateLastModified);
			text += String(modified.getTime());
		}

		text += "\n";
	}
}
SaveToFile(settingFile, text);

//Alert("Mery を中断します．");

// エディタを閉じる
for (var i=0; i<Editors.Count; i++) {
	var edit = Editors.Item(i);
	for (var j=0; j<edit.Documents.Count; j++) {
		edit.Documents.Item(j).Saved = true;
	}
}
Editor.CloseAll();

// ファイル保存
function SaveToFile(path, text) {
	var adodb = new ActiveXObject("ADODB.Stream");
	adodb.Charset = "utf-8";
	adodb.Type = 2;
	adodb.Open();
	adodb.WriteText(text);
	adodb.SaveToFile(path, 2);
	adodb.Close();
};
