<?php
	if(!isset($_GET['p'])) {
		$ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
		header( "Location: ".$ini['dirhtml']."/pages/todo.php" );
		
		exit();
	}
	$working = readCsvFile2('../data/working.csv');
	$todo = readCsvFile2('../data/todo.csv');
	$periodically = readCsvFile2('../data/periodically.csv');
	
	//http://localhost:81/Memoria/pages/todo/todo.php?p=6&f=20&page=whendo&startTime=23%3A54&finishTime=18%3A27&date=2017%2F08%2F15+18%3A27%3A22&keeper=0
?>
<div style='width:90%; margin: 0 auto' class="">

<form class='form-horizontal container-fluid' method='post' action='todo/do.php' style='padding-top: 50px;'>
	
	<?php echo "<input type='hidden' name='p' value='{$_GET['p']}' id='pid'>"; ?>
	<input type='hidden' name='page' value='do'>
	<?php echo "<input type='hidden' name='f' value='{$_GET['f']}'>"; ?>
	<div class="row">
	<div class='form-group col-sm-4'>
			<div class='form-group col-sm-12 container'>
				<span class="input-group-btn"><button type="button" class="btn btn-info" onclick="document.getElementById('startTime').value=change_seccond(document.getElementById('startTime').value,'セット',0)" style="background-color:#efefef">セット</button></span>
				<span class="input-group-btn"><button type="button" class="btn btn-info" onclick="document.getElementById('startTime').value=change_seccond(document.getElementById('startTime').value,'-',30)" style="background-color:#efefef">-30</button></span>
				<span class="input-group-btn"><button type="button" class="btn btn-info" onclick="document.getElementById('startTime').value=change_seccond(document.getElementById('startTime').value,'-',15)" style="background-color:#efefef">-15</button></span>
				<span class="input-group-btn"><button type="button" class="btn btn-info" onclick="document.getElementById('startTime').value=change_seccond(document.getElementById('startTime').value,'+',15)" style="background-color:#efefef">+15</button></span>
				<span class="input-group-btn"><button type="button" class="btn btn-info" onclick="document.getElementById('startTime').value=change_seccond(document.getElementById('startTime').value,'+',30)" style="background-color:#efefef">+30</button></span>
			</div>
		<div class='form-group col-sm-12'>
			<label class='' for='startTime'>開始時間</label>
			<div class='input-group'>
				<span class='input-group-addon'><span class='glyphicon glyphicon-time' aria-hidden='true'></span></span>
				<?php echo "<input type='text' id='startTime' class='form-control time' name='startTime' value='{$working[(count($working)-1)]['finishTime']}'>"; ?>
				<span class="input-group-btn"><button type="button" class="btn btn-default" onclick="document.getElementById('startTime').value='09:30';document.getElementById('finishTime').value='10:00'" style="background-color:#efefef">朝</button></span>
				<span class="input-group-btn"><button type="button" class="btn btn-default" onclick="document.getElementById('startTime').value='11:45';document.getElementById('finishTime').value='12:45'" style="background-color:#efefef">昼</button></span>
				<!--<span class="input-group-btn"><button type="button" class="btn btn-default" onclick='startTimeChange()' style="background-color:#efefef">ｾｯﾄ</button></span>-->
			</div>
		</div>
	</div>
	<div class='col-sm-1'></div>
	<div class='form-group col-sm-4'>
			<div class='form-group col-sm-12 container'>
				<span class="input-group-btn"><button type="button" class="btn btn-info" onclick="document.getElementById('finishTime').value=change_seccond(document.getElementById('finishTime').value,'セット',0)" style="background-color:#efefef">セット</button></span>
				<span class="input-group-btn"><button type="button" class="btn btn-info" onclick="document.getElementById('finishTime').value=change_seccond(document.getElementById('finishTime').value,'-',30)" style="background-color:#efefef">-30</button></span>
				<span class="input-group-btn"><button type="button" class="btn btn-info" onclick="document.getElementById('finishTime').value=change_seccond(document.getElementById('finishTime').value,'-',15)" style="background-color:#efefef">-15</button></span>
				<span class="input-group-btn"><button type="button" class="btn btn-info" onclick="document.getElementById('finishTime').value=change_seccond(document.getElementById('finishTime').value,'+',15)" style="background-color:#efefef">+15</button></span>
				<span class="input-group-btn"><button type="button" class="btn btn-info" onclick="document.getElementById('finishTime').value=change_seccond(document.getElementById('finishTime').value,'+',30)" style="background-color:#efefef">+30</button></span>
			</div>
		<div class='form-group col-sm-12'>
			<label class='' for='finishTime'>終了時間</label>
			<div class='input-group'>
				<span class='input-group-addon'><span class='glyphicon glyphicon-time' aria-hidden='true'></span></span>
				<?php 
				echo "<input type='text' class='form-control time' name='finishTime' id='finishTime' value=".date('H:i', strtotime("+30 minute" ,strtotime($working[(count($working)-1)]['finishTime']))).">";
				 ?>
				
				<span class="input-group-btn"><button type="button" class="btn btn-default" onclick="document.getElementById('finishTime').value='11:45'" style="background-color:#efefef">昼</button></span>
				<span class="input-group-btn"><button type="button" class="btn btn-default" onclick="document.getElementById('finishTime').value=document.getElementById('startTime').value" style="background-color:#efefef">同</button></span>
			</div>
		</div>
	</div>


	<div class="form-group col-sm-3">
		<span class="custom-dropdown"><!-- select-circle-arrow -->
			<select name="goto" id="">
				<option value='today'>Ｋ.やることリスト</option>
				<?php
					if( $_GET['p'] != "deskwork" ) {
						echo "<option value='todo'>Ｙ.やることリスト</option>";
						echo "<option value='detail'>Ｓ.詳細</option>";
					}
				?>
				<option value='keeper'>Ｔ.時間管理</option>
			</select>
		</span>
	</div>
	</div>
