<?php
	$file = readCsvFile2($ini['dirWin'].'/data/file.csv');
	//name,furi,summary,detail,count,syurui,date,delete
	$group = readCsvFile2($ini['dirWin'].'/data/file_group.csv');
	//group,abc,detail

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

	<div class="col-12">
		<a href="./file.php?page=new" class="btn btn-info">�V�K</a>�@
		<a href="./file.php?page=reset" class="btn btn-primary">�ēǂݍ���</a>
		<div class='table-responsive container-fluid'>
			<table class='table table-striped table-hover ' id='link'>
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
					for($i = 1; $i<count($file); $i++) {
						if(!isset($_GET['search']) && $file[$i]['delete']!=1) {
						//name,furi,summary,detail,count,syurui,date,delete
							echo "<tr class='syurui".$file[$i]['syurui']."'><td>";
							echo $file[$i]['name'];
							echo "</td><td>";
							echo $file[$i]['furi'];
							echo "</td><td>";
							if($file[$i]['syurui'] == 2) 
								echo "<a href='".$file[$i]['summary']."' onClick='move(".$i.")'>".$file[$i]['summary']."</a>";
							else
								echo "<a href='".$file[$i]['summary']."' target='_blank' onClick='move(".$i.")'>".$file[$i]['summary']."</a>";
							if($file[$i]['detail']!="")
							//echo "<span style='float: right;'><a href='./file.php?page=detail&p=".$i."'>�ڍ�</span></td><td>";
							echo "<br>{$file[$i]['detail']}</td><td>";
							else { echo "</td><td>"; }
							echo $file[$i]['count'];
							echo "</td><td><a href='./file.php?page=change&p=".$i."' class='btn btn-info'>�ҏW</a>";
							echo "</td><td><a href='./file.php?page=delete&p=".$i."' class='btn btn-danger'>�폜</a>";
							echo "</td></tr>";
						}
					}
					
				?>
				</tbody>
			</table>
		</div>
	</div>
	
