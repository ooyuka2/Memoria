<?php
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\data\config.ini');
	//include_once($ini['dirWin'].'/pages/function.php');
	//include($ini['dirWin'].'/pages/hedder.php');
	
	//$ini['dirhtml']="/Memoria"
	//$ini['dirWin']="C:/xampp/htdocs/Memoria"
	
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
?>