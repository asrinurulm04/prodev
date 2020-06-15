@extends('admin.tempadmin')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Edit Parameter</h3>
				</div>
				<div class="panel-body">
					<form action="{{('')}}" method="post" enctype="multipart/form-data">
						{{ csrf_field() }}
						@foreach($edit as $data)
						@endforeach
						<div class="form-group">
							<input type="text" name="parameter" placeholder="Parameter" class="form-control" value="{{$data->parameter}}">
						</div>
						<div class="form-group">
							<select class="form-control" name="kategori">
								<option value="{{$data->id_kategori}}">{{$data->get_kategori->kategori}}</option>
							</select>
						</div>
						<div class="form-group">
							<select name="akg" class="form-control">
								<option disabled selected>AKG</option>
								@foreach($akg as $field)
                                <option value="{{ $field->id_akg }}" selected>{{ $field->zat_gizi }}</option>
                                
                                @endforeach
							</select>
						</div>
						<div class="form-group">
							<input type="text" name="satuan" class="form-control" placeholder="Satuan" value="{{$data->satuan}}">
						</div>
						<div class="form-group">
							<input type="text" name="keterangan" class="form-control" placeholder="Keterangan" value="{{$data->keterangan}}">
						</div>
						<button class="btn btn-warning" type="submit">Update</button>
						<a href="{{url('datap')}}" class="btn btn-danger" type="submit">Batal</a>	
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection