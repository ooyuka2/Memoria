
<?php

	$dictionary = readCsvFile('../data/dictionary.csv');
	$group = readCsvFile('../data/dictionary_group.csv');
	date_default_timezone_set('Asia/Tokyo');
	if(isset($_GET['toroku'])) {
		$dictionary[$_GET['toroku']][0] = $_POST['name'];
		$dictionary[$_GET['toroku']][1] = $_POST['furi'];
		$dictionary[$_GET['toroku']][2] = str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['summary']);
		$dictionary[$_GET['toroku']][3] = str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['detail']);
		$dictionary[$_GET['toroku']][4] = $_POST['genre'];
		//$dictionary[$_GET['toroku']][5] = date('Y/m/d H:i:s');
		$dictionary[$_GET['toroku']][6] = 0;
		writeCsvFile("../data/dictionary.csv", $dictionary);
		$name = $dictionary[$_GET['toroku']][0];
		$_SESSION['change'] = "{$name}��ύX���܂����B";
		header( "Location: ./dictionary.php" );
		exit();
	}
?>

  <!-- Forms
  ================================================== -->
  <div class="bs-docs-section" style="margin:0">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-header">
          <h1 id="forms">�ҏW�o�^</h1>
        </div>
      </div>
    </div>

    <div class="row">
        <div class="well bs-component">
          <?php
          	  $id=$_GET['p']; 
	          echo "<form class='form-horizontal' method='post' action='dictionary.php?page=change&toroku={$id}'>";
	      ?>
            <fieldset>
              <legend>���͗�</legend>
              <div class="form-group">
                <label for="inputEmail" class="col-lg-2 control-label">�����^�C�g��</label>
                <div class="col-lg-10">
                    <?php
                		echo "<input type='text' class='form-control' id='name' name='name' placeholder='����' value='{$dictionary[$_GET['p']][0]}' onBlur='check_furi()'>";//
                	?>
                </div>

              </div>
              <div class="form-group">
                <label for="inputEmail" class="col-lg-2 control-label">�ӂ肪��</label>
                <div class="col-lg-10">
                    <?php
                		echo "<input type='text' class='form-control' id='furi' name='furi' placeholder='����' value='{$dictionary[$_GET['p']][1]}'>";//
                	?>
                </div>

              </div>
              <div class="form-group">
              	<div class="col-xs-offset-2 col-xs-3">
			                  <select class="form-control input-normal input-sm" id="genre" name="genre">
			                  	
			                  	<?php
			                  		//echo "<option value='0'></option>";
			                  		for($i=1;$i<count($group);$i++) {
			                  			if($dictionary[$_GET['p']][4]==$i)
			                  				echo "<option value='{$i}'selected>{$group[$i][0]}</option>";
			                  			else echo "<option value='{$i}'>{$group[$i][0]}</option>";
			                  		}
			                  	?>
			                    
			                  </select>
			                  </div></div>
              <div class="form-group">
                <label for="textArea" class="col-lg-2 control-label">�v�_</label>
                <div class="col-lg-10">
                  <textarea class="form-control" rows="3" id="textArea" name="summary"><?php 
                  	$summary = str_replace('<br>', '&#13;',$dictionary[$_GET['p']][2]); 
                  	echo $summary;
                  	
                  	?></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="textArea" class="col-lg-2 control-label">�ڍ�</label>
                <div class="col-lg-10">
                  <textarea class="form-control" rows="3" id="textArea" name="detail"><?php 
                  	$detail = str_replace('<br>', '&#13;',$dictionary[$_GET['p']][3]); 
                  	echo $detail;
                  	
                  	?></textarea>
                </div>
              </div>

              <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                  <button type="reset" class="btn btn-default">Reset</button>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </div>
            </fieldset>
          </form>
        </div>
      </div>
    </div>