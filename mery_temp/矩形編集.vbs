' -----------------------------------------------------------------------------
' 矩形編集
'
' Copyright (c) Heet. All Rights Reserved.
' www:    http://heetnote.com/
' -----------------------------------------------------------------------------
Dim Input
Input = InputBox("挿入する文字列を入力してください。")
document.selection.Replace "^", Input , meFindNext Or meFindReplaceRegExp Or meReplaceSelOnly Or meReplaceAll