
<?php
	if(isset($_GET['finisflist_search'])) {
		$searchtext=$_GET['finisflist_search'];
	} else {
		$searchtext="";
	}
	echo "<div class='clearfix'><div style='width: 30%; float: right;'><input type='text' onChange='finisflist_search(this)' value='{$searchtext}' class='form-control input-normal input-sm' id='finisflist_search'></div></div><div style='height: 5px'></div>";
	
	$working = readCsvFile2('../data/working.csv');
	$c = 0;
	$ary = array();
	for($i=count($working)-1; $i>0; $i--) {
		if($working[$i]['id'] != "deskwork" && $todo[$todo[$working[$i]['id']]['top']]['����'] == 1 && serch_word($todo[$working[$i]['id']]['top'], $ary)==0) {
			$ary[$c] = $todo[$working[$i]['id']]['top'];
			$c++;
			$top = $todo[$working[$i]['id']]['top'];
			if(!isset($_GET['finisflist_search']) || strpos($todo[$top]['�^�C�g��'],$_GET['finisflist_search']) !== false || strpos($todo[$top]['��Ɠ��e'],$_GET['finisflist_search']) !== false || strpos($todo[$working[$i]['id']]['�^�C�g��'],$_GET['finisflist_search']) !== false || strpos($todo[$working[$i]['id']]['��Ɠ��e'],$_GET['finisflist_search']) !== false) {
				echo "<div class='panel panel-primary'>";
				echo "<div class='panel-heading'>";
				echo "<a href='./todo.php?d=detail&p={$top}' style='color:#ffffff;'>";
				echo "<h3 class='panel-title'>{$todo[$top]['�^�C�g��']}</h3>";
				echo "</a></div>";
				echo "<div class='panel-body'>";
				echo "{$todo[$top]['��Ɠ��e']}<br>";
				echo "<div class='col-xs-12'><div class='progress'><div class='progress-bar progress-bar-success progress-bar-striped active' role='progressbar' style='width: {$todo[$top]['�p�[�Z���e�[�W']}%;'>";
				echo "{$todo[$top]['�p�[�Z���e�[�W']}%";
				echo "</div></div></div>";
				echo "</div>";
				echo "<div class='panel-footer'>{$todo[$top]['�J�n�\���']}�@�`�@{$todo[$top]['�[��']}</div>";
				echo "</div>";
			}
		}
	}
?>