<?php
	if(!isset($ini)) $ini = parse_ini_file(dirname ( __FILE__ ).'\..\..\data\config.ini');
?>

<div class="col-lg-12">
	
	<div class="bs-component">
		<ul class="nav nav-tabs">
		<?php
			echo "<li class='nav-item' onclick='read_tool_php(\"".$ini['dirhtml']."/pages/tools/tools.php\", \"toolstab\")' id='toolstab'><a class='nav-link active'>tools</a></li>";
			echo "<li class='d-none nav-item' onclick='' id='resulttab'><a class='nav-link'>結果表示</a></li>";
			echo "<li class='nav-item' onclick='read_tool_php(\"".$ini['dirhtml']."/pages/tools/tools/compare_form.php\", \"comparetab\")' id='comparetab'><a class='nav-link'>比較ツール</a></li>";
			
			echo "<li class='nav-item' onclick='read_tool_php(\"".$ini['dirhtml']."/pages/tools/tools/read_phpfunction_memo.php\", \"memotab\")' id='memotab'><a class='nav-link'>php関数メモ</a></li>";
			echo "<li class='nav-item' onclick='read_tool_php(\"".$ini['dirhtml']."/pages/tools/tools/playground.php\", \"Programtab\")' id='Programtab'><a class='nav-link'>Program</a></li>";
			echo "<li class='nav-item' onclick='read_tool_php(\"".$ini['dirhtml']."/pages/tools/tools/read_md.php\", \"read_mdtab\")' id='read_mdtab'><a class='nav-link'>MarkDownで読み込み（印刷用）</a></li>";
			
		?>
		</ul>
		<div style='width:95%; margin: auto'><!-- class='col-md-offset-1 col-md-10 col-sm-12' -->
			<div id="myTabContent" class="tab-content">
	<?php
			echo "<div class='tab-pane fade show active' id='tools' style='min-height:700px; margin-top: 20px;'>";
			echo "</div>";
	?>
			</div>
		</div>
	</div>
</div>
