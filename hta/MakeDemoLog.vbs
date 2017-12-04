Const numMakeFile = 20 ' ダミーファイルを作成する個数
Const secMakeFile = 2 ' ダミーファイルを作成する間隔（秒）

call makeText
Dim count
count = 0
Do While count < numMakeFile
    ' 10秒停止
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
				'■環境によっては、単純に ＞　Wshell.Run "@",0,1　でも動くのだが…
		if timer * 1000 >= dstart + millisec then Exit Do
	Loop
	Set Wshell = Nothing
end sub

function makeText()
	Dim objFSO      ' FileSystemObject
	Dim objFile     ' ファイル書き込み用

	Set objFSO = CreateObject("Scripting.FileSystemObject")
	If Err.Number = 0 Then

		Dim strNow
		strNow = FormatDateTime(Now, 0)
		strNow = Replace(strNow, "/", "")
		strNow = Replace(strNow, ":", "")
		strNow = Replace(strNow, " ", "")

		Dim color
		color = "赤,黄,青,緑,白"
		color = Split(color, ",")
		Randomize
		Dim num
		num = Int((5 - 0) * Rnd + 0)
		
		'MsgBox strNow, , strNow
	    Set objFile = objFSO.OpenTextFile("LOG/"&strNow&"_["&color(num)&"]の警告灯xxxxxxxxxxxxxxxxxxxxxx.log", 2, True)
	    If Err.Number = 0 Then
	    	For i = 0 to Int(Rnd * 10)
	        	objFile.WriteLine("これはダミーのログファイルです")
	        Next
	        objFile.Close
	    Else
	        WScript.Echo "ファイルオープンエラー: " & Err.Description
	    End If
	Else
	    WScript.Echo "エラー: " & Err.Description
	End If

	Set objFile = Nothing
	Set objFSO = Nothing
End function
