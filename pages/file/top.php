<?php
	$file = readCsvFile2('../data/file.csv');
	//name,furi,summary,detail,count,syurui,date,delete
	$group = readCsvFile2('../data/file_group.csv');
	//group,abc,detail
?>
<?php include('file/table.php'); ?>
    <div class="row">
      <div class="col-lg-12">
        <p id="nav-tabs"></p>
        <div class="bs-component">
          <ul class="nav nav-tabs">
          	<?php
          		if(!isset($_GET['d']) || $_GET['d']=="home") echo "<li class='active'><a href='#home'>home</a></li>";
          		else echo "<li><a href='./file.php?d=home'>home</a></li>";
	        	for($i=1; $i<count($group); $i++) {
	        		$tab = "tab_".$group[$i]['abc'];
	          		if(!isset($_GET['d']) || $_GET['d']!=$group[$i]['abc'])
	          			echo "<li><a href='./file.php?d={$group[$i]['abc']}'>{$group[$i]['group']}</a></li>";
	          		else if(isset($_GET['d']) && $_GET['d']==$group[$i]['abc'])
	          			echo "<li class='active'><a href='./file.php?d={$group[$i]['abc']}'>{$group[$i]['group']}</a></li>";
	        	}
            
            ?>
		  </ul>
			<?php
				//変更動作についての文章。
				if(isset($_SESSION['change'])) {
					echo "<div class='alert alert-dismissible alert-info'><button type='button' class='close' data-dismiss='alert'>&times;</button><p>{$_SESSION['change']}</p></div>";
					unset($_SESSION['change']);
				}
				//削除動作についての文章。
				//print_r($_SESSION);
				if(isset($_SESSION['delete'])) {
					echo "<div class='alert alert-dismissible alert-warning'><button type='button' class='close' data-dismiss='alert'>&times;</button><p class='text-danger'>{$_SESSION['delete']}</p></div>";
					unset($_SESSION['delete']);
				}
			?>
			
          <div id="myTabContent" class="tab-content">
          	<?php
	            
				if(!isset($_GET['d']) || $_GET['d']=="home") echo "<div class='tab-pane fade active in' id='home'>";
          		else echo "<div class='tab-pane fade' id='home'>";
          	?>
          		<?php read_table('home', 0); ?>
	            </div>
          	<?php
	        	for($i=1; $i<count($group); $i++) {
	        		$tab = "tab_".$group[$i]['abc'];
	          			if(!isset($_GET['d']) || $_GET['d']!=$group[$i]['abc'])
	          				echo "<div class='tab-pane fade' id='{$tab}'>";
	          			else if(isset($_GET['d']) && $_GET['d']==$group[$i]['abc'])
	          				echo "<div class='tab-pane fade active in' id='{$tab}'>";
	          			read_table($group[$i]['abc'], $i);
	          			echo "</div>";
	        	}
            
            ?>
          </div>
        </div>
      </div>
    </div>
	  
