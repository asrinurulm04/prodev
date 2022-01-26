@extends('layout.tempvv')
@section('title', 'PRODEV|Data Satuan')
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

<!-- Satuan -->
<div class="x_panel">
  <div class="x_title">
    <h3><li class="fa fa-list"> List Satuan</li></h3>
  </div>
  <div class="card-block">
  <a type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#add_satuan" id="tambah"><i class="fa fa-plus"></i> Tambah Satuan</a>
	  <div class="dt-responsive table-responsive">
      <table id="datatable" class="Table table-bordered">
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <th>ID</th>
            <th>Satuan</th>
            <th class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($satuans as $satuan)
          <tr>
            <td>{{ $satuan->id }}</td>
            <td>{{ $satuan->satuan }}</td>
            <td class="text-center">
              <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit_satuan{{ $satuan->id }}"><i class="fa fa-edit"></i></a></button>
              <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus Satuan ?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></button>
              {!! Form::close() !!}
            </td>
          </tr>
          <!-- Add New  -->
          <div class="modal fade" id="edit_satuan{{ $satuan->id }}" role="dialog" aria-labelledby="EWBModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="EWBModalLabel"><i class="fa fa-plus"></i> Edit Satuan
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></h4>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{ route('satuan.update', $satuan->id) }}">
                  <label for="" class="control-label">Satuan</label>
                  <input class="form-control" id="satuan" name="satuan" placeholder="Satuan" value="{{ $satuan->satuan }}" required />
                </div>
                <div class="modal-footer">
                  <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-plus"></i> Submit</button>
                  {{ csrf_field() }}
                  {{ method_field('PATCH') }}
                  </form>
                </div>   
              </div>
            </div>
          </div>
          <!-- selesai -->
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Add New  -->
<div class="modal fade" id="add_satuan" role="dialog" aria-labelledby="EWBModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="EWBModalLabel"><i class="fa fa-plus"></i> Add Satuan
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('satuan.store') }}">
        <label for="" class="control-label">Satuan</label>
        <input class="form-control" id="satuan" name="satuan" placeholder="Satuan" value="{{ old('Satuan') }}" required />
        {{ csrf_field() }}
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-plus"></i> Submit</button>
        </form>
      </div>   
    </div>
  </div>
</div>
{{-- selesai --}}
@endsection
@section('s')
    <link href="{{ asset('lib/advanced-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" />
    <script src="{{ asset('js/datatables.min.js')}}"></script>
@endsection