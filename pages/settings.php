<?php
	include('hedder.php');
?>
<body>
<?php
	include('navigation.php');
	if(isset($_POST["kakutei"])) {
		$ini['csstype'] = $_POST['kakutei'];
		write_ini_file('../data/config.ini', $ini);
		header( "Location: ./settings.php" );
		exit();
	}
?>


<div class="jumbotron special">
	<!--  <div class="honoka"></div> -->
	<div class="container">
		<div class="row clearfix">
			<div class="col-xs-4 txtright col-xs-offset-8"><!--  outline -->
				<h1>Setting</h1>
				<div class="download">
					<div class="basedon small">
						<span class="last-version"></span>setting.phpにて色のタイプの変更可能<span class="base-version"></span>
					</div>
					<div id="sampleWrap">
						<form class='form-horizontal' method='post' action='./settings.php'>
							<button type='button' class="btn btn-default" onclick="setHref('../img/honoka/css/bootstrap.css'); setHref2('../img/honoka/css/example.css'); setValue('honoka')">オレンジ</button>
							<button type='button' class="btn btn-default" onclick="setHref('../img/niko/css/bootstrap.css'); setHref2('../img/niko/css/example.css');setValue('niko')">ピンク</button>
							<button type='button' class="btn btn-default" onclick="setHref('../img/rin/css/bootstrap.css'); setHref2('../img/rin/css/example.css');setValue('rin')">黄色</button>
							<button type='button' class="btn btn-default" onclick="setHref('../img/umi/css/bootstrap.css'); setHref2('../img/umi/css/example.css');setValue('umi')">青色</button>
							<button type='button' class="btn btn-default" onclick="setHref('../img/frandre/css/bootstrap.css'); setHref2('../img/frandre/css/example.css');setValue('frandre')">赤色</button>
							<button type='submit' value='niko' class="btn btn-danger" id="kakutei" name="kakutei">確定</button>
							<!-- <br><br><a href="./xxx.php" class="btn">xxx.php</a> -->
						</form>
					</div>
					<div class="basedon small">
						<span class="last-version"></span>todo.csvの更新ver+Order<span class="base-version"></span>
					</div>
					<div id="sampleWrap">
						<a href="/Memoria/pages/settings/PlusOrder.php" class="btn btn-danger btn-block btn-sm">更新</a>
					</div>
					<div class="basedon small">
						<span class="last-version"></span>working.csvの更新ver+periodically<span class="base-version"></span>
					</div>
					<div id="sampleWrap">
						<a href="/Memoria/pages/settings/xxx_20171022.php" class="btn btn-danger btn-block btn-sm">更新</a>
					</div>
					<div class="basedon small">
						<span class="last-version"></span>todo.csvの更新ver+今日やること<span class="base-version"></span>
					</div>
					<div id="sampleWrap">
						<a href="/Memoria/pages/settings/PlusTodayDo.php" class="btn btn-danger btn-block btn-sm">更新</a>
					</div>
					<div class="basedon small">
						<span class="last-version"></span>todo.csvの更新ver+テーマ対応、テーマ概要<span class="base-version"></span>
					</div>
					<div id="sampleWrap">
						<a href="/Memoria/pages/settings/xxx_20180507.php" class="btn btn-danger btn-block btn-sm">更新</a>
					</div>
					
					<div class="basedon small">
						<span class="last-version"></span>todoリストを分ける<span class="base-version"></span>
					</div>
					<div id="sampleWrap">
						<a href="/Memoria/pages/settings/makeBK.php" class="btn btn-danger btn-block btn-sm">更新</a>
					</div>
					<div class="basedon small">
						<span class="last-version"></span>担当追加<span class="base-version"></span>
					</div>
					<div id="sampleWrap">
						<a href="/Memoria/pages/settings/Pluspeople.php" class="btn btn-danger btn-block btn-sm">更新</a>
					</div>
					<div class="basedon small">
						<span class="last-version"></span>週報情報修正<span class="base-version"></span>
					</div>
					<div id="sampleWrap">
						<a href="/Memoria/pages/settings/makeWeeklycsv.php" class="btn btn-danger btn-block btn-sm">更新</a>
					</div>
					
					
					
					
				</div>
			</div>
		</div>
	</div>
</div>

<?php
	include('footer.php');
?>
<script>
	window.onload = function(){
	    document.getElementsByClassName('setting')[0].classList.add('active');
	}
</script>
<script type="text/javascript">
function setHref( $href ) {
    jQuery( '#sampleLink' ).attr( 'href', $href );
}
function setHref2( $href ) {
    jQuery( '#sampleLink2' ).attr( 'href', $href );
}setValue('honoka')
function setValue( iro ) {
    document.getElementById("kakutei").value=iro;
}
</script>
</body>
</html>
