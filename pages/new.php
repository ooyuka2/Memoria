<?php
	include('hedder.php');
?>
<body>
<?php
	include('navigation.php');
	$dictionary = readCsvFile('../data/dictionary.csv');
	
	if(isset($_GET['toroku'])) {//id,artwork,author,year,commentary,floor,place,img
		$dictionary[$_GET['toroku']][0] = $_POST['name'];
		$dictionary[$_GET['toroku']][1] = str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['summary']);
		$dictionary[$_GET['toroku']][2] = str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['detail']);
		writeCsvFile("../data/dictionary.csv", $dictionary);
		header( "Location: ./dictionary.php" );
		exit();
	}
?>

<!-- jumbotron special -->
<section class="section section-inverse japanese-font">
	<div class="container">
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
	          echo "<form class='form-horizontal' method='post' action='new.php?&toroku={$id}'>";
	      ?>
            <fieldset>
              <legend>入力欄</legend>
              <div class="form-group">
                <label for="inputEmail" class="col-lg-2 control-label">メモ</label>
                <div class="col-lg-10">
                  <input type="text" class="form-control" id="" name="name" placeholder="メモ">
                </div>
              </div>
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
                  <button type="reset" class="btn btn-default">Cancel</button>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </div>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
	</div>
</section>


<?php
	include('footer.php');
?>
<script>
	window.onload = function(){
	    document.getElementsByClassName('dictionary')[0].classList.add('active');
	}
</script>
</body>
</html>
