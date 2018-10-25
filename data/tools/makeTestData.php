<?php
	//session_start();
	header("Content-type: text/html; charset=SJIS-win");
	if(!isset($ini)) $ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
	include_once($ini['dirWin'].'/pages/function.php');
	
	$TodayS = date('Ymd');
	$today = new DateTime($TodayS);

	$todofile = $ini['dirWin'].'/data/todo.csv';
	$theme = readCsvFile2($ini['dirWin'].'/data/todo_keeper_theme.csv');
	
	$todo_old = readCsvFile2($todofile);
	$todo[0] = $todo_old[0];
	
	$id = 1;
	for($i=1; $i<count($theme); $i++) {
		
		$temp = rand(-20, 100);
		$temp2 = rand($temp, ($temp+25));
		$start = new DateTime($TodayS);
		$noki = new DateTime($TodayS);
		if($temp>=0) $start->modify('+ '.$temp.' days');
		else $start->modify('- '.abs($temp).' days');
		if($temp2 >= 0) $noki->modify('+ '.$temp2.' days');
		else $noki->modify('- '.abs($temp2).' days');
		

		$todo[$id]['id'] = $id;
		$todo[$id]['�^�C�g��'] = $theme[$i]['�e�[�}'];
		$todo[$id]['��Ɠ��e'] = $theme[$i]['�e�[�}']."�̍�Ɠ��e";
		$todo[$id]['�[��'] = $noki->format('Y/m/d');
		$todo[$id]['�[������'] = "18:00";
		$todo[$id]['�J�n�\���'] = $start->format('Y/m/d');
		$todo[$id]['�I���\���'] = $noki->format('Y/m/d');
		$todo[$id]['�p�[�Z���e�[�W'] = 0;
		$todo[$id]['����'] = 0;
		$todo[$id]['����'] = "no comment";
		$todo[$id]['level'] = 1;
		$todo[$id]['top'] = $id;
		$todo[$id]['parent'] = 0;
		$todo[$id]['child'] = 5;
		$todo[$id]['���ʕ�'] = "���ʕ�";
		$todo[$id]['�e�[�}'] = 0;
		$todo[$id]['�D��x'] = 1;
		$todo[$id]['�o�^��'] = date('Y/m/d H:i:s');
		$todo[$id]['�ۗ�'] = 0;
		$todo[$id]['�폜'] = 0;
		$todo[$id]['���ԊǗ��e�[�}'] = $theme[$i]['id'];
		$todo[$id]['����'] = 0;
		$todo[$id]['������邱��'] = 0;
		$id++;
	}
	$temp = rand(5, 20);
	for($i=1; $i<$temp; $i++) {
		
		$temp = rand(-20, 100);
		$temp2 = rand($temp, ($temp+25));
		$start = new DateTime($TodayS);
		$noki = new DateTime($TodayS);
		if($temp>=0) $start->modify('+ '.$temp.' days');
		else $start->modify('- '.abs($temp).' days');
		if($temp2 >= 0) $noki->modify('+ '.$temp2.' days');
		else $noki->modify('- '.abs($temp2).' days');
		
		$todo[$id]['id'] = $id;
		$todo[$id]['�^�C�g��'] = $id. "�@�@�e�[�}�O�̍��";
		$todo[$id]['��Ɠ��e'] = $theme[18]['�e�[�}']."�̍�Ɠ��e";
		$todo[$id]['�[��'] = $noki->format('Y/m/d');
		$todo[$id]['�[������'] = "18:00";
		$todo[$id]['�J�n�\���'] = $start->format('Y/m/d');
		$todo[$id]['�I���\���'] = $noki->format('Y/m/d');
		$todo[$id]['�p�[�Z���e�[�W'] = 0;
		$todo[$id]['����'] = 0;
		$todo[$id]['����'] = "no comment";
		$todo[$id]['level'] = 1;
		$todo[$id]['top'] = $id;
		$todo[$id]['parent'] = 0;
		$todo[$id]['child'] = 0;
		$todo[$id]['���ʕ�'] = "���ʕ�";
		$todo[$id]['�e�[�}'] = 0;
		$todo[$id]['�D��x'] = 1;
		$todo[$id]['�o�^��'] = date('Y/m/d H:i:s');
		$todo[$id]['�ۗ�'] = 0;
		$todo[$id]['�폜'] = 0;
		$todo[$id]['���ԊǗ��e�[�}'] = 40;
		$todo[$id]['����'] = 0;
		$todo[$id]['������邱��'] = 0;
		$id++;
	}
	for($j=0;$j<5;$j++) {
		for($i=1; $i<count($theme); $i++) {
			$todo[$id]['id'] = $id;
			$todo[$id]['�^�C�g��'] = "1-".$j."�@".$theme[$i]['�e�[�}'];
			$todo[$id]['��Ɠ��e'] = $theme[$i]['�e�[�}']."�̍�Ɠ��e";
			$todo[$id]['�[��'] = $todo[$i]['�[��'];
			$todo[$id]['�[������'] = "18:00";
			$todo[$id]['�J�n�\���'] = $todo[$i]['�J�n�\���'];
			$todo[$id]['�I���\���'] = $todo[$i]['�I���\���'];
			$todo[$id]['�p�[�Z���e�[�W'] = 0;
			$todo[$id]['����'] = 0;
			$todo[$id]['����'] = "no comment";
			$todo[$id]['level'] = 2;
			$todo[$id]['top'] = $i;
			$todo[$id]['parent'] = $i;
			$todo[$id]['child'] = 0;
			$todo[$id]['���ʕ�'] = "���ʕ�";
			$todo[$id]['�e�[�}'] = 0;
			$todo[$id]['�D��x'] = 1;
			$todo[$id]['�o�^��'] = date('Y/m/d H:i:s');
			$todo[$id]['�ۗ�'] = 0;
			$todo[$id]['�폜'] = 0;
			$todo[$id]['���ԊǗ��e�[�}'] = 0;
			$todo[$id]['����'] = ($j+1);
			$todo[$id]['������邱��'] = 0;
			$id++;
		}
	}
	while($id<501) {
		$temp = rand(1, (count($todo) -1));
		//$temp = 98;
		if($todo[$temp]['level'] != 0) {
			$todo = plusnewtodo($todo, $id, $temp);
			$id++;
		}
		//echo count($todo)."<br><br>";
	}
	
	writeCsvFile2($todofile, $todo);
	
	$txt = 'file,id,day,per,startTime,finishTime,keeper,note'."\r\n".'todo,periodically,"2018/07/16 17:23:04",0,11:00,11:30,60,���̂�';
	file_put_contents($ini['dirWin'].'/data/working.csv', $txt);
	$txt = 'todoid,�e�[�}�T�v,KPI,�S��,�ς�,�i��,"����̗\��",parentid,�ŏI�X�V����,"�\��"'."\r\n".'13,test1<br>�C���V�f���g�֘A�e�[�}�T�v,�C���V�f���g�֘AKPI,����,�C���V�f���g<br>�ς�,�C���V�f���g�֘A<br>�i��,"�C���V�f���g�֘A<br>����̗\��",13,"2018/07/10 17:15:46",0'."\r\n".'15,�T�[�r�X�֘A�e�[�}�T�v,�T�[�r�X�֘AKPI,����,�T�[�r�X�֘A<br>�ς�,�T�[�r�X<br>�֘A�i��,"�T�[�r�X�֘A<br>����̗\��",15,"2018/07/10 17:15:46",0';
	file_put_contents($ini['dirWin'].'/data/weekly.csv', $txt);
	
	function plusnewtodo($todo, $id, $pre) {
		$todo[$id]['id'] = $id;
		$level = ($todo[$pre]['level'] + 1);
		$temp = ($todo[$pre]['child'] + 1);
		$todo[$id]['�^�C�g��'] =  ($level-1)."-".$temp."�@".$todo[$todo[$pre]['top']]['�^�C�g��'];
		$todo[$id]['��Ɠ��e'] = $todo[$id]['�^�C�g��']."�̍�Ɠ��e";
		$todo[$id]['�[��'] = $todo[$pre]['�[��'];
		$todo[$id]['�[������'] = "18:00";
		$todo[$id]['�J�n�\���'] = $todo[$pre]['�J�n�\���'];
		$todo[$id]['�I���\���'] = $todo[$pre]['�I���\���'];
		$todo[$id]['�p�[�Z���e�[�W'] = 0;
		$todo[$id]['����'] = 0;
		$todo[$id]['����'] = "no comment";
		$todo[$id]['level'] = $level;
		$todo[$id]['top'] = $todo[$pre]['top'];
		$todo[$id]['parent'] = $todo[$pre]['id'];
		$todo[$id]['child'] = 0;
		$todo[$id]['���ʕ�'] = "���ʕ�";
		$todo[$id]['�e�[�}'] = 0;
		$todo[$id]['�D��x'] = 1;
		$todo[$id]['�o�^��'] = date('Y/m/d H:i:s');
		$todo[$id]['�ۗ�'] = 0;
		$todo[$id]['�폜'] = 0;
		$todo[$id]['���ԊǗ��e�[�}'] = 0;
		$todo[$id]['����'] = ($todo[$pre]['����'] + 1);
		$todo[$id]['������邱��'] = 0;
		
		$todo[$todo[$pre]['id']]['child'] = $temp;

		$todo = renumberid($todo, $id);
		return $todo;
	}
	
	function renumberid($todo, $id) {
		for($i=1; $i<count($todo); $i++) {
			if($todo[$id]['top'] == $todo[$i]['top'] && $todo[$i]['����'] >= $todo[$id]['����'] && $id != $i) $todo[$i]['����'] = ($todo[$i]['����'] + 1);
		}
		
		return $todo;
	}
	//121
?>
