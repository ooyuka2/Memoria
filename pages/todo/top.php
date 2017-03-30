<?php
	$todo = readCsvFile2('../data/todo.csv');
?>

<div class="row">
	<div class="col-lg-12">
		<div class="bs-component">
			<p id="nav-tabs"></p>
			<?php
				for($i=0; $i<count($todo); $i++) {
					if($todo[$i]['level'] == 1 && $todo[$i]['完了']==0) {
						echo "<div class='panel panel-primary'>";
						echo "<div class='panel-heading'>";
						echo "<h3 class='panel-title'>{$todo[$i]['タイトル']}</h3>";
						echo "</div>";
						echo "<div class='panel-body'>";
						echo "{$todo[$i]['作業内容']}<br>";
						echo "<div class='col-xs-11'><div class='progress'><div class='progress-bar progress-bar-info progress-bar-striped active' role='progressbar' style='width: {$todo[$i]['パーセンテージ']}%;'>";
						echo "{$todo[$i]['パーセンテージ']}%";
						echo "</div></div></div>";
						echo "<div class='col-xs-1'><a href='#' class='btn btn-primary'>完了</a></div>";//todo.php?page=finish
						echo "</div>";
						echo "<div class='panel-footer'>{$todo[$i]['開始予定日']}　～　{$todo[$i]['納期']}</div>";
						echo "</div>";
					}
				}
			?>
		</div>
	</div>
</div>