<?php
	include("todo_make.php");
?>
<!--<?php
	$todo = readCsvFile2('../data/todo.csv');
	$todo_theme = readCsvFile2('../data/todo_theme.csv');
	$todo_keeper_theme = readCsvFile2('../data/todo_keeper_theme.csv');
?>

<div class="col-xs-1"></div>
<div class="col-xs-10">
        <form class='form-horizontal' method='post' action='todo/toroku.php'>

<?php
	include("todo_make.php");
	todo_fieldset($todo, $todo_theme, $todo_keeper_theme, 1, "new", count($todo));
?>


	    <div class="new"></div>
	    <div class="form-group">
	    	<button class="btn btn-success center-block" type="button" onClick='plus();'><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>Å@í«â¡</button>
	    </div>
	    
        <div class="form-group" style="margin-bottom:0; position: fixed; bottom: 20px;right:0;width:500px;">
            <div class="col-xs-offset-3 col-xs-3">
                <button type="reset" class="btn btn-default btn-block">Reset</button>
            </div>
			<div class="col-xs-3">
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </div>
			<div class="col-xs-offset-3 col-xs-6" style="margin-top:10px">
                <button type="button" class="btn btn-info btn-block btn-xs" onClick="setDateTime()">Set DateTime</button>
            </div>
        </div>
        <div style="height: 100px"></div>
    </form>
</div>

-->