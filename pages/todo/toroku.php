<?php
//id,�^�C�g��,��Ɠ��e,�[��,�[������,�J�n�\���,�I���\���,�p�[�Z���e�[�W,
//����,����,level,top,parent,child,���ʕ�,�e�[�},�D��x,�o�^��
	
	include('../function.php');
	$todo = readCsvFile2('../../data/todo.csv');
	$id = $_POST['id'][0];
	$number = $id;
	date_default_timezone_set('Asia/Tokyo');
	for($j=0; $j<count($_POST['name']);$j++) {
		if($_POST['name'][$j]!="") {
			$todo[$id]['id'] = $id;
			$todo[$id]['�^�C�g��'] = $_POST['name'][$j];
			$todo[$id]['��Ɠ��e'] = str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['detail'][$j]);
			$todo[$id]['�[��'] = $_POST['noki'][$j];
			$todo[$id]['�[������'] = $_POST['time'][$j];
			$todo[$id]['�J�n�\���'] = $_POST['kaisi'][$j];
			$todo[$id]['�I���\���'] = $_POST['syuryo'][$j];
			$todo[$id]['�p�[�Z���e�[�W'] = 0;
			$todo[$id]['����'] = 0;
			$todo[$id]['����'] = "no comment";
			$todo[$id]['level'] = $_POST['level'][$j];
			$todo[$id]['top'] = $number;
			$todo[$id]['parent'] = 0;
			$todo[$id]['child'] = 0;
			$todo[$id]['���ʕ�'] = $_POST['mono'][$j];
			if($j==0) $todo[$id]['�e�[�}'] = $_POST['theme'][$j];
			else $todo[$id]['�e�[�}'] = 0;
			$todo[$id]['�D��x'] = $_POST['priority'][$j];
			$todo[$id]['�o�^��'] = date('Y/m/d H:i:s');
			$todo[$id]['�ۗ�'] = 0;
			$todo[$id]['�폜'] = 0;
			$todo[$id]['���ԊǗ��e�[�}'] = $_POST['theme2'][0];
			$todo[$id]['����'] = $j;
			$todo[$id]['������邱��'] = 0;
			if($j==0) $todo[$id]['�e�[�}�Ή�'] = $_POST['theme'][$j];
			else $todo[$id]['�e�[�}�Ή�'] = 0;
			$todo[$id]['�e�[�}�T�v'] = "";
			$id++;
		}
	}
	
	$id = $_POST['id'][0];
	for($j=0; $j<count($_POST['name']);$j++) {
		if($_POST['name'][$j]!="") {
			if($todo[$id]['level']==1) $todo[$id]['parent'] = 0;
			else if(($todo[$id]['level']-$todo[($id-1)]['level'])==1) $todo[$id]['parent'] = $todo[($id-1)]['id'];
			else if($todo[$id]['level']==$todo[($id-1)]['level']) $todo[$id]['parent'] = $todo[($id-1)]['parent'];
			else {
				for($k=$id-1; $k>=0; $k--) {
					if($todo[$id]['level']==($todo[$k]['level'])+1) {
						$todo[$id]['parent'] = $todo[$k]['id'];
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
			$todo[$id]['child'] = $child;
			$id++;
		}
	}
	
	/*echo "<pre>";
	print_r($todo);
	echo "</pre>";*/
	writeCsvFile2("../../data/todo.csv", $todo);
	if($_POST['name'][0] == "") header( "Location: ../todo.php" );
	else header( "Location: ../todo.php?p={$_POST['id'][0]}" );
	exit();

?>