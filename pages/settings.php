<?php
	include('hedder.php');
?>
<body>
<?php
	include('navigation.php');
	if(isset($_POST["kakutei"])) {
		$txtfile = "<?php\r\n	//honoka, niko, rin, umi\r\n	\$color = '".$_POST['kakutei']."';\r\n?>";
		file_put_contents( 'setting.php', $txtfile, LOCK_EX );
		header( "Location: ./settings.php" );
		exit();
	}
?>


<div class="jumbotron special">
  <div class="honoka"></div>
  <div class="container">
    <div class="row">
      <div class="col-xs-12 outline">
        <h1>Setting</h1>
        <p>未実装！！</p>
        <div class="download">
			<div id="sampleWrap">
			    <button class="btn btn-default" onclick="setHref('../honoka/css/bootstrap.css'); setHref2('../honoka/css/example.css'); setValue('honoka')">オレンジ</button>
			    <button class="btn btn-default" onclick="setHref('../niko/css/bootstrap.css'); setHref2('../niko/css/example.css');setValue('niko')">ピンク</button>
			    <button class="btn btn-default" onclick="setHref('../rin/css/bootstrap.css'); setHref2('../rin/css/example.css');setValue('rin')">黄色</button>
			    <button class="btn btn-default" onclick="setHref('../umi/css/bootstrap.css'); setHref2('../umi/css/example.css');setValue('umi')">青色</button>
			</div>
          <div class="basedon small">
          <span class="last-version"></span>setting.phpにて色のタイプの変更可能<span class="base-version"></span>
          </div>
          <form class='form-horizontal' method='post' action='./settings.php'>
          	<button type='submit' value='niko' class="btn btn-danger btn-lg" id="kakutei" name="kakutei">確定</button>
          	<br><br><a href="./xxx.php" class="btn">xxx.php</a>
          </form>
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
