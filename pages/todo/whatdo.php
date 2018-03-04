<?php
	if(!isset($_GET['p'])) {
		header( "Location: ".$_SERVER['HTTP_REFERER'] );
		exit();
	}
	$working = readCsvFile2('../data/working.csv');
	$todo = readCsvFile2('../data/todo.csv');
	$periodically = readCsvFile2('../data/periodically.csv');
	
	//http://localhost:81/Memoria/pages/todo/todo.php?p=6&f=20&page=whendo&startTime=23%3A54&finishTime=18%3A27&date=2017%2F08%2F15+18%3A27%3A22&keeper=0
?>
<div style='width:90%; margin: auto'  >

<form class='form-horizontal' method='post' action='todo/do.php' style='padding-top: 50px;'>
	
	<?php echo "<input type='hidden' name='p' value='{$_GET['p']}' id='pid'>"; ?>
	<input type='hidden' name='page' value='do'>
	<?php echo "<input type='hidden' name='f' value='{$_GET['f']}'>"; ?>
	<div class="row">
	<div class='form-group col-sm-4'>
		<label class='' for='startTime'>開始時間</label>
		<div class='input-group'>
			<span class='input-group-addon'><span class='glyphicon glyphicon-time' aria-hidden='true'></span></span>
			<?php echo "<input type='text' id='startTime' class='form-control time' name='startTime' value='{$working[(count($working)-1)]['finishTime']}'>"; ?>
			<span class="input-group-btn"><button type="button" class="btn btn-default" onclick="document.getElementById('startTime').value='09:00';document.getElementById('finishTime').value='09:30'" style="background-color:#efefef">朝</button></span>
			<span class="input-group-btn"><button type="button" class="btn btn-default" onclick="document.getElementById('startTime').value='13:00';document.getElementById('finishTime').value='13:30'" style="background-color:#efefef">昼</button></span>
			<!--<span class="input-group-btn"><button type="button" class="btn btn-default" onclick='startTimeChange()' style="background-color:#efefef">ｾｯﾄ</button></span>-->

		</div>
	</div>
	<div class='col-sm-1'></div>
	<div class='form-group col-sm-4'>
		<label class='' for='finishTime'>終了時間</label>
		<div class='input-group'>
			<span class='input-group-addon'><span class='glyphicon glyphicon-time' aria-hidden='true'></span></span>
			<?php 
			echo "<input type='text' class='form-control time' name='finishTime' id='finishTime' value=".date('H:i', strtotime("+30 minute" ,strtotime($working[(count($working)-1)]['finishTime']))).">";
			 ?>
			
			<span class="input-group-btn"><button type="button" class="btn btn-default" onclick="document.getElementById('finishTime').value='12:00'" style="background-color:#efefef">昼</button></span>
			<span class="input-group-btn"><button type="button" class="btn btn-default" onclick="document.getElementById('finishTime').value=document.getElementById('startTime').value" style="background-color:#efefef">同</button></span>

		</div>
	</div>
	<div class="form-group col-sm-3">
		<div class="select-wrap select-circle"><!-- select-circle-arrow -->
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
		</div>
	</div>
	</div>
<?php
	date_default_timezone_set('Asia/Tokyo');
	$today=date('Y/m/d H:i:s');
?>
	<div class="row">
	<div class='form-group col-sm-4'>
		<?php echo "<input type='text' class='form-control input-normal input-sm noki' name='date' value='{$today}'>"; ?>
	</div>
	

<?php
	if( $_GET['p'] == "deskwork" ) {
		echo "<div class='form-group col-sm-8'><div class='select-wrap select-circle'><select id='selectPeriodically' onChange='changePID()'>";
		for($i=1; $i<count($periodically); $i++) {
			echo "<option value='{$periodically[$i]['title']}'>{$periodically[$i]['内容']}</option>";
		}
		echo "</select></div></div></div><div class='row'><div class='form-group  col-sm-9'><textarea class='form-control input-normal input-sm' name='note' id='note' onChange='checkNote()'>事務作業（メール対応etc）</textarea></div></div>";
?>
	<div class='row'>
	<div class="form-group checkbox-wrap text-center col-sm-8">
		<label class="label-checkbox">
			<input type="checkbox" name="work_mail" checked="checked" id="work_mail" onclick="toggleMail()">
			<span class="lever">メール対応</span>
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
		echo "</div><div class='row'><div class='form-group  col-sm-9'><textarea class='form-control input-normal input-sm' name='note' id='note'>{$todo[$_GET['p']]['所感']}</textarea></div></div>";
	} else echo "<div class='row'><div class='form-group  col-sm-9'><textarea class='form-control input-normal input-sm' name='note' placeholder='{$todo[$_GET['p']]['所感']}' id='note'></textarea></div></div>";
?>
	<div class='row'>
	<div class='form-group col-sm-4'>
		<div class='keeper-btn'>
			<input type='radio' name='keeper' id='on' value='0' checked=''>
			<label for='on' class='switch-on'>はい</label><input type='radio' name='keeper' id='off' value='1'>
			<label for='off' class='switch-off'>いいえ</label>
		</div>
	</div>

	</div>

	
	<div class='row'>
	<div class='col-sm-6'></div>
	<div class='form-group col-sm-2'>
		<button type='reset' class='btn btn-default'>リセット</button>
	</div>
	<div class='form-group col-sm-4'>
		<button type='submit' class='btn btn-default'>送信</button>
	</div>
	</div>

</form>
</div>