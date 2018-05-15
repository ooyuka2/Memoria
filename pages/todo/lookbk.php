<?php
	session_start();
	if(!isset($_SESSION['todofile'])) {
		
		$_SESSION['todofile'] = "old201804";
	}
	else unset($_SESSION['todofile']);
	
	header( "Location: /Memoria/pages/todo.php?list=finishlist" );
	exit();
	
?>