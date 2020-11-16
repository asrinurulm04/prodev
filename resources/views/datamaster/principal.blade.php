@extends('admin.tempadmin')
@section('title', 'Master Data | List Principal')
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
        <h3><li class="fa fa-edit"></li> Registrasi user principal</h3>
      </div>
      <div class="card-block">
        <div class="x_content">
        	<?php $last = Date('j-F-Y'); ?>
          <input id="last" value="{{ $last }}" class="form-control col-md-12 col-xs-12" name="last" required="required" type="hidden">
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#258039">Name</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
          		<input id="name" class="form-control col-md-12 col-xs-12" name="name" required="required" type="text">
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#258039">Supplier</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
            <select required id="supplier" name="supplier" class="form-control" >
							@foreach($supplier as $supplier)
							<option value="{{$supplier->id}}">{{$supplier->nama_supplier_principal}}</option>
							@endforeach
            </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#258039">Email</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
          		<input id="email" class="form-control col-md-12 col-xs-12" name="email" required="required" type="email">
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#258039">telp</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
          		<input id="telp" class="form-control col-md-12 col-xs-12" name="telp" required="required" type="number">
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#258039">jabatan</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
          		<input id="jabatan" class="form-control col-md-12 col-xs-12" name="jabatan" required="required" type="text">
            </div>
          </div><hr>
					<div class="card-block col-md-5 col-md-offset-5">
						<button type="reset" class="btn btn-warning btn-sm">Reset</button>
						<button type="submit" class="btn btn-primary btn-sm">Submit</button>
						{{ csrf_field() }}
					</div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-7 col-xs-12">
    <div class="x_panel" style="min-height:240px">
      <div class="x_title">
        <h3><li class="fa fa-folder-open"> </li> List principal</h3>
      </div>
      <div class="card-block">
				<table class="Table table-bordered">
					<thead>
						<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
							<th>No</th>
							<th>Suplier</th>
							<th>Name</th>
							<th>Email</th>
							<th>Telp</th>
							<th>Jabatan</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($principal as $principal)
						<tr>
							<td>{{$principal->id}}</td>
							<td>{{$principal->ms_supplier_principal_id}}</td>
							<td>{{$principal->nama_cp}}</td>
							<td>{{$principal->email_cp}}</td>
							<td>{{$principal->telepon_cp}}</td>
							<td>{{$principal->jabatan_cp}}</td>
							<td>{{$principal->is_active}}</td>
							<td></td>
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