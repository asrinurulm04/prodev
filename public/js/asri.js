var oTable = $('#users-table').DataTable({
        dom: "<'row'<'col-xs-12'<'col-xs-6'l><'col-xs-6'p>>r>"+
            "<'row'<'col-xs-12't>>"+
            "<'row'<'col-xs-12'<'col-xs-6'i><'col-xs-6'p>>>",
        processing: true,
        serverSide: true,
        ajax: {
            url: 'https://datatables.yajrabox.com/eloquent/custom-filter-data',
            data: function (d) {
                d.name = $('input[name=name]').val();
                d.email = $('input[name=email]').val();
            }
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'created_at', name: 'created_at'},
            {data: 'updated_at', name: 'updated_at'}
        ]
    });

    $('#search-form').on('submit', function(e) {
        oTable.draw();
        e.preventDefault();
    });
	
	$.notify("data berhasil dihapus", {
	animate: {
		enter: 'animated lightSpeedIn',
		exit: 'animated lightSpeedOut'
	}
});