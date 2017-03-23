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
        <h1>詳細ページ</h1>
        <p>未実装！！</p>
        <div class="download">
          <a href="./todo.php" class="btn btn-warning btn-lg last-release-download-link"><i class="fa fa-github-alt"></i> Go to ToDo List</a>
          <a href="./dictionary.php" class="btn btn-primary btn-lg"><i class="fa fa-play"></i> Watch Dictionary</a>
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
	    document.getElementsByClassName('dictionary')[0].classList.add('active');
	}
</script>
</body>
</html>
