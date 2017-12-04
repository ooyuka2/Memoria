'Option Explicit
'On Error Resume Next

Dim objFileSys, Wshell, Messages, nowFolder, Word
Set objFileSys = CreateObject("Scripting.FileSystemObject")
Set Word = CreateObject("Word.Application")

Set Wshell = CreateObject("WScript.Shell")
nowFolder = Wshell.CurrentDirectory


Call Query_Directory(nowFolder)

Word.Quit
msgbox "Word����e�L�X�g�ϊ��I�����܂����IEnter�������Ă�"


Sub Query_Directory(PATH)
    
   Set objFOLDERS = objFileSys.GetFolder(PATH)
 
   '��Ƀt�@�C����\������
   For Each FILE In objFOLDERS.Files
       'Wscript.Echo FILE
       ChengeWordTxt(FILE)
   Next
    
   '�t�H���_������΃t�H���_�̒�������ɓW�J
   For Each Folder In objFOLDERS.SubFolders
		Call Query_Directory(Folder)
   Next
   Set objFSO = Nothing
   Set objFOLDERS = Nothing
End Sub

Sub ChengeWordTxt(FILE)
	t = LCase(objFileSys.GetExtensionName(FILE))
	If (t = "doc") Or (t = "docx")  Or (t = "docm") Or (t = "rtf") Then
		Set d = Word.Documents.Open(CStr(FILE))
		d.SaveAs _
		d.Path & "\txt" & Replace(objFileSys.GetFileName(FILE), "." & t,".txt"), 2
		d.Close
	End If
End Sub