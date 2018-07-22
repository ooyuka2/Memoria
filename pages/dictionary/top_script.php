<script type="text/javascript" src="../DataTables/datatables.min.js"></script>
<script>
	jQuery(function($){
		$.extend( $.fn.dataTable.defaults, { 
			language: {
				url: "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Japanese.json"
			} 
		}); 
		$('#dictionary').dataTable({
			// 件数切替の値を10～50の10刻みにする
			lengthMenu: [ 50, 100, 150, 200, 250, 300, 500, 750, 1000 ],
			// 件数のデフォルトの値を50にする
			displayLength: 250,
			//stateSave: true,
			columnDefs: [
				// 2列目を消す(visibleをfalseにすると消えます)
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
