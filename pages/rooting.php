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
	
		//css�t�@�C���̃��[�g
		$link_css = $ini['dirhtml']."/img/bootstrap4/MDB/css/";
		$link_bootstrap_type_css = $ini['dirhtml']."/img/bootstrap4/". $ini['csstype'] . "/css/";
		
		//css�t�@�C���̃����N
		$link_drawer_css = $link_css. "drawer.min.css";
		$link_bootstrap_css = $link_bootstrap_type_css. "bootstrap.min.css";
		$link_mdb_css = $link_css. "mdb.css";
		$link_style_css = $link_css. "style.css";
		
		
		//js�t�@�C���̃��[�g
		$link_js = $ini['dirhtml']."/img/bootstrap4/MDB/js/";
		$link_bootstrap_type_js = $ini['dirhtml']."/img/bootstrap4/". $ini['csstype'] . "/js/";
		
		//js�t�@�C���̃����N
		$link_iscroll_js = $link_js. "iscroll.min.js";
		$link_drawer_js = $link_js. "drawer.min.js";
		$link_jquery = $link_js. "jquery-3.3.1.min.js";
		$link_bootstrap_js = $link_bootstrap_type_js. "bootstrap.min.js";
		$link_popper_js = $link_js. "popper.min.js";
		$link_mdb_js = $link_js. "mdb.min.js";
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
	
	$link_todo_tree_Win =  $link_pages_Win . "todo/todo_tree.php";
?>