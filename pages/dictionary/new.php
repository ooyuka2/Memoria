
<?php

	$dictionary = readCsvFile('../data/dictionary.csv');
	$group = readCsvFile('../data/dictionary_group.csv');
	
	if(isset($_GET['toroku'])) {
		$dictionary[$_GET['toroku']][0] = $_POST['name'];
		$dictionary[$_GET['toroku']][1] = $_POST['furi'];
		$dictionary[$_GET['toroku']][2] = str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['summary']);
		$dictionary[$_GET['toroku']][3] = str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['detail']);
		$dictionary[$_GET['toroku']][4] = $_POST['genre'];
		$dictionary[$_GET['toroku']][5] = date('Y/m/d H:i:s');
		writeCsvFile("../data/dictionary.csv", $dictionary);
		header( "Location: ./dictionary.php?page=new" );
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
		      ?>
			      <div class="well bs-component">
			        <div class="form-group" style="margin-bottom:0;">
			            <div class="col-xs-2" style="padding-right:0;">
			                  <select class="form-control input-normal input-sm" id="genre" name="genre" style='font-size:50%;'>
			                  	<option value="0"></option>
			                  	<?php
			                  		
			                  		for($i=1;$i<count($group);$i++) {
			                  			echo "<option value='{$i}'>{$group[$i][0]}</option>";
			                  		}
			                  	?>
			                    
			                  </select>
			            </div>
			            <div class="col-xs-5" style="padding-right:0; padding-left:0;">
			                <input type="text" class="form-control input-normal input-sm" id="name" name="name" placeholder="メモ" onBlur="check_furi()" style='font-size:50%;'>
			            </div>
			            <div class="col-xs-5" style="padding-left:0;">
			                <input type="text" class="form-control input-normal input-sm" id="furi" name="furi" placeholder="ふりがな" style='font-size:50%;'>
			            </div>
			        </div>
			        <div class="form-group" style="margin-bottom:0;">
			            <div class="col-xs-12">
							<textarea class="form-control input-normal input-sm" rows="2" id="textArea" name="summary" style='font-size:50%;'></textarea>
			            </div>
			        </div>
			        <div class="form-group" style="margin-bottom:0;">
			            <div class="col-xs-12">
			                <textarea class="form-control input-normal input-sm" rows="4" id="textArea" name="detail" style='font-size:50%;'></textarea>
			            </div>
			        </div>
			    </div>
		        <div class="form-group" style="margin-bottom:0;">
		            <div class="col-xs-offset-3 col-xs-3">
		                <button type="reset" class="btn btn-default btn-block">Cancel</button>
		            </div>
					<div class="col-xs-3">
		                <button type="submit" class="btn btn-primary btn-block">Submit</button>
		            </div>
		        </div>
		    </form>
		</fieldset>
    </div>
</div>
