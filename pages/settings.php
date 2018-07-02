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
						<span class="last-version"></span>setting.php�ɂĐF�̃^�C�v�̕ύX�\<span class="base-version"></span>
					</div>
					<div id="sampleWrap">
						<form class='form-horizontal' method='post' action='./settings.php'>
							<button type='button' class="btn btn-default" onclick="setHref('../img/honoka/css/bootstrap.css'); setHref2('../img/honoka/css/example.css'); setValue('honoka')">�I�����W</button>
							<button type='button' class="btn btn-default" onclick="setHref('../img/niko/css/bootstrap.css'); setHref2('../img/niko/css/example.css');setValue('niko')">�s���N</button>
							<button type='button' class="btn btn-default" onclick="setHref('../img/rin/css/bootstrap.css'); setHref2('../img/rin/css/example.css');setValue('rin')">���F</button>
							<button type='button' class="btn btn-default" onclick="setHref('../img/umi/css/bootstrap.css'); setHref2('../img/umi/css/example.css');setValue('umi')">�F</button>
							<button type='button' class="btn btn-default" onclick="setHref('../img/frandre/css/bootstrap.css'); setHref2('../img/frandre/css/example.css');setValue('frandre')">�ԐF</button>
							<button type='submit' value='niko' class="btn btn-danger" id="kakutei" name="kakutei">�m��</button>
							<!-- <br><br><a href="./xxx.php" class="btn">xxx.php</a> -->
						</form>
					</div>
					<div class="basedon small">
						<span class="last-version"></span>todo.csv�̍X�Vver+Order<span class="base-version"></span>
					</div>
					<div id="sampleWrap">
						<a href="/Memoria/pages/settings/PlusOrder.php" class="btn btn-danger btn-block btn-sm">�X�V</a>
					</div>
					<div class="basedon small">
						<span class="last-version"></span>working.csv�̍X�Vver+periodically<span class="base-version"></span>
					</div>
					<div id="sampleWrap">
						<a href="/Memoria/pages/settings/xxx_20171022.php" class="btn btn-danger btn-block btn-sm">�X�V</a>
					</div>
					<div class="basedon small">
						<span class="last-version"></span>todo.csv�̍X�Vver+������邱��<span class="base-version"></span>
					</div>
					<div id="sampleWrap">
						<a href="/Memoria/pages/settings/PlusTodayDo.php" class="btn btn-danger btn-block btn-sm">�X�V</a>
					</div>
					<div class="basedon small">
						<span class="last-version"></span>todo.csv�̍X�Vver+�e�[�}�Ή��A�e�[�}�T�v<span class="base-version"></span>
					</div>
					<div id="sampleWrap">
						<a href="/Memoria/pages/settings/xxx_20180507.php" class="btn btn-danger btn-block btn-sm">�X�V</a>
					</div>
					
					<div class="basedon small">
						<span class="last-version"></span>todo���X�g�𕪂���<span class="base-version"></span>
					</div>
					<div id="sampleWrap">
						<a href="/Memoria/pages/settings/makeBK.php" class="btn btn-danger btn-block btn-sm">�X�V</a>
					</div>
					<div class="basedon small">
						<span class="last-version"></span>�S���ǉ�<span class="base-version"></span>
					</div>
					<div id="sampleWrap">
						<a href="/Memoria/pages/settings/Pluspeople.php" class="btn btn-danger btn-block btn-sm">�X�V</a>
					</div>
					<div class="basedon small">
						<span class="last-version"></span>�T����C��<span class="base-version"></span>
					</div>
					<div id="sampleWrap">
						<a href="/Memoria/pages/settings/makeWeeklycsv.php" class="btn btn-danger btn-block btn-sm">�X�V</a>
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
