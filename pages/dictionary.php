<?php
	include('hedder.php');
?>
<body style='font-size:100%;'>
<?php
	include('navigation.php');
	//$dictionary = readCsvFile('../data/dictionary.csv');
	if(!isset($_GET['page'])) $_GET['page'] = "top";
?>

<!-- jumbotron special -->
<section class="section section-inverse japanese-font">
	<div class="container" style="padding:0 0 50px 0">
	  <?php
	  	select_page("dictionary", $_GET['page']);
	  ?>
	</div>
</section>

<?php
	
	include_once('footer.php');
	select_script_page("dictionary", $_GET['page']);
?>
<script>
	window.onload = function(){
	    document.getElementsByClassName('dictionary')[0].classList.add('active');
	}
	//document.body.style.fontSize = '60%';
</script>
</body>
</html>
