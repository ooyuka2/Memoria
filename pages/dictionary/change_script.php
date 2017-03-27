<script type="text/javascript" src="../js/jquery.autoKana.js"></script>
<script>
	$(function() {
	    $.fn.autoKana('#name', '#furi', {
	        katakana : false  //true：カタカナ、false：ひらがな（デフォルト）
	    });
	});
/*  $(function(){
    $.fn.autoKana2('#name', '#furi');
  });*/
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
function check_furi() {
	if(document.getElementById("furi").value=="")
	document.getElementById("furi").value=document.getElementById("name").value;
}
</script>
