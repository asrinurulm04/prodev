@extends('pv.tempvv')
@section('title', 'List Allergen')
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

  <div class="col-md-12 col-xs-12">
    <div class="x_panel" style="min-height:240px">
      <div class="x_title">
        <h3><li class="fa fa-file-archive-o"> </li> List Allergen</h3>
      </div>
      <div class="card-block">
  			<form class="form-horizontal form-label-left" method="POST" action="{{ route('add_allergen') }}">
				<div class="form-group row">
          <label class="control-label col-md-2 col-sm-2 col-xs-12" style="color:#258039">Add New Allergen </label>
          <div class="col-md-8 col-sm-8 col-xs-12">
            <input id="allergen" class="form-control col-md-12 col-xs-12" name="allergen" required="required" type="text">
        		<?php $last = Date('j-F-Y'); ?>
            <input id="last" value="{{ $last }}" class="form-control col-md-12 col-xs-12" name="last" required="required" type="hidden">
          </div>
					<button class="btn btn-primary btn-sm" type="submit"><li class="fa fa-plus"></li> Submit</button>
      		{{ csrf_field() }}
        </div><hr>
				</form>
				<table class="Table table-bordered">
					<thead>
						<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
							<th width="5%">No</th>
							<th>Allergen</th>
							<th>Created Date</th>
							<th>Last Update</th>
							<th>User</th>
							<th width="8%">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($allergen as $all)
						<tr>
							<td class="text-center">{{$all->id}}</td>
							<td>{{$all->allergen}}</td>
							<td>{{$all->tgl_dibuat}}</td>
							<td>{{$all->tgl_update}}</td>
							<td>@if($all->id_user!=NULL){{$all->user->name}}@endif</td>
							<td class="text-center"><button class="btn btn-warning btn-sm" type="button" data-toggle="modal" data-target="#edit{{$all->id_allergen}}"><i class="fa fa-edit"></i></a></button></td>
							
								<!-- Edit Allergen -->
								<div class="modal fade" id="edit{{$all->id_allergen}}" role="dialog" aria-labelledby="EWBModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title" id="EWBModalLabel"><i class="fa fa-plus"></i> Edit
												<button type="button" class="close" data-dismiss="modal" edit-hidden="true">&times;</button></h4>
											</div>
											<div class="modal-body">
												<form method="POST" action="{{ route('edit_allergen',$all->id) }}">
												<label for="nama_produk" class="control-label">Allergen</label>
												<input class="form-control" id="allergen" value="{{$all->allergen}}" name="allergen" required />
												<?php $last = Date('j-F-Y'); ?>
												<input id="last" value="{{ $last }}" class="form-control col-md-12 col-xs-12" name="last" required="required" type="hidden">
												{{ csrf_field() }}     
											</div>
											<div class="modal-footer">
												<button class="btn btn-warning btn-sm" type="submit"><i class="fa fa-edit"></i> Edit</button>
												<a type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-ban"></i> Cencel</a>
												</form>
											</div>
										</div>
									</div>
								</div>
								<!-- Selesai -->
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