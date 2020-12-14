@extends('pv.tempvv')
@section('title', 'DataDepartement')
@section('judulhalaman','User Management')
@section('content')

@if (session('status'))
<div class="row">
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
</div>
@endif

<div class="x_panel">
  <div class="x_title">
    <h3><li class="fa fa-industry"> List Departement</li></h3>
  </div>
  <a type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#add_dept"><i class="fa fa-plus"></i> Tambah Departement</a>
  <div class="dt-responsive table-responsive">
    <table class="Table table-striped table-bordered nowrap">
      <thead>
        <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
          <th class="text-center">ID</th>
          <th class="text-center">Departement</th>
          <th class="text-center">Keterangan (Nama Departement) </th>
          <th class="text-center">Manager</th>
          <th class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
      @foreach ($depts as $dept)
        <tr>
          <td class="text-center">{{ $dept->id}}</td>
          <td class="text-center">{{ $dept->dept}}</td>
          <td class="text-center">{{ $dept->nama_dept}}</td>
          <td class="text-center">
            @foreach($users as $user)
							@if($user->id == $dept->manager_id)
							{{ $user->name}}
							@endif 
            @endforeach
          </td>
          <td class="text-center"> 
            <a class="btn-sm btn-primary" type="button" class="btn btn-info" data-toggle="modal" data-target="#edit_dept{{ $dept->id}}"><i class="fa fa-edit" data-toggle="tooltip" title="Edit"></i></a> &nbsp
            <a class="btn-sm btn-danger" onclick="return confirm('Are You Sure ?')" href="{{ route('deldept',$dept->id) }}" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>
          </td>
				</tr>
				<!-- Modal edit Departement -->
				<div class="modal fade" id="edit_dept{{ $dept->id}}" role="dialog" aria-labelledby="EWBModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title" id="EWBModalLabel"><i class="fa fa-plus"></i> Edit Departement {{ $dept->dept}}
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></h4>
							</div>
							<form method="POST" action="{{ route('storeupdatedept',$dept->id) }}">
								<div class="modal-body">
									<label for="nama_produk" class="control-label">Departement</label>
									<input class="form-control" id="dept" name="dept" value="{{ $dept->dept }}" required />
									<label for="nama_produk" class="control-label">Keterangan</label>
									<input class="form-control" id="nama_dept" name="nama_dept" value="{{ $dept->nama_dept }}" required />
									<label for="nama_produk" class="control-label">Manager</label>
									<select id="manager" name="manager" class="form-control">
										<option selected disabled>--> Select One <--<option>
										@foreach($users as $user) 
											@if($user->departement_id==$dept->id)
											<option value="{{  $user->id }}" {{ ( $user->id == $dept->manager_id ) ? ' selected' : '' }}>{{ $user->role->role }} - {{ $user->name }}</option>
											@endif
										@endforeach
									</select>
								</div>
								<div class="modal-footer">
									{{ csrf_field() }}
									{{ method_field('PATCH') }}
									<button class="btn btn-primary" type="submit"><i class="fa fa-edit"></i> Save</button>
									<a type="button" class="btn btn-danger" href="{{ route('dept') }}"><i class="fa fa-times"></i> Cencel</a>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- Selesai -->
      @endforeach
      </tbody>
    </table>
  </div>
</div>

<!-- Add New Departement -->
<div class="modal fade" id="add_dept" role="dialog" aria-labelledby="EWBModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="EWBModalLabel"><i class="fa fa-plus"></i> Tambah Departement
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></h4>
			</div>
			<form method="POST" action="{{ route('adddept') }}">
			<div class="modal-body">
				<label for="" class="control-label">Departement</label>
				<input class="form-control" id="dept" name="dept" placeholder="Ex. RKA" required />
				<label for="" class="control-label">Keterangan</label>
				<input class="form-control" id="nama_dept" name="nama_dept" placeholder="Ex. R&D Packaging and Service" required />
				<label for="" class="control-label">Manager</label><br>
				<select id="manager" name="manager" class="form-control">
					@foreach($users as $user) 
						@if($user->role->id=='12')
						<option value="{{  $user->id }}"">{{ $user->role->role}} - {{ $user->name }}</option>
						@endif
					@endforeach
				</select>
				{{ csrf_field() }}
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
				<button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
			</div>
			</form>
		</div>
	</div>
</div>
<!-- selesai -->
@endsection