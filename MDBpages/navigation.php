

<!--Double navigation-->
<header role="banner">
	<nav class="drawer-nav side-nav " role="navigation">
		<ul class="drawer-menu">
			<li><a class="drawer-brand" style="height:65px">　</a></li>
			<li class="drawer-dropdown todonav"><a class="drawer-menu-item parent" onclick="navToggle(this)">
				<span class="fa fa-check-square-o pull-left drawer-menu-icon"></span><span onclick="location.href='<?php echo $link_todo_html; ?>'">todo</span><span class="fa fa-angle-down pull-right"></span></a>
				<ul>
					<li><a class="drawer-menu-item" href="<?php echo $link_todo_html; ?>?page=weekly">週報</a></li>
					<li><a class="drawer-menu-item" href="<?php echo $link_todo_html; ?>?page=keeper">時間管理</a></li>
					<li><a class="drawer-menu-item" href="<?php echo $link_todo_html; ?>?d=new">新規追加</a></li>
					<li><a class="drawer-menu-item" href="<?php echo $link_todo_html; ?>?d=calendar">カレンダー</a></li>
				</ul>
			</li>
			<li class="drawer-dropdown filenav"><a class="drawer-menu-item parent" onclick="navToggle(this)">
				<span class="fa fa-link pull-left drawer-menu-icon"></span><span onclick="location.href='<?php echo $link_link_html; ?>'">link</span><span class="fa fa-angle-down pull-right"></span></a>
				<ul>
					<li><a class="drawer-menu-item" href="#">Top</a></li>
					<li><a class="drawer-menu-item" href="#">XXXXX</a></li>
					<li><a class="drawer-menu-item" href="#">XXXXX</a></li>
				</ul>
			</li>
			<li class="drawer-dropdown"><a class="drawer-menu-item parent" onclick="navToggle(this)">
				<span class="fa fa-wrench pull-left drawer-menu-icon"></span><span onclick="location.href='<?php echo $ini['dirhtml']."/pages/tools.php"; ?>'">tools</span><span class="fa fa-angle-down pull-right"></span></a>
				<ul>
					<li><a class="drawer-menu-item" href="#">Top</a></li>
					<li><a class="drawer-menu-item" href="#">XXXXX</a></li>
					<li><a class="drawer-menu-item" href="#">XXXXX</a></li>
				</ul>
			</li>
			<li class="drawer-dropdown"><a class="drawer-menu-item parent" onclick="navToggle(this)">
				<span class="fa fa-graduation-cap pull-left drawer-menu-icon"></span><span onclick="location.href='<?php echo $ini['dirhtml']."/pages/dictionary.php"; ?>'">dictionary</span><span class="fa fa-angle-down pull-right"></span></a>
				<ul>
					<li><a class="drawer-menu-item" href="#">Top</a></li>
					<li><a class="drawer-menu-item" href="#">XXXXX</a></li>
					<li><a class="drawer-menu-item" href="#">XXXXX</a></li>
				</ul>
			</li>
			
			<li class="drawer-dropdown"><a class="drawer-menu-item parent" onclick="navToggle(this)">
				<span class="fa fa-envelope-o pull-left drawer-menu-icon"></span><span onclick="">mail</span><span class="fa fa-angle-down pull-right"></span></a>
				<ul>
					<li><a class="drawer-menu-item" href="#">Top</a></li>
					<li><a class="drawer-menu-item" href="#">XXXXX</a></li>
					<li><a class="drawer-menu-item" href="#">XXXXX</a></li>
				</ul>
			</li>
			<li class="drawer-dropdown settingsnav"><a class="drawer-menu-item parent" onclick="navToggle(this)">
				<span class="fa fa-cogs pull-left drawer-menu-icon"></span><span onclick="location.href='<?php echo $link_settings_html; ?>'">settings</span><span class="fa fa-angle-down pull-right"></span></a>
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
		<form class="form-inline">
			<div class="md-form my-0">
			<input class="form-control" type="text" placeholder="Search" aria-label="Search" onkeyup="todo_serch(this.value)">
			</div>
		</form>
		<!--/.Search Form-->
	</nav>
	<!-- /.Navbar -->
</header>
<!--/.Double navigation-->