<?php
	date_default_timezone_set('Asia/Tokyo');
	$today=date('Y/m/d');
?>
	<div class="row">
	<div class='form-group col-sm-4'>
		<?php echo "<input type='text' class='form-control input-normal input-sm noki' name='date' value='{$today}'>"; ?>
	</div>
	

<?php
	if( $_GET['p'] == "deskwork" ) {
		echo "<div class='form-group col-sm-8'><span class='custom-dropdown'><select id='selectPeriodically' onChange='changePID()'>";
		for($i=1; $i<count($periodically); $i++) {
			echo "<option value='{$periodically[$i]['title']}'>{$periodically[$i]['内容']}</option>";
		}
		echo "</select></span></div></div><div class='row'><div class='form-group  col-sm-9'><textarea class='form-control input-normal input-sm' name='note' id='note' onChange='checkNote()'>事務作業（メール/Teams確認etc）</textarea></div></div>";
?>
	<div class='row'>
		<div class="form-group checkbox-wrap text-center col-sm-8">
			<label class="label-checkbox">
				<input type="checkbox" name="work_mail" checked="checked" id="work_mail" onclick="toggleMail()">
				<span class="lever">メール/Teams確認</span>
			</label>
			<label class="label-checkbox">
				<input type="checkbox" name="work_doc" id="work_doc" onclick="toggleDoc()">
				<span class="lever">ドキュメント更新</span>
			</label>
			<label class="label-checkbox">
				<input type="checkbox" name="work_make" id="work_make" onclick="toggleMake()">
				<span class="lever">申請書作成</span>
			</label>
			<label class="label-checkbox">
				<input type="checkbox" name="work_time" id="work_time" onclick="toggleTime()">
				<span class="lever">時間管理</span>
			</label>
			<label class="label-checkbox">
				<input type="checkbox" name="work_weekly" id="work_weekly" onclick="toggleWeekly()">
				<span class="lever">週報</span>
			</label>
		</div>
	</div>
<?php
	} else if($todo[$_GET['p']]['所感'] != "" && $todo[$_GET['p']]['所感'] != "no comment" ) {
		echo "</div><div class='row'><div class='form-group col-sm-9'><textarea class='form-control input-normal input-sm' name='note' id='note'>" .str_replace('<br>', '&#10;',$todo[$_GET['p']]['所感']) . "</textarea></div></div>";
	} else echo "</div><div class='row'><div class='form-group  col-sm-9'><textarea class='form-control input-normal input-sm' name='note' placeholder='" .str_replace('<br>', '&#10;',$todo[$_GET['p']]['所感']) . "' id='note'></textarea></div></div>";
?>

		<!-- //場所と接触者の追加欄 -->
<?php
	$place_ayyar = explode(",",$ini['keeper place'].",,");
	$people_ayyar = explode(",",$ini['keeper people'].",,");
	$people_commonly_ayyar = explode(",",$ini['keeper people commonly'].",,");
