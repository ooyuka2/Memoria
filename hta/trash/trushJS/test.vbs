Option Explicit
On Error Resume Next


Sub Window_OnLoad
	Window.ResizeTo 1000,640
	'finish("mshta.exe") '起動しているhtaがあれば、強制終了
	'makeList() 'LOGフォルダの中の*.logファイルを読み込んでlist.csvを作成
	Msgbox "OK"
End Sub



'LOGフォルダの中の*.logファイルを読み込んでlist.csvを作成
Function makeList()
	Dim objFileSys, objFolder, objFile, listFile, nowFolder, Wshell
	Dim Filetime, listFileName, Flug, i, ids
	Set Wshell = CreateObject("WScript.Shell")
	 
	'ファイルシステムを扱うオブジェクトを作成
	Set objFileSys = CreateObject("Scripting.FileSystemObject")
	nowFolder = Wshell.CurrentDirectory
	'LOG フォルダのオブジェクトを取得
	Set objFolder = objFileSys.GetFolder(nowFolder & "\LOG")
	'list ファイルのオブジェクト取得
	
	
	'list ファイルを読み込んで配列にする
	Dim list
	listFileName = nowFolder & "\LOG\list.csv"
	list = readList(listFileName)
	ids = list(0, Ubound(list, 2)) + 1
	
	Set listFile = objFileSys.OpenTextFile(listFileName, 2, True)
    If Err.Number = 0 Then
		'FolderオブジェクトのFilesプロパティからFileオブジェクトを取得
		For Each objFile In objFolder.Files
			if InStr(objFile.Name, ".log") <> 0 then
				Flug = True
				For i = 0 to Ubound(list, 2)
					if list(1, i) = objFile.Name then
						'取得したファイルのファイル名を書き込み
						listFile.WriteLine(list(0,i) & "," & list(1,i) & "," & list(2,i) & "," & list(3,i))
						Flug = False
					End if
				Next
				if Flug then
					'取得したファイルの更新日時を確認
					Filetime = Right("0" & Hour(objFile.DateCreated), 2) & _
								 ":" & Right("0" & Minute(objFile.DateCreated), 2) & _
								 ":" & Right("0" & Second(objFile.DateCreated), 2)
					'取得したファイルのファイル名を書き込み
					listFile.WriteLine(ids & "," & objFile.Name & "," & Filetime & ",0")
					ids = ids + 1
				End if
			End if
		Next
        listFile.Close
    Else
        Msgbox "ファイルオープンエラー: " & Err.Description
    End If
	Set objFolder = Nothing
	Set objFileSys = Nothing 
End Function

'csvファイルを読み込んで、配列に格納
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

'起動しているhtaがあれば、強制終了
Function finish(strProcName)
	'strProcName  終了するプロセス名
	Dim objProcList ' プロセス一覧
	Dim objProcess  ' プロセス情報
	Dim lngKillNum  ' 終了したプロセス数
	lngKillNum = 0

	Set objProcList = GetObject("winmgmts:").InstancesOf("win32_process")
	For Each objProcess In objProcList
	    If LCase(objProcess.Name) = strProcName Then
	        objProcess.Terminate
	        If Err.Number = 0 Then
	            lngKillNum = lngKillNum + 1
	        Else
	            Msgbox "エラー: " & Err.Description
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
				'■環境によっては、単純に ＞　Wshell.Run "@",0,1　でも動くのだが…
		if timer * 1000 >= dstart + millisec then Exit Do
	Loop
	Set Wshell = Nothing
end sub