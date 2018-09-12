$(function () {
	$('[data-toggle="popover"]').popover();
	$('[data-toggle="tooltip"]').tooltip();
	setDateTime_start();
});

/*
if (!Modernizr.inputtypes.date) { //HTML5‚Ìinput—v‘f‚É‘Î‰ž‚µ‚Ä‚¢‚é‚©”»’è
	$(document).on("click",document, function() {
			$(".noki").datepicker();
			$(".kaisi").datepicker();
			$(".syuryo").datepicker();
			});
}*/

var menuHeight = $(".navbar").height();
var startPos = 0;
$(window).scroll(function(){
	var currentPos = $(this).scrollTop();
	if (currentPos > startPos) {
		if($(window).scrollTop() >= 200) {
			$(".navbar").css("top", "-" + menuHeight + "px");
		}
	} else {
		$(".navbar").css("top", 0 + "px");
	}
	startPos = currentPos;
});