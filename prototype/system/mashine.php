<?php
	$file = readCsvFile2($ini['dirWin'].'/prototype/data/mashine.csv');
	//name,furi,summary,detail,count,syurui,date,delete
	//$group = readCsvFile2($ini['dirWin'].'/data/file_group.csv');
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
		<a href="./file.php?page=table_make&type=new" class="btn btn-info">�V�K</a>�@
		<button onclick="location.reload()" class="btn btn-primary">�ēǂݍ���</button>
		<div class='table-responsive container-fluid'>
			<table class='table table-striped table-hover ' id='tablespage' cellspacing="0" width="100%">
				<thead>
					<tr>
						<th class="th-sm">���_</th>
						<th class="th-sm">�X�e�[�^�X</th>
						<th class="th-sm">�}�V����</th>
						<th class="th-sm">IP�A�h���X</th>
						<th class="th-sm">�p�r</th>
						
						<th class="th-sm">OS</th>
					</tr>
				</thead>
				<tbody>
				<?php
					for($i = 1; $i<count($file); $i++) {
						echo "<tr>";
						echo "<td>" . $file[$i]['���_'] . "</td>";
						echo "<td>" . $file[$i]['status'] . "</td>";
						echo "<td>" . $file[$i]['hostname'] . "</td>";
						echo "<td>" . $file[$i]['ipaddress'] . "</td>";
						echo "<td>" . $file[$i]['whattodo'] . "</td>";
						
						echo "<td>" . $file[$i]['os'] . "</td>";
						echo "</tr>";
					}
					
				?>
				</tbody>
			</table>
		</div>
	</div>
	