?>
	<div class="row">
		<div class='form-group col-sm-9'>
			<label class='' for='place'>作業場所</label>
			<textarea class='form-control input-normal input-sm' name='place' id='place' onChange='checkPlace()'><?php echo $working[(count($working)-1)]['place'] ?></textarea>
		</div>
		<div class='form-group col-sm-1'></div>
		<div class='form-group col-sm-2'>
		<button type="button" class="btn btn-outline-primary btn-sm " onClick="document.getElementById('people').value='';document.getElementById('place').value='自宅';checkPlace();checkPeople();">テレワーク</button>
		</div>
	</div>
	<div class='row'>
		<div class="form-group checkbox-wrap text-center col-sm-9">
			<?php
				for($i=0; $i<count($place_ayyar)-2; $i++) {
					echo "<label class='label-checkbox'>";
					if($i==0)  echo "<input type='checkbox' checked='checked' onclick='togglePlace(\"{$place_ayyar[$i]}\", \"place_{$i}\")' id='place_{$i}'>";
					else echo "<input type='checkbox' onclick='togglePlace(\"{$place_ayyar[$i]}\", \"place_{$i}\")' id='place_{$i}'>";
					echo "<span class='lever'>{$place_ayyar[$i]}</span></label>";
				}
			?>
		</div>
	</div>
	
	
	<div class="row">
		<div class='form-group col-sm-9'>
			<label class='' for='people'>濃厚接触者（1m以内に15分以上近づいた方々）</label>
			<textarea class='form-control input-normal input-sm' name='people' id='people' onChange='checkPeople()'><?php echo $working[(count($working)-1)]['people'] ?></textarea>
		</div>
	</div>
	
	<div class='row'>
		<div class="form-group checkbox-wrap text-center col-sm-9">
			<?php
				for($i=0; $i<count($people_ayyar)-2; $i++) {
					echo "<label class='label-checkbox'>";
					echo "<input type='checkbox' onclick='togglePeople(\"{$people_ayyar[$i]}\", \"people_{$i}\")' id='people_{$i}'>";
					echo "<span class='lever'>{$people_ayyar[$i]}</span></label>";
				}
			?>
		</div>
	</div>
	<div class='row'>
		<div class="form-group checkbox-wrap text-center col-sm-9">
			<?php
				for($i=0; $i<count($people_commonly_ayyar)-2; $i++) {
					echo "<label class='label-checkbox'>";
					if($i == 0) echo "<input type='checkbox' onclick='togglePeople(\"{$people_commonly_ayyar[$i]}\", \"people_commonly_{$i}\")' id='people_commonly_{$i}' checked='checked' >";
					else echo "<input type='checkbox' onclick='togglePeople(\"{$people_commonly_ayyar[$i]}\", \"people_commonly_{$i}\")' id='people_commonly_{$i}'>";
					echo "<span class='lever'>{$people_commonly_ayyar[$i]}</span></label>";
				}
			?>
		</div>
	</div>
<script>
window.onload = function(){
	checkPlace();
	checkPeople();
}
function checkPeople() {
	var note = document.getElementById('people').value;
	if (note.startsWith("・")) { 
		document.getElementById('people').value = document.getElementById('people').value.slice(1) ;
	}
	<?php
	for($i=0; $i<count($people_ayyar)-2; $i++) {
	echo "if (note.match(/{$people_ayyar[$i]}/)) {";
	echo "document.getElementById('people_{$i}').checked = true;} else {";
	echo "document.getElementById('people_{$i}').checked = false;}";
	}
	
	for($i=0; $i<count($people_commonly_ayyar)-2; $i++) {
	echo "if (note.match(/{$people_commonly_ayyar[$i]}/)) {";
	echo "document.getElementById('people_commonly_{$i}').checked = true;} else {";
	echo "document.getElementById('people_commonly_{$i}').checked = false;}";
	}
	?>
}

function checkPlace() {
	var note = document.getElementById('place').value;
	if (note.startsWith("・")) { 
		document.getElementById('place').value = document.getElementById('place').value.slice(1) ;
	}
	<?php
	for($i=0; $i<count($place_ayyar)-2; $i++) {
	echo "if (note.match(/{$place_ayyar[$i]}/)) {";
	echo "document.getElementById('place_{$i}').checked = true;} else {";
	echo "document.getElementById('place_{$i}').checked = false;}";
	}
	?>
}


</script>
		<!-- 場所と接触者の追加欄ここまで -->


	<div class='row'>
	<div class='form-group col-sm-4'>
		<div class='keeper-btn'>
			<input type='radio' name='keeper' id='on' value='0' checked=''>
			<label for='on' class='switch-on'>はい</label><input type='radio' name='keeper' id='off' value='1'>
			<label for='off' class='switch-off'>いいえ</label>
		</div>
	</div>

	</div>


	<div class='row' style="margin-bottom:0; position: fixed; bottom: 150px;right:0;width:500px;">
	<div class='col-sm-4'></div>
	<div class='form-group col-sm-4'>
		<button type='reset' class='btn btn-default'>リセット</button>
	</div>
	<div class='form-group col-sm-4'>
		<button type='submit' class='btn btn-default'>送信</button>
	</div>
	</div>

</form>
</div>






