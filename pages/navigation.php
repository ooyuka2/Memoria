<header>
	<div class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<a href="./"class="navbar-brand">
					<img src='../img/logo.png' alt='Memoria' style="width:auto;height:300%;position:relative;bottom:25px;">
				</a>
				<button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div class="navbar-collapse collapse" id="navbar-main">
				<ul class="nav navbar-nav">
				<?php
					echo "<li class='top'><a href='".$ini['dirhtml']."/pages/'><span class='glyphicon glyphicon-home' aria-hidden='true' style='font-size:120%;'></span></a></li>";
					echo "<li class='todo'><a href='".$ini['dirhtml']."/pages/todo.php'><span class='glyphicon glyphicon-tasks' aria-hidden='true' style='font-size:120%;'></span> ToDo</a></li>";
					echo "<li class='file'><a href='".$ini['dirhtml']."/pages/file.php'><span class='glyphicon glyphicon-file' aria-hidden='true' style='font-size:120%;'></span> file</a></li>";
					echo "<li class='dictionary'><a href='".$ini['dirhtml']."/pages/dictionary.php'><span class='glyphicon glyphicon-book' aria-hidden='true' style='font-size:120%;'></span> Dictionary</a></li>";
					echo "<li class='tools'><a href='".$ini['dirhtml']."/pages/tools.php'><span class='glyphicon glyphicon-cog' aria-hidden='true' style='font-size:120%;'></span> tools</a></li>";
					echo "<li class='setting'><a href='".$ini['dirhtml']."/pages/settings.php'><span class='glyphicon glyphicon-cog' aria-hidden='true' style='font-size:120%;'></span> Setting</a></li>";
				?>
				</ul>
			</div>
		</div>
	</div>
</header>


