@extends('layout.tempvv')
@section('title', 'PRODEV| List Principal')
@section('content')

<div class="row">
  @if (session('status'))
  <div class="col-lg-12 col-md-12 col-sm-12">
    <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert">×</button>
      {{ session('status') }}
    </div>
  </div>
  @elseif(session('error'))
  <div class="col-lg-12 col-md-12 col-sm-12">
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert">×</button>
      {{ session('error') }}
    </div>
  </div>
  @endif
</div>

<div class="row">
  <div class="col-md-5 col-xs-12">
    <div class="x_panel" style="min-height:240px">
      <div class="x_title">
        <h3><li class="fa fa-edit"></li> Registrasi Supplier</h3>
      </div>
  		<form class="form-horizontal form-label-left" method="POST" action="{{ route('add_supplier') }}">
      <div class="card-block">
        <div class="x_content">
        	<?php $last = Date('j-F-Y'); ?>
          <input id="last" value="{{ $last }}" class="form-control col-md-12 col-xs-12" name="last" required="required" type="hidden">
          <div class="form-group row">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Suplier</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
          		<input id="nama" class="form-control col-md-12 col-xs-12" name="nama" required="required" type="text">
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Alamat</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
          		<input id="alamat" class="form-control col-md-12 col-xs-12" name="alamat" type="text">
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">telp</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
          		<input id="telp" class="form-control col-md-12 col-xs-12" name="telp" type="number">
            </div>
          </div><hr>
					<div class="card-block col-md-5 col-md-offset-5">
						<button type="reset" class="btn btn-warning btn-sm"><li class="fa fa-repeat"></li> Reset</button>
						<button type="submit" class="btn btn-primary btn-sm"><li class="fa fa-check"></li> Submit</button>
						{{ csrf_field() }}
					</div>
        </div>
      </div>
      </form>
    </div>
  </div>

  <div class="col-md-7 col-xs-12">
    <div class="x_panel" style="min-height:240px">
      <div class="x_title">
        <h3><li class="fa fa-folder-open"> </li> List Suplier</h3>
      </div>
      <div class="card-block">
				<table id="datatable" class="Table table-bordered">
					<thead>
						<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
							<th class="text-center" width="5%">No</th>
							<th class="text-center" width="30%">Nama Suplier</th>
							<th class="text-center" width="15%">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($supplier as $supplier)
						<tr>
							<td class="text-center">{{$supplier->id}}</td>
							<td>{{$supplier->nama_supplier_principal}}</td>
							<td class="text-center">
                @if($supplier->is_active=='active')
                <a href="{{route('inactive_supplier',$supplier->id)}}" class="btn btn-sm btn-danger" type="button" title="inactive"><li class="fa fa-ban"></li></a>
                <button class="btn btn-warning btn-sm" type="button" data-toggle="modal" data-target="#edit{{$supplier->id}}"><i class="fa fa-edit"></i></a></button></td>
							
								<!-- Edit -->
								<div class="modal fade" id="edit{{$supplier->id}}" role="dialog" aria-labelledby="EWBModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title" id="EWBModalLabel"><i class="fa fa-edit"></i> Edit
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></h4>
											</div>
											<div class="modal-body">
												<form method="POST" action="{{ route('edit_supplier',$supplier->id) }}">
                        <div class="card-block">
                          <div class="x_content">
                            <?php $last = Date('j-F-Y'); ?>
                            <input id="last" value="{{ $last }}" class="form-control col-md-12 col-xs-12" name="last" required="required" type="hidden">
                            <div class="form-group row">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Suplier</label>
                              <div class="col-md-9 col-sm-9 col-xs-12">
                                <input id="nama" class="form-control col-md-12 col-xs-12" name="nama" value="{{$supplier->nama_supplier_principal}}" required="required" type="text">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12">Alamat</label>
                              <div class="col-md-9 col-sm-9 col-xs-12">
                                <input id="alamat" class="form-control col-md-12 col-xs-12" name="alamat" value="{{$supplier->alamat_supplier_principal}}" type="text">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12">telp</label>
                              <div class="col-md-9 col-sm-9 col-xs-12">
                                <input id="telp" class="form-control col-md-12 col-xs-12" name="telp" value="{{$supplier->telepon_supplier_principal}}" type="number">
                              </div>
                            </div><hr>
                            <div class="card-block col-md-5 col-md-offset-5">
                              
                            </div>
                          </div>
                        </div>
											</div>
											<div class="modal-footer">
                        <a type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-ban"></i> Cencel</a>
                        <button class="btn btn-warning btn-sm" type="submit"><i class="fa fa-edit"></i> Edit</button>
                        {{ csrf_field() }}
												</form>
											</div>
										</div>
									</div>
								</div>
								<!-- Selesai -->
                @elseif($supplier->is_active=='inactive')
                <a href="{{route('active_supplier',$supplier->id)}}" class="btn btn-sm btn-info" type="button" title="active"><li class="fa fa-check"></li></a>
                <button class="btn btn-warning btn-sm" type="button" disabled title="supplier inactive"><i class="fa fa-edit"></i></a></button></td>
                @endif
              </td>
						</tr>
						@endforeach
					</tbody>
        </table>
      </div>
    </div>
    </div>
  </div>
</div>
@endsection
@section('s')
<link href="{{ asset('lib/advanced-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" />
<script src="{{ asset('js/datatables.min.js')}}"></script>
@endsection