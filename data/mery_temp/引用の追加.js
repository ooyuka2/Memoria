// -----------------------------------------------------------------------------
// 引用の追加
//
// Copyright (c) Kuro. All Rights Reserved.
// www:    http://www.haijin-boys.com/
// -----------------------------------------------------------------------------

var q = new Array("", "> ", "' ", "// ", "-- ", "; ", "REM ", "", "");
var m = CreatePopupMenu();
m.Add("[> ]メール引用符", 1);
m.Add("[' ]VBコメント", 2);
m.Add("[// ]Cコメント", 3);
m.Add("[-- ]SQLコメント", 4);
m.Add("[; ]INIコメント", 5);
m.Add("[REM ]BATコメント", 6);
m.Add("", 0, meMenuSeparator);
m.Add("1つ削除", 7);
m.Add("すべて削除", 8);
m.Add("", 0, meMenuSeparator);
m.Add("キャンセル", 0);
var r = m.Track(0);
if (r > 0) {
  var x = document.selection.GetActivePointX(mePosLogical);
  var y = document.selection.GetActivePointY(mePosLogical);
  document.selection.StartOfLine(true);
  s = document.selection.Text;
  switch (r) {
    case 1: case 2: case 3: case 4: case 5: case 6:
      document.selection.Text = insertQuote(s, q[r]);
      break;
    case 7:
      document.selection.Text = deleteQuote(s);
      break;
    case 8:
      for (var i = 0; i < 40; i++) {
        var t = deleteQuote(s);
        if (t == s)
          break;
        s = t;
      }
      document.selection.Text = t;
      break;
    default:
      break;
  }
  document.selection.SetActivePoint(mePosLogical, x, y, true);
}

function insertQuote(arg1, arg2) {
  var a = arg1.split("\n");
  for (var i = 0; i < a.length; i++)
    a[i] = arg2 + a[i];
  return a.join("\n");
}

function deleteQuote(arg1) {
  var a = arg1.split("\n");
  for (var i = 0; i < a.length; i++) {
    for (var j = 0; j < q.length; j++) {
      if (q[j].length == 0)
        continue;
      var s = q[j];
      if (a[i].substr(0, s.length) == s)
        a[i] = a[i].substr(s.length);
    }
  }
  return a.join("\n"); 
}
