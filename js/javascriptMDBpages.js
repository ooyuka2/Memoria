$(document).ready(function() {
	
	// Drawer�ǂݍ���
	$('.drawer').drawer();
	
	// �h�����[���j���[���J�����Ƃ�
	$('.drawer').on('drawer.opened', function(){
		//alert('�h�����[���J���܂���');
		
	});
 
	// �h�����[���j���[�������Ƃ�
	$('.drawer').on('drawer.closed', function(){
		//alert('�h�����[�������܂���');
		 $(".drawer-hamburger").css("display","");
	});
});

function navOnload() {
	if($('.activenav').length) {
		$('.activenav').find('li').slideToggle(500);
		document.getElementsByClassName('activenav')[0].children[0].children[1].classList.toggle("fa-angle-down");
		document.getElementsByClassName('activenav')[0].children[0].children[1].classList.toggle("fa-angle-up");
	}
}

function navToggle(element) {
	$(element).parent().find('li').slideToggle(500);
	element.children[1].classList.toggle("fa-angle-down");
	element.children[1].classList.toggle("fa-angle-up");
}

$(".box__area").hover(function() {

});

$(function() {
	$(".drawer-hover").hover(
		function(){
			$(".drawer-hamburger").css("display","none");
			$('.drawer').drawer('open');
		}
	);
});
