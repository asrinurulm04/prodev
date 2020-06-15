@extends('pv.tempvv')
@section('title', 'komponen Klaim')
@section('judulhalaman','komponen Klaim')
@section('content')

<div class="row">
	<div class="x_panel">
		<a href="{{route('exportklaim')}}" class="btn btn-info btn-sm"><li class="fa fa-download"></li> Export Data Klaim</a>
		@if(auth()->user()->role->namaRule == 'admin')
		<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#komponen"><i class="fa fa-plus"></i> Add Data Komponen</button>
		<!-- modal -->
		<div class="modal" id="komponen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title" id="exampleModalLabel">Add Data komponen
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button></h3>
					</div>
					<div class="modal-body">
					<form class="form-horizontal form-label-left" method="POST" action="" novalidate>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-2 col-sm-3 col-xs-12">Komponen</label>
									<div class="col-md-9 col-sm-4 col-xs-12">
										<input value="" required="required" class="form-control col-md-12 col-xs-12" type="text" name="komponen">
									</div>
								</div>
								<table class="table table-bordered">
									<thead>
										<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
											<td class="text-center">Klaim</td>
											<td class="text-center">Persyaratan</td>
											<td></td>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><input type="text" class="form-control" name="klaim"></td>
											<td><textarea name="persyaratan" class="form-control" rows="1"></textarea></td>
											<td class="text-center"><button class="btn btn-info btn-sm"><li class="fa fa-plus"></li></button></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Submit</button>
						{{ csrf_field() }}
					</div>
					</form>
				</div>
			</div>
		</div>
		<!-- modal selesai -->
		<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#klaim"><i class="fa fa-plus"></i> Add Data Klaim</button>
		<!-- modal -->
		<div class="modal" id="klaim" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title" id="exampleModalLabel">Add Data komponen
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button></h3>
					</div>
					<div class="modal-body">
					<form class="form-horizontal form-label-left" method="POST" action="" novalidate>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-2 col-sm-3 col-xs-12">Komponen</label>
									<div class="col-md-9 col-sm-4 col-xs-12">
										<select name="komponen" class="form-control" style="width:400px">
											@foreach ($komponen as $komponen)
											<option value="{{$komponen->id}}">{{$komponen->komponen}}</option>
											@endforeach
											<option value=""></option>
										</select>
									</div>
								</div>
								<table class="table table-bordered">
									<thead>
										<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
											<td class="text-center">Klaim</td>
											<td class="text-center">Persyaratan</td>
											<td></td>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><input type="text" class="form-control" name="klaim"></td>
											<td><textarea name="persyaratan" class="form-control" rows="1"></textarea></td>
											<td class="text-center"><button id="add_data" type="button" class="btn btn-info btn-sm pull-left"><li class="fa fa-plus"></li> </button></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Submit</button>
						{{ csrf_field() }}
					</div>
					</form>
				</div>
			</div>
		</div>
		<!-- modal selesai -->
		@endif
		<table class="Table table-bordered">
			<thead>
				<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
					<td class="text-center" width="10px">No</td>
					<td class="text-center" width="15%">Component</td>
          <td class="text-center" width="15%">Claim</td>
					<td class="text-center">Note</td>
					@if(auth()->user()->role->namaRule == 'admin')
					<td class="text-center"></td>
					@endif
				</tr>
			</thead>
			<tbody>
				@php
					$no = 0;
				@endphp
				@foreach($klaim as $klaim)
				<tr>
					<td class="text-center">{{++$no}}</td>
					<td>{{$klaim->komponen}}</td>
					<td>{{$klaim->dataklaim->klaim}}</td>
					<td>{{$klaim->dataklaim->persyaratan}}</td>
					@if(auth()->user()->role->namaRule == 'admin')
					<td><button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModal{{ $klaim->id }}" data-toggle="tooltip" data-placement="top" title="Edit"><li class="fa fa-edit "></li></button></td>
					@endif
				</tr>
				<!-- modal -->
					<div class="modal" id="exampleModal{{ $klaim->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h3 class="modal-title" id="exampleModalLabel">Edit Data {{$klaim->komponen}}
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button></h3>
								</div>
								<div class="modal-body">
								<form class="form-horizontal form-label-left" method="POST" action="{{Route('editklaim',$klaim->id)}}" novalidate>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-2 col-sm-3 col-xs-12">Komponen</label>
												<div class="col-md-5 col-sm-4 col-xs-12">
													<input disabled value="{{$klaim->komponen}}" required="required" class="form-control col-md-12 col-xs-12" type="text" name="komponen">
												</div>
												<label class="control-label col-md-1 col-sm-3 col-xs-12">Klaim</label>
												<div class="col-md-4 col-sm-4 col-xs-12">
													<input value="{{$klaim->dataklaim->klaim}}" required="required" class="form-control col-md-12 col-xs-12" type="text" name="klaim">
												</div>
											</div><br><br>
											<div class="form-group">
												<label class="control-label col-md-2 col-sm-3 col-xs-12">Persyaratan</label>
												<div class="col-md-9 col-sm-9 col-xs-12">
													<textarea name="persyaratan" class="form-control col-md-12 col-xs-12" rows="4" value="{{$klaim->dataklaim->persyaratan}}">{{$klaim->dataklaim->persyaratan}}</textarea>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Submit</button>
									{{ csrf_field() }}
								</div>
								</form>
							</div>
						</div>
					</div>
				<!-- modal selesai -->
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection

@section('s')
<script type="text/javascript">
  $('select').select2({
    placeholder: '-->Select One<--',
    allowClear: true
  });
</script>

<script>
  $(document).ready(function() {
		$('#tabledata').on('click', 'tr a', function(e) {
        e.preventDefault();
        var lenRow = $('#tabledata tbody tr').length;
        if (lenRow == 1 || lenRow <= 1) {
          alert("Tidak bisa hapus semua baris!!");
        } else {
          $(this).parents('tr').remove();
        }
    });

  var i = 1;
  $("#add_data").click(function() {
    $('#addrow' + i).html( "<td>"+
			"<select name='sku[]' style='width:280px;' class='form-control items'>"+sku1+
			"</select>"+
			"</td>"+
      "<td><input type='text' name='pcs[]' placeholder='Allocation ' class='form-control' /></td>"+
			"<td><select require name='opsi[]' id='opsi' class='form-control'>"+
				"<option value='pcs'>PCS</option>"+
				"<option value='forecast'>forecast</option>"+
			"</select></td>"+
      "<td><textarea rows='4' type='text' required name='remarks[]' placeholder='Remarks' class='form-control' ></textarea></td>"+
      "<td><input type='date' required name='start[]' placeholder='Start' title='start' class='form-control' /></td>"+
			"<td><input type='date' required name='end[]' placeholder='End' title='End' class='form-control' /></td>"+
			"<td><input type='date' required name='rto[]' placeholder='rto' class='form-control' /></td>"+
			"<td><a href='' class='btn btn-danger btn-sm'><li class='fa fa-trash'></li></a>"+
			"</td>");

    	$('#tabledata').append('<tr id="addrow' + (i + 1) + '"></tr>');
    	i++;
  	});
  });

</script>
@endsection
