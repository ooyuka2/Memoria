Const numMakeFile = 20 ' �_�~�[�t�@�C�����쐬�����
Const secMakeFile = 2 ' �_�~�[�t�@�C�����쐬����Ԋu�i�b�j

call makeText
Dim count
count = 0
Do While count < numMakeFile
    ' 10�b��~
    Sleep(1000 * secMakeFile)
    count = count + 1
    call makeText
Loop



sub Sleep(millisec)
	Dim Wshell
	Dim dstart
	Set Wshell = CreateObject("WScript.Shell")
	dstart = timer * 1000
	Do while True
		Wshell.Run "%comspec% /c @",0,1
				'�����ɂ���ẮA�P���� ���@Wshell.Run "@",0,1�@�ł������̂����c
		if timer * 1000 >= dstart + millisec then Exit Do
	Loop
	Set Wshell = Nothing
end sub

function makeText()
	Dim objFSO      ' FileSystemObject
	Dim objFile     ' �t�@�C���������ݗp

	Set objFSO = CreateObject("Scripting.FileSystemObject")
	If Err.Number = 0 Then

		Dim strNow
		strNow = FormatDateTime(Now, 0)
		strNow = Replace(strNow, "/", "")
		strNow = Replace(strNow, ":", "")
		strNow = Replace(strNow, " ", "")

		Dim color
		color = "��,��,��,��,��"
		color = Split(color, ",")
		Randomize
		Dim num
		num = Int((5 - 0) * Rnd + 0)
		
		'MsgBox strNow, , strNow
	    Set objFile = objFSO.OpenTextFile("LOG/"&strNow&"_["&color(num)&"]�̌x����xxxxxxxxxxxxxxxxxxxxxx.log", 2, True)
	    If Err.Number = 0 Then
	    	For i = 0 to Int(Rnd * 10)
	        	objFile.WriteLine("����̓_�~�[�̃��O�t�@�C���ł�")
	        Next
	        objFile.Close
	    Else
	        WScript.Echo "�t�@�C���I�[�v���G���[: " & Err.Description
	    End If
	Else
	    WScript.Echo "�G���[: " & Err.Description
	End If

	Set objFile = Nothing
	Set objFSO = Nothing
End function
