<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="/Memoria/js/javascript.js"></script>
<script type="text/javascript">
$(function () {
  $('[data-toggle="popover"]').popover();
  $('[data-toggle="tooltip"]').tooltip();
});
</script>
<?php
	include('setting.php');
	echo '<script src="../'.$color.'/js/bootstrap.min.js"></script>';
?>