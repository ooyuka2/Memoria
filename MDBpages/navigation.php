

<!--Double navigation-->
<header role="banner">
	<nav class="drawer-nav side-nav " role="navigation">
		<ul class="drawer-menu">
			<li><a class="drawer-brand" style="height:65px">　</a></li>
			<li class="drawer-dropdown todonav"><a class="drawer-menu-item parent" onclick="navToggle(this)">
				<span class="fa fa-tasks pull-left drawer-menu-icon"></span><span onclick="location.href='<?php echo $link_todo_html; ?>'" oncontextmenu="window.open('<?php echo $link_todo_html; ?>');return false">todo</span><span class="fa fa-angle-down pull-right"></span></a>
				<ul>
					<li><a class="drawer-menu-item" href="<?php echo $link_todo_html; ?>?page=weekly">週報</a></li>
					<li><a class="drawer-menu-item" href="<?php echo $link_todo_html; ?>?page=keeper">時間管理</a></li>
					<li><a class="drawer-menu-item" href="<?php echo $link_todo_html; ?>?d=new">新規追加</a></li>
					<li><a class="drawer-menu-item" href="<?php echo $link_todo_html; ?>">カレンダー</a></li>
				</ul>
			</li>
			<li class="drawer-dropdown filenav"><a class="drawer-menu-item parent" onclick="navToggle(this)">
				<span class="fa fa-link pull-left drawer-menu-icon"></span><span onclick="location.href='<?php echo $link_link_html; ?>'" oncontextmenu="window.open('<?php echo $link_link_html; ?>');return false">link</span><span class="fa fa-angle-down pull-right"></span></a>
				<ul>
					<li><a class="drawer-menu-item" href="<?php echo $link_link_html; ?>">Top</a></li>
					<?php
						$filegroup = readCsvFile2($ini['dirWin'].'/data/file_group.csv');
						for($i=1; $i<count($filegroup); $i++) {
							echo '<li><a class="drawer-menu-item" href="' . $link_link_html . '?search=' . $i . '">' . $filegroup[$i]['group'] . '</a></li>';
						}
					?>
				</ul>
			</li>
			<li class="drawer-dropdown toolsnav"><a class="drawer-menu-item parent" onclick="navToggle(this)">
				<span class="fa fa-wrench pull-left drawer-menu-icon"></span><span onclick="location.href='<?php echo $link_tools_html; ?>'" oncontextmenu="window.open('<?php echo $link_tools_html; ?>');return false">tools</span><span class="fa fa-angle-down pull-right"></span></a>
				<!--
				<ul>
					<li><a class="drawer-menu-item" href="<?php echo $link_tools_html; ?>">Top</a></li>
					<li><a class="drawer-menu-item" href="#">XXXXX</a></li>
					<li><a class="drawer-menu-item" href="#">XXXXX</a></li>
				</ul>
				-->
			</li>
			<li class="drawer-dropdown dictionarynav"><a class="drawer-menu-item parent" onclick="navToggle(this)">
				<span class="fa fa-graduation-cap pull-left drawer-menu-icon"></span><span onclick="location.href='<?php echo $link_dictionary_html; ?>'" oncontextmenu="window.open('<?php echo $link_dictionary_html; ?>');return false">dictionary</span><span class="fa fa-angle-down pull-right"></span></a>
				<ul>
					<li><a class="drawer-menu-item" href="<?php echo $link_dictionary_html; ?>">Top</a></li>
					<?php
						$dictionarygroup = readCsvFile2($ini['dirWin'].'/data/dictionary_group.csv');
						for($i=1; $i<count($dictionarygroup); $i++) {
							echo '<li><a class="drawer-menu-item" href="' . $link_dictionary_html . '?search=' . $i . '">' . $dictionarygroup[$i]['group'] . '</a></li>';
						}
					?>
				</ul>
			</li>
			<li class="drawer-dropdown tablesnav"><a class="drawer-menu-item parent" onclick="navToggle(this)">
				<span class="fa fa-table pull-left drawer-menu-icon"></span><span onclick="location.href='<?php echo $link_tables_html; ?>'" oncontextmenu="window.open('<?php echo $link_tables_html; ?>');return false">tables</span><span class="fa fa-angle-down pull-right"></span></a>
				<ul>
					<?php
						$tables = readCsvFile2($ini['dirWin'].'/data/tables.csv');
						for($i=1; $i<count($tables); $i++) {
							echo '<li><a class="drawer-menu-item" href="' . $link_tables_html . '?page=tables&table=' . str_replace(".csv","",$tables[$i]['filename'] ) . '">' . $tables[$i]['tablename'] . '</a></li>';
						}
					?>
				</ul>
			</li>
			<li class="drawer-dropdown mailnav"><a class="drawer-menu-item parent" onclick="navToggle(this)">
				<span class="fa fa-envelope-o pull-left drawer-menu-icon"></span><span onclick="location.href='<?php echo $link_mail_html; ?>'" oncontextmenu="window.open('<?php echo $link_mail_html; ?>');return false">mail</span><span class="fa fa-angle-down pull-right"></span></a>
				<ul>
					<li><a class="drawer-menu-item" href="<?php echo $link_mail_html; ?>">Top</a></li>
					<?php
						$mailgroup = readCsvFile2($ini['dirWin'].'/data/mail_group.csv');
						for($i=1; $i<count($mailgroup); $i++) {
							echo '<li><a class="drawer-menu-item" href="' . $link_mail_html . '?search=' . $i . '">' . $mailgroup[$i]['group'] . '</a></li>';
						}
					?>
				</ul>
			</li>
			<li class="drawer-dropdown settingsnav"><a class="drawer-menu-item parent" onclick="navToggle(this)">
				<span class="fa fa-cogs pull-left drawer-menu-icon"></span><span onclick="location.href='<?php echo $link_settings_html; ?>'" oncontextmenu="window.open('<?php echo $link_settings_html; ?>');return false">settings</span><span class="fa fa-angle-down pull-right"></span></a>
				<!--
				<ul>
					<li><a class="drawer-menu-item" href="#">Top</a></li>
					<li><a class="drawer-menu-item" href="#">XXXXX</a></li>
					<li><a class="drawer-menu-item" href="#">XXXXX</a></li>
				</ul>
				-->
			</li>
		</ul>
	</nav>
	<!-- Navbar -->
	<nav class="navbar fixed-top navbar-toggleable-md navbar-expand-lg scrolling-navbar double-nav">
		<!-- SideNav slide-out button -->
		<div class="float-left">
			<a href="#" data-activates="slide-out" class="button-collapse drawer-toggle drawer-hamburger" onclick='$(".drawer-hamburger").css("display","none");'><i class="fa fa-bars"></i></a>
		</div>
		<!-- Breadcrumb-->
		<div class="breadcrumb-dn mr-auto" >
			<a href="<?php echo $link_pages_html; ?>"><img src="../img/logo.png" class="img-fluid flex-center"  style="margin-left:20px"></a>
		</div>
		<!-- Search form -->
		
		<div class="md-form my-0">
		<input class="form-control" type="text" placeholder="Search" aria-label="Search" onkeyup="todo_serch(this.value)">
		</div>
		
		<!--/.Search Form-->
	</nav>
	<!-- /.Navbar -->
</header>
<!--/.Double navigation-->


