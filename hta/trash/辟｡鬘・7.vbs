Dim Bbox() '<================C³

Bbox = test2

Function test2()

	Dim i
	Dim Abox(10, 2)

	For i = 1 To 10
	Abox(i, 1) = Cells(i, 1)
	Abox(i, 2) = Cells(i, 2)
	Next
	test2 = Abox

End Function