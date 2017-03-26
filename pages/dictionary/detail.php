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
      <h1 id="tables"><?php echo $dictionary[$_GET['p']][0]; ?></h1>
    </div>
	
    <div class="bs-component">
		<h2>要約</h2>
		<?php echo $dictionary[$_GET['p']][1]; ?>
    <div class="bs-component">
		<h2>詳細</h2>
		<?php echo $dictionary[$_GET['p']][2]; ?>
    </div>
  </div>
</div>