@extends('admin.tempadmin')
@section('title', 'Data gudang')
@section('judulnya', 'Data Gudang')
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

<!-- Gudang -->
<div class="x_panel">
  <div class="x_title">
    <h3><li class="fa fa-list"> List Gudang</li></h3>
  </div>
  <div class="card-block">
    <a type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#add_gudang"><i class="fa fa-plus"></i> Tambah Gudang </a>
	  <div class="dt-responsive table-responsive">
      <table class="Table table-striped table-bordered nowrap">
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <th>ID</th>
            <th>Gudang</th>
            <th>Keterangan</th>
            <th class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
        @foreach($gudangs as $gudang)
          <tr>
            <td>{{ $gudang->id }}</td>
            <td>{{ $gudang->gudang }}</td>
            <td>{{ $gudang->keterangan }}</td>
            <td class="text-center">
              {!! Form::open(['method' => 'Delete', 'route' => ['gudang.destroy', $gudang->id]]) !!}
              <a class="btn-sm btn-primary" href="{{ route('gudang.edit',$gudang->id) }}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
              <button class="btn-sm btn-danger" onclick="return confirm('Hapus Gudang ?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></button>
              {!! Form::close() !!}
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Add New  -->
<div class="modal fade" id="add_gudang" role="dialog" aria-labelledby="EWBModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="EWBModalLabel"><i class="fa fa-plus"></i> Tambah Gudang</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('gudang.store') }}">
        <label for="" class="control-label">Gudang</label>
        <input class="form-control" id="gudang" name="gudang" placeholder="Gudang" value="{{ old('Gudang') }}" required />
        <label for="" class="control-label">Keterangan</label>
        <input class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan" value="{{ old('keterangan') }}" required />
        {{ csrf_field() }}                
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" type="submit"><i class="fa fa-plus"></i> Submit</button>
        <a type="button" class="btn btn-danger" data-dismiss="modal" class="fa fa-times"></i> BATAL</a>
        </form>    
      </div>  
    </div>
  </div>
</div>
{{-- selesai --}}
@endsection


@section('s')
<script type="text/javascript"></script>
@endsection