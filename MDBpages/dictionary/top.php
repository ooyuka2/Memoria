<?php
	$dictionary = readCsvFile2($ini['dirWin'].'/data/dictionary.csv');
	//name,furi,summary,detail,count,syurui,date,delete
	$group = readCsvFile2($ini['dirWin'].'/data/dictionary_group.csv');
	//group,abc,detail

	//�ύX����ɂ��Ă̕��́B
	if(isset($_SESSION['change'])) {
		echo "<div class='alert alert-dismissible alert-info col-12'><button type='button' class='close' data-dismiss='alert'>&times;</button><p>{$_SESSION['change']}</p></div>";
		unset($_SESSION['change']);
	}
	//�폜����ɂ��Ă̕��́B
	//print_r($_SESSION);
	if(isset($_SESSION['delete'])) {
		echo "<div class='alert alert-dismissible alert-warning col-12'><button type='button' class='close' data-dismiss='alert'>&times;</button><p class='text-danger'>{$_SESSION['delete']}</p></div>";
		unset($_SESSION['delete']);
	}
?>

	<div class="col-12">
		<a href="./dictionary.php?page=table_make&type=new" class="btn btn-info">�V�K</a>�@
		<button onclick="location.reload()" class="btn btn-primary">�ēǂݍ���</button>
		<div class='table-responsive container-fluid'>
			<table class='table table-striped table-hover ' id='datatable'>
				<thead>
					<tr>
						<th class="col-3">����</th>
						<th>�ӂ肪��</th>
						<th class="col-8">���e</th>
						<th>�o�^����</th>
						<th>�ҏW</th>
						<th>�폜</th>
					</tr>
				</thead>
				<tbody>
				<?php
					for($i = 1; $i<count($dictionary); $i++) {
						if((!isset($_GET['search']) || $_GET['search'] == $dictionary[$i]['syurui']) && $dictionary[$i]['delete']!=1) {
						//name,furi,summary,detail,count,syurui,date,delete
							echo "<tr class='syurui".$dictionary[$i]['syurui']."'><td>";
							echo $dictionary[$i]['name'];
							echo "</td><td>";
							echo $dictionary[$i]['furi'];
							echo "</td><td>";
							echo "<h4 class='text-primary'>".$dictionary[$i]['summary']."</h4>";
							if($dictionary[$i]['detail']!="")
							//echo "<span style='float: right;'><a href='./dictionary.php?page=detail&p=".$i."'>�ڍ�</span></td><td>";
							echo "<br>{$dictionary[$i]['detail']}</td><td>";
							else { echo "</td><td>"; }
							echo $dictionary[$i]['date'];
							echo "</td><td><a href='./dictionary.php?page=table_make&type=change&p=".$i."' class='btn btn-info'>�ҏW</a>";
							echo "</td><td><button class='btn btn-danger' onclick='delete_check(\"".$dictionary[$i]['name']."\", ".$i.", \"dictionary\")' style='margin:0'>�폜</button>";
							echo "</td></tr>";
						}
					}
					
				?>
				</tbody>
			</table>
		</div>
	</div>
	
