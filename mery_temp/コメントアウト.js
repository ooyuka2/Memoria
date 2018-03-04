#title = "選択行コメントアウト"

// -----------------------------------------------------------------------------
// Eclipse風なコメントアウト
// 複数行一括コメントアウト，復帰マクロ
// 1) 対象は行全体(行途中の選択も行全体とみなす)
// 2) 空白行はコメントアウトしない
// 3) インデントは選択行の範囲で一番左(タブ幅単位)に合わせる
// 4) 選択範囲全体がコメントアウトされている場合は復帰
//
// Copyright (c) ks. All Rights Reserved.
// www:    http://merysmacro.seesaa.net/
// -----------------------------------------------------------------------------

var COM = "//";      // 単一行コメント

switch (Document.Mode.toLowerCase()) {
case "bat":
  COM = "::";
  break;
case "visualbasic":
case "vbscript":
  COM = "'";
  break;
case "python":
case "ini":
  COM = "#";
  break;
}

var meGetLineLogical = 0;

var reg = new RegExp("^[ \\t]*" + COM);
var scrollY = window.ScrollY;
var doc = editor.ActiveDocument;
var sel = doc.Selection;
var st = sel.GetTopPointY(mePosLogical);
var ed = sel.GetBottomPointY(mePosLogical);
var t = "";
var tab = GetTabSpace();

sel.SetActivePoint(mePosLogical, document.GetLine(ed, meGetLineLogical).length+1, ed);
sel.SetAnchorPoint(mePosLogical, 1, st);
var lines = sel.Text.split("\n")
sel.Untabify();
var linesWithoutTab = sel.Text.split("\n");
doc.Undo();

// インデント取得
var indent = -1;
var existNotCommentLine = false;  // 空白・コメント行でない行が存在するか
for (var i=0, len=linesWithoutTab.length; i<len; i++) {
  var s = linesWithoutTab[i];
  var left = s.search(/[^ ]/);
  if (left >= 0 && (indent < 0 || left < indent)) {
    // インデントはタブ幅単位(左寄せ)
    indent = Math.floor(left / tab) * tab;
  }
  if (left >= 0) {
    // コメント行判定
    if (!existNotCommentLine && s.search(reg) == -1) {
      existNotCommentLine = true;
    }
  }
}

// コメントアウト
if (existNotCommentLine) {
  for (var i=0, len=lines.length; i<len; i++) {
    var s = lines[i] + "\n";
    // 空白行はコメントアウトしない
    if (s.search(/[^ \t\n]/) == -1) {
      t += s;
      continue;
    }
 
    // 挿入位置をタブと空白を考慮して決定
    var index = 0, j;
    for (j=0; index<indent; j++) {
      // indent の範囲には半角スペースかタブしかない
      if (s.charAt(j) == " ") {
        index += 1;
      } else {
        index += tab - (index % tab);
      }
    }
    t += s.substring(0, j) + COM + s.substring(j);
  }
}
// コメントから復帰
else {
  for (var i=0, len=lines.length; i<len; i++) {
    var s = lines[i] + "\n";
    if (s.match(reg)) {
      t += s.replace(COM, "");  // 先頭のコメントのみ削除
    } else {
      t += s;
    }
  }
}

// コメントアウト部分を書き換えて，全体を選択
sel.SetActivePoint(mePosLogical, document.GetLine(ed, meGetLineLogical).length+1, ed);
sel.SetAnchorPoint(mePosLogical, 1, st);
sel.Text = t.substring(0, t.length-1);      // 最後の改行は除去
sel.SetAnchorPoint(mePosLogical, 1, st);
window.ScrollY = scrollY;


//========================================
// 関数
//========================================
// タブ幅を取得
function GetTabSpace() {
  var doc = editor.ActiveDocument;
  var sel = doc.Selection;
  sel.EndOfDocument();
  doc.Write("\n\t");
  sel.SetAnchorPoint(mePosLogical, sel.GetActivePointX(mePosLogical)-1, sel.GetActivePointY(mePosLogical));
  sel.Untabify();
  var n = sel.Text.length;
  doc.Undo(); doc.Undo();
 
  return n;
}