
<?php
	$file = readCsvFile2('../data/file.csv');
	$group = readCsvFile2('../data/file_group.csv');
?>

<?php
	date_default_timezone_set('Asia/Tokyo');
	if(isset($_GET['toroku'])) {
		for($j=0; $j<count($_POST['name']);$j++) {
			if($_POST['name'][$j]!="") {
				$file[$_POST['id'][$j]]['name'] = $_POST['name'][$j];
				$file[$_POST['id'][$j]]['furi'] = $_POST['furi'][$j];
				$file[$_POST['id'][$j]]['summary'] = str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['summary'][$j]);
				$file[$_POST['id'][$j]]['detail'] = str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['detail'][$j]);
				$file[$_POST['id'][$j]]['syurui'] = $_POST['genre'][$j];
				$file[$_POST['id'][$j]]['count'] = 0;
				$file[$_POST['id'][$j]]['date'] = date('Y/m/d H:i:s');
				$file[$_POST['id'][$j]]['delete'] = 0;
				//echo $_POST['id'][$j];
			}
		}
		writeCsvFile("../data/file.csv", $file);
		header( "Location: ./file.php" );
		exit();
	}	
	
?>
<div class="row">
  <div class="col-lg-12">
    <div class="page-header">
      
    </div>
  </div>
</div>
<datalist id="keywords">
<?php
	/*for($i=1;$i<count($file);$i++) {
		echo "<option value='{$file[$i][0]}'>";
	}*/
?>
</datalist>
  <!-- Forms
  ================================================== -->
  <div class="bs-docs-section" style="margin:0">
    <div class="row">
        <fieldset>
	          <?php
	          	  $id=count($file); 
		          echo "<form class='form-horizontal ' method='post' action='file.php?page=new&toroku={$id}' name='form_back'>";//form-inline
			    for($j=0; $j<10;$j++) {
		      ?>
			      <div class="well bs-component">
			        <div class="form-group" style="margin-bottom:0;">
			            <div class="col-xs-3" style="padding-right:0;">
							<div class="col-xs-12" style="padding-right:0;">
								<?php
									echo "<input type='search' autocomplete='on' list='keywords' class='form-control input-normal input-sm name' id='name' name='name[]' placeholder='ƒƒ‚' onBlur='check_furi({$j})'>";
									$id=count($file)+$j;
									echo "<input type='hidden' name='id[]' value='{$id}'>";
								?>
							</div>
							<div class="col-xs-12" style="padding-right:0;">
								<input type="text" class="form-control input-normal input-sm furi" id="furi" name="furi[]" placeholder="‚Ó‚è‚ª‚È">
							</div>
			            	<div class="col-xs-12" style="padding-right:0;">
			                  <select class="form-control input-normal input-sm" id="genre" name="genre[]">
			                  	<?php
			                  		
			                  		for($i=1;$i<count($group);$i++) {
			                  			echo "<option value='{$i}'>{$group[$i]['group']}</option>";
			                  		}
			                  	?>
			                  </select>
							</div>
			            </div>
			            <div class="col-xs-9" style="padding-right:0; padding-left:0;">
							<div class="col-xs-12" style="padding-left:0;">
								<textarea class="form-control input-normal input-sm" rows="2" id="textArea" name="summary[]"></textarea>
							</div>
							<div class="col-xs-12" style="padding-left:0;">
								<textarea class="form-control input-normal input-sm" rows="3" id="textArea" name="detail[]"></textarea>
							</div>
			            </div>
			        </div>
			    </div>
			    <?php
			    	}
			    ?>
			    
			    
			    

		        <div class="form-group" style="margin-bottom:0; position: fixed; bottom: 50px;right:0;width:500px;">
		            <div class="col-xs-offset-3 col-xs-3">
		                <button type="reset" class="btn btn-default btn-block">Reset</button>
		            </div>
					<div class="col-xs-3">
		                <button type="submit" class="btn btn-primary btn-block">Submit</button>
		            </div>
		        </div>
		        <div style="height: 100px"></div>
		    </form>
		</fieldset>
    </div>
</div>