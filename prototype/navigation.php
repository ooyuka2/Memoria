

<!--Double navigation-->
<header role="banner">
	<nav class="drawer-nav side-nav " role="navigation">
		<ul class="drawer-menu">
			<li><a class="drawer-brand" style="height:65px">　</a></li>
			
			<li class="drawer-dropdown"><a class="drawer-menu-item parent" onclick="navToggle(this)">
				<span class="fa fa-tasks pull-left drawer-menu-icon"></span><span>作業申請</span><span class="fa fa-angle-down pull-right"></span></a>
				<ul>
					<li><a class="drawer-menu-item" href="<?php echo $link_system_html; ?>?page=weekly">新規申請</a></li>
					<li><a class="drawer-menu-item" href="<?php echo $link_system_html; ?>?d=calendar">申請書の回覧</a></li>
					<li><a class="drawer-menu-item" href="<?php echo $link_system_html; ?>?page=keeper">作業前</a></li>
					<li><a class="drawer-menu-item" href="<?php echo $link_system_html; ?>?d=new">作業中</a></li>
					<li><a class="drawer-menu-item" href="<?php echo $link_system_html; ?>?d=calendar">作業完了・報告書</a></li>
				</ul>
			</li>
			<li class="drawer-dropdown systemnav"><a class="drawer-menu-item parent" onclick="navToggle(this)">
				<span class="fa fa-table pull-left drawer-menu-icon"></span><span>設備情報</span><span class="fa fa-angle-down pull-right"></span></a>
				<ul>
					<li><a class="drawer-menu-item" href="<?php echo $link_system_html; ?>">設備概要</a></li>
					<li><a class="drawer-menu-item" href="<?php echo $link_system_html; ?>?page=mashine">設備一覧</a></li>
					<li><a class="drawer-menu-item" href="<?php echo $link_system_html; ?>?page=keeper">IPアドレス一覧</a></li>
					<li><a class="drawer-menu-item" href="<?php echo $link_system_html; ?>?page=norerece">ソフトウェア一覧</a></li>
					<li><a class="drawer-menu-item" href="<?php echo $link_system_html; ?>?page=norerece">ライセンス一覧</a></li>
					<li><a class="drawer-menu-item" href="<?php echo $link_system_html; ?>?page=norerece">保守一覧</a></li>
					<li><a class="drawer-menu-item" href="<?php echo $link_system_html; ?>?page=norerece">ユーザー一覧</a></li>
					<li><a class="drawer-menu-item" href="<?php echo $link_system_html; ?>?page=weekly">導入予定機器</a></li>
					<li><a class="drawer-menu-item" href="<?php echo $link_system_html; ?>?page=weekly">撤去予定機器</a></li>
				</ul>
			</li>
			<li class="drawer-dropdown"><a class="drawer-menu-item parent" onclick="navToggle(this)">
				<span class="fa fa-frown-o pull-left drawer-menu-icon"></span><span>障害情報</span><span class="fa fa-angle-down pull-right"></span></a>
				<ul>
					<li><a class="drawer-menu-item" onclick="alert('レッドマインと連携すると便利かなと思います')">レッドマインへリンク</a></li>
				</ul>
			</li>
			<li class="drawer-dropdown"><a class="drawer-menu-item parent" onclick="navToggle(this)">
				<span class="fa fa-comments-o pull-left drawer-menu-icon"></span><span>チャット</span><span class="fa fa-angle-down pull-right"></span></a>
				<ul>
					
				</ul>
			</li>
			<li class="drawer-dropdown settingsnav"><a class="drawer-menu-item parent" onclick="location.href='<?php echo $link_settings_html; ?>'">
				<span class="fa fa-cogs pull-left drawer-menu-icon"></span><span onclick="">settings</span></a>
			</li>
			<li class="drawer-dropdown"><a class="drawer-menu-item parent" onclick="location.href='/Memoria/prototype/logoff.php'">
				<span class="fa fa-user-o pull-left drawer-menu-icon"></span><span onclick="">ログオフ</span></a>
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
			<a href="/Memoria/prototype/"><img src="./data/cooltext303248613241317.png" class="img-fluid flex-center"  style="margin-left:20px"></a>
		</div>
		<?php 
			if(isset($_SESSION['staff']))
			echo "<div class='float-right' style='margin-right:50px'><i class='fa fa-user-circle-o fa-3x text-white' aria-hidden='true'></i>　<span style='color:#fff;font-size:1.5rem;'>" . $_SESSION['staff']['苗字'] . "さん</span></div>";
		
		?>
		<!-- Search form -->
		<form class="form-inline">
			<div class="md-form my-0">
			<input class="form-control" type="text" placeholder="Search" aria-label="Search">
			</div>
		</form>
		<!--/.Search Form-->
	</nav>
	<!-- /.Navbar -->
</header>
<!--/.Double navigation-->


