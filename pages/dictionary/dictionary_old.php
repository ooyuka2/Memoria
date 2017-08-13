<?php
	include('hedder.php');
?>
<body>
<?php
	include('navigation.php');
?>


<div class="jumbotron special">
  <div class="honoka"></div>
  <div class="container">
    <div class="row">
      <div class="col-xs-12 outline">
        <h1>Memoria for Ooyuka.</h1>
        <p>分からない単語のメモや自分のタスクを管理しよう！！</p>
        <div class="download">
          <a href="./todo.php" class="btn btn-warning btn-lg last-release-download-link"><i class="fa fa-github-alt"></i> Go to ToDo List</a>
          <a href="./dictionary.php" class="btn btn-primary btn-lg"><i class="fa fa-play"></i> Watch Dictionary</a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- jumbotron special -->
<section class="section section-inverse japanese-font">
	<div class="container">
	    <!-- Tables
	  ================================================== -->
	  <div class="bs-docs-section" style="margin:0">

	    <div class="row">
	      <div class="col-lg-12">
	        <div class="page-header">
	          <h1 id="tables">メモ帳</h1>
	        </div>

	        <div class="bs-component">
	          <table class="table table-striped table-hover " id="dictionary">
	            <thead>
	              <tr>
	                <th>#</th>
	                <th>Column heading</th>
	                <th>Column heading</th>
	                <th>Column heading</th>
	              </tr>
	            </thead>
	            <tbody id="ActiveDoc">
	              <tr>
	                <td>1</td>
	                <td>Column content</td>
	                <td>Column content</td>
	                <td>Column content</td>
	              </tr>
	              <tr>
	                <td>2</td>
	                <td>Column content</td>
	                <td>Column content</td>
	                <td>Column content</td>
	              </tr>
	              <tr class="info">
	                <td>3</td>
	                <td>Column content</td>
	                <td>Column content</td>
	                <td>Column content</td>
	              </tr>
	              <tr class="success">
	                <td>4</td>
	                <td>Column content</td>
	                <td>Column content</td>
	                <td>Column content</td>
	              </tr>
	              <tr class="danger">
	                <td>5</td>
	                <td>Column content</td>
	                <td>Column content</td>
	                <td>Column content</td>
	              </tr>
	              <tr class="warning">
	                <td>6</td>
	                <td>Column content</td>
	                <td>Column content</td>
	                <td>Column content</td>
	              </tr>
	              <tr class="active">
	                <td>7</td>
	                <td>Column content</td>
	                <td>Column content</td>
	                <td>Column content</td>
	              </tr>

	            </tbody>
	          </table>
	        </div><!-- /example -->
	      </div>
	    </div>
	  </div>
	</div>
</section>


<?php
	include('footer.php');
?>
<script>
    jQuery(function($){
    	$.extend( $.fn.dataTable.defaults, { 
	        language: {
	            url: "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Japanese.json"
	        } 
	    }); 
        $("#dictionary").dataTable({
    	    // 件数切替の値を10～50の10刻みにする
		    lengthMenu: [ 50, 100, 150, 200, 250, 300, 500 ],
		    // 件数のデフォルトの値を50にする
		    displayLength: 10,  
			stateSave: true
        });
    });
	window.onload = function(){
	    document.getElementsByClassName('top')[0].classList.add('active');
	}
</script>
</body>
</html>
