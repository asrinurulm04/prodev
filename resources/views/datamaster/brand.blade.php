@extends('admin.tempadmin')
@section('title', 'Data Brand')
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

<!-- BRAND -->
<div class="x_panel">
  <div class="x_title">
    <h3><li class="fa fa-list"> List Brand</li></h3>
  </div>
  <a type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#add_brand" id="tambah"><i class="fa fa-plus"></i> Tambah Brand</a>
  <div class="card-block">
    <div class="dt-responsive table-responsive">
      <table class="Table table-striped table-bordered nowrap">
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <th>ID</th>
            <th>Brand</th>
            <th>Created</th>
            <th>Updated</th>
            <th class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($brands as $brand)
          <tr>
            <td>{{ $brand->id }}</td>
            <td>{{ $brand->brand }}</td>
            <td>{{ $brand->created_at }}</td>
            <td>{{ $brand->updated_at }}</td>
            <td class="text-center">
              <a class="btn-sm btn-primary" type="button" class="btn btn-info" data-toggle="modal" data-target="#edit_brand{{ $brand->id}}"><i class="fa fa-edit" data-toggle="tooltip" title="Edit"></i></a> &nbsp
              <a class="btn-sm btn-danger" onclick="return confirm('Hapus Bahan Baku ?')" data-toggle="tooltip" title="Delete" href="{{ route('brand.destroy',$brand->id) }}"><i class="fa fa-trash-o"></i></a>
            </td>
          </tr>
            <!-- Edit Brand-->
            <div class="modal fade" id="edit_brand{{ $brand->id}}" role="dialog" aria-labelledby="EWBModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="EWBModalLabel"><i class="fa fa-plus"></i> Edit Brand {{ $brand->brand}}
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></h4>
                  </div>
                  <form method="POST" action="{{ route('brand.update',$brand->id) }}">
                  <div class="modal-body">
                    <label for="nama_produk" class="control-label">Brand</label>
                    <input class="form-control" id="brand" name=brand placeholder="Brand" value="{{ $brand->brand }}" required />
                  </div>
                  <div class="modal-footer">
                    {{ csrf_field() }}
                    <button class="btn btn-primary" type="submit"><i class="fa fa-edit"></i> Simpan Perubahan</button>
                    <a type="button" class="btn btn-danger" id="xx" href="{{ route('brand.index') }}"><i class="fa fa-times"></i> BATAL</a>
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

<!-- Add New Brand-->
<div class="modal fade" id="add_brand" role="dialog" aria-labelledby="EWBModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="EWBModalLabel"><i class="fa fa-plus"></i> Tambah Brand
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></h4>
      </div>
      <form method="POST" action="{{ route('brand.store') }}">
      <div class="modal-body">
        <label for="nama_produk" class="control-label">Brand</label>
        <input class="form-control" id="brand" name=brand placeholder="Brand" required />
        {{ csrf_field() }}     
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" type="submit"><i class="fa fa-plus"></i> Submit</button>
        <a type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> BATAL</a>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- selesai -->
@endsection

@section('s')
<script type="text/javascript"></script>
@endsection