

<!--Double navigation-->
<header role="banner">
	<nav class="drawer-nav side-nav " role="navigation">
		<ul class="drawer-menu">
			<li><a class="drawer-brand" style="height:65px">�@</a></li>
			
			<li class="drawer-dropdown worknav"><a class="drawer-menu-item parent" onclick="navToggle(this)">
				<span class="fa fa-tasks pull-left drawer-menu-icon"></span><span>��Ɛ\��</span><span class="fa fa-angle-down pull-right"></span></a>
				<ul>
					<li><a class="drawer-menu-item"style="font-size:12px" href="<?php echo $link_work_html; ?>">�\���ꗗ</a></li>
					<li><a class="drawer-menu-item"style="font-size:12px" href="<?php echo $link_work_html; ?>?page=makeWork&type=new">�V�K�\��</a></li>
					<li><a class="drawer-menu-item"style="font-size:12px" onclick="alert('������')">�\�����̉�</a></li>
					<li><a class="drawer-menu-item"style="font-size:12px" onclick="alert('������')">��ƑO</a></li>
					<li><a class="drawer-menu-item"style="font-size:12px" onclick="alert('������')">��ƒ�</a></li>
					<li><a class="drawer-menu-item"style="font-size:12px" onclick="alert('������')">�Ď��V�X�e���̃����e�i���X�\��</a></li>
					<li><a class="drawer-menu-item"style="font-size:12px" onclick="alert('������')">��Ɗ����E�񍐏�</a></li>
				</ul>
			</li>
			<li class="drawer-dropdown systemnav"><a class="drawer-menu-item parent" onclick="navToggle(this)">
				<span class="fa fa-table pull-left drawer-menu-icon"></span><span>�ݔ����</span><span class="fa fa-angle-down pull-right"></span></a>
				<ul>
					<li><a class="drawer-menu-item"style="font-size:12px" href="<?php echo $link_system_html; ?>">�ݔ��T�v</a></li>
					<li><a class="drawer-menu-item"style="font-size:12px" href="<?php echo $link_system_html; ?>?page=mashine">�ݔ��ꗗ</a></li>
					<li><a class="drawer-menu-item"style="font-size:12px" href="<?php echo $link_system_html; ?>?page=ipaddress">IP�A�h���X�ꗗ</a></li>
					<li><a class="drawer-menu-item"style="font-size:12px" href="<?php echo $link_system_html; ?>?page=norerece">�\�t�g�E�F�A�ꗗ</a></li>
					<li><a class="drawer-menu-item"style="font-size:12px" href="<?php echo $link_system_html; ?>?page=norerece">���C�Z���X�ꗗ</a></li>
					<li><a class="drawer-menu-item"style="font-size:12px" href="<?php echo $link_system_html; ?>?page=norerece">�ێ�ꗗ</a></li>
					<li><a class="drawer-menu-item"style="font-size:12px" href="<?php echo $link_system_html; ?>?page=norerece">���[�U�[�ꗗ</a></li>
					<li><a class="drawer-menu-item"style="font-size:12px" onclick="alert('������')">�����\��@��</a></li>
					<li><a class="drawer-menu-item"style="font-size:12px" onclick="alert('������')">�P���\��@��</a></li>
					<li><a class="drawer-menu-item"style="font-size:12px" onclick="alert('������')">���c�[������̘A�g</a></li>
				</ul>
			</li>
			<li class="drawer-dropdown"><a class="drawer-menu-item parent" onclick="navToggle(this)">
				<span class="fa fa-frown-o pull-left drawer-menu-icon"></span><span>��Q���</span><span class="fa fa-angle-down pull-right"></span></a>
				<ul>
					<li><a class="drawer-menu-item"style="font-size:12px" onclick="alert('���b�h�}�C���ƘA�g����ƕ֗����ȂƎv���܂�')">���b�h�}�C���փ����N</a></li>
				</ul>
			</li>
			<li class="drawer-dropdown"><a class="drawer-menu-item parent" onclick="navToggle(this)">
				<span class="fa fa-info pull-left drawer-menu-icon"></span><span>�����e�i���X</span><span class="fa fa-angle-down pull-right"></span></a>
				<ul>
					<li><a class="drawer-menu-item"style="font-size:12px" onclick="alert('������')">���������e�i���X���̋Ɩ���~�\��</a></li>
					<li><a class="drawer-menu-item"style="font-size:12px" onclick="alert('������')">��������e�i���X�\��</a></li>
					<li><a class="drawer-menu-item"style="font-size:12px" onclick="alert('������')">�����X�|�b�g�����e�i���X�\��</a></li>
					<li><a class="drawer-menu-item"style="font-size:12px" onclick="alert('������')">�����e�i���X�ۑ�</a></li>
					<li><a class="drawer-menu-item"style="font-size:12px" onclick="alert('������')">���ʃ����e�i���X���</a></li>
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


