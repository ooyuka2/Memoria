<?php
//id,�^�C�g��,��Ɠ��e,�[��,�[������,�J�n�\���,�I���\���,�p�[�Z���e�[�W,
//����,����,level,top,parent,child,���ʕ�,�e�[�},�D��x,�o�^��

	if(!isset($ini)) $ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	include($ini['dirWin'].'/pages/function.php');
	$todo = readCsvFile2($ini['dirWin'].'/data/todo.csv');

	
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
	
	if($_POST['name'][0]!="" && isset($_POST['make_weekly']) && $_POST['make_weekly']==-1) {
		$weekly = readCsvFile2($ini['dirWin'].'/data/weekly.csv');
		$ini = parse_ini_file($ini['dirWin'].'/data/config.ini');
		
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
		writeCsvFile2($ini['dirWin']."/data/weekly.csv", $weekly);
	} else if($_POST['name'][0]!="" && isset($_POST['make_weekly'])) {
		$weekly = readCsvFile2($ini['dirWin'].'/data/weekly.csv');
		include($ini['dirWin'].'/pages/todo/weekly.php');
		
		$weeklyid = check2array($weekly, $_POST['make_weekly'], "todoid");
		
		$c = count($weekly);
		$weekly[$c]["todoid"] = $number;
		$weekly[$c]["�e�[�}�T�v"] = $weekly[$weeklyid]["�e�[�}�T�v"];
		$weekly[$c]["KPI"] = $weekly[$weeklyid]["KPI"];
		$weekly[$c]["�S��"] = $weekly[$weeklyid]["�S��"] ;
		$weekly[$c]["�ς�"] = $weekly[$weeklyid]["�ς�"];
		$weekly[$c]["�i��"] = $weekly[$weeklyid]["�i��"];
		$weekly[$c]["����̗\��"] = $weekly[$weeklyid]["����̗\��"];
		$weekly[$c]["parentid"] = $weekly[$weeklyid]["parentid"];
		$weekly[$c]["�ŏI�X�V����"] = date('Y/m/d H:i:s');
		$weekly[$c]["�\��"] = "0";
		writeCsvFile2($ini['dirWin']."/data/weekly.csv", $weekly);
	}
	
	/*echo "<pre>";
	print_r($todo);
	echo "</pre>";*/
	writeCsvFile2($ini['dirWin']."/data/todo.csv", $todo);
	if($_POST['name'][0] == "") header( "Location: " . $link_todo_html );
	else header( "Location: " . $link_todo_html . "?p={$_POST['id'][0]}" );
	exit();

?>