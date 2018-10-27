<?php
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\data\config.ini');
	session_start();
	header("Content-type: text/html; charset=SJIS-win");
	$pagetype = "MDBpages";
	include_once($ini['dirWin'].'/pages/function.php');
	if(isset($_POST['userID'])) {
		$staff = readCsvFile2("./data/staff.csv");
		$login = false;
		for($i=1; $i<count($staff);$i++) {
			if($_POST['userID'] == $staff[$i]['社員ID'] && password_verify($_POST['password'], $staff[$i]['パスワード'])) {
				$login = true;
				/*
				$_SESSION['staff']['id'] = $_POST['社員ID'];
				$_SESSION['staff']['name'] = $staff[$i][0];
				$_SESSION['staff']['authority'] = $staff[$i][3];
				*/
				$_SESSION['staff'] = $staff[$i];
			}
		}
		if($login) { 
			header( "Location: ./index.php" ) ;
			exit();
		 }
	}
	
?>
<?php
	include($ini['dirWin'].'/prototype/hedder.php');
?>
<body class="drawer drawer--left">
<?php
	include($ini['dirWin'].'/prototype/navigation.php');
?>



<!--Main Layout-->
<div class="main-contents">
<div class="pull-left drawer-hover"></div>
<main class="row">
	<div class="container-fluid col-12" style="">
		<h1>ログイン画面</h1>
		
<?php
		print_r_pre($_SESSION['staff']);
		if(isset($login) && !$login) { 
			echo "ログイン失敗<br>"; 
			echo password_hash("rasmuslerdorf", PASSWORD_DEFAULT)."\n";
		}
?>
		<form class='form-horizontal container-fluid' method='post' action='./login.php'>
			<div class="row">
				<div class='form-group col-12'>
					<label class='' for='userID'>社員番号</label>
					<div class='input-group'>
						<input type='text' id='userID' class='form-control' name='userID'  placeholder='スタッフIDを入力してください' required>
					</div>
				</div>
				<div class='form-group col-12'>
					<label class='' for='password'>パスワード</label>
					<div class='input-group'>
						<input type='password' id='password' class='form-control' name='password' placeholder='パスワードを入力してください' required>
					</div>
				</div>
				<div class='form-group col-11'>
					<button type='reset' class='btn btn-default pull-right'>リセット</button>
				</div>
				<div class='form-group col-1'>
					<button type='submit' class='btn btn-default pull-right'>ログイン</button>
				</div>
			</div>
		</form>
	<div class="row">
			<button type="button" class="btn btn-default" onclick="document.getElementsByName('userID')[0].value = 'D999999';document.getElementsByName('password')[0].value = 'rasmuslerdorf';">基盤Aさん</button>
			<button type="button" class="btn btn-primary" onclick="document.getElementsByName('userID')[0].value = 'D999998';document.getElementsByName('password')[0].value = 'rasmuslerdorf';">基盤Bさん</button>
			<button type="button" class="btn btn-secondary" onclick="document.getElementsByName('userID')[0].value = 'D999997';document.getElementsByName('password')[0].value = 'rasmuslerdorf';">基盤Cさん</button>
			<button type="button" class="btn btn-success" onclick="document.getElementsByName('userID')[0].value = 'D999996';document.getElementsByName('password')[0].value = 'rasmuslerdorf';">GLのDさん</button>
			<button type="button" class="btn btn-info" onclick="document.getElementsByName('userID')[0].value = 'D999995';document.getElementsByName('password')[0].value = 'rasmuslerdorf';">GLのEさん</button>
			<button type="button" class="btn btn-warning" onclick="document.getElementsByName('userID')[0].value = 'D999994';document.getElementsByName('password')[0].value = 'rasmuslerdorf';">部長のFさん</button>
			<button type="button" class="btn  btn-elegant" onclick="document.getElementsByName('userID')[0].value = 'D999993';document.getElementsByName('password')[0].value = 'rasmuslerdorf';">開発Gさん</button>
			<button type="button" class="btn btn-unique" onclick="document.getElementsByName('userID')[0].value = 'D999992';document.getElementsByName('password')[0].value = 'rasmuslerdorf';">運用Hさん</button>
			<button type="button" class="btn btn-btn-pink" onclick="document.getElementsByName('userID')[0].value = 'D999991';document.getElementsByName('password')[0].value = 'rasmuslerdorf';">運用職制Iさん</button>
		</div>
	</div>
	</div>

	
	
	
</main>
	<div class="form-group" style="margin-bottom:0; position: fixed; top: 80px;right:0;width:250px;">
		<button type="submit" class="btn btn-default btn-block waves-effect waves-light" style="margin-right:30px" data-toggle="modal" data-target="#centralModalInfo">このページの説明</button>
	</div>
<!-- Central Modal Medium Info -->
<div class="modal fade" id="centralModalInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-notify modal-info" role="document">
	<!--Content-->
	<div class="modal-content">
		<!--Header-->
		<div class="modal-header">
			<p class="heading lead">ログオンページのサンプルです。</p>

			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true" class="white-text">&times;</span>
			</button>
		</div>

		<!--Body-->
		<div class="modal-body">
			<div class="text-center">
				<i class="fa fa-check fa-4x mb-3 animated rotateIn"></i>
				<p></p>
				<p>人によって権限を変えることで作業申請や導入申請などの承認の類いをスムーズに行えます。<br>
				サンプルとして、いろんな立場の人のユーザーを用意しました。<br>
				画面下部のボタンを押すことで社員番号、パスワードが入力されますので、試してみてください。<br>
				ログオフは画面左側のメニューから行えます</p>
			</div>
		</div>

		<!--Footer-->
		<div class="modal-footer justify-content-center">
		</div>
	</div>
	<!--/.Content-->
</div>
</div>
<!-- Central Modal Medium Info-->
</div>
<!--Main Layout-->
<?php
	include($ini['dirWin'].'/prototype/footer.php');
?>

<script>
	$(document).ready(function() {
		//document.getElementsByClassName('todonav')[0].classList.add('activenav');
		navOnload();
	});
</script>

</body>
</html>
