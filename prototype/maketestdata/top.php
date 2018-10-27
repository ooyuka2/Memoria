<?php
	if(!isset($ini)) $ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
?>

<div class="col-lg-12">
	
	<div class="bs-component">
		<ul class="nav nav-tabs">
		<?php
			echo "<li class='nav-item' onclick='read_tool_php2(\"".$ini['dirhtml']."/prototype/maketestdata/tools.php\", \"toolstab\")' id='toolstab'><a class='nav-link active'>tools</a></li>";
			echo "<li class='d-none nav-item' onclick='' id='resulttab'><a class='nav-link'>Œ‹‰Ê•\Ž¦</a></li>";
			
		?>
		</ul>
		<div style='width:95%; margin: auto'><!-- class='col-md-offset-1 col-md-10 col-sm-12' -->
			<div id="prototypeTabContent" class="tab-content">
	<?php
			echo "<div class='tab-pane fade show active' id='tools2' style='min-height:700px; margin-top: 20px;'>";
			echo "</div>";
	?>
			</div>
		</div>
	</div>
</div>
