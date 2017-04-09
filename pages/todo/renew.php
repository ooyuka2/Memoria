<?php
	$todo = readCsvFile2('../data/todo.csv');
	if(!isset($_GET['p']) || $todo[$_GET['p']]['level']!=1) { // || $todo[$_GET['p']]['level']!=1
		header( "Location: Error.php" );
		exit();
	}
	date_default_timezone_set('Asia/Tokyo');
?>
  <!-- Forms
  ================================================== -->

<div class="col-xs-1"></div>
<div class="col-xs-10">
      <?php
		$todo_theme = readCsvFile2('../data/todo_theme.csv');
		//print_r($todo[$_GET['p']]);
		?>
        <form class='form-horizontal' method='post' action='todo/toroku.php'>
		<fieldset>
			<div class="well bs-component">
		        <div class="form-group">
		            <div class="col-xs-8">
		            	<div class="col-xs-12" style="margin-bottom:5px">
							<select class="form-control input-normal input-sm theme" name="theme[]">
								<?php
									$todo_theme = readCsvFile2('../data/todo_theme.csv');
									echo "<option value='0'>テーマの選択</option>";
									for($i=1;$i<count($todo_theme);$i++) {
										if($todo[$_GET['p']]['テーマ']==$i) {
											echo "<option value='{$i}' selected>{$todo_theme[$i]['テーマ']}</option>";
										} else {
											echo "<option value='{$i}'>{$todo_theme[$i]['テーマ']}</option>";//col-sm-2
										}
									}
								?>
							</select>
						</div>
						<div class="col-xs-12" style="margin-bottom:5px">
							<?php
								echo "<input type='text' class='form-control input-normal input-sm name' name='name[]' placeholder='タイトル' value='{$todo[$_GET['p']]['タイトル']}'>";
								$id=count($todo);
								echo "<input type='hidden' name='id[]' value='$id'>";
							?>
						</div>
						<div class="col-xs-12" style="margin-bottom:5px">
							<textarea class="form-control input-normal input-sm detail" rows="3" name="detail[]"><?php 
			                  	$detail = str_replace('<br>', '&#13;',$todo[$_GET['p']]['作業内容']); 
			                  	echo $detail;
			                  	?></textarea>
						</div>
						<div class="col-xs-12" style="margin-bottom:5px">
							<?php
								echo "<input type='text' class='form-control input-normal input-sm mono' name='mono[]' placeholder='成果物' value={$todo[$_GET['p']]['成果物']}>";
							?>
						</div>
						<label class="col-sm-2 control-label" style="margin-bottom:5px">レベル</label>
						<div class="col-xs-4" style="margin-bottom:5px">
							<input type='number' class='form-control input-normal input-sm level' name='level[]' value='1' min='1' max='10' readonly>
						</div>
						<label class="col-sm-2 control-label" style="margin-bottom:5px">優先度</label>
						<div class="col-xs-4" style="margin-bottom:5px">
							<?php
								echo "<input type='number' class='form-control input-normal input-sm priority' name='priority[]' value='{$todo[$_GET['p']]['優先度']}' min='1' max='10'>";
							?>
						</div>
		            </div>
		            <div class="col-xs-4">
						<div class="col-xs-12" style="margin-bottom:5px">
						<label class="control-label">納期</label>
						<?php
							$date = date('Y-m-d');;
							echo "<input type='date' class='form-control input-normal input-sm noki' name='noki[]' value='{$date}'>";
							//{$todo[$_GET['p']]['納期']}
						?>
						</div>
						<div class="col-xs-12" style="margin-bottom:5px">
							<label class="control-label">納期の時間</label>
							<?php echo "<input type='time' class='form-control input-normal input-sm time' name='time[]' value='{$todo[$_GET['p']]['納期時間']}' step='900'>"; ?>
						</div>
						<div class="col-xs-12" style="margin-bottom:5px">
							<label class="control-label">開始予定時刻</label>
							<?php 
								$date = date('Y-m-d');
								echo "<input type='date' class='form-control input-normal input-sm kaisi' name='kaisi[]' value='{$date}'>";
							
							 ?>
						</div>
						<div class="col-xs-12" style="margin-bottom:5px">
							<label class="control-label">終了予定日時</label>
							<?php 
								$date = date('Y-m-d');
								echo "<input type='date' class='form-control input-normal input-sm syuryo' name='syuryo[]' value='{$date}'>";
							 ?>
						</div>
		            </div>
		        </div>
			</div>
	    </fieldset>
	    <?php
		    for($i=1; $i<count($todo);$i++) {
		    	if($todo[$i]['top']==$_GET['p'] && $todo[$i]['level']!=1) {
		    		$detail = str_replace('<br>', '&#13;',$todo[$i]['作業内容']);
		    		$nokidate = date('Y-m-d');
		    		$startdate = date('Y-m-d');
		    		$finishdate = date('Y-m-d');
		    		echo "<fieldset><div class='well bs-component'><div class='clearfix'><span class='pull-right close' onClick='minus({$i});'>&times;</span></div><div class='form-group'><div class='col-xs-8'><div class='col-xs-12' style='margin-bottom:5px'><input type='text' class='form-control input-normal input-sm name' name='name[]' placeholder='タイトル' value='{$todo[$i]['タイトル']}'></div><div class='col-xs-12' style='margin-bottom:5px'><textarea class='form-control input-normal input-sm detail' rows='3' name='detail[]'>{$detail}</textarea></div><div class='col-xs-12' style='margin-bottom:5px'><input type='text' class='form-control input-normal input-sm mono' name='mono[]' placeholder='成果物' value={$todo[$i]['成果物']}></div><label class='col-sm-2 control-label' style='margin-bottom:5px'>レベル</label><div class='col-xs-4' style='margin-bottom:5px'><input type='number' class='form-control input-normal input-sm level' name='level[]' value='{$todo[$i]['level']}' min='2' max='10'></div><label class='col-sm-2 control-label' style='margin-bottom:5px'>優先度</label><div class='col-xs-4' style='margin-bottom:5px'><input type='number' class='form-control input-normal input-sm priority' name='priority[]' min='1' max='10' value='{$todo[$i]['優先度']}'></div></div><div class='col-xs-4'><div class='col-xs-12' style='margin-bottom:5px'><label class='control-label'>納期</label><input type='date' class='form-control input-normal input-sm noki' name='noki[]' value='{$nokidate}'></div><div class='col-xs-12' style='margin-bottom:5px'><label class='control-label'>納期の時間</label><input type='time' class='form-control input-normal input-sm time' name='time[]' step='900' value='{$todo[$i]['納期時間']}'></div><div class='col-xs-12' style='margin-bottom:5px'><label class='control-label'>開始予定時刻</label><input type='date' class='form-control input-normal input-sm kaisi' name='kaisi[]' value='{$startdate}'></div><div class='col-xs-12' style='margin-bottom:5px'><label class='control-label'>終了予定日時</label><input type='date' class='form-control input-normal input-sm syuryo' name='syuryo[]' value='{$finishdate}'></div></div></div></div><div class='form-group' style='margin-bottom:0; position: fixed; bottom: 50px;right:0;width:500px;'></div></fieldset>";
		    	}
		    }
	    ?>
	    
	    
	    
	    <div class="new"></div>
	    <div class="form-group">
	    	<button class="btn btn-success center-block" type="button" onClick='plus();'><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>　追加</button>
	    </div>
	    
        <div class="form-group" style="margin-bottom:0; position: fixed; bottom: 50px;right:0;width:500px;">
            <div class="col-xs-offset-3 col-xs-3">
                <button type="reset" class="btn btn-default btn-block">Reset</button>
            </div>
			<div class="col-xs-3">
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </div>
        </div>
        <div style="height: 100px"></div>
    </form>
</div>

