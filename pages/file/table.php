<?php
	//<a class='btn btn-default' href="javascript:document.form_back.submit();">戻る</a>
	function read_table($what_table, $d) {
?>
<?php
	$file = readCsvFile2('../data/file.csv');
	//name,furi,summary,detail,count,syurui,date,delete
	$group = readCsvFile2('../data/file_group.csv');
	//group,abc,detail
?>
<!-- Tables
================================================== -->
<div class="bs-docs-section" style="margin:0">
<a href="./file.php?page=new" class="btn btn-info">新規</a>　
<a href="./file.php?page=reset" class="btn btn-primary">再読み込み</a>
<p></p>
<div class='container-fluid'>
	<div class="row">
	  <div class="col-lg-12">
	    <!-- <div class="page-header"> -->
	    <!-- </div> -->
	    <div class="bs-component table-responsive">
	      <?php
	      	if($what_table=="home") echo "<table class='table table-striped table-hover ' id='dictionary'>";
	      	else echo "<table class='table table-striped table-hover ' id='dictionary_{$what_table}'>";
	      ?>
	        <thead>
	          <tr>
	            <th>メモ</th>
	            <th>内容</th>
	            <th>登録日時</th>
	            <th>編集</th>
	            <th>削除</th>
	          </tr>
	        </thead>
	        <tbody>
	        	<?php

	        		for($i = 1; $i<count($file); $i++) {
	        			if(!isset($_GET['search'])) {
	        				if(($d==0 || $d==$file[$i]['syurui']) && $file[$i]['delete']!=1) {
	        				//name,furi,summary,detail,count,syurui,date,delete
			    				echo "<tr><td>";
			    				echo $file[$i]['name'];
			    				echo "</td><td>";
			    				if($file[$i]['syurui'] == 2) 
			    					echo "<a href='".$file[$i]['summary']."' onClick='move(".$i.")'>".$file[$i]['summary']."</a>";
			    				else
			    					echo "<a href='".$file[$i]['summary']."' target='_blank' onClick='move(".$i.")'>".$file[$i]['summary']."</a>";
			    				if($file[$i]['detail']!="")
			    				//echo "<span style='float: right;'><a href='./file.php?page=detail&p=".$i."'>詳細</span></td><td>";
			    				echo "<br>{$file[$i]['detail']}</td><td>";
			    				else { echo "</td><td>"; }
			    				echo $file[$i]['count'];
			    				echo "</td><td><a href='./file.php?page=change&p=".$i."' class='btn btn-info'>編集</a>";
			    				echo "</td><td><a href='./file.php?page=delete&p=".$i."' class='btn btn-danger'>削除</a>";
			    				echo "</td></tr>";
			    			}
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

<?php
	}
?>