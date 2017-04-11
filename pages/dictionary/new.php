<datalist id="keywords">
<?php
	$dictionary = readCsvFile('../data/dictionary.csv');
	$group = readCsvFile('../data/dictionary_group.csv');
	for($i=1;$i<count($dictionary);$i++) {
		echo "<option value='{$dictionary[$i][0]}'>";
	}
?>
</datalist>
<?php
	date_default_timezone_set('Asia/Tokyo');
	if(isset($_GET['toroku'])) {
		for($j=0; $j<count($_POST['name']);$j++) {
			if($_POST['name'][$j]!="") {
				$dictionary[$_POST['id'][$j]][0] = $_POST['name'][$j];
				$dictionary[$_POST['id'][$j]][1] = $_POST['furi'][$j];
				$dictionary[$_POST['id'][$j]][2] = str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['summary'][$j]);
				$dictionary[$_POST['id'][$j]][3] = str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['detail'][$j]);
				$dictionary[$_POST['id'][$j]][4] = $_POST['genre'][$j];
				$dictionary[$_POST['id'][$j]][5] = date('Y/m/d H:i:s');
				$dictionary[$_POST['id'][$j]][6] = 0;
				//echo $_POST['id'][$j];
			}
		}
		writeCsvFile("../data/dictionary.csv", $dictionary);
		header( "Location: ./dictionary.php" );
		exit();
	}	
?>
<div class="row">
  <div class="col-lg-12">
    <div class="page-header">
      
    </div>
  </div>
</div>
  <!-- Forms
  ================================================== -->
  <div class="bs-docs-section" style="margin:0">
    <div class="row">
        <fieldset>
	          <?php
	          	  $id=count($dictionary); 
		          echo "<form class='form-horizontal ' method='post' action='dictionary.php?page=new&toroku={$id}' name='form_back'>";//form-inline
			    for($j=0; $j<10;$j++) {
		      ?>
			      <div class="well bs-component">
			        <div class="form-group" style="margin-bottom:0;">
			            <div class="col-xs-3" style="padding-right:0;">
							<div class="col-xs-12" style="padding-right:0;">
								<?php
									echo "<input type='search' autocomplete='on' list='keywords' class='form-control input-normal input-sm name' id='name' name='name[]' placeholder='メモ' onBlur='check_furi({$j})'>";
									$id=count($dictionary)+$j;
									echo "<input type='hidden' name='id[]' value='{$id}'>";
								?>
							</div>
							<div class="col-xs-12" style="padding-right:0;">
								<input type="text" class="form-control input-normal input-sm furi" id="furi" name="furi[]" placeholder="ふりがな">
							</div>
			            	<div class="col-xs-12" style="padding-right:0;">
			                  <select class="form-control input-normal input-sm" id="genre" name="genre[]">
			                  	<?php
			                  		
			                  		for($i=1;$i<count($group);$i++) {
			                  			echo "<option value='{$i}'>{$group[$i][0]}</option>";
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
								<textarea class="form-control input-normal input-sm" rows="3" id="textArea" name="detail[]"><?php echo "\n\n&lt;a href='' target='_blank'&gt;参考WEBサイト&lt;/a&gt;"; ?></textarea>
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