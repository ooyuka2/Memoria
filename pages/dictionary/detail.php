<?php
	$dictionary = readCsvFile('../data/dictionary.csv');
	if(!isset($_GET['p']) || $_GET['p']>=count($dictionary)) {
		header( "Location: ./dictionary.php" );
		exit();
	}
?>
<!-- Tables
================================================== -->
<div class="bs-docs-section" style="margin:0">

<div class="row">
  <div class="col-lg-12">
    <div class="page-header">
      <h1 id="tables"><?php echo "<ruby>".$dictionary[$_GET['p']][0]."<rt>{$dictionary[$_GET['p']][1]}</rt></ruby>"; ?></h1>
    </div>
	
    <div class="bs-component">
		<h3>—v–ñ</h3>
		<?php echo $dictionary[$_GET['p']][2]; ?>
    <div class="bs-component">
		<h3>Ú×</h3>
		<?php echo $dictionary[$_GET['p']][3]; ?>
    </div>
  </div>
</div>