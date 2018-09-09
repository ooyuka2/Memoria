

<!--Double navigation-->
<header role="banner">
	<nav class="drawer-nav side-nav " role="navigation">
		<ul class="drawer-menu">
			<li><a class="drawer-brand" style="height:65px">Å@</a></li>
			<li class="drawer-dropdown"><a class="drawer-menu-item parent" onclick="navToggle(this)">
				<span class="fa fa-check-square-o pull-left drawer-menu-icon"></span>todo<span class="fa fa-angle-down pull-right"></span></a>
				<ul>
					<li><a class="drawer-menu-item" href="#">Top</a></li>
					<li><a class="drawer-menu-item" href="#">Left</a></li>
					<li><a class="drawer-menu-item" href="#">Right</a></li>
				</ul>
			</li>
			<li class="drawer-dropdown"><a class="drawer-menu-item parent" onclick="navToggle(this)">
				<span class="fa fa-link pull-left drawer-menu-icon"></span>link<span class="fa fa-angle-down pull-right"></span></a>
				<ul>
					<li><a class="drawer-menu-item" href="#">Top</a></li>
					<li><a class="drawer-menu-item" href="#">Left</a></li>
					<li><a class="drawer-menu-item" href="#">Right</a></li>
				</ul>
			</li>
			<li class="drawer-dropdown"><a class="drawer-menu-item parent" onclick="navToggle(this)">
				<span class="fa fa-wrench pull-left drawer-menu-icon"></span>tools<span class="fa fa-angle-down pull-right"></span></a>
				<ul>
					<li><a class="drawer-menu-item" href="#">Top</a></li>
					<li><a class="drawer-menu-item" href="#">Left</a></li>
					<li><a class="drawer-menu-item" href="#">Right</a></li>
				</ul>
			</li>
			<li class="drawer-dropdown"><a class="drawer-menu-item parent" onclick="navToggle(this)">
				<span class="fa fa-graduation-cap pull-left drawer-menu-icon"></span>dictionary<span class="fa fa-angle-down pull-right"></span></a>
				<ul>
					<li><a class="drawer-menu-item" href="#">Top</a></li>
					<li><a class="drawer-menu-item" href="#">Left</a></li>
					<li><a class="drawer-menu-item" href="#">Right</a></li>
				</ul>
			</li>
			
			<li class="drawer-dropdown"><a class="drawer-menu-item parent" onclick="navToggle(this)">
				<span class="fa fa-envelope-o pull-left drawer-menu-icon"></span>mail<span class="fa fa-angle-down pull-right"></span></a>
				<ul>
					<li><a class="drawer-menu-item" href="#">Top</a></li>
					<li><a class="drawer-menu-item" href="#">Left</a></li>
					<li><a class="drawer-menu-item" href="#">Right</a></li>
				</ul>
			</li>
			<li class="drawer-dropdown"><a class="drawer-menu-item parent" onclick="navToggle(this)">
				<span class="fa fa-cogs pull-left drawer-menu-icon"></span>settings<span class="fa fa-angle-down pull-right"></span></a>
				<ul>
					<li><a class="drawer-menu-item" href="#">Top</a></li>
					<li><a class="drawer-menu-item" href="#">Left</a></li>
					<li><a class="drawer-menu-item" href="#">Right</a></li>
				</ul>
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
			<a href="#"><img src="../img/logo.png" class="img-fluid flex-center"  style="margin-left:20px"></a>
		</div>
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


