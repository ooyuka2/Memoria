<?php
//id,�^�C�g��,��Ɠ��e,�[��,�[������,�J�n�\���,�I���\���,�p�[�Z���e�[�W,
//����,����,level,top,parent,child,���ʕ�,�e�[�},�D��x,�o�^��

	
	include('../function.php');
	$todo = readCsvFile2('../../data/todo.csv');
	if(!isset($ini)) $ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	$id=$_POST['id'][0];
	$number = $id;
	date_default_timezone_set('Asia/Tokyo');
	$idarray = array();
	$newflug = false;
	for($j=0; $j<count($_POST['name']);$j++) {
		if($_POST['name'][$j]!="") {
			if(isset($_POST['id'][$j]) && $_POST['id'][$j]<count($todo)) {
				$id = $_POST['id'][$j];
				
				$persentage = $todo[$id]['�p�[�Z���e�[�W'];
				$finish = $todo[$id]['����'];
				$commnet = $todo[$id]['����'];
				$toroku = $todo[$id]['�o�^��'];
				$wait = $todo[$id]['�ۗ�'];
				$deletekey = $todo[$id]['�폜'];
				$todoToday = $todo[$id]['������邱��'];
			} else if(isset($_POST['id'][$j])) {
				$id = $_POST['id'][$j];
				$persentage = 0;
				$finish = 0;
				$commnet = "no comment";
				$toroku = date('Y/m/d H:i:s');
				$wait = 0;
				$deletekey = 0;
				$newflug = true;
				$todoToday = 0;
			} else {
				$id = count($todo);
				$persentage = 0;
				$finish = 0;
				$commnet = "no comment";
				$toroku = date('Y/m/d H:i:s');
				$wait = 0;
				$deletekey = 0;
				$todoToday = 0;
			}
			$idarray[$j] = $id;
			$todo[$id]['id'] = $id;
			$todo[$id]['�^�C�g��'] = $_POST['name'][$j];
			$todo[$id]['��Ɠ��e'] = str_replace(array("\r\n", "\r", "\n","[EOF]"), '<br>', $_POST['detail'][$j]);
			$todo[$id]['�[��'] = $_POST['noki'][$j];
			$todo[$id]['�[������'] = $_POST['time'][$j];
			$todo[$id]['�J�n�\���'] = $_POST['kaisi'][$j];
			$todo[$id]['�I���\���'] = $_POST['syuryo'][$j];
			$todo[$id]['�p�[�Z���e�[�W'] = $persentage;
			$todo[$id]['����'] = $finish;
			$todo[$id]['����'] = $commnet;
			$todo[$id]['level'] = $_POST['level'][$j];
			$todo[$id]['top'] = $number;
			$todo[$id]['parent'] = 0;
			$todo[$id]['child'] = 0;
			$todo[$id]['���ʕ�'] = $_POST['mono'][$j];
			if($j==0) $todo[$id]['�e�[�}'] = $_POST['theme'][$j];
			else $todo[$id]['�e�[�}'] = 0;
			$todo[$id]['�D��x'] = $_POST['priority'][$j];
			$todo[$id]['�o�^��'] = $toroku;
			$todo[$id]['�ۗ�'] = $wait;
			$todo[$id]['�폜'] = 0;
			$todo[$id]['���ԊǗ��e�[�}'] = $_POST['theme2'][0];
			$todo[$id]['����'] = $j;
			$todo[$id]['������邱��'] = $todoToday;
		}
	}


	for($j=0; $j<count($_POST['name']);$j++) {
		if($_POST['name'][$j]!="") {
			$id = $idarray[$j];
			if($_POST['name'][$j]!="") {
				if($todo[$idarray[$j]]['level']==1) $todo[$idarray[$j]]['parent'] = 0;
				else if(($todo[$idarray[$j]]['level']-$todo[$idarray[$j-1]]['level'])==1) $todo[$idarray[$j]]['parent'] = $todo[$idarray[$j-1]]['id'];
				else if($todo[$idarray[$j]]['level']==$todo[$idarray[$j-1]]['level']) $todo[$idarray[$j]]['parent'] = $todo[$idarray[$j-1]]['parent'];
				else {
					for($k=$j-1; $k>=0; $k--) {
						if($todo[$idarray[$j]]['level']==($todo[$idarray[$k]]['level'])+1) {
							$todo[$idarray[$j]]['parent'] = $todo[$idarray[$k]]['id'];
							break;
						}
					}
				}
				$child = 0;
				$i=$j+1;
				while($i<count($_POST['name']) && $_POST['level'][$j]<$_POST['level'][$i]) {
					if(($_POST['level'][$j]+1)==$_POST['level'][$i]) {
						$child++;
					}
					$i++;
				}
				$todo[$idarray[$j]]['child'] = $child;
			}
		}
	}
	$id=$_POST['id'][0];
	//�폜�Ώۂ��Ȃ����̊m�F
	for($i=1; $i<count($todo); $i++) {
		if($todo[$i]['top'] == $id) {
			$check = 0;
			for($j=0; $j<count($_POST['id']);$j++) {
				if($todo[$i]['id'] == $_POST['id'][$j]) $check++;
				//echo $_POST['id'][$j] ."* ";
			}
			if($check==0) {
				$todo[$i]['�폜'] = 1;
				//echo $todo[$todo[$i]['parent']]['child']. ":::" .$todo[$i]['parent'];
				//$todo[$todo[$i]['parent']]['child'] -= 1;
				//echo "<hr>��";
				//echo $todo[$todo[$i]['parent']]['child'] ." : " .$todo[$i]['parent'] ."<hr>";
			}
		}
	}
	
	//�V�����񂪂���ꍇ�̃p�[�Z���e�[�W�̏C��
	if($newflug) {
		for($i=1; $i<count($todo); $i++) {
			if($todo[$i]['top'] == $id && $todo[$i]['child']!=0) {
				$todo[$i]['�p�[�Z���e�[�W'] = 0;
				$todo[$i]['����'] = 0;
			}
		}
		for($i=1; $i<count($todo); $i++) {
			if($todo[$i]['top'] == $id && $todo[$i]['child']==0) {
				$todo = check_parent_finish($todo, $i, $todo[$i]['�p�[�Z���e�[�W']);
			}
		}
		
		//check_parent_finish($todo, $child, $fdo)
	}
	
	
	/*
	print_r($_POST['id']);
	
	echo "<pre>";
	print_r($_POST);
	
	for($i=1; $i<count($todo); $i++) {
		if($todo[$i]['top'] == $id) {
			print_r($todo[$i]);
		}
	}
	echo "</pre>";
	*/
	
	if(isset($_POST['make_weekly'])) {
		$weekly = readCsvFile2('../../data/weekly.csv');
		include('../../weekly.php');
		
		$weeklyid = check2array($weekly, $_POST['make_weekly'], "todoid");
		
		if($weeklyid == -1) {
			$c = count($weekly);
			$weekly[$c]["todoid"] = $number;
			$weekly[$c]["�e�[�}�T�v"] = $todo[$number]['��Ɠ��e'];
			$weekly[$c]["KPI"] = "";
			$weekly[$c]["�S��"] = $ini['myname'];
			$weekly[$c]["�ς�"] = "";
			$weekly[$c]["�i��"] = "";
			$weekly[$c]["����̗\��"] = "";
			if($_POST['theme2'][0] == $ini['incidentID'] || $_POST['theme2'][0] == $ini['servicesID']) $weekly[$c]["parentid"] = $_POST['theme2'][0];
			else $weekly[$c]["parentid"] = "0";
			$weekly[$c]["�ŏI�X�V����"] = date('Y/m/d H:i:s');
			$weekly[$c]["�\��"] = "0";
			writeCsvFile2("../../data/weekly.csv", $weekly);
		} else if($weekly[$weeklyid]["�\��"] == 1) {
			$weekly[$weeklyid]["�\��"] = "0";
			writeCsvFile2("../../data/weekly.csv", $weekly);
		}
	} else {
		$weekly = readCsvFile2('../../data/weekly.csv');
		$weeklyid = check2array($weekly, $number, "todoid");
		
		if($weeklyid != -1) {
			$weekly[$weeklyid]["�\��"] = "1";
			writeCsvFile2("../../data/weekly.csv", $weekly);
		}
	}
	
	
	writeCsvFile2("../../data/todo.csv", $todo);
	
	header( "Location: ../todo.php?p={$_POST['id'][0]}" );
	exit();

?>