<?php
	$ini = parse_ini_file(dirname ( __FILE__ ).'\..\data\config.ini');
	
	
	//dataフォルダ
	$link_data = $ini['dirWin'] . "/prototype/data/";
	
	
		if(!isset($_SESSION['staff'])) {
			$csstype = "umi";
		} else {
			$csstype = $_SESSION['staff']['style'];
		}
		//cssファイルのルート
		$link_css = $ini['dirhtml']."/img/bootstrap4/MDB/css/";
		$link_bootstrap_type_css = $ini['dirhtml']."/img/bootstrap4/honoka/css/";
		
		//jsファイルのルート
		$link_js = $ini['dirhtml']."/img/bootstrap4/MDB/js/";
		$link_bootstrap_type_js = $ini['dirhtml']."/img/bootstrap4/honoka/js/";
		
		//cssファイルのリンク
		$link_drawer_css = $link_css. "drawer.min.css";
		$link_bootstrap_css = $link_bootstrap_type_css. "bootstrap.min.css";
		$link_mdb_css = $link_css. "mdb.css";
		$link_style_css = $link_css. "style.css";
		$link_color_css = $link_css. $csstype . ".css";
		$link_datatable_css = $link_js. "addons/datatables.min.css";
		
		
		//jsファイルのリンク
		$link_iscroll_js = $link_js. "iscroll.min.js";
		$link_drawer_js = $link_js. "drawer.min.js";
		$link_jquery = $link_js. "jquery-3.3.1.min.js";
		$link_bootstrap_js = $link_bootstrap_type_js. "bootstrap.min.js";
		$link_popper_js = $link_js. "popper.min.js";
		$link_mdb_js = $link_js. "mdb.min.js";
		$link_datatable_js = $link_js. "addons/datatables.min.js";
		//$link_datatable_js = $ini['dirhtml'] . "/DataTables/datatables.js";
		$link_javascript_js = $ini['dirhtml'] . "/js/javascript.js";
		$link_javascriptpages_js = $ini['dirhtml'] . "/js/javascriptMDBpages.js";
		
		//mdbpageへのリンク
		$link_pages_html = $ini['dirhtml'] . "/prototype/";
		$link_pages_Win = $ini['dirWin'] . "/prototype/";
		
		//functionページへのリンク
		$link_function = $link_pages_Win . "functionpages.php";
		
		$link_settings_html = $link_pages_html . "settings.php";
		$link_system_html  = $link_pages_html . "system.php";
		$link_work_html  = $link_pages_html . "work.php";

	
?>