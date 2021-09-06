@extends('pv.tempvv')
@section('title', 'PRODEV|SKU')
@section('content')

<div class="row">
	<div class="x_panel">
		@if(auth()->user()->role->namaRule == 'admin')
		<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#sku"><i class="fa fa-plus"></i> Add Data SKU</button>
		<!-- modal -->
		<div class="modal" id="sku" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">                 
						<h3 class="modal-title" id="exampleModalLabel">Add data SKU
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button></h3>
					</div>
					<div class="modal-body">
						<form class="form-horizontal form-label-left" method="POST" action="{{route('tambahsku')}}" novalidate>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">No Formula</label>
									<div class="col-md-9 col-sm-9 col-xs-12">
										<input id="" class="form-control col-md-12 col-xs-12" type="text" name="formula">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Produk</label>
									<div class="col-md-9 col-sm-9 col-xs-12">
										<input id="" class="form-control col-md-12 col-xs-12" type="text" name="produk">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">Nama SKU</label>
									<div class="col-md-9 col-sm-9 col-xs-12">
										<input id="" class="form-control col-md-12 col-xs-12" type="text" name="sku">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">Kode Item</label>
									<div class="col-md-4 col-sm-4 col-xs-12">
										<input required="required" class="form-control col-md-12 col-xs-12" type="text" name="kode">
									</div>
									<label class="control-label col-md-1 col-sm-3 col-xs-12">No</label>
									<div class="col-md-4 col-sm-4 col-xs-12">
										<input required="required" class="form-control col-md-12 col-xs-12" type="text" name="no">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Submit</button>
						{{ csrf_field() }}
					</div>
					</form>
				</div>
			</div>
		</div>
		<!-- modal selesai -->
		@endif
		<table  id="datatable" class="table table-striped table-bordered" style="width:100%">
			<thead>
				<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
					<td width="10px">No</td>
					<td>No Formula</td>
          <td>Nama Produk</td>
          <td>Nama SKU</td>
					<td>Kode Item</td>
					@if(auth()->user()->role->namaRule == 'admin')
					<td></td>
					@endif
				</tr>
			</thead>
			<tbody>
				@php $no = 0; @endphp
				@foreach($sku as $sku)
				<tr>
					<td>{{++$no}}</td>
					<td>{{$sku->no_formula}}</td>
          <td>{{$sku->nama_produk}}</td>
          <td>{{$sku->nama_sku}}</td>
					<td>{{$sku->kode_items}}</td>
					@if(auth()->user()->role->namaRule == 'admin')
					<td><button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModal{{ $sku->id }}" data-toggle="tooltip" data-placement="top" title="Edit"><li class="fa fa-edit "></li></button></td>
					<!-- modal -->
					<div class="modal" id="exampleModal{{ $sku->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">                 
									<h3 class="modal-title" id="exampleModalLabel">Edit Data {{$sku->nama_produk}}
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button></h3>
								</div>
								<div class="modal-body">
								<form class="form-horizontal form-label-left" method="POST" action="{{Route('editsku',$sku->id)}}" novalidate>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">No Formula</label>
												<div class="col-md-9 col-sm-9 col-xs-12">
													<input id="name" disabled value="{{$sku->no_formula}}" class="form-control col-md-12 col-xs-12" type="text" name="name">
												</div>
											</div><br><br>
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Produk</label>
												<div class="col-md-9 col-sm-9 col-xs-12">
													<input id="name" value="{{$sku->nama_produk}}" class="form-control col-md-12 col-xs-12" type="text" name="name">
												</div>
											</div><br><br>
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">Nama SKU</label>
												<div class="col-md-9 col-sm-9 col-xs-12">
													<input id="name" value="{{$sku->nama_sku}}" class="form-control col-md-12 col-xs-12" type="text" name="sku">
												</div>
											</div><br><br>
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">Kode Item</label>
												<div class="col-md-4 col-sm-4 col-xs-12">
													<input value="{{$sku->kode_items}}" required="required" class="form-control col-md-12 col-xs-12" type="text" name="kode">
												</div>
												<label class="control-label col-md-1 col-sm-3 col-xs-12">No</label>
												<div class="col-md-4 col-sm-4 col-xs-12">
													<input value="{{$sku->no}}" required="required" class="form-control col-md-12 col-xs-12" type="text" name="no">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Submit</button>
									{{ csrf_field() }}
								</div>
								</form>
							</div>
						</div>
					</div>
					<!-- modal selesai -->
					@endif
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection
@section('s')
    <link href="{{ asset('lib/advanced-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" />
    <script src="{{ asset('js/datatables.min.js')}}"></script>
@endsection