/* �s���̋󔒂��폜.js r0 2014-11-28 */

var state = new StateBackup()
var something = document.selection.IsEmpty ? document : document.selection
state.Backup()
window.Redraw = false
something.Text = something.Text.replace(/[ \u3000\t\v\f]+$/gm, "")
state.Restore()
window.Redraw = true

/* ks���� StateBackup.js ( http://www.haijin-boys.com/wiki/include%E3%83%A9%E3%82%A4%E3%83%96%E3%83%A9%E3%83%AA ) �����ς��ė��p�����Ē����Ă��܂� */
function StateBackup(doc) {
	// Private Instance Member Value
	var _doc = doc || Editor.ActiveDocument;	// �Ώۂ̃h�L�������g�i���w��̏ꍇ�̓A�N�e�B�u�h�L�������g�j

	// Private Instance Member Function

	// Public Instance Member Value
	this.saved = null;		// �ۑ��ς݃t���O�D
	this.scrollX = null;	// X �����X�N���[���ʁD
	this.scrollY = null;	// Y �����X�N���[���ʁD
	this.actPosX = null;	// �J�[�\�� X �l�D
	this.actPosY = null;	// �J�[�\�� Y �l�D
	this.ancPosX = null;	// �I��͈� X �l�D
	this.ancPosY = null;	// �I��͈� Y �l�D
	this.isBoxed = null;	// ��`�I���t���O�D	// ���󕜌��s�\

	// Public Instance Member Function
	/**
	 * �\����Ԃ�Ҕ��D
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
	 * �\����Ԃ𕜌��D
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
