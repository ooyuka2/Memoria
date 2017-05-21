<?php
	$file = readCsvFile2('../data/file.csv');
	$group = readCsvFile2('../data/file_group.csv');
	
	if(!isset($_GET['p']) || $_GET['p']>=count($file)) {
		header( "Location: ./file.php" );
		exit();
	}
?>
<!-- Tables
================================================== -->
<div class="bs-docs-section" style="margin:0">

<div class="row">
  <div class="col-lg-12">
    <div class="page-header">
      <h1 id="tables"><?php echo "<ruby>".$file[$_GET['p']]['name']."<rt>{$file[$_GET['p']]['furi']}</rt></ruby>"; ?></h1>
    </div>
	
    <div class="bs-component">
		<h3>要約</h3>
		<?php echo $file[$_GET['p']]['summary']; ?>
    <div class="bs-component">
		<h3>詳細</h3>
		<?php echo $file[$_GET['p']]['detail']; ?>
    </div>
  </div>
</div>