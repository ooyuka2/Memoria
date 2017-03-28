<?php
	function read_table($what_table, $d) {
?>
<?php
	$abc = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
	$abcl = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","g");
	$abc2 = array("S_A","S_B","S_C","S_D","S_E","S_F","S_G","S_H","S_I","S_J","S_K","S_L","S_M","S_N","S_O","S_P","S_Q","S_R","S_S","S_T","S_U","S_V","S_W","S_X","S_Y","S_Z");
	$abc3 = array("G_A","G_A","G_A","G_A","G_A","G_F","G_F","G_F","G_F","G_F","G_K","G_K","G_K","G_K","G_K","G_P","G_P","G_P","G_P","G_P","G_U","G_U","G_U","G_U","G_U","G_Z");
	$hiragana = array("あ","い","う","え","お","か","き","く","け","こ","さ","し","す","せ","そ","た","ち","つ","て","と","な","に","ぬ","ね","の","は","ひ","ふ","へ","ほ","ま","み","む","め","も","や","ゆ","よ","","","ら","り","る","れ","ろ","わ","を","ん","","");
	$hiragana2 = array("S_a","S_i","S_u","S_e","S_o","S_ka","S_ki","S_ku","S_ke","S_ko","S_sa","S_si","S_su","S_se","S_so","S_ta","S_ti","S_tu","S_te","S_to","S_na","S_ni","S_nu","S_ne","S_no","S_ha","S_hi","S_hu","S_he","S_ho","S_ma","S_mi","S_mu","S_me","S_mo","S_ya","S_yi","S_yu","S_ye","S_yo","S_ra","S_ri","S_ru","S_re","S_ro","S_wa","S_wi","S_wu","S_we","S_wo");
	$hiragana3 = array("G_a","G_a","G_a","G_a","G_a","G_ka","G_ka","G_ka","G_ka","G_ka","G_sa","G_sa","G_sa","G_sa","G_sa","G_ta","G_ta","G_ta","G_ta","G_ta","G_na","G_na","G_na","G_na","G_na","G_ha","G_ha","G_ha","G_ha","G_ha","G_ma","G_ma","G_ma","G_ma","G_ma","G_ya","G_ya","G_ya","G_ya","G_ya","G_ra","G_ra","G_ra","G_ra","G_ra","G_wa","G_wa","G_wa","G_wa","G_wa");
	$dictionary = readCsvFile('../data/dictionary.csv');
	$group = readCsvFile('../data/dictionary_group.csv');
?>
<!-- Tables
================================================== -->
<div class="bs-docs-section" style="margin:0">
<a href="./dictionary.php?page=new" class="btn btn-info">新規</a>
<p></p>
<div class="row">
  <div class="col-lg-12">
    <!-- <div class="page-header"> -->
    <!-- </div> -->
        <div class="bs-component" id="tables" style="margin: 0 auto 5px auto;text-align: center;">
          <div class="btn-toolbar" style="text-align: center;">
          	<?php
          		if(!isset($_GET['search']) && $what_table=="home") {
          			echo "<div class='btn-group'><a href='./dictionary.php' class='btn btn-primary'>すべて</a></div>";
          		} else {
          			echo "<div class='btn-group'><a href='./dictionary.php?d=".$what_table."' class='btn btn-default'>すべて</a></div>";
          		}
          		
      		?>
      		<?php
          		for($i=0; $i<count($abc); $i++) {
          			if($i%5==0) { echo "<div class='btn-group' onMouseLeave=\"hihyouzi('{$abc3[$i]}')\">";}//
          			echo "<a href='./dictionary.php?search=".$abc2[$i]."&d=".$what_table."' class='{$abc3[$i]} btn ";
          			if(isset($_GET['search']) && $_GET['search']==$abc2[$i]) { echo "btn-primary"; }
          			else { echo "btn-default"; }
          			echo "' id=".$abc2[$i];
          			if($i%5!=0 && !(isset($_GET['search']) && $_GET['search']==$abc2[$i])) { echo " style='display:none'";}
          			else { echo " style='display:block'";}
          			if($i%5==0) echo " onMouseOver=\"hyouzi('{$abc3[$i]}')\"";
          			echo ">";
          			echo $abc[$i]."</a>";
          			if($i%5==4) { echo "</div>";}
          		}
          		echo "</div>";
          		for($i=0; $i<count($hiragana); $i++) {
          			if($i%5==0) { echo "<div class='btn-group' onMouseLeave=\"hihyouzi('{$hiragana3[$i]}')\">";}//
          			if($hiragana[$i]!="") {
	          			echo "<a href='./dictionary.php?search=".$hiragana2[$i]."&d=".$what_table."' class='{$hiragana3[$i]} btn ";
	          			if(isset($_GET['search']) && $_GET['search']==$hiragana2[$i]) { echo "btn-primary'"; }
	          			else { echo "btn-default'"; }
	          			if($i%5!=0 && !(isset($_GET['search']) && $_GET['search']==$hiragana2[$i])) { echo " style='display:none'";}
	          			if($i%5==0) echo " onMouseOver=\"hyouzi('{$hiragana3[$i]}')\"";
	          			echo " id='".$hiragana2[$i]."'>".$hiragana[$i]."</a>";
          			}
          			if($i%5==4) { echo "</div>";}
          		}
          	?>
          </div>
        </div>
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

        		for($i = 1; $i<count($dictionary); $i++) {
        			if(!isset($_GET['search']) || search_array($abc, $abc2, $abcl, $hiragana, $hiragana2, mb_substr($dictionary[$i][1], 0, 1))) {
        				if($d==0 || $d==$dictionary[$i][4]) {
		    				echo "<tr><td>";
		    				echo $dictionary[$i][0];
		    				echo "</td><td>";
		    				echo $dictionary[$i][2];
		    				if($dictionary[$i][3]!="")
		    				echo "<span style='float: right;'><a href='./dictionary.php?page=detail&p=".$i."'>詳細</span></td><td>";
		    				else { echo "</td><td>"; }
		    				echo $dictionary[$i][5];
		    				echo "</td><td><a href='./dictionary.php?page=change&p=".$i."' class='btn btn-info'>編集</a>";
		    				echo "</td><td><a href='./dictionary.php?page=delete&p=".$i."' class='btn btn-danger'>削除</a>";
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

<?php
	}
?>