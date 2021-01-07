@extends('pv.tempvv')
@section('title', 'PRODEV|Data Produksi')
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

<!-- Produksi -->
<div class="x_panel">
  <div class="x_title">
    <h3><li class="fa fa-list"> List Produksi</li></h3>
  </div>
  <div class="card-block">
    <a type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#add_produksi"><i class="fa fa-plus"></i> Tambah Produksi </a>
		<div class="dt-responsive table-responsive">
      <table class="Table table-striped table-bordered nowrap">
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <th>ID</th>
            <th>Produksi</th>
            <th>Keterangan</th>
            <th class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
        @foreach($produksis as $produksi)
          <tr>
            <td>{{ $produksi->id }}</td>
            <td>{{ $produksi->produksi }}</td>
            <td>{{ $produksi->keterangan }}</td>
            <td class="text-center">
              <button class="btn-primary btn-sm" data-toggle="modal" data-target="#edit_produksi{{ $produksi->id }}"><i class="fa fa-edit"></i></a></button>
              <button class="btn-sm btn-danger" onclick="return confirm('Hapus Produksi ?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></button>
              {!! Form::close() !!}
            </td>
          </tr>
          <!-- Add New  -->
          <div class="modal fade" id="edit_produksi{{ $produksi->id }}" role="dialog" aria-labelledby="EWBModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="EWBModalLabel"><i class="fa fa-plus"></i> Edit Produksi
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></h4>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{ route('produksi.update',$produksi->id) }}">
                    <label for="" class="control-label">Produksi</label>
                    <input class="form-control" id="Produksi" name="Produksi" placeholder="Produksi" value="{{ $produksi->produksi }}" required />
                    <label for="" class="control-label">Keterangan</label>
                    <input class="form-control" id="Keterangan" name="Keterangan" placeholder="Keterangan" value="{{ $produksi->keterangan }}" required />
                </div>
                <div class="modal-footer">
                  <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-edit"></i> Submit</button>
                  <a type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cencel</a>
                  {{ csrf_field() }}
                  {{ method_field('PATCH') }}
                  </form>
                </div>
              </div>
            </div>
          </div>
          {{-- selesai --}}
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Add New  -->
<div class="modal fade" id="add_produksi" role="dialog" aria-labelledby="EWBModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="EWBModalLabel"><i class="fa fa-plus"></i> Tambah Produksi
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('produksi.store') }}">
        <label for="" class="control-label">Produksi</label>
        <input class="form-control" id="Produksi" name="Produksi" placeholder="Produksi" value="{{ old('Produksi') }}" required />
        <label for="" class="control-label">Keterangan</label>
        <input class="form-control" id="Keterangan" name="Keterangan" placeholder="Keterangan" value="{{ old('keterangan') }}" required />
        {{ csrf_field() }}
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-plus"></i> Submit</button>
        <a type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> BATAL</a>
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