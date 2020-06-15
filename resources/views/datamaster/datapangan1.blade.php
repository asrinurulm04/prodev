@extends('pv.tempvv')
@section('title', 'Data Pangan')
@section('judulhalaman','Data Pangan')
@section('content')

<div class="row">
	<div class="x_panel">
		<div class="x_title">
			<h3><li class="fa fa-file"></li> PKBPOM No 16 thn.2016 tentang kriteria Mikrobiologi dalam olahan pangan</h3>
		  </div>
		<a href="{{route('exportBpom')}}" class="btn btn-info btn-sm"><li class="fa fa-download"></li> Export Data BPOMa</a>
		@if(auth()->user()->role->namaRule == 'admin')
		<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#pangan"><i class="fa fa-plus"></i> Add Data Pangan</button>
		<!-- modal -->
		<div class="modal" id="pangan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title text-left" id="exampleModalLabel">Add Data Pangan
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></h3>
						</button>
					</div>
					<div class="modal-body">
						<form class="form-horizontal form-label-left" method="POST" action="{{route('tambahpangan')}}" novalidate>
						<div class="form-group row">
							<label class="control-label text-bold col-md-3 col-sm-3 col-xs-12 text-center">Jenis</label>
							<div class="col-md- col-sm-3 col-xs-12">
								<select name="jenis" class="form-control form-control-line" style="width:408px">
									@foreach($datapangan as $data)
									<option value="{{$data->kategori_pangan}}">{{$data->kategori_pangan}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label text-bold col-md-3 col-sm-3 col-xs-12 text-center">No.Kategori</label>
							<div class="col-md-9 col-sm-3 col-xs-12">
								<input type="text" class="form-control" name="no">
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label text-bold col-md-3 col-sm-3 col-xs-12 text-center">Kategori</label>
							<div class="col-md-9 col-sm-3 col-xs-12">
								<input type="text" class="form-control" name="kategori">
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label text-bold col-md-3 col-sm-3 col-xs-12 text-center">Jenis Mikroba</label>
							<div class="col-md-9 col-sm-3 col-xs-12">
								<input type="text" class="form-control" name="mikroba">
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label text-bold col-md-3 col-sm-3 col-xs-12 text-center">n</label>
							<div class="col-md-4 col-sm-3 col-xs-12">
								<input type="text" class="form-control" name="n">
							</div>
							<label class="control-label text-bold col-md-1 col-sm-3 col-xs-12 text-center">c</label>
							<div class="col-md-4 col-sm-3 col-xs-12">
								<input type="text" class="form-control" name="c">
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label text-bold col-md-3 col-sm-3 col-xs-12 text-center">m</label>
							<div class="col-md-4 col-sm-3 col-xs-12">
								<input type="text" class="form-control" name="m1">
							</div>
							<label class="control-label text-bold col-md-1 col-sm-3 col-xs-12 text-center">M</label>
							<div class="col-md-4 col-sm-3 col-xs-12">
								<input type="text" class="form-control" name="m2">
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label text-bold col-md-3 col-sm-3 col-xs-12 text-center">Metode Analisa</label>
							<div class="col-md-9 col-sm-3 col-xs-12">
								<input type="text" class="form-control" name="analisa">
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Submit</button>
							{{ csrf_field() }}
						</div>
					</form>
					</div>
				</div>
			</div>
		</div>
		<!-- Modal Selesai -->
		@endif

		<table class="Table table-bordered">
			<thead>
				<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
					<th class="text-center" width="10">No Category</th>
					<th class="text-center" width="20%">Food Category</th>
					<th class="text-center" width="15%">Microba Parameters</th>
					<th class="text-center">n</th>
					<th class="text-center">c</th>
					<th class="text-center" width="13%">m</th>
					<th class="text-center" width="13%">M</th>
					<th class="text-center" width="20%">Method</th>
					@if(auth()->user()->role->namaRule == 'admin')
					<th class="text-center"></th>
					@endif
				</tr>
			</thead>
			<tbody>
				@php
					$no = 0;
				@endphp
				@foreach ($Kjenispangan as $item)
					<tr>
					<td>{{$item->no_kategori}}</td>
					<td>{{$item->kategori}}</td>
					<td>
						@foreach($mikroba as $mikro)
						@if($item->no_kategori == $mikro->no_kategori)
						=> {{$mikro->jenis_mikroba}} <br>
						@else
						@endif
						@endforeach
					</td>
					<td>
						@foreach($mikroba as $mikro)
						@if($item->no_kategori == $mikro->no_kategori)
						=> {{$mikro->n}} <br>
						@else
						@endif
						@endforeach
					</td>
					<td>
						@foreach($mikroba as $mikro)
						@if($item->no_kategori == $mikro->no_kategori)
						=> {{$mikro->c}} <br>
						@else
						@endif
						@endforeach
					</td>
					<td>
						@foreach($mikroba as $mikro)
						@if($item->no_kategori == $mikro->no_kategori)
						=> {{$mikro->mk}} <br>
						@else
						@endif
						@endforeach
					</td>
					<td>
						@foreach($mikroba as $mikro)
						@if($item->no_kategori == $mikro->no_kategori)
						=> {{$mikro->Mb}} <br>
						@else
						@endif
						@endforeach
					</td>
					<td>
						@foreach($mikroba as $mikro)
						@if($item->no_kategori == $mikro->no_kategori)
						=> {{$mikro->metode_analisa}} <br>
						@else
						@endif
						@endforeach
					</td>
					</tr>
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
@endsection
