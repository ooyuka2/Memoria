<?php
	if(!isset($ini)) $ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
?>

<div class="row">
	<div class="col-lg-12">
		<p id="nav-tabs"></p>
		<div class="bs-component">
			<p id="nav-tabs"></p>
			<ul class="nav nav-tabs clearfix">
			<?php
				echo "<li class='active' onclick='read_tool_php(\"".$ini['dirhtml']."/pages/tools/tools.php\", \"toolstab\")' id='toolstab'><a>tools</a></li>";
				echo "<li onclick='' id='resulttab'><a>Œ‹‰Ê•\Ž¦</a></li>";
				echo "<li onclick='read_tool_php(\"".$ini['dirhtml']."/pages/tools/tools/compare_form.php\", \"comparetab\")' id='comparetab'><a>”äŠrƒc[ƒ‹</a></li>";
				echo "<li onclick='read_tool_php(\"".$ini['dirhtml']."/pages/tools/tools/read_md.php\", \"read_mdtab\")' id='read_mdtab'><a>MarkDown‚Å“Ç‚Ýž‚Ý</a></li>";
				echo "<li onclick='read_tool_php(\"".$ini['dirhtml']."/pages/tools/tools/read_phpfunction_memo.php\", \"memotab\")' id='memotab'><a>phpŠÖ”ƒƒ‚</a></li>";
				echo "<li onclick='read_tool_php(\"".$ini['dirhtml']."/pages/tools/tools/read_phpfunction_memo.php\", \"Programtab\")' id='Programtab'><a>Program</a></li>";
				
				
			?>
			</ul>
			<div style='width:95%; margin: auto'><!-- class='col-md-offset-1 col-md-10 col-sm-12' -->
				<div id="myTabContent" class="tab-content">
		<?php
				echo "<div class='tab-pane fade active in' id='tools' style='min-height:700px'>";
				echo "</div>";
		?>
			</div>
		</div>
	</div>
</div>

<?php


?>