<?php
	$todo = readCsvFile2('../data/todo.csv');
	if(!isset($_GET['p']) || $todo[$_GET['p']]['level']!=1) { // || $todo[$_GET['p']]['level']!=1
		header( "Location: Error.php" );
		exit();
	}
?>
  <!-- Forms
  ================================================== -->


</form>
<div class="col-xs-1"></div>
<div class="col-xs-10">
      <?php
		$todo_theme = readCsvFile2('../data/todo_theme.csv');
		//print_r($todo[$_GET['p']]);
		?>
        <form class='form-horizontal' method='post' action='todo/toroku2.php' name='changetodo'>
		<fieldset>
			<div class="well bs-component">
		        <div class="form-group">
		            <div class="col-xs-8">
		            	<div class="col-xs-12" style="margin-bottom:5px">
							<select class="form-control input-normal input-sm theme" name="theme[]">
								<?php
									$todo_theme = readCsvFile2('../data/todo_theme.csv');
									echo "<option value='0'>�e�[�}�̑I��</option>";
									for($i=1;$i<count($todo_theme);$i++) {
										if($todo[$_GET['p']]['�e�[�}']==$i) {
											echo "<option value='{$i}' selected>{$todo_theme[$i]['�e�[�}']}</option>";
										} else {
											echo "<option value='{$i}'>{$todo_theme[$i]['�e�[�}']}</option>";//col-sm-2
										}
									}
								?>
							</select>
						</div>
						<div class="col-xs-12" style="margin-bottom:5px">
							<?php
								echo "<input type='text' class='form-control input-normal input-sm name' name='name[]' placeholder='�^�C�g��' value='{$todo[$_GET['p']]['�^�C�g��']}'>";
								$id=count($todo);
							?>
						</div>
						<div class="col-xs-12" style="margin-bottom:5px">
							<textarea class="form-control input-normal input-sm detail" rows="3" name="detail[]"><?php 
			                  	$detail = str_replace('<br>', '&#13;',$todo[$_GET['p']]['��Ɠ��e']); 
			                  	echo $detail;
			                  	?></textarea>
						</div>
						<div class="col-xs-12" style="margin-bottom:5px">
							<?php
								echo "<input type='text' class='form-control input-normal input-sm mono' name='mono[]' placeholder='���ʕ�' value={$todo[$_GET['p']]['���ʕ�']}>";
							?>
						</div>
						<label class="col-sm-2 control-label" style="margin-bottom:5px">���x��</label>
						<div class="col-xs-3" style="margin-bottom:5px">
							<input type='number' class='form-control input-normal input-sm level' name='level[]' value='1' min='1' max='10' readonly>
						</div>
						<label class="col-sm-2 control-label" style="margin-bottom:5px">�D��x</label>
						<div class="col-xs-3" style="margin-bottom:5px">
							<?php
								echo "<input type='number' class='form-control input-normal input-sm priority' name='priority[]' value='{$todo[$_GET['p']]['�D��x']}' min='1' max='10'>";
							?>
						</div>
						<div class="col-xs-2" style="margin-bottom:5px">
							<input type='text' class='form-control input-normal input-sm' name='ids[]' value='<?php echo $_GET['p']; ?>' readonly>
						</div>
		            </div>
		            <div class="col-xs-4">
						<div class="col-xs-12" style="margin-bottom:5px">
						<label class="control-label">�[��</label>
						<?php
							$date = date('Y-m-d',  strtotime($todo[$_GET['p']]['�[��']));
							echo "<input type='date' class='form-control input-normal input-sm noki' name='noki[]' value='{$date}'>";
							//{$todo[$_GET['p']]['�[��']}
						?>
						</div>
						<div class="col-xs-12" style="margin-bottom:5px">
							<label class="control-label">�[���̎���</label>
							<?php echo "<input type='time' class='form-control input-normal input-sm time' name='time[]' value='{$todo[$_GET['p']]['�[������']}' step='900'>"; ?>
						</div>
						<div class="col-xs-12" style="margin-bottom:5px">
							<label class="control-label">�J�n�\�莞��</label>
							<?php 
								$date = date('Y-m-d',  strtotime($todo[$_GET['p']]['�J�n�\���']));
								echo "<input type='date' class='form-control input-normal input-sm kaisi' name='kaisi[]' value='{$date}'>";
							
							 ?>
						</div>
						<div class="col-xs-12" style="margin-bottom:5px">
							<label class="control-label">�I���\�����</label>
							<?php 
								$date = date('Y-m-d',  strtotime($todo[$_GET['p']]['�I���\���']));
								echo "<input type='date' class='form-control input-normal input-sm syuryo' name='syuryo[]' value='{$date}'>";
							 ?>
						</div>
		            </div>
		        </div>
			</div>
	    </fieldset>
	    <div class='new'>
	    <?php
	    	$count=1;
		    for($i=1; $i<count($todo);$i++) {
		    	if($todo[$i]['top']==$_GET['p'] && $todo[$i]['level']!=1) {
		    		$detail = str_replace('<br>', '&#13;',$todo[$i]['��Ɠ��e']);
		    		$nokidate = date('Y-m-d',  strtotime($todo[$_GET['p']]['�[��']));
		    		$startdate = date('Y-m-d',  strtotime($todo[$_GET['p']]['�J�n�\���']));
		    		$finishdate = date('Y-m-d',  strtotime($todo[$_GET['p']]['�I���\���']));
		    		echo "<fieldset><div class='well bs-component'><div class='clearfix'><span class='pull-right close' onClick='minus({$count});'>&times;</span><span class='pull-right close'>�@</span><span class='pull-right close' onClick='plus2({$count});'>+</span></div><div class='form-group'><div class='col-xs-8'><div class='col-xs-12' style='margin-bottom:5px'><input type='text' class='form-control input-normal input-sm name' name='name[]' placeholder='�^�C�g��' value='{$todo[$i]['�^�C�g��']}'></div><div class='col-xs-12' style='margin-bottom:5px'><textarea class='form-control input-normal input-sm detail' rows='3' name='detail[]'>{$detail}</textarea></div><div class='col-xs-12' style='margin-bottom:5px'><input type='text' class='form-control input-normal input-sm mono' name='mono[]' placeholder='���ʕ�' value={$todo[$i]['���ʕ�']}></div><label class='col-sm-2 control-label' style='margin-bottom:5px'>���x��</label><div class='col-xs-3' style='margin-bottom:5px'><input type='number' class='form-control input-normal input-sm level' name='level[]' value='{$todo[$i]['level']}' min='2' max='10'></div><label class='col-sm-2 control-label' style='margin-bottom:5px'>�D��x</label><div class='col-xs-3' style='margin-bottom:5px'><input type='number' class='form-control input-normal input-sm priority' name='priority[]' min='1' max='10' value='{$todo[$i]['�D��x']}'></div><div class='col-xs-2' style='margin-bottom:5px'><input type='text' class='form-control input-normal input-sm ' name='ids[]' value='{$todo[$i]['id']}' readonly></div></div><div class='col-xs-4'><div class='col-xs-12' style='margin-bottom:5px'><label class='control-label'>�[��</label><input type='date' class='form-control input-normal input-sm noki' name='noki[]' value='{$nokidate}'></div><div class='col-xs-12' style='margin-bottom:5px'><label class='control-label'>�[���̎���</label><input type='time' class='form-control input-normal input-sm time' name='time[]' step='900' value='{$todo[$i]['�[������']}'></div><div class='col-xs-12' style='margin-bottom:5px'><label class='control-label'>�J�n�\�莞��</label><input type='date' class='form-control input-normal input-sm kaisi' name='kaisi[]' value='{$startdate}'></div><div class='col-xs-12' style='margin-bottom:5px'><label class='control-label'>�I���\�����</label><input type='date' class='form-control input-normal input-sm syuryo' name='syuryo[]' value='{$finishdate}'></div></div></div></div><div class='form-group' style='margin-bottom:0; position: fixed; bottom: 50px;right:0;width:500px;'></div></fieldset>";
		    		$count++;
		    	}
		    }
	    ?>
	    </div>
	    <div class="form-group">
	    	<button class="btn btn-success center-block" type="button" onClick='plus();'><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>�@�ǉ�</button>
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
