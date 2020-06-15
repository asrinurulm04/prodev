@extends('admin.tempadmin')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Edit Cemaran</h3>
				</div>
				<div class="panel-body">
					<form action="{{url('inputc')}}" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<select class="form-control" name="jenis_cemaran">
								<option disabled selected>Jenis Cemaran</option>
							</select>
						</div>
						<div class="form-group">
							<select class="form-control" name="cemaran">
								<option disabled selected>Cemaran</option>
							</select>
						</div>
						<div class="form-group">
							<select class="form-control" name="jenis_makanan">
								<option disabled selected>Jenis Makanan</option>
							</select>
						</div>
						<div class="form-group">
							<input type="text" name="satuan" class="form-control" placeholder="Batas Maksimum">
						</div>
						<button class="btn btn-warning" type="submit">Update</button>
						<a href="{{url('datac')}}" class="btn btn-danger" type="submit">Batal</a>	
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection