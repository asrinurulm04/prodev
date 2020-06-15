@extends('admin.tempadmin')

@section("content")
<div class="row">
	<div class="col-md-14">
		<div class="showback">
			<div class="row">
			  <div class="col-md-6"><h4><i class="fa fa-cube"></i> Data Parameter</h4> </div>
			  <div class="col-md-6 text-right"><h5><i class="fa fa-home"></i> / <a href="{{url('/datap')}}">Data Parameter</a></h5></div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="showback" style="border-radius:3px;">
			<a href="{{url('inputp')}}" class="btn btn-primary"><i class="fa fa-plus"></i> &nbsp Tambah</a><br><br>
			<table class="table table-hover table-bordered table-condensed" id="Table">
				<thead>
					<tr>
						<th class="text-center" style="width: 5%;">No</th>
						<th class="text-center">Kategori</th>
						<th class="text-center">Parameter</th>
						<th class="text-center">AKG</th>
						<th class="text-center">Satuan</th>
						<th class="text-center">Keterangan</th>
						<th class="text-center">Aksi</th>
					</tr>
				</thead>
				@foreach($tampilkan as $data)
				<tr>
					<td class="text-center">{{$loop->iteration}}</td>
					<td class="text-center">{{$data->kategori}}</td>
					<td class="text-center">{{$data->parameter}}</td>
					<td class="text-center">{{$data->nilai}}</td>
					<td class="text-center">{{$data->satuan}}</td>
					<td class="text-center">{{$data->keterangan}}</td>
					<td class="text-center">
						<a href="{{ url('editparameter/'.$data->id_p)}}"  class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
            			<a href="{{ url('hapus/'.$data->id_p) }}" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></a>	
					</td>
				</tr>
				@endforeach
      		</table>
    	</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready( function () {
  
  var table = $('#Table').DataTable({
    "order": [[ 1, "desc" ]],
    "oLanguage": {
      "sInfo": "Showing _START_ to _END_ of _TOTAL_ items."
    }
  });

    $("#Table tfoot th").each( function ( i ) {
    
    if ($(this).text() !== '') {
          var isStatusColumn = (($(this).text() == 'Status') ? true : false);
      var select = $('<select class="form-control"><option value="">Semua</option></select>')
              .appendTo( $(this).empty() )
              .on( 'change', function () {
                  var val = $(this).val();  
          
                  table.column( i )
                      .search( val ? '^'+$(this).val()+'$' : val, true, false )
                      .draw();
              } );
      
      // Get the Status values a specific way since the status is a anchor/image
      if (isStatusColumn) {
        var statusItems = [];
        
                /* ### IS THERE A BETTER/SIMPLER WAY TO GET A UNIQUE ARRAY OF <TD> data-filter ATTRIBUTES? ### */
        table.column( i ).nodes().to$().each( function(d, j){
          var thisStatus = $(j).attr("data-filter");
          if($.inArray(thisStatus, statusItems) === -1) statusItems.push(thisStatus);
        } );
        
        statusItems.sort();
                
        $.each( statusItems, function(i, item){
            select.append( '<option value="'+item+'">'+item+'</option>' );
        });

      }
            // All other non-Status columns (like the example)
      else {
        table.column( i ).data().unique().sort().each( function ( d, j ) {  
          select.append( '<option value="'+d+'">'+d+'</option>' );
            } );  
      }
          
    }
    } );
  
  
  
  
} );
</script>
@endsection