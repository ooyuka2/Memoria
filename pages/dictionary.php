<?php
	include('hedder.php');
?>
<body>
<?php
	include('navigation.php');
	$dictionary = readCsvFile('../data/dictionary.csv');
?>

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
	          <a href="./new.php" class="btn btn-primary">新規</a>
	        </div>
			
	        <div class="bs-component">
	          <table class="table table-striped table-hover " id="dictionary">
	            <thead>
	              <tr>
	                <th>メモタイトル</th>
	                <th>内容</th>
	              </tr>
	            </thead>
	            <tbody>
	            	<?php
	            		for($i = 0; $i<count($dictionary); $i++) {
	            			if($i%2==0) {
	            				echo "<tr class='warning'><td>";
	            				echo $dictionary[$i][0];
	            				echo "</td><td>";
	            				echo $dictionary[$i][1];
	            				echo "<span style='float: right;'><a href='./detail.php?page=".$i."'>詳細はこちら</span>";
	            				echo "</td></tr>";
	            			}
	            			else {
	            				echo "<tr><td>";
	            				echo $dictionary[$i][0];
	            				echo "</td><td>";
	            				echo $dictionary[$i][1];
	            				echo "<span style='float: right;'><a href='./detail.php?page=".$i."'>詳細はこちら</span>";
	            				echo "</td></tr>";
	            			}
	            		}
	            		
	            	?>
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
		    displayLength: 50,  
			stateSave: true
        });
    });
	window.onload = function(){
	    document.getElementsByClassName('dictionary')[0].classList.add('active');
	}
</script>
</body>
</html>
