<?php
	include('hedder.php');
?>
<style type="text/css">
table {
    width: 100%;
}
table th {
    background: #87cefa;
}
table th,
table td {
    border: 1px solid #CCCCCC;
    text-align: center;
    padding: 5px;
}
.calendar {
	margin: 30px 10px;
}
</style>
<body>
<?php
	include('navigation.php');
	//$dictionary = readCsvFile('../data/dictionary.csv');
	if(!isset($_GET['page'])) $_GET['page'] = "top";
?>

<!-- jumbotron special -->
<section class="section section-inverse japanese-font">
	<div class='bkcolor'>
	<div class="container" style="padding:0 0 50px 0">
	  <?php
	  	select_page("todo", $_GET['page']);
	  ?>
	</div>
	</div>
</section>

<?php
	
	include_once('footer.php');
	select_script_page("todo", $_GET['page']);
?>
<script>
	window.onload = function(){
	    document.getElementsByClassName('todo')[0].classList.add('active');
	}
</script>
</body>
</html>
