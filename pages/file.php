<?php
	include('hedder.php');
?>
<body>
<?php
	include('navigation.php');
	//$dictionary = readCsvFile('../data/file_0.csv');
	if(!isset($_GET['page'])) $_GET['page'] = "top";
?>

<!-- jumbotron special -->
<section class="section section-inverse japanese-font">
	<div class='bkcolor'>
	<div class="container" style="padding:0 0 50px 0">
	  <?php
	  		$file = readCsvFile2('../data/file.csv');
			//name,furi,summary,detail,count,syurui,date,delete
			$group = readCsvFile2('../data/file_group.csv');
			//group,abc,detail
	  	select_page("file", $_GET['page']);
	  ?>
	</div>
</section>

<?php
	
	include_once('footer.php');
	select_script_page("file", $_GET['page']);
?>
<script>
	window.onload = function(){
	    document.getElementsByClassName('file')[0].classList.add('active');
	}
	//document.body.style.fontSize = '60%';
</script>
</body>
</html>
