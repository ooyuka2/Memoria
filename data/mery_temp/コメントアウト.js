#title = "�I���s�R�����g�A�E�g"

// -----------------------------------------------------------------------------
// Eclipse���ȃR�����g�A�E�g
// �����s�ꊇ�R�����g�A�E�g�C���A�}�N��
// 1) �Ώۂ͍s�S��(�s�r���̑I�����s�S�̂Ƃ݂Ȃ�)
// 2) �󔒍s�̓R�����g�A�E�g���Ȃ�
// 3) �C���f���g�͑I���s�͈̔͂ň�ԍ�(�^�u���P��)�ɍ��킹��
// 4) �I��͈͑S�̂��R�����g�A�E�g����Ă���ꍇ�͕��A
//
// Copyright (c) ks. All Rights Reserved.
// www:    http://merysmacro.seesaa.net/
// -----------------------------------------------------------------------------

var COM = "//";      // �P��s�R�����g

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

// �C���f���g�擾
var indent = -1;
var existNotCommentLine = false;  // �󔒁E�R�����g�s�łȂ��s�����݂��邩
for (var i=0, len=linesWithoutTab.length; i<len; i++) {
  var s = linesWithoutTab[i];
  var left = s.search(/[^ ]/);
  if (left >= 0 && (indent < 0 || left < indent)) {
    // �C���f���g�̓^�u���P��(����)
    indent = Math.floor(left / tab) * tab;
  }
  if (left >= 0) {
    // �R�����g�s����
    if (!existNotCommentLine && s.search(reg) == -1) {
      existNotCommentLine = true;
    }
  }
}

// �R�����g�A�E�g
if (existNotCommentLine) {
  for (var i=0, len=lines.length; i<len; i++) {
    var s = lines[i] + "\n";
    // �󔒍s�̓R�����g�A�E�g���Ȃ�
    if (s.search(/[^ \t\n]/) == -1) {
      t += s;
      continue;
    }
 
    // �}���ʒu���^�u�Ƌ󔒂��l�����Č���
    var index = 0, j;
    for (j=0; index<indent; j++) {
      // indent �͈̔͂ɂ͔��p�X�y�[�X���^�u�����Ȃ�
      if (s.charAt(j) == " ") {
        index += 1;
      } else {
        index += tab - (index % tab);
      }
    }
    t += s.substring(0, j) + COM + s.substring(j);
  }
}
// �R�����g���畜�A
else {
  for (var i=0, len=lines.length; i<len; i++) {
    var s = lines[i] + "\n";
    if (s.match(reg)) {
      t += s.replace(COM, "");  // �擪�̃R�����g�̂ݍ폜
    } else {
      t += s;
    }
  }
}

// �R�����g�A�E�g���������������āC�S�̂�I��
sel.SetActivePoint(mePosLogical, document.GetLine(ed, meGetLineLogical).length+1, ed);
sel.SetAnchorPoint(mePosLogical, 1, st);
sel.Text = t.substring(0, t.length-1);      // �Ō�̉��s�͏���
sel.SetAnchorPoint(mePosLogical, 1, st);
window.ScrollY = scrollY;


//========================================
// �֐�
//========================================
// �^�u�����擾
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