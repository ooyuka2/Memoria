<?php
	include('hedder.php');
?>
<body>
<?php
	include('navigation.php');
?>


<div class="jumbotron special">
  <div class="honoka"></div>
  <div class="container">
    <div class="row">
      <div class="col-xs-12 outline">
        <h1>Setting</h1>
        <p>未実装！！</p>
        <div class="download">
          <a href="./todo.php" class="btn btn-warning btn-lg last-release-download-link"><i class="fa fa-github-alt"></i> Go to ToDo List</a>
          <a href="./dictionary.php" class="btn btn-primary btn-lg"><i class="fa fa-play"></i> Watch Dictionary</a>
          <div class="basedon small">
          <span class="last-version"></span>setting.phpにて色のタイプの変更可能<span class="base-version"></span>
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
</body>
</html>
