<script>
	"use strict";
	$(document).on('ready', function() {
		// Setting datatable defaults
		$.extend( $.fn.dataTable.defaults, {
			autoWidth: false,
			columnDefs: [{
				orderable: true,
				width: 'auto'
			}],
			//dom: '<"datatable-header"fBl><"datatable-scroll"t><"datatable-footer"ip>',
			language: {
				search: 'Filter: _INPUT_',
				lengthMenu: '<span>Show:</span> _MENU_',
				paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
			},
			drawCallback: function () {
				$(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
			},
			preDrawCallback: function() {
				$(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
			}
		});

		var table = $('#dataTables-example').DataTable({
			buttons: {
				buttons: [
					{
						extend: 'excelHtml5',
						className: 'btn btn-default',
						exportOptions: {
							columns: ':visible'
						}
					}
				]
			}
		});

		// Add placeholder to the datatable filter option
		$('.dataTables_filter input[type=search]').attr('placeholder','Keywords...');
	});
</script>