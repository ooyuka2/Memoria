
<?php

	$dictionary = readCsvFile('../data/dictionary.csv');
	
	if(isset($_GET['toroku'])) {
		$dictionary[$_GET['toroku']][0] = $_POST['name'];
		$dictionary[$_GET['toroku']][1] = $_POST['furi'];
		$dictionary[$_GET['toroku']][2] = str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['summary']);
		$dictionary[$_GET['toroku']][3] = str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['detail']);
		$dictionary[$_GET['toroku']][4] = 0;
		$dictionary[$_GET['toroku']][5] = date('Y/m/d H:i:s');
		writeCsvFile("../data/dictionary.csv", $dictionary);
		header( "Location: ./dictionary.php?page=new" );
		exit();
	}
?>

  <!-- Forms
  ================================================== -->
  <div class="bs-docs-section" style="margin:0">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-header">
          <h1 id="forms">新規登録</h1>
        </div>
      </div>
    </div>

    <div class="row">
        <div class="well bs-component">
          <?php
          	  $id=count($dictionary); 
	          echo "<form class='form-horizontal' method='post' action='dictionary.php?page=new&toroku={$id}' name='form_back'>";
	      ?>
            <fieldset>
              <legend>入力欄</legend>
              <div class="form-group">
                <label for="inputEmail" class="col-lg-2 control-label">メモタイトル</label>
                <div class="col-lg-10">
                  <input type="text" class="form-control" id="name" name="name" placeholder="メモ" onBlur="check_furi()" style='font-size:50%;'>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail" class="col-lg-2 control-label">ふりがな</label>
                <div class="col-lg-10">
                  <input type="text" class="form-control" id="furi" name="furi" placeholder="ふりがな" style='font-size:50%;'>
                </div>
              </div>
              <div class="form-group">
                <label for="textArea" class="col-lg-2 control-label">要点</label>
                <div class="col-lg-10">
                  <textarea class="form-control" rows="3" id="textArea" name="summary" style='font-size:50%;'></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="textArea" class="col-lg-2 control-label">詳細</label>
                <div class="col-lg-10">
                  <textarea class="form-control" rows="3" id="textArea" name="detail" style='font-size:50%;'></textarea>
                </div>
              </div>

              <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                  <button type="reset" class="btn btn-default">Cancel</button>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </div>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
