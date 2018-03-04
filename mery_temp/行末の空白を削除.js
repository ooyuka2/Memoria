/* 行末の空白を削除.js r0 2014-11-28 */

var state = new StateBackup()
var something = document.selection.IsEmpty ? document : document.selection
state.Backup()
window.Redraw = false
something.Text = something.Text.replace(/[ \u3000\t\v\f]+$/gm, "")
state.Restore()
window.Redraw = true

/* ks氏の StateBackup.js ( http://www.haijin-boys.com/wiki/include%E3%83%A9%E3%82%A4%E3%83%96%E3%83%A9%E3%83%AA ) を改変して利用させて頂いています */
function StateBackup(doc) {
	// Private Instance Member Value
	var _doc = doc || Editor.ActiveDocument;	// 対象のドキュメント（未指定の場合はアクティブドキュメント）

	// Private Instance Member Function

	// Public Instance Member Value
	this.saved = null;		// 保存済みフラグ．
	this.scrollX = null;	// X 方向スクロール量．
	this.scrollY = null;	// Y 方向スクロール量．
	this.actPosX = null;	// カーソル X 値．
	this.actPosY = null;	// カーソル Y 値．
	this.ancPosX = null;	// 選択範囲 X 値．
	this.ancPosY = null;	// 選択範囲 Y 値．
	this.isBoxed = null;	// 矩形選択フラグ．	// 現状復元不可能

	// Public Instance Member Function
	/**
	 * 表示状態を待避．
	 */
	this.Backup = function() {
		var sel = _doc.Selection;
		this.saved = _doc.Saved;
		this.scrollX = ScrollX;
		this.scrollY = ScrollY;
		this.actPosX = sel.GetActivePointX(mePosLogical);
		this.actPosY = sel.GetActivePointY(mePosLogical);
		this.ancPosX = sel.GetAnchorPointX(mePosLogical);
		this.ancPosY = sel.GetAnchorPointY(mePosLogical);
		this._isBoxed = (sel.GetBottomPointY(mePosView) - sel.GetTopPointY(mePosView)) != (sel.Text.match(/\n/g) || []).length
	}

	/**
	 * 表示状態を復元．
	 */
	this.Restore = function() {
		var sel = _doc.Selection;
		/* _doc.Saved = this.saved; */
		sel.SetActivePoint(mePosLogical, this.actPosX, this.actPosY);
		sel.SetAnchorPoint(mePosLogical, this.ancPosX, this.ancPosY);
		ScrollX = this.scrollX;
		ScrollY = this.scrollY;
	}

	// Initialize
}
