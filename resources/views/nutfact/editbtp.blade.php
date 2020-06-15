@extends('admin.tempadmin')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Edit BTP Carry Over</h3>
				</div>
				<div class="panel-body">
					<form action="{{url('inputbtp')}}" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<input type="text" name="parameter" class="form-control" placeholder="Parameter">
						</div>
						<div class="form-group">
							<select class="form-control" name="kategori">
								<option disabled selected>Kategori</option>
							</select>
						</div>
						<div class="form-group">
							<select name="akg" class="form-control">
								<option disabled selected>AKG</option>
							</select>
						</div>
						<div class="form-group">
							<input type="text" name="satuan" class="form-control" placeholder="Satuan">
						</div>
						<div class="form-group">
							<input type="text" name="keterangan" class="form-control" placeholder="Keterangan">
						</div>
						<button class="btn btn-warning" type="submit">Update</button>
						<a href="{{url('databtp')}}" class="btn btn-danger" type="submit">Batal</a>	
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection