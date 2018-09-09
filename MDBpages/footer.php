	<!-- SCRIPTS -->
	<!-- JQuery -->
	<?php
		echo '<script type="text/javascript" src="' . $link_jquery .'"></script>';
	?>
	<!-- Tooltips -->
	<?php
		echo '<script type="text/javascript" src="' . $link_popper_js .'"></script>';
	?>
	<!-- Bootstrap core JavaScript -->
	<?php
		echo '<script type="text/javascript" src="' . $link_bootstrap_js .'"></script>';
	?>
	<!-- MDB core JavaScript -->
	<?php
		echo '<script type="text/javascript" src="' . $link_mdb_js .'"></script>';
	?>
	<!-- jquery & iScroll -->
	<?php
		echo '<script type="text/javascript" src="' . $link_iscroll_js .'"></script>';
	?>
	<!-- drawer.js -->
	<?php
		echo '<script type="text/javascript" src="' . $link_drawer_js .'"></script>';
	?>
	<script>
		
	$(document).ready(function() {
		// Drawer読み込み
		$('.drawer').drawer();
		
		if($('.activenav').length) {
			$('.activenav').find('li').slideToggle(500);
			document.getElementsByClassName('activenav')[0].children[0].children[1].classList.toggle("fa-angle-down");
			document.getElementsByClassName('activenav')[0].children[0].children[1].classList.toggle("fa-angle-up");
		}
		// ドロワーメニューが開いたとき
		$('.drawer').on('drawer.opened', function(){
			//alert('ドロワーが開きました');
			
		});
	 
		// ドロワーメニューが閉じたとき
		$('.drawer').on('drawer.closed', function(){
			//alert('ドロワーが閉じられました');
			 $(".drawer-hamburger").css("display","");
		});
	});
	
	function navToggle(element) {
		$(element).parent().find('li').slideToggle(500);
		element.children[1].classList.toggle("fa-angle-down");
		element.children[1].classList.toggle("fa-angle-up");
	}


	</script>