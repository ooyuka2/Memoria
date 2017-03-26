<meta http-equiv="refresh" content="5;URL=./index.php">
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
        <h1>Memoria Error</h1>
		<h3>エラーが発生しました</h3>
		５秒後にジャンプします。<br>
		ジャンプしない場合は、下記のリンクをクリックしてください。<br>
		<br>
		<a href="./index.php">Memoria</a>
        <div class="download">
          <a href="./todo.php" class="btn btn-warning btn-lg last-release-download-link"><i class="fa fa-github-alt"></i> Go to ToDo List</a>
          <a href="./dictionary.php" class="btn btn-primary btn-lg"><i class="fa fa-play"></i> Watch Dictionary</a>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
	window.onload = function(){
	    document.getElementsByClassName('top')[0].classList.add('active');
	}
</script>
</body>
</html>