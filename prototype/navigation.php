

<!--Double navigation-->
<header role="banner">
	<nav class="drawer-nav side-nav " role="navigation">
		<ul class="drawer-menu">
			<li><a class="drawer-brand" style="height:65px">�@</a></li>
			
			<li class="drawer-dropdown"><a class="drawer-menu-item parent" onclick="navToggle(this)">
				<span class="fa fa-tasks pull-left drawer-menu-icon"></span><span>��Ɛ\��</span><span class="fa fa-angle-down pull-right"></span></a>
				<ul>
					<li><a class="drawer-menu-item" href="<?php echo $link_system_html; ?>?page=weekly">�V�K�\��</a></li>
					<li><a class="drawer-menu-item" href="<?php echo $link_system_html; ?>?d=calendar">�\�����̉�</a></li>
					<li><a class="drawer-menu-item" href="<?php echo $link_system_html; ?>?page=keeper">��ƑO</a></li>
					<li><a class="drawer-menu-item" href="<?php echo $link_system_html; ?>?d=new">��ƒ�</a></li>
					<li><a class="drawer-menu-item" href="<?php echo $link_system_html; ?>?d=calendar">��Ɗ����E�񍐏�</a></li>
				</ul>
			</li>
			<li class="drawer-dropdown systemnav"><a class="drawer-menu-item parent" onclick="navToggle(this)">
				<span class="fa fa-table pull-left drawer-menu-icon"></span><span>�ݔ����</span><span class="fa fa-angle-down pull-right"></span></a>
				<ul>
					<li><a class="drawer-menu-item" href="<?php echo $link_system_html; ?>">�ݔ��T�v</a></li>
					<li><a class="drawer-menu-item" href="<?php echo $link_system_html; ?>?page=mashine">�ݔ��ꗗ</a></li>
					<li><a class="drawer-menu-item" href="<?php echo $link_system_html; ?>?page=keeper">IP�A�h���X�ꗗ</a></li>
					<li><a class="drawer-menu-item" href="<?php echo $link_system_html; ?>?page=norerece">�\�t�g�E�F�A�ꗗ</a></li>
					<li><a class="drawer-menu-item" href="<?php echo $link_system_html; ?>?page=norerece">���C�Z���X�ꗗ</a></li>
					<li><a class="drawer-menu-item" href="<?php echo $link_system_html; ?>?page=norerece">�ێ�ꗗ</a></li>
					<li><a class="drawer-menu-item" href="<?php echo $link_system_html; ?>?page=norerece">���[�U�[�ꗗ</a></li>
					<li><a class="drawer-menu-item" href="<?php echo $link_system_html; ?>?page=weekly">�����\��@��</a></li>
					<li><a class="drawer-menu-item" href="<?php echo $link_system_html; ?>?page=weekly">�P���\��@��</a></li>
				</ul>
			</li>
			<li class="drawer-dropdown"><a class="drawer-menu-item parent" onclick="navToggle(this)">
				<span class="fa fa-frown-o pull-left drawer-menu-icon"></span><span>��Q���</span><span class="fa fa-angle-down pull-right"></span></a>
				<ul>
					<li><a class="drawer-menu-item" onclick="alert('���b�h�}�C���ƘA�g����ƕ֗����ȂƎv���܂�')">���b�h�}�C���փ����N</a></li>
				</ul>
			</li>
			<li class="drawer-dropdown"><a class="drawer-menu-item parent" onclick="navToggle(this)">
				<span class="fa fa-comments-o pull-left drawer-menu-icon"></span><span>�`���b�g</span><span class="fa fa-angle-down pull-right"></span></a>
				<ul>
					
				</ul>
			</li>
			<li class="drawer-dropdown settingsnav"><a class="drawer-menu-item parent" onclick="location.href='<?php echo $link_settings_html; ?>'">
				<span class="fa fa-cogs pull-left drawer-menu-icon"></span><span onclick="">settings</span></a>
			</li>
			<li class="drawer-dropdown"><a class="drawer-menu-item parent" onclick="location.href='/Memoria/prototype/logoff.php'">
				<span class="fa fa-user-o pull-left drawer-menu-icon"></span><span onclick="">���O�I�t</span></a>
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
			echo "<div class='float-right' style='margin-right:50px'><i class='fa fa-user-circle-o fa-3x text-white' aria-hidden='true'></i>�@<span style='color:#fff;font-size:1.5rem;'>" . $_SESSION['staff']['�c��'] . "����</span></div>";
		
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


