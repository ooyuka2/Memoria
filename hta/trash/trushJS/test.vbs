Option Explicit
On Error Resume Next


Sub Window_OnLoad
	Window.ResizeTo 1000,640
	'finish("mshta.exe") '�N�����Ă���hta������΁A�����I��
	'makeList() 'LOG�t�H���_�̒���*.log�t�@�C����ǂݍ����list.csv���쐬
	Msgbox "OK"
End Sub



'LOG�t�H���_�̒���*.log�t�@�C����ǂݍ����list.csv���쐬
Function makeList()
	Dim objFileSys, objFolder, objFile, listFile, nowFolder, Wshell
	Dim Filetime, listFileName, Flug, i, ids
	Set Wshell = CreateObject("WScript.Shell")
	 
	'�t�@�C���V�X�e���������I�u�W�F�N�g���쐬
	Set objFileSys = CreateObject("Scripting.FileSystemObject")
	nowFolder = Wshell.CurrentDirectory
	'LOG �t�H���_�̃I�u�W�F�N�g���擾
	Set objFolder = objFileSys.GetFolder(nowFolder & "\LOG")
	'list �t�@�C���̃I�u�W�F�N�g�擾
	
	
	'list �t�@�C����ǂݍ���Ŕz��ɂ���
	Dim list
	listFileName = nowFolder & "\LOG\list.csv"
	list = readList(listFileName)
	ids = list(0, Ubound(list, 2)) + 1
	
	Set listFile = objFileSys.OpenTextFile(listFileName, 2, True)
    If Err.Number = 0 Then
		'Folder�I�u�W�F�N�g��Files�v���p�e�B����File�I�u�W�F�N�g���擾
		For Each objFile In objFolder.Files
			if InStr(objFile.Name, ".log") <> 0 then
				Flug = True
				For i = 0 to Ubound(list, 2)
					if list(1, i) = objFile.Name then
						'�擾�����t�@�C���̃t�@�C��������������
						listFile.WriteLine(list(0,i) & "," & list(1,i) & "," & list(2,i) & "," & list(3,i))
						Flug = False
					End if
				Next
				if Flug then
					'�擾�����t�@�C���̍X�V�������m�F
					Filetime = Right("0" & Hour(objFile.DateCreated), 2) & _
								 ":" & Right("0" & Minute(objFile.DateCreated), 2) & _
								 ":" & Right("0" & Second(objFile.DateCreated), 2)
					'�擾�����t�@�C���̃t�@�C��������������
					listFile.WriteLine(ids & "," & objFile.Name & "," & Filetime & ",0")
					ids = ids + 1
				End if
			End if
		Next
        listFile.Close
    Else
        Msgbox "�t�@�C���I�[�v���G���[: " & Err.Description
    End If
	Set objFolder = Nothing
	Set objFileSys = Nothing 
End Function

'csv�t�@�C����ǂݍ���ŁA�z��Ɋi�[
Function readList(listFilePass)
	Dim i, j, objFSO, objTextFile, strNextLine, arrServiceList
	Dim list()
	ReDim list(3,0)
	
	Set objFSO = CreateObject("Scripting.FileSystemObject")
	Set objTextFile = objFSO.OpenTextFile(listFilePass, 1)
	
	i=0
	Do Until objTextFile.AtEndOfStream
	    strNextLine = objTextFile.Readline
	    arrServiceList = Split(strNextLine , ",")
	    ReDim Preserve list(Ubound(arrServiceList),i)
	    For j = 0 to Ubound(arrServiceList)
	         list(j, i) = arrServiceList(j)
	    Next
	    i = i + 1
	Loop
	readList = list
End Function

'�N�����Ă���hta������΁A�����I��
Function finish(strProcName)
	'strProcName  �I������v���Z�X��
	Dim objProcList ' �v���Z�X�ꗗ
	Dim objProcess  ' �v���Z�X���
	Dim lngKillNum  ' �I�������v���Z�X��
	lngKillNum = 0

	Set objProcList = GetObject("winmgmts:").InstancesOf("win32_process")
	For Each objProcess In objProcList
	    If LCase(objProcess.Name) = strProcName Then
	        objProcess.Terminate
	        If Err.Number = 0 Then
	            lngKillNum = lngKillNum + 1
	        Else
	            Msgbox "�G���[: " & Err.Description
	        End If
	    End If
	Next
	Set objProcList = Nothing
End Function

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