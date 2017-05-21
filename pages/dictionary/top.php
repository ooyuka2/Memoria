<?php
	$group = readCsvFile('../data/dictionary_group.csv');
?>
<?php include('dictionary/table.php'); ?>
    <div class="row">
      <div class="col-lg-12">
        <p id="nav-tabs"></p>
        <div class="bs-component">
          <ul class="nav nav-tabs">
          	<?php
          		if(!isset($_GET['d']) || $_GET['d']=="home") echo "<li class='active'><a href='#home'>home</a></li>";
          		else echo "<li><a href='./dictionary.php?d=home'>home</a></li>";
	        	for($i=1; $i<count($group); $i++) {
	        		$tab = "tab_".$group[$i][1];
	          		if(!isset($_GET['d']) || $_GET['d']!=$group[$i][1])
	          			echo "<li><a href='./dictionary.php?d={$group[$i][1]}'>{$group[$i][0]}</a></li>";
	          		else if(isset($_GET['d']) && $_GET['d']==$group[$i][1])
	          			echo "<li class='active'><a href='./dictionary.php?d={$group[$i][1]}'>{$group[$i][0]}</a></li>";
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
	        		$tab = "tab_".$group[$i][1];
	          			if(!isset($_GET['d']) || $_GET['d']!=$group[$i][1])
	          				echo "<div class='tab-pane fade' id='{$tab}'>";
	          			else if(isset($_GET['d']) && $_GET['d']==$group[$i][1])
	          				echo "<div class='tab-pane fade active in' id='{$tab}'>";
	          			read_table($group[$i][1], $i);
	          			echo "</div>";
	        	}
            
            ?>
          </div>
        </div>
      </div>
    </div>
	  
