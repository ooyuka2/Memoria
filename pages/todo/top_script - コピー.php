<script language="javascript" type="text/javascript">
	var new_id = 1;
	function plus() {
		//var array = ['', '','','','','','','',''];
		var array = new Array();
		for(var i=0; i<document.getElementsByClassName("name").length; i++) {
			array[i] = new Array();
			array[i][0] = document.getElementsByClassName("name")[i].value;
			array[i][1] = document.getElementsByClassName("detail")[i].value;
			array[i][2] = document.getElementsByClassName("mono")[i].value;
			array[i][3] = document.getElementsByClassName("level")[i].value;
			array[i][4] = document.getElementsByClassName("priority")[i].value;
			array[i][5] = document.getElementsByClassName("noki")[i].value;
			array[i][6] = document.getElementsByClassName("time")[i].value;
			array[i][7] = document.getElementsByClassName("kaisi")[i].value;
			array[i][8] = document.getElementsByClassName("syuryo")[i].value;
		}
		/*document.getElementsByClassName("new")[0].innerHTML = "";
		for(var i=0; i<document.getElementsByClassName("name").length; i++) {
			
		}*/
		document.getElementsByClassName("new")[0].innerHTML += "<fieldset><div class='well bs-component'><div class='form-group'><div class='col-xs-8'><div class='col-xs-12' style='margin-bottom:5px'><input type='text' class='form-control input-normal input-sm name' name='name[]' placeholder='タイトル'></div><div class='col-xs-12' style='margin-bottom:5px'><textarea class='form-control input-normal input-sm detail' rows='3' name='detail[]'></textarea></div><div class='col-xs-12' style='margin-bottom:5px'><input type='text' class='form-control input-normal input-sm mono' name='mono[]' placeholder='成果物'></div><label class='col-sm-2 control-label' style='margin-bottom:5px'>レベル</label><div class='col-xs-4' style='margin-bottom:5px'><input type='number' class='form-control input-normal input-sm level' name='level[]' value='2' min='2' max='10'></div><label class='col-sm-2 control-label' style='margin-bottom:5px'>優先度</label><div class='col-xs-4' style='margin-bottom:5px'><input type='number' class='form-control input-normal input-sm priority' name='priority[]' min='1' max='10'></div></div><div class='col-xs-4'><div class='col-xs-12' style='margin-bottom:5px'><label class='control-label'>納期</label><input type='date' class='form-control input-normal input-sm noki' name='noki[]'></div><div class='col-xs-12' style='margin-bottom:5px'><label class='control-label'>納期の時間</label><input type='time' class='form-control input-normal input-sm time' name='time[]' step='900'></div><div class='col-xs-12' style='margin-bottom:5px'><label class='control-label'>開始予定時刻</label><input type='date' class='form-control input-normal input-sm kaisi' name='kaisi[]'></div><div class='col-xs-12' style='margin-bottom:5px'><label class='control-label'>終了予定日時</label><input type='date' class='form-control input-normal input-sm syuryo' name='syuryo[]'></div></div></div></div><div class='form-group' style='margin-bottom:0; position: fixed; bottom: 50px;right:0;width:500px;'><div class='col-xs-offset-3 col-xs-3'><button type='reset' class='btn btn-default btn-block'>Reset</button></div><div class='col-xs-3'><button type='submit' class='btn btn-primary btn-block'>Submit</button></div></div></form></fieldset>";
		for(var i=0; i<(document.getElementsByClassName("name").length-1); i++) {
			document.getElementsByClassName("name")[i].value = array[i][0];
			document.getElementsByClassName("detail")[i].value = array[i][1];
			document.getElementsByClassName("mono")[i].value = array[i][2];
			document.getElementsByClassName("level")[i].value = array[i][3];
			document.getElementsByClassName("priority")[i].value = array[i][4];
			document.getElementsByClassName("noki")[i].value = array[i][5];
			document.getElementsByClassName("time")[i].value = array[i][6];
			document.getElementsByClassName("kaisi")[i].value = array[i][7];
			document.getElementsByClassName("syuryo")[i].value = array[i][8];
		}
		document.getElementsByClassName("priority")[new_id].value = document.getElementsByClassName("priority")[(new_id-1)].value;
		document.getElementsByClassName("noki")[new_id].value = document.getElementsByClassName("noki")[(new_id-1)].value;
		document.getElementsByClassName("time")[new_id].value = document.getElementsByClassName("time")[(new_id-1)].value;
		document.getElementsByClassName("kaisi")[new_id].value = document.getElementsByClassName("kaisi")[(new_id-1)].value;
		document.getElementsByClassName("syuryo")[new_id].value = document.getElementsByClassName("syuryo")[(new_id-1)].value;
		new_id++;
	}
</script>