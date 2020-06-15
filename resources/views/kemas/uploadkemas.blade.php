@extends('kemas.tempkemas')
@section('title', 'feasibility|Kemas')
@section('judulnya', 'List Feasibility')
@section('content')

	<div class="x_panel">
	  <div class="card-block">
		@foreach($formulas as $formula)
		<table>
			<tr><th width="10%">Nama Produk </th><th width="45%">: {{ $formula->nama_produk}}</th>
			<tr><th width="10%">Tanggal Terima</th><th width="45%">: {{ $formula->updated_at }}</th>
			<tr><th width="10%">No.PKP</th><th width="45%">: {{ $formula->workbook->NO_PKP }}</th>
			<tr><th width="10%">Description</th><th width="45%">: {{ $formula->workbook->deskripsi }}</th></tr>
		</table>
		@endforeach
	  </div>
	</div>

	<div class="col-md-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
			<h3><li class="fa fa-download"> Upload Kemas</li></h3>
 			</div>
			<div class="panel-body">
				<form action="{{ route('hasil',$id_feasibility) }}" method="post" enctype="multipart/form-data">
					{{ csrf_field() }}

					@if (session('success'))
					<div class="alert alert-success">
						{{ session('success') }}
					</div>
					@endif

					@if (session('error'))
					<div class="alert alert-success">
						{{ session('error') }}
					</div>
					@endif
					<div class="form-group">
						<div>
							<input type="hidden" name="finance" maxlength="45" required="required" value="{{$fe->id}}" class="form-control col-md-7 col-xs-12">
						</div>
						<label for="">File (.csv)</label>
						<input type="file" class="form-control" name="file">
						<p class="text-danger">{{ $errors->first('file') }}</p>
					</div>
					<div class="form-group">
						<button class="btn btn-theme btn-sm">Upload</button>
					</div>
				</form>
				@foreach($dataF as $dF)
					<a href="{{ url('lihat',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}" class="btn btn-info btn-sm" type="button">Lihat</a>
				@endforeach
			</div>
		</div>
	</div>
@endsection