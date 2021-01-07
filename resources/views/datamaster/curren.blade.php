@extends('pv.tempvv')
@section('title', 'PRODEV|Data currency')
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

<!-- Currency -->
<div class="x_panel">
  <div class="x_title">
    <h3><li class="fa fa-list"> List Currency</li></h3>
  </div>
  <div class="card-block">
    <a type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#add_curren"><i class="fa fa-plus"></i> Add Currency </a>
	  <div class="dt-responsive table-responsive">
      <table class="Table table-striped table-bordered ">
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <th>ID</th>
            <th>Currency</th>
            <th>Harga</th>
            <th>Keterangan</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($currens as $curren)
          <tr>
            <td>{{ $curren->id }}</td>
            <td>{{ $curren->currency }}</td>
            <td>{{ $curren->harga }}</td>
            <td>{{ $curren->keterangan }}</td>
            <td class="text-center">
              <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit_curren{{ $curren->id }}"><i class="fa fa-edit"></i></a></button>
              <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus currency ?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></button>
              {!! Form::close() !!}
            </td>
          </tr>
          <!-- Add New  Currency-->
          <div class="modal fade" id="edit_curren{{ $curren->id }}" role="dialog" aria-labelledby="EWBModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="EWBModalLabel"><i class="fa fa-plus"></i> Edit Currency
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></h4>
                </div>
                <form method="POST" action="{{ route('curren.update',$curren->id) }}">
                  <div class="modal-body">
                    <label for="" class="control-label">Currency</label>
                    <input class="form-control" id="currency" name="currency" placeholder="Currency" value="{{ $curren->currency }}" required />
                    <label for="" class="control-label">Harga</label>
                    <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga" required value="{{ $curren->harga }}"/>
                    <label for="" class="control-label">Keterangan</label>
                    <input class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan" value="{{ $curren->keterangan }}" required />
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-plus"></i> Submit</button>
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                  </div>      
                </form>
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
<!-- Selesai -->

<!-- Add New  Currency-->
<div class="modal fade" id="add_curren" role="dialog" aria-labelledby="EWBModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="EWBModalLabel"><i class="fa fa-plus"></i> Add Currency
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('curren.store') }}">
        <label for="" class="control-label">Currency</label>
        <input class="form-control" id="currency" name="currency" placeholder="Currency" value="{{ old('currency') }}" required />
        <label for="" class="control-label">Harga</label>
        <input type="number" step=any class="form-control" id="harga" name="harga" placeholder="Harga" required value="{{ old('harga') }}"/>
        <label for="" class="control-label">Keterangan</label>
        <input class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan" value="{{ old('keterangan') }}" required />
        {{ csrf_field() }}
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-plus"></i> Submit</button>
        </form>
      </div>      
    </div>
  </div>
</div>
<!-- selesai -->
@endsection

@section('s')
<script type="text/javascript"></script>
@endsection