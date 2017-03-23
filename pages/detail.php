<?php
	include('hedder.php');
?>
<body>
<?php
	include('navigation.php');
	$dictionary = readCsvFile('../data/dictionary.csv');
	if(!isset($_GET['page']) || $_GET['page']>=count($dictionary)) {
		header( "Location: ./dictionary.php" );
		exit();
	}
?>

<!-- jumbotron special -->
<section class="section section-inverse japanese-font">
	<div class="container">
	    <!-- Tables
	  ================================================== -->
	  <div class="bs-docs-section" style="margin:0">

	    <div class="row">
	      <div class="col-lg-12">
	        <div class="page-header">
	          <h1 id="tables"><?php echo $dictionary[$_GET['page']][0]; ?></h1>
	        </div>
			
	        <div class="bs-component">
				<h2>要約</h2>
				<?php echo $dictionary[$_GET['page']][1]; ?>
	        <div class="bs-component">
				<h2>詳細</h2>
				<?php echo $dictionary[$_GET['page']][2]; ?>
	        </div>
	      </div>
	    </div>
	  </div>
	</div>
</section>


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
