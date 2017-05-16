<script type="text/javascript" src="../js/jquery.autoKana.js"></script>
<script>
	$(function() {
		for(var i=0; i<document.getElementsByClassName("name").length; i++) {
		    $.fn.autoKana('.name:eq('+i+')', '.furi:eq('+i+')', {
		        katakana : false  //true：カタカナ、false：ひらがな（デフォルト）
	    	});
	    }
	});
	
/*  $(function(){
    $.fn.autoKana2('#name', '#furi');
  });*/
function check_furi(i) {
	if(document.getElementsByClassName("furi")[i].value=="")
	document.getElementsByClassName("furi")[i].value=document.getElementsByClassName("name")[i].value;
}

document.onkeydown = 
   function (e) {
      if (event.ctrlKey ){
         if (event.keyCode == 83){
            //alert("Crtl + S");
            event.keyCode = 0;
            return false;
         }
      }
   }

document.onkeypress = 
function (e) {
      if (e != null){
         if ((e.ctrlKey || e.metaKey) && e.which == 115){
            //alert("Crtl + S");
            return false;
         }
      }
   }

</script>
