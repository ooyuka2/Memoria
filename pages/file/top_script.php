<script type="text/javascript" src="../DataTables/datatables.min.js"></script>
<script>
    jQuery(function($){
    	$.extend( $.fn.dataTable.defaults, { 
	        language: {
	            url: "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Japanese.json"
	        } 
	    }); 
        <?php
			$group = readCsvFile('../data/file_group.csv');
        	function script_table($group) {
        		echo "'#dictionary";
	        	for($i=1; $i<count($group); $i++) {
	        		echo ", #dictionary_".$group[$i][1];
	        	}
	        	echo "'";
        	}
        ?>
        $(<?php script_table($group); ?>).dataTable({
    	    // 件数切替の値を10～50の10刻みにする
		    lengthMenu: [ 50, 100, 150, 200, 250, 300, 500, 750, 1000 ],
		    // 件数のデフォルトの値を50にする
		    displayLength: 250,  
			//stateSave: true,
			columnDefs: [
		        // 2列目を消す(visibleをfalseにすると消えます)
		        { targets: 2, visible: false },
		    ],
		    responsive: true, order: [[2, 'desc']],
        });

    });
    
	var abc = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];
	var abc2 = ["S_A","S_B","S_C","S_D","S_E","S_F","S_G","S_H","S_I","S_J","S_K","S_L","S_M","S_N","S_O","S_P","S_Q","S_R","S_S","S_T","S_U","S_V","S_W","S_X","S_Y","S_Z"];
	var abc3 = ["G_A","G_A","G_A","G_A","G_A","G_F","G_F","G_F","G_F","G_F","G_K","G_K","G_K","G_K","G_K","G_P","G_P","G_P","G_P","G_P","G_U","G_U","G_U","G_U","G_U","G_Z"];
	var hiragana = ["あ","い","う","え","お","か","き","く","け","こ","さ","し","す","せ","そ","た","ち","つ","て","と","な","に","ぬ","ね","の","は","ひ","ふ","へ","ほ","ま","み","む","め","も","や","ゆ","よ","","","ら","り","る","れ","ろ","わ","を","ん","",""];
	var hiragana2 = ["S_a","S_i","S_u","S_e","S_o","S_ka","S_ki","S_ku","S_ke","S_ko","S_sa","S_si","S_su","S_se","S_so","S_ta","S_ti","S_tu","S_te","S_to","S_na","S_ni","S_nu","S_ne","S_no","S_ha","S_hi","S_hu","S_he","S_ho","S_ma","S_mi","S_mu","S_me","S_mo","S_ya","S_yi","S_yu","S_ye","S_yo","S_ra","S_ri","S_ru","S_re","S_ro","S_wa","S_wi","S_wu","S_we","S_wo"];
	var hiragana3 = ["G_a","G_a","G_a","G_a","G_a","G_ka","G_ka","G_ka","G_ka","G_ka","G_sa","G_sa","G_sa","G_sa","G_sa","G_ta","G_ta","G_ta","G_ta","G_ta","G_na","G_na","G_na","G_na","G_na","G_ha","G_ha","G_ha","G_ha","G_ha","G_ma","G_ma","G_ma","G_ma","G_ma","G_ya","G_ya","G_ya","G_ya","G_ya","G_ra","G_ra","G_ra","G_ra","G_ra","G_wa","G_wa","G_wa","G_wa","G_wa"];
    
    
    
    function hyouzi(cls) {
    	for(var i=0; i<document.getElementsByClassName(cls).length; i++) {
    		document.getElementsByClassName(cls)[i].style.display="block";
    	}
    	//document.getElementsByClassName(cls)[1].style.display="block";
    	//document.getElementsByClassName(cls)[2].style.display="block";
    	//document.getElementsByClassName(cls)[3].style.display="block";
    	//document.getElementsByClassName(cls)[4].style.display="block";
    }
    function hihyouzi(cls) {
    	for(var i=0; i<document.getElementsByClassName(cls).length; i++) {
    		if(i%5!=0) document.getElementsByClassName(cls)[i].style.display="none";
    	}
    	//document.getElementsByClassName(cls)[1].style.display="none";
    	//document.getElementsByClassName(cls)[2].style.display="none";
    	//document.getElementsByClassName(cls)[3].style.display="none";
    	//document.getElementsByClassName(cls)[4].style.display="none";
    }
    
    function move(page) {
    	location.href = 'http://localhost:81/Memoria/pages/file.php?page=count&p=' + page;
    }
</script>
