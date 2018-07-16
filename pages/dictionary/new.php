
<?php
	$dictionary = readCsvFile('../data/dictionary.csv');
	$group = readCsvFile('../data/dictionary_group.csv');
?>

<?php
	date_default_timezone_set('Asia/Tokyo');
	if(isset($_GET['toroku'])) {
		if($_POST['name']!="") {
			$dictionary[$_GET['toroku']][0] = $_POST['name'];
			$dictionary[$_GET['toroku']][1] = $_POST['furi'];
			$dictionary[$_GET['toroku']][2] = rtrim(str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['summary']), '\\');
			$dictionary[$_GET['toroku']][3] = rtrim(str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['detail']), '\\');
			$dictionary[$_GET['toroku']][4] = $_POST['genre'];
			$dictionary[$_GET['toroku']][5] = date('Y/m/d H:i:s');
			$dictionary[$_GET['toroku']][6] = 0;
		}
		writeCsvFile("../data/dictionary.csv", $dictionary);
		$_SESSION['change'] = "{$_POST['name']}を追加しました。";
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
<datalist id="keywords">
<?php
	/*for($i=1;$i<count($dictionary);$i++) {
		echo "<option value='{$dictionary[$i][0]}'>";
	}*/
?>
</datalist>
  <!-- Forms
  ================================================== -->
  <div class="bs-docs-section" style="margin:0">
    <div class="row">
        <fieldset>
	          <?php
	          	  $id=count($dictionary); 
		          echo "<form class='form-horizontal ' method='post' action='dictionary.php?page=new&toroku={$id}' name='form_back'>";//form-inline
		      ?>
              <legend>入力欄</legend>
              <div class="form-group">
                <label for="inputEmail" class="col-lg-2 control-label">メモタイトル</label>
                <div class="col-lg-10">
                    <?php
                		echo "<input type='text' class='form-control' id='name' name='name' placeholder='メモ' value='' onBlur='check_furi()'>";//
                	?>
                </div>

              </div>
              <div class="form-group">
                <label for="inputEmail" class="col-lg-2 control-label">ふりがな</label>
                <div class="col-lg-10">
                    <?php
                		echo "<input type='text' class='form-control' id='furi' name='furi' placeholder='メモ' value=''>";//
                	?>
                </div>

              </div>
              <div class="form-group">
              	<div class="col-xs-offset-2 col-xs-3">
			                  <select class="form-control input-normal input-sm" id="genre" name="genre">
			                  	
			                  	<?php
			                  		//echo "<option value='0'></option>";
			                  		for($i=1;$i<count($group);$i++) {
			                  			echo "<option value='{$i}'>{$group[$i][0]}</option>";
			                  		}
			                  	?>
			                    
			                  </select>
			                  </div></div>
              <div class="form-group">
                <label for="textArea" class="col-lg-2 control-label">要点</label>
                <div class="col-lg-10">
                  <textarea class="form-control" rows="3" id="textArea" name="summary"></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="textArea" class="col-lg-2 control-label">詳細</label>
                <div class="col-lg-10">
                  <textarea class="form-control" rows="3" id="textArea" name="detail"></textarea>
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
    </div>iv>