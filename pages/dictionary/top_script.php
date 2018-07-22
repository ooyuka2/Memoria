<script type="text/javascript" src="../DataTables/datatables.min.js"></script>
<script>
	jQuery(function($){
		$.extend( $.fn.dataTable.defaults, { 
			language: {
				url: "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Japanese.json"
			} 
		}); 
		$('#dictionary').dataTable({
			// �����ؑւ̒l��10�`50��10���݂ɂ���
			lengthMenu: [ 50, 100, 150, 200, 250, 300, 500, 750, 1000 ],
			// �����̃f�t�H���g�̒l��50�ɂ���
			displayLength: 250,
			//stateSave: true,
			columnDefs: [
				// 2��ڂ�����(visible��false�ɂ���Ə����܂�)
				{ targets: 2, visible: false },
			],
			responsive: true, order: [[2, 'asc']],
		});

	});
	function move_tab(tabname) {
		$("li.active").removeClass("active");
		$("#"+tabname).addClass("active");
		$(".hidden").removeClass("hidden");
		if(tabname != "home") {
			$("tr").addClass("hidden");
			$("."+tabname).removeClass("hidden");
		}
	}
</script>
