<?php
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\data\config.ini');
	
	//include_once($ini['dirWin'].'/pages/function.php');
	//include($ini['dirWin'].'/pages/hedder.php');
	
	//$ini['dirhtml']="/Memoria"
	//$ini['dirWin']="C:/xampp/htdocs/Memoria"
	
	//data�t�H���_
	$link_data = $ini['dirWin'] . "/data/";
	
	
	if(!isset($pagetype)) $pagetype = "pages";
	
	if($pagetype == "pages") {
		if( $ini['csstype'] == "white") $ini['csstype'] = "niko";
		//css�t�@�C���̃��[�g
		
		//css�t�@�C���̃����N
		
		//js�t�@�C���̃��[�g
		
		//js�t�@�C���̃����N

		//page�ւ̃����N
		$link_pages_html = $ini['dirhtml'] . "/pages/";
		$link_pages_Win = $ini['dirWin'] . "/pages/";
		
		//function�y�[�W�ւ̃����N
		$link_function = $link_pages_Win . "functionpages.php";
		
	} else if($pagetype == "MDBpages") {
		if($_SERVER['SERVER_ADDR'] != $_SERVER['REMOTE_ADDR']) {
			$ini['csstype'] = "umi";
		}
		//css�t�@�C���̃��[�g
		$link_css = $ini['dirhtml']."/img/bootstrap4/MDB/css/";
		$link_bootstrap_type_css = $ini['dirhtml']."/img/bootstrap4/honoka/css/";
		
		//js�t�@�C���̃��[�g
		$link_js = $ini['dirhtml']."/img/bootstrap4/MDB/js/";
		$link_bootstrap_type_js = $ini['dirhtml']."/img/bootstrap4/honoka/js/";
		
		//css�t�@�C���̃����N
		$link_drawer_css = $link_css. "drawer.min.css";
		$link_bootstrap_css = $link_bootstrap_type_css. "bootstrap.min.css";
		$link_mdb_css = $link_css. "mdb.css";
		$link_style_css = $link_css. "style.css";
		$link_color_css = $link_css. $ini['csstype'] . ".css";
		$link_datatable_css = $link_js. "addons/datatables.min.css";
		
		
		//js�t�@�C���̃����N
		$link_iscroll_js = $link_js. "iscroll.min.js";
		$link_drawer_js = $link_js. "drawer.min.js";
		$link_jquery = $link_js. "jquery-3.3.1.min.js";
		$link_bootstrap_js = $link_bootstrap_type_js. "bootstrap.min.js";
		$link_popper_js = $link_js. "popper.min.js";
		$link_mdb_js = $link_js. "mdb.min.js";
		$link_datatable_js = $link_js. "addons/datatables.js";
		$link_datatable_js = $ini['dirhtml'] . "/DataTables/datatables.js";
		$link_javascript_js = $ini['dirhtml'] . "/js/javascript.js";
		$link_javascriptpages_js = $ini['dirhtml'] . "/js/javascriptMDBpages.js";
		
		//mdbpage�ւ̃����N
		$link_pages_html = $ini['dirhtml'] . "/MDBpages/";
		$link_pages_Win = $ini['dirWin'] . "/MDBpages/";
		
		//function�y�[�W�ւ̃����N
		$link_function = $link_pages_Win . "functionpages.php";
	
	}
	
	//todo�y�[�W�ւ̃����N
	$link_todo_html = $link_pages_html . "todo.php";
	$link_todo_Win = $link_pages_Win . "todo.php";
	
	//todo�y�[�W�̏T��w�����N
	if($pagetype == "pages") {
		$link_todo_weekly_html = $link_todo_html . "?d=weekly";

	} else if($pagetype == "MDBpages") {
		$link_todo_weekly_html = $link_todo_html . "?page=weekly";
	}
	
	$link_todo_tree_Win =  $link_pages_Win . "todo/todo_tree.php";
	
	//link�y�[�W�ւ̃����N
	$link_link_html = $link_pages_html . "file.php";
	$link_link_Win = $link_pages_Win . "file.php";
	
	//�ݒ�y�[�W�ւ̃����N
	$link_settings_html = $link_pages_html . "settings.php";
	$link_settings_Win = $link_pages_Win . "settings.php";
	
?>