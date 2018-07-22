<?php
	$group = readCsvFile('../data/dictionary_group.csv');
	$dictionary = readCsvFile('../data/dictionary.csv');
?>
	<div class="row">
	<div class="col-lg-12">
		<p id="nav-tabs"></p>
		<div class="bs-component">
		<ul class="nav nav-tabs">
			<?php
				echo "<li id='home' class='active'><a onclick='move_tab(\"home\")'>home</a></li>";
				for($i=1; $i<count($group); $i++) {
					echo "<li id='syurui{$i}'><a onclick='move_tab(\"syurui{$i}\")'>{$group[$i][0]}</a></li>";
				}
			
			?>
		</ul>
			<?php
				//�ύX����ɂ��Ă̕��́B
				if(isset($_SESSION['change'])) {
					echo "<div class='alert alert-dismissible alert-info'><button type='button' class='close' data-dismiss='alert'>&times;</button><p>{$_SESSION['change']}</p></div>";
					unset($_SESSION['change']);
				}
				//�폜����ɂ��Ă̕��́B
				//print_r($_SESSION);
				if(isset($_SESSION['delete'])) {
					echo "<div class='alert alert-dismissible alert-warning'><button type='button' class='close' data-dismiss='alert'>&times;</button><p class='text-danger'>{$_SESSION['delete']}</p></div>";
					unset($_SESSION['delete']);
				}
			?>
			
		<div id="myTabContent" class="tab-content">
			<div class='tab-pane fade active in' id='home'>
<div class="bs-docs-section" style="margin:0">
<a href="./dictionary.php?page=new" class="btn btn-info">�V�K</a>
<p></p>
<div class='container-fluid'>

			<div class="bs-component " id="tables" style="margin: 0 auto 5px auto;text-align: center;">
			</div>
		<div class="bs-component table-responsive">
		<table class='table table-striped table-hover ' id='dictionary'>
			<thead>
			<tr>
				<th>����</th>
				<th>���e</th>
				<th>�o�^����</th>
				<th>�ҏW</th>
				<th>�폜</th>
			</tr>
			</thead>
			<tbody>
				<?php
					for($i = 1; $i<count($dictionary); $i++) {
						//if(!isset($_GET['search']) || search_array($abc, $abc2, $abcl, $hiragana, $hiragana2, mb_substr($dictionary[$i][1], 0, 1))) {
						if(!isset($_GET['search']) && $dictionary[$i][6]!=1) {
							echo "<tr class='syurui".$dictionary[$i][4]."'><td>";
							echo $dictionary[$i][0];
							echo "</td><td>";
							echo $dictionary[$i][2];
							if($dictionary[$i][3]!="") echo "<span style='float: right;'><a href='./dictionary.php?page=detail&p=".$i."'>�ڍ�</span></td><td>";
							else { echo "</td><td>"; }
							echo $dictionary[$i][5];
							echo "</td><td><a href='./dictionary.php?page=change&p=".$i."' class='btn btn-info'>�ҏW</a>";
							echo "</td><td><a href='./dictionary.php?page=delete&p=".$i."' class='btn btn-danger'>�폜</a>";
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
		</div>
	</div>
	</div>
	
