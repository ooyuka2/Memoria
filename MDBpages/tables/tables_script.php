<script>
$(document).ready(function(){
	var filterNum = $('#tablespage_json thead th').length;
	var filterInput = "<tr>";
	for (var i=0; i<filterNum; i++) {
		filterInput += '<th><input type="text" class="form-control form-control-sm" style="width:100%"/></th>';
	}
	filterInput += "</tr>";
	$('#tablespage_json thead').prepend(filterInput);

	var table = $('#tablespage_json').DataTable({
				language: {
					url: "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Japanese.json"
				},
				// 件数切替の値を10～50の10刻みにする
				lengthMenu: [ 25, 50, 100, 150, 200, 250, 300, 500, 750, 1000 ],
				// 件数のデフォルトの値を50にする
				displayLength: 25,  
				//stateSave: true,
				columnDefs: [
				],
				//dom: 'Bfrtip',
				/*buttons: [
					{
					extend: 'csvHtml5',
					//text: 'Copy all data',
					}
				],*/
				
				responsive: true, order: [[0, 'asc']],
				//"serverSide": true,
				//"ajax" : "/Memoria/data/tables/<?php echo $_GET['table']; ?>.json",
				"ajax" : "/Memoria/MDBpages/tables/echojson.php?table=<?php echo $_GET['table']; ?>",
			});
		$('#tablespage_json th input').each( function () {
			var index = $('#tablespage_json th input').index(this);
			//alert(index);
			$('#tablespage_json th input').eq(index).on( 'keyup', function () {
				//alert(table.columns().indexes);
				table
					.columns( index )
					.search(this.value)
					.draw();
			} );
		} );

		$('#tablespage_json tbody').on( 'mouseenter', 'td', function () {
			var colIdx = table.cell(this).index().column;

			$( table.cells().nodes() ).removeClass( 'highlight' );
			$( table.column( colIdx ).nodes() ).addClass( 'highlight' );
		} );
	//table.buttons().container().appendTo( $('.col-sm-6:eq(0)', table.table().container() ) );
});
</script>