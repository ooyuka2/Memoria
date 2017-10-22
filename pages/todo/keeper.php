
<div id='keeper' class="table-responsive">
	<div class='clearfix'>
		<button style='margin:10px 0' class='btn btn-default pull-right btn-xs' onClick='location.href = "/Memoria/pages/todo.php?d=keeper&day=all"'>すべて</button>
		<button style='margin:10px 10px' class='btn btn-default pull-right btn-xs' onClick='location.href = "/Memoria/pages/todo.php?d=keeper&day=31"'>31日間</button>
		<button style='margin:10px 0' class='btn btn-default pull-right btn-xs' onClick='location.href = "/Memoria/pages/todo.php?d=keeper&day=7"'>7日間</button>
	</div>

<?php
	//$todo = readCsvFile2('../data/todo.csv');
	include('../data/weekly.php');
	
	$working = readCsvFile2('../data/working.csv');

	echo "<br><div class='clearfix'><a href='{$keeperpage}' class='pull-right'>時間管理</a></div>";
	$when = new DateTime($working[(count($working)-1)]['day']);
	$when = $when->format('Y/m/d');
	$keeper = "<table class='table table-condensed'><thead><tr><th class='col-md-2'>開始時間-終了時間</th><th class='col-md-8'>タイトル</th><th class='col-md-2'>時間管理テーマ</th></tr></thead><tbody>";
	$copytext = $when."	";
	$last = count($working)-1;
	$day = 1;
	
	$countday = 7;
	if(isset($_GET['day']) && $_GET['day'] == 'all') $countday = $last;
	else if(isset($_GET['day']) && ctype_digit($_GET['day'])) 	$countday = $_GET['day'];
	
	for($i=count($working)-1; $i>0; $i--) {
		$comDay = new DateTime($working[$i]['day']);
		$comDay = $comDay->format('Y/m/d');
		if($comDay != $when || $i==1) {
			$first = $i+1;
			for($j=$first; $j<=$last; $j++) {
				if($working[$j]['keeper'] == 1) continue;
				$processTime = str_replace(":", "", $working[$j]['startTime'] . "-" . $working[$j]['finishTime']);
				$keeper .= "<td>{$processTime}</td>";
				$copytext .= $processTime . "	";
				if($working[$j]['id'] == "periodically") {
					$keeper .= "<td><span>{$working[$j]['note']}</span></td>";
					$keeper .= "<td>{$working[$j]['keeper']}</td></tr>";
					if(strpos($working[$j]['note'], '<br>') !== false){
						$note = str_replace("<br>", "\\n", "&quot".$working[$j]['note']."&quot");//\\\'
					} else $note = $working[$j]['note'];
					$copytext .= $note . "	{$working[$j]['keeper']}\\n	";
				} else {
					$keeper .= "<td><span onClick='goto_detail({$todo[$working[$j]['id']]['top']})'>{$todo[$todo[$working[$j]['id']]['top']]['タイトル']}</span></td>";
					$keeper .= "<td>{$todo[$todo[$working[$j]['id']]['top']]['時間管理テーマ']}</td></tr>";
					$copytext .= $todo[$todo[$working[$j]['id']]['top']]['タイトル'] . "	" . $todo[$todo[$working[$j]['id']]['top']]['時間管理テーマ']. "\\n	";
				}
			}
			if($i!=1 && $day != $countday) {
				$keeper .= "</tbody></table>";
				echo '<div class="clearfix"><h3>'.$when.'<button onClick="execCopy(\''.$copytext.'\')" class="pull-right btn btn-sm btn-primary">copy</button></h3></div>';
				
				echo $keeper;

				
				$when = new DateTime($working[$i]['day']);
				$when = $when->format('Y/m/d');
				$keeper = "<table class='table table-condensed'><thead><tr><th class='col-md-2'>開始時間-終了時間</th><th class='col-md-8'>タイトル</th><th class='col-md-2'>時間管理テーマ</th></tr></thead><tbody>";
				$copytext = $when."	";
				$last = $i;
			} else if($day == $countday) {
				break;
			}
		$day ++;
		}
	}
	echo '<div class="clearfix"><h3>'.$when.'</h3><button onClick="execCopy(\''.$copytext.'\')" class="pull-right btn btn-sm btn-primary">copy</button></div>';
	echo $keeper;
?>
	</tbody>
</table>
</div>

<?php
	//https://www.hotpepper.jp/strJ000758708/course/
	//https://r.gnavi.co.jp/a81kzjy90000/menu4/
?>