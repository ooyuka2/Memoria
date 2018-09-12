
<?php
	$file = readCsvFile2('../data/file.csv');
	$group = readCsvFile2('../data/file_group.csv');
?>

<?php
	date_default_timezone_set('Asia/Tokyo');
	if(isset($_GET['toroku'])) {
		if($_POST['name']!="") {
			$file[$_GET['toroku']]['name'] = $_POST['name'];
			$file[$_GET['toroku']]['furi'] = $_POST['furi'];
			$file[$_GET['toroku']]['summary'] = rtrim(str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['summary']), '\\');
			$file[$_GET['toroku']]['detail'] = rtrim(str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['detail']), '\\');
			$file[$_GET['toroku']]['count'] = 0;
			$file[$_GET['toroku']]['syurui'] = $_POST['genre'];
			$file[$_GET['toroku']]['date'] = date('Y/m/d H:i:s');
			$file[$_GET['toroku']]['delete'] = 0;
		}
		$_SESSION['change'] = "{$_POST['name']}を追加しました。";
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
			                  			echo "<option value='{$i}'>{$group[$i]['group']}</option>";
			                  		}
			                  	?>
			                    
			                  </select>
			                  </div></div>
              <div class="form-group">
                <label for="textArea" class="col-lg-2 control-label">URL</label>
                <div class="col-lg-10">
                  <textarea class="form-control" rows="3" id="textArea" name="summary"><?php 
                  	//$summary = str_replace('<br>', '&#10;',$file[$_GET['p']]['summary']); 
                  	//echo $summary;
                  	
                  	?></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="textArea" class="col-lg-2 control-label">備考</label>
                <div class="col-lg-10">
                  <textarea class="form-control" rows="3" id="textArea" name="detail"><?php 
                  	//$detail = str_replace('<br>', '&#10;',$file[$_GET['p']]['detail']); 
                  	//echo $detail;
                  	
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