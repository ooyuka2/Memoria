<?php
	$todo = readCsvFile2('../data/todo.csv');
	$navTodoCount = 0;
	for($i=1; $i<count($todo); $i++) {
		date_default_timezone_set('Asia/Tokyo');
		$day1 = new DateTime($todo[$i]['開始予定日']);
		$day2 = new DateTime(date('Y/m/d'));
		$interval = $day1->diff($day2);
		if($todo[$i]['完了']==0 && $interval->format('%r%a 日')>=0 && $todo[$i]['保留']==0 && $todo[$i]['child']==0 && $todo[$i]['削除']==0) {
			$navTodoCount++;
		}
	}
	//$navTodoCount = 0;
?>
<header>
  <div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <a href="./"class="navbar-brand">
        	<img src='../img/logo.png' alt='Memoria' style="width:auto;height:500%;position:relative;bottom:45px;">
        </a>
        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      <div class="navbar-collapse collapse" id="navbar-main">
        <ul class="nav navbar-nav">
          <li class="top"><a href="./">	<span class="glyphicon glyphicon-home" aria-hidden="true" style='font-size:120%;'></span></a></li>
          <li class="todo"><a href="./todo.php"><span class="glyphicon glyphicon-tasks" aria-hidden="true" style='font-size:120%;'></span> ToDo　<span class="badge"><?php echo $navTodoCount; ?></span></a></li>
          <li class="dictionary"><a href="./dictionary.php"><span class="glyphicon glyphicon-book" aria-hidden="true" style='font-size:120%;'></span> Dictionary</a></li>
          <li class="setting"><a href="./settings.php"><span class="glyphicon glyphicon-cog" aria-hidden="true" style='font-size:120%;'></span> Setting</a></li>
          
        </ul>
      </div>
    </div>
  </div>
</header>


