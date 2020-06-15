@extends('admin.tempadmin')
@section('title', 'Data Kelompok')
@section('judulhalaman','Data Master')
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

<!-- Kelompok -->
<div class="card">
  <div class="card-header">
    <h5>List Kelompok</h5>
  </div>
  <div class="card-block">
    <a type="button" class="btn btn-info" data-toggle="modal" data-target="#add_kelompok"><i class="fa fa-plus"></i> Tambah Kelompok </a>
	  <div class="dt-responsive table-responsive">
      <table class="table table-striped table-bordered nowrap">
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <th>ID</th>
            <th>Kelompok</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        @foreach($kelompoks as $kelompok)
          <tr>
            <td>{{ $kelompok->id }}</td>
            <td>{{ $kelompok->nama }}</td>
            <td>
              {!! Form::open(['method' => 'Delete', 'route' => ['kelompok.destroy', $kelompok->id]]) !!}
              <a class="btn-sm btn-primary" href="{{ route('kelompok.edit',$kelompok->id) }}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
              <button class="btn-sm btn-danger" onclick="return confirm('Hapus Kelompok ?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></button>
              {!! Form::close() !!}
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6" id="add" style="background-color:#2f323a;display:none">
    <div class="form-panel" >
      <h4><i class="fa fa-plus"></i> Tambah Kelompok</h4>
      <form method="POST" action="{{ route('kelompok.store') }}">
        <label for="" class="control-label">Kelompok</label>
        <input class="form-control" id="Kelompok" name="kelompok" placeholder="kelompok" value="{{ old('kelompok') }}" required />
        {{ csrf_field() }}
        <br><br>
        <button class="btn btn-primary" type="submit"><i class="fa fa-plus"></i> Submit</button>
        <a type="button" class="btn btn-danger" id="xx" href="#"><i class="fa fa-times"></i> BATAL</a>
      </form>
    </div>
  </div>
</div>

<!-- Add New Kelompok-->
<div class="modal fade" id="add_kelompok" role="dialog" aria-labelledby="EWBModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="EWBModalLabel"><i class="fa fa-plus"></i> Tambah Kelompok
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('kelompok.store') }}">
        <label for="" class="control-label">Kelompok</label>
        <input class="form-control" id="Kelompok" name="kelompok" placeholder="kelompok" value="{{ old('kelompok') }}" required />
        {{ csrf_field() }}    
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" type="submit"><i class="fa fa-plus"></i> Submit</button>
        <a type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> BATAL</a>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
