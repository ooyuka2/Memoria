<?php
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	$pagetype = "MDBpages";
	include_once($ini['dirWin'].'/pages/function.php');
	$mail = readCsvFile2($ini['dirWin'].'/data/mail.csv');
	//name,furi,summary,detail,count,syurui,date,delete
	$group = readCsvFile2($ini['dirWin'].'/data/mail_group.csv');
	date_default_timezone_set('Asia/Tokyo');
	
	if(isset($_GET['toroku'])) {
		session_start();
		if($_GET['toroku'] == count($mail)) $flug = "new";
		else $flug = "renew";
		

		if($_POST['name']!="") {
			$mail[$_GET['toroku']]['name'] = $_POST['name'];
			$mail[$_GET['toroku']]['furi'] = $_POST['furi'];
			$mail[$_GET['toroku']]['summary'] = rtrim(str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['summary']), '\\');
			$mail[$_GET['toroku']]['detail'] = rtrim(str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['detail']), '\\');
			//if($flug == "new") $mail[$_GET['toroku']]['count'] = 0;
			$mail[$_GET['toroku']]['syurui'] = $_POST['syurui'];
			if($flug == "new") $mail[$_GET['toroku']]['date'] = date('Y/m/d H:i:s');
			$mail[$_GET['toroku']]['delete'] = 0;
		}
		if($flug == "new") $_SESSION['change'] = "『{$_POST['name']}』を追加しました。";
		else $_SESSION['change'] = "『{$_POST['name']}』を変更しました。";
		writeCsvFile($ini['dirWin'].'/data/mail.csv', $mail);
		header( "Location: " . $link_mail_html );
		exit();
	} else if(isset($_GET['type']) && $_GET['type'] == "delete" && isset($_GET['p'])) {
		session_start();
		$name = $mail[$_GET['p']]['name'];
		$mail[$_GET['p']]['delete']=1;
		//unset($mail[$_GET['p']]);
		//array_values($mail);
		writeCsvFile($ini['dirWin'].'/data/mail.csv', $mail);
		$_SESSION['delete'] = "『{$name}』を削除しました。";
		header( "Location: " . $link_mail_html );
		exit();
	}
	
	if(isset($_GET['type']) && $_GET['type'] == "new") {
		$id=count($mail);
		$name = "";
		$furi = "";
		$summary = "";
		$detail = "";
		$syurui = 2;
	} else if(isset($_GET['type']) && $_GET['type'] == "change" && isset($_GET['p'])) {
		$id=$_GET['p'];
		$name = $mail[$_GET['p']]['name'];
		$furi = $mail[$_GET['p']]['furi'];
		$summary = $mail[$_GET['p']]['summary'];
		$detail = $mail[$_GET['p']]['detail'];
		$syurui = $mail[$_GET['p']]['syurui'];
	}
	
	
?>
<div style='width:90%; margin: 0 auto' class="">
<?php
	echo "<form class='form-horizontal container-fluid' method='post' action='./mail/table_make.php?toroku=" . $id . "' style='padding-top: 50px;'>";
?>
	<div class="row">
		<div class='form-group col-12'>
			<label class='' for='name'>メールタイトル</label>
			<div class='input-group'>
				<?php echo "<input type='text' id='name' class='form-control' name='name' value='{$name}' onBlur='check_furi()'>"; ?>
			</div>
		</div>
		<div class='form-group col-12'>
			<label class='' for='furi'>ふりがな</label>
			<div class='input-group'>
				<?php echo "<input type='text' id='furi' class='form-control' name='furi' value='{$furi}'>"; ?>
			</div>
		</div>
		<div class="form-group col-5">
			<span class="custom-dropdown">
				<select name="syurui" id="">
					<?php
						for($i=1;$i<count($group);$i++) {
							if($syurui==$i)
								echo "<option value='{$i}'selected>{$group[$i]['group']}</option>";
							else echo "<option value='{$i}'>{$group[$i]['group']}</option>";
						}
					?>
				</select>
			</span>
		</div>
		<div class='form-group col-12'>
			<label class='' for='summary'>メール宛先</label>
			<div class='input-group'>
				<?php echo "<textarea class='form-control input-normal input-sm' name='summary' id='summary'>{$summary}</textarea>"; ?>
			</div>
		</div>
		<div class='form-group col-12'>
			<label class='' for='detail'>メール中身</label>
			<div class='input-group'>
				<?php echo "<textarea class='form-control input-normal input-sm' name='detail' id='detail'>{$detail}</textarea>"; ?>
			</div>
		</div>
	
	</div>
	<div class='row'>
		<div class='form-group col-11'>
			<button type='reset' class='btn btn-default pull-right'>リセット</button>
		</div>
		<div class='form-group col-1'>
			<button type='submit' class='btn btn-default pull-right'>送信</button>
		</div>
	</div>

</form>
</div>